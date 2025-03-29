<?php

namespace App\Services\Master;

use Plugins\Alert;
use Plugins\Notes;

class SingleService
{
    public function get($model, $code, $relation = false)
    {
        if (request()->wantsJson()) {
            return Notes::single($model->singleRepository($code, $relation));
        }

        return $model->singleRepository($code, $relation);
    }

    public function delete($model, $code)
    {
        $rules = ['code' => 'required'];
        request()->validate($rules, ['code.required' => 'Silahkan centang terlebih dahulu!']);

        $check = $model->deleteRepository($code);
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

    public function sort($model, $data)
    {
        $check = false;
        if ($data && $model) {
            foreach ($data as $key => $value) {
                $check = $model::find($key)->update([$model->field_sort() => $value]);
            }
        }

        $check = Notes::update($data);
        Alert::update();

        return $check;
    }
}
