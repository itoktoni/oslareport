<?php

namespace Plugins;

use App\Dao\Models\History as ModelsHistory;

class History
{
    public static function log($rfid, $status, $message = null)
    {
        ModelsHistory::create([
            ModelsHistory::field_name() => $rfid,
            ModelsHistory::field_status() => $status,
            ModelsHistory::field_created_at() => date('Y-m-d H:i:s'),
            ModelsHistory::field_created_by() => auth()->user()->name,
            ModelsHistory::field_description() => json_encode($message),
        ]);
    }

    public static function bulk($rfid, $status, $message = null)
    {
        $log = [];
        foreach ($rfid as $item) {
            $log[] = [
                ModelsHistory::field_name() => $item,
                ModelsHistory::field_status() => $status,
                ModelsHistory::field_created_by() => auth()->user()->name ?? 'System',
                ModelsHistory::field_created_at() => date('Y-m-d H:i:s'),
                ModelsHistory::field_description() => json_encode($message),
            ];
        }

        if (! empty($log)) {

            foreach (array_chunk($log, env('TRANSACTION_CHUNK')) as $save_log) {
                ModelsHistory::insert($save_log);
            }

        }
    }
}
