<?php

namespace App\Services\Master;

use Plugins\Alert;

class CreateService
{
    public function save($model, $data)
    {
        $check = false;
        try {
            $check = $model->saveRepository($data->all());
            if (isset($check['status']) && $check['status']) {

                Alert::create();
            } else {
                $message = env('APP_DEBUG') ? $check['data'] : $check['message'];
                Alert::error($message);
            }
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());

            return $th->getMessage();
        }

        return $check;
    }
}
