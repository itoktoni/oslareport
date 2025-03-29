<?php

namespace App\Dao\Traits;

use App\Facades\Model\FilterModel;
use Coderello\SharedData\Facades\SharedData;
use Illuminate\Support\Facades\Cache;

trait ActiveTrait
{
    // abstract public function field_active();
    public function scopeActive($query)
    {
        if (Cache::has('filter')) {
            foreach (Cache::get('filter') as $filter) {
                if (SharedData::get('action_code') == $filter->{FilterModel::field_name()}) {
                    $value = $filter->{FilterModel::field_from_user()} ? auth()->user()->{$filter->{FilterModel::field_value()}} : $filter->{FilterModel::field_value()};
                    $query = $query->where($filter->{FilterModel::field_field()}, $filter->{FilterModel::field_operator()}, $value);
                }
            }
        }

        return $query;
    }
}
