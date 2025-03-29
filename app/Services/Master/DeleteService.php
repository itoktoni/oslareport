<?php

namespace App\Services\Master;

use Plugins\Alert;

class DeleteService
{
    public function delete($repository, $code)
    {
        $rules = ['code' => 'required'];
        request()->validate($rules, ['code.required' => 'Please select any data !']);

        $check = $repository->deleteRepository($code);

        if ($check['status']) {
            Alert::delete();
        } else {
            Alert::error($check['message']);
        }

        if (request()->wantsJson()) {

            return response()->json($check)->getData();
        }

        return $check;
    }
}
