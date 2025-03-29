<?php

namespace Plugins;

use Coderello\SharedData\Facades\SharedData;

class Views
{
    public static function create($page = 'master', $folder = 'system')
    {
        return ucfirst($folder).'::page.'.Helper::snake($page).'.create';
    }

    public static function update($page = 'master', $folder = 'system')
    {
        return ucfirst($folder).'::page.'.Helper::snake($page).'.update';
    }

    public static function index($page = 'master', $folder = 'system')
    {
        return ucfirst($folder).'::page.'.Helper::snake($page).'.data';
    }

    public static function show($page = 'master', $folder = 'system')
    {
        return ucfirst($folder).'::page.'.Helper::snake($page).'.show';
    }

    public static function backend($file = false)
    {
        $path = 'backend.'.env('TEMPLATE_ADMIN', 'default').'.';

        return $file ? $path.$file : $path.'.layout';
    }

    public static function include($page, $folder = false)
    {
        $folder = $folder ? $folder : config('folder');

        return ucfirst($folder).'::page.'.Helper::snake($page).'.form';
    }

    public static function action($page = 'master', $folder = 'system')
    {
        return ucfirst($folder).'::page.'.Helper::snake($page).'.actions';
    }

    public static function checkbox($page = 'master', $folder = 'system')
    {
        return ucfirst($folder).'::page.'.Helper::snake($page).'.checkbox';
    }

    public static function pdf($page = 'master', $folder = 'system', $name = 'default')
    {
        return ucfirst($folder).'::page.'.Helper::snake($page).'.'.$name;
    }

    public static function form($form, $page = 'master', $folder = 'system')
    {
        return ucfirst($folder).'::page.'.Helper::snake($page).'.'.Helper::snake($form);
    }

    public static function option($option, $placeholder = true, $raw = false, $cache = false)
    {
        $data = Helper::filter($option->dataRepository())->get();

        if (empty($data)) {
            return [];
        }

        if (! $raw) {
            $data = $data->pluck($option->searching, (string) $option->getKeyName());
        }
        if ($placeholder) {
            $data = $data->prepend(__('- Select '.Helper::getNameTable($option->getTable()).' -'), '');
        }

        return $data;
    }

    public static function status($data, $placeholder = false)
    {
        $status = collect($data)->map(function ($item) {
            if (is_array($item)) {
                return $item[0];
            }

            return $item;
        });
        if ($placeholder) {
            $status = $status->prepend(__('- Select Option -'), '');
        }

        return $status;
    }

    public static function createStatus($value, $option = false)
    {
        $color = 'default';
        $label = 'Unknows';

        $label = $option[$value][0] ?? $label;
        $color = $option[$value][1] ?? $color;

        return '<span class="btn btn-xs btn-block btn-'.$color.'">'.$label.'</span>';
    }

    public static function permision($value)
    {
        return SharedData::get('route').'.'.$value;
    }

    public static function uiiShort($value)
    {
        return strtoupper(substr($value, 0, 8)) ?? '';
    }

    public static function randomColorPart()
    {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

    public static function noImage()
    {
        return url('storage/noimage.png');
    }

    public static function randomColor()
    {
        return self::randomColorPart().self::randomColorPart().self::randomColorPart();
    }

    public static function formatLocation($location_name, $building_name, $floor_name = false)
    {
        $string = 'Loc : '.$location_name.PHP_EOL;
        if ($building_name) {
            $string = $string.$building_name.PHP_EOL;
        }
        if ($floor_name) {
            $string = $string.$floor_name;
        }

        return $string;
    }
}
