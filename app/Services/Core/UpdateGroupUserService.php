<?php

namespace App\Services\Core;

use App\Http\Services\Master\UpdateService;
use Plugins\Alert;

class UpdateGroupUserService extends UpdateService
{
    public function update($repository, $data, $code)
    {
        $check = $repository->updateRepository($data->all(), $code);
        if ($check['status']) {

            $getData = $check['data'] ?? [];
            $getData->connection_group_module()->sync($data->get('groups'));
        }

        if ($check['status']) {
            Alert::update();
        } else {
            Alert::error($check['message']);
        }

        return $check;
    }
}
