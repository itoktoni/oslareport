<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Laravie\SerializesQuery\Eloquent;
use Spatie\SimpleExcel\SimpleExcelWriter;

class JobExportCsvUser implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public $fileName,
        public $query,
        public $chunkIndex,
        public $chunkSize,
        public $delimiter
    ) {}

    private function getHeader()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
        ];
    }

    public function handle()
    {
        $query = Eloquent::unserialize($this->query)
            ->select(array_keys($this->getHeader()));

        if ($this->chunkIndex == 1) {
            $data = $query->get();

            if (! empty($data)) {
                $excel = SimpleExcelWriter::create($this->fileName, delimiter: $this->delimiter);
                $excel->addHeader(array_values($this->getHeader()));

                foreach ($data as $item) {
                    $excel->addRow($item->toArray());
                }
            }

        } else {

            if (! file_exists($this->fileName)) {

                SimpleExcelWriter::create($this->fileName, delimiter: $this->delimiter)
                    ->addHeader(array_values($this->getHeader()));
            }

            $users = $query
                ->orderBy('id', 'asc')
                ->skip(($this->chunkIndex - 1) * $this->chunkSize)
                ->take($this->chunkSize)
                ->get()
                ->map(function ($user) {
                    return [
                        $user->id,
                        $user->name,
                        $user->email,
                    ];
                });

            $file = $this->fileName;
            $open = fopen($file, 'a+');

            foreach ($users as $user) {
                fputcsv($open, $user, env('CSV_DELIMITER', ','));
            }

            fclose($open);
        }

    }

    private function usersGenerator($users)
    {
        foreach ($users as $user) {
            yield $user;
        }
    }

    public function middleware()
    {
        return [new WithoutOverlapping($this->chunkIndex)];
    }
}
