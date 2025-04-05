<?php

namespace App\Console\Commands;

use App\Dao\Enums\Core\SyncStatusType;
use App\Dao\Models\Core\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SummaryData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'summary:data {--day=7}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'untuk membuat summary data';

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
        DELETE FROM data_kotor WHERE tanggal >= ( CURDATE() - INTERVAL $day DAY );
        DELETE FROM data_bersih WHERE tanggal >= ( CURDATE() - INTERVAL $day DAY );
        SQL;
    }

    private function baseQueryBersih($day = 7)
    {
        return <<<SQL
        SELECT
            CONCAT(
                transaksi_rs_ori,
                COALESCE(transaksi_id_ruangan, '000'),
                COALESCE(transaksi_id_jenis, '000'),
                transaksi_report
            ) AS id,
            transaksi_rs_ori AS rs_id,
            COALESCE(transaksi_id_ruangan, '000') AS ruangan_id,
            COALESCE(transaksi_id_jenis, '000') AS jenis_id,
            transaksi_report AS tanggal,
            transaksi_bersih AS status,
            COUNT( transaksi_rfid ) AS qty
        FROM
            transaksi
        WHERE
            transaksi_report >= ( CURDATE() - INTERVAL $day DAY )
            AND transaksi_bersih IN (4,5,6) -- BERSIH
            AND transaksi_delivery IS NOT NULL
        GROUP BY
            transaksi_rs_ori,
            transaksi_id_ruangan,
            transaksi_id_jenis,
            transaksi_bersih,
            transaksi_report;

        SQL;
    }

    private function baseQueryKotor($day = 7)
    {
        return <<<SQL
        SELECT
            CONCAT(
                transaksi_id_rs,
                COALESCE(transaksi_id_ruangan, '000'),
                COALESCE(transaksi_id_jenis, '000'),
                DATE(transaksi_created_at)
            ) AS id,
            transaksi_id_rs AS rs_id,
            COALESCE(transaksi_id_ruangan, '000') AS ruangan_id,
            COALESCE(transaksi_id_jenis, '000') AS jenis_id,
            DATE(transaksi_created_at) AS tanggal,
            transaksi_status AS status,
            COUNT( transaksi_rfid ) AS qty
        FROM
            transaksi
        WHERE
            DATE(transaksi_created_at) >= ( CURDATE() - INTERVAL $day DAY )
            AND transaksi_status IN (1,2,3) -- KOTOR
        GROUP BY
                transaksi_id_rs,
                transaksi_id_ruangan,
                transaksi_id_jenis,
                transaksi_status,
                DATE(transaksi_created_at);

        SQL;
    }

    private function getAlreadySync($day = 7)
    {
        $summary_kotor = DB::connection('report')
            ->table('data_kotor')
            ->selectRaw('SUM(qty) as qty')
            ->where('tanggal', '>=', Carbon::now()->subDays($day)->format('Y-m-d'))
            ->first();

        $transaksi_kotor = DB::connection('report')
            ->table('transaksi')
            ->selectRaw('COUNT(transaksi_rfid) as qty')
            ->whereIN('transaksi_status', [1,2,3])
            ->whereDate('transaksi_created_at', '>=', Carbon::now()->subDays($day)->format('Y-m-d'))
            ->first();

        $summary_bersih = DB::connection('report')
            ->table('data_bersih')
            ->selectRaw('SUM(qty) as qty')
            ->where('tanggal', '>=', Carbon::now()->subDays($day)->format('Y-m-d'))
            ->first();

        $transaksi_bersih = DB::connection('report')
            ->table('transaksi')
            ->selectRaw('COUNT(transaksi_rfid) as qty')
            ->whereIn('transaksi_bersih', [4,5,6])
            ->where('transaksi_report', '>=', Carbon::now()->subDays($day)->format('Y-m-d'))
            ->whereNotNull('transaksi_delivery')
            ->first();

        return ($summary_kotor->qty == $transaksi_kotor->qty) && ($summary_bersih->qty == $transaksi_bersih->qty);
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
        // if(true)
        {
            $this->info("Proses Start");

            $sql = "

            -- create table if not exists
            CREATE TABLE IF NOT EXISTS data_kotor AS
            {$this->baseQueryKotor($day)}

            CREATE TABLE IF NOT EXISTS data_bersih AS
            {$this->baseQueryBersih($day)}

            -- TRUNCATE TABLE;
            {$this->deletePeriodeDays($day)}

            -- Insert data from another table
            INSERT INTO data_kotor
            {$this->baseQueryKotor($day)}

            INSERT INTO data_bersih
            {$this->baseQueryBersih($day)}

            ";

            Log::info($sql);

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
            $needsSync = true;

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
