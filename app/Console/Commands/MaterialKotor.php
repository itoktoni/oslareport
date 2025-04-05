<?php

namespace App\Console\Commands;

use App\Dao\Enums\Core\SyncStatusType;
use App\Dao\Models\Core\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MaterialKotor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'material:kotor {--day=7}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'untuk mengirimkan whatsapp otomatis';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function deletePeriodeDays($day = 7)
    {
        return <<<SQL
        -- TRUNCATE TABLE data_kotor;
        DELETE FROM data_kotor WHERE tanggal >= ( CURDATE() - INTERVAL $day DAY )
        SQL;
    }

    private function baseQuery($day = 7)
    {
        return <<<SQL
        SELECT
            CONCAT(
                transaksi_id_rs,
                transaksi_id_ruangan,
                detail_id_jenis,
                DATE(transaksi_created_at)
            ) AS id,
            transaksi_id_rs AS rs_id,
            transaksi_id_ruangan AS ruangan_id,
            detail_id_jenis AS jenis_id,
            DATE(transaksi_created_at) AS tanggal,
            COUNT( transaksi_rfid ) AS qty
        FROM
            transaksi
            JOIN detail on detail_rfid = transaksi_rfid
        WHERE
        DATE(transaksi_created_at) >= ( CURDATE() - INTERVAL $day DAY )
            AND transaksi_id_ruangan IS NOT NULL
            AND transaksi_status = 1 -- KOTOR
        GROUP BY
            transaksi_id_rs,
            transaksi_id_ruangan,
            detail_id_jenis,
            DATE(transaksi_created_at)
        SQL;
    }

    private function getAlreadySync($day = 7)
    {
        $total_material = DB::connection('report')
            ->table('data_kotor')
            ->selectRaw('SUM(qty) as qty')
            ->where('tanggal', '>=', Carbon::now()->subDays($day)->format('Y-m-d'))
            ->first();

        $total_transaksi = DB::connection('report')
            ->table('transaksi')
            ->selectRaw('COUNT(transaksi_rfid) as qty')
            ->where('transaksi_status', 1)
            ->whereNotNull('transaksi_id_ruangan')
            ->whereDate('transaksi_created_at', '>=', Carbon::now()->subDays($day))
            ->first();

        return $total_material->qty == $total_transaksi->qty;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $day = $this->option('day');

        if(Cache::get('sync') == SyncStatusType::Pending)
        {
            $this->info("Proses Start");

            $sql = "

            -- create table if not exists
            CREATE TABLE IF NOT EXISTS data_kotor AS
            {$this->baseQuery($day)};

            -- TRUNCATE TABLE data_kotor;
            {$this->deletePeriodeDays($day)};

            -- Insert data from another table
            INSERT INTO data_kotor
            {$this->baseQuery($day)};

            ";

            $done = DB::connection('report')->unprepared($sql);
            if($done)
            {
                Cache::put('sync', SyncStatusType::Sync);
                Cache::put('last_sync_time', now());
            }

            Log::info($done);
            $this->info("Proses Done");
        }
        else
        {
            $lastSyncTime = Cache::get('last_sync_time');
            $needsSync = Carbon::parse($lastSyncTime)->diffInMinutes(now()) > 5;

            if($needsSync)
            {
                if($this->getAlreadySync())
                {
                    $this->info("Already sync total");
                    Cache::put('sync', SyncStatusType::Sync);
                }
                else
                {
                    $this->info("Sync Time");
                    Cache::put('sync', SyncStatusType::Pending);
                }
            }
            else
            {
                $this->info("Already Sync");
                Cache::put('sync', SyncStatusType::Sync);
            }
        }
    }
}
