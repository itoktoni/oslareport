<?php

namespace Plugins;

use App\Facades\Model\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class Filter
{
    private static function getDataFilter($model = null)
    {
        $table = $model->getModel()->getTable();
        if (Cache::has('filter')) {
            $filter = Cache::get('filter');
        } else {
            // $filter = DB::table(ModelsFilter::getTable())->get();
            // Cache::put('filter', $filter, 3000);
        }

        if (! empty($filter)) {
            $data = $filter
                ->where('module', str_replace('_api', '', Route::currentRouteName()))
                ->where('table', $table)
                ->all();

            Cache::put('filter', $data);
            if (! empty($data)) {
                return $data;
            }
        }

        return false;
    }

    public static function getFilter($data)
    {
        $dataFilter = self::getDataFilter($data);

        if ($dataFilter) {
            $data = $data->when($dataFilter, function ($query) use ($dataFilter) {
                $query->where(function ($query) use ($dataFilter) {
                    foreach ($dataFilter as $filtering) {
                        switch ($filtering->custom) {
                            case 1:
                                if (is_string($filtering->value)) {
                                    $value = $filtering->value;
                                } else {
                                    $value = json_decode($filtering->value);
                                }
                                break;
                            case 0:
                                if (! request()->ajax() && request()->wantsJson()) {
                                    $auth = UserModel::where('api_token', request()->bearerToken())->first();
                                } else {
                                    $auth = Auth::user();
                                }
                                $value = $auth->{$filtering->value};
                                break;
                        }
                        if ($filtering->operator) {
                            $query->{$filtering->function}($filtering->field, $filtering->operator, $value);
                        } else {
                            $query->{$filtering->function}($filtering->field, $value);
                        }
                    }
                });
            });

        }

        return $data;
    }
}
