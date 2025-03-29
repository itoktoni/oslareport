<?php

namespace Plugins;

use App\Dao\Enums\Core\RoleLevel;
use Coderello\SharedData\Facades\SharedData;
use Collective\Html\FormFacade as Form;
use Illuminate\Support\Str;

class Template
{
    public static $template;

    public function __construct()
    {
        self::$template = config('template.template');
    }

    public static function ajax()
    {
        return request()->ajax() ? 'pages.master.modal' : 'pages.master.content';
    }

    public static function getControllerName($class)
    {
        $controller = (new \ReflectionClass($class))->getShortName();
        $clean = Str::replaceLast('Controller', '', $controller);

        return Str::snake($clean);
    }

    public static function master($template = 'admin')
    {
        if (request()->ajax()) {
            return 'layouts.modal';
        }

        return 'layouts.'.$template;
    }

    public static function table($template = false)
    {
        if ($template) {
            return 'pages.'.$template.'.table';
        }

        return 'pages.'.self::$template.'.table';
    }

    public static function print($template = false, $name = false)
    {
        if ($name) {
            return 'pages.'.$template.'.'.$name;
        }

        return 'pages.'.$template.'.data';
    }

    public static function form($template = false, $name = false)
    {
        if ($template && $name) {
            return 'pages.'.$template.'.'.$name;
        }

        if ($name) {
            return 'pages.'.self::$template.'.'.$name;
        }

        if ($template) {
            return 'pages.'.$template.'.form';
        }

        return 'pages.'.$template.'.'.$name;
    }

    public static function isMobile()
    {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
        |fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER['HTTP_USER_AGENT']);
    }

    public static function tableResponsive()
    {
        return self::isMobile() ? 'table-responsive-stack' : 'table-responsive';
    }

    public static function extractColumn($value)
    {
        $string = '';
        if ($value->class) {
            $string = ' class='.$value->class;
        }
        if ($value->width) {
            $string = $string.'style=width:'.$value->width;
        }

        return $string;
    }

    public static function components($value)
    {
        return 'components.'.$value;
    }

    public static function form_table()
    {
        return Form::open([
            'url' => route(SharedData::get('route').'.getTable'),
            'class' => '', 'method' => 'GET',
        ]);
    }

    public static function form_report($action = false)
    {
        $name = $action ? SharedData::get('route').'.'.$action : SharedData::get('route').'.getPrint';

        return Form::open([
            'url' => route($name),
            'class' => 'form-horizontal needs-validation',
            'novalidate',
            'method' => 'GET',
            'target' => '_blank',
        ]);
    }

    public static function form_open($model, $action = false)
    {
        if ($model) {
            $name = $action ? SharedData::get('route').'.'.$action : SharedData::get('route').'.postUpdate';

            return Form::model($model, [
                'route' => [
                    $name,
                    'code' => $model->{$model->getKeyName()},
                ],
                'class' => 'form-horizontal needs-validation',
                'files' => true,
                'novalidate',
            ]);
        } else {
            $name = $action ? SharedData::get('route').'.'.$action : SharedData::get('route').'.postCreate';

            return Form::open([
                'url' => route($name),
                'class' => 'form-submit form-horizontal needs-validation',
                'files' => true,
                'novalidate',
            ]);
        }
    }

    public static function form_close()
    {
        return Form::close();
    }

    public static function text($name, $label = null, $value = null)
    {
        return Form::text($name, $value, [
            'class' => 'form-control',
            'id' => 'brand_name',
            'placeholder' => __($label) ?? __('* Wajib diisi'),
        ]);
    }

    public static function number($name, $value = null)
    {
        return Form::number($name, $value, [
            'class' => 'form-control',
            'id' => 'brand_name',
            'placeholder' => '* Wajib diisi',
        ]);
    }

    public static function textarea($name, $value = null, $rows = 5)
    {
        return Form::textarea($name, $value, [
            'class' => 'form-control h-auto',
            'id' => 'brand_name',
            'placeholder' => __('* Wajib diisi'),
            'rows' => $rows,
        ]);
    }

    public static function isUser()
    {
        return auth()->user()->type == RoleLevel::Pengguna;
    }

    public static function isTeknisi()
    {
        return auth()->user()->type == RoleLevel::Teknisi;
    }

    public static function isVendor()
    {
        return auth()->user()->type == RoleLevel::Teknisi && ! empty(auth()->user()->vendor);
    }

    public static function isAdmin()
    {
        return auth()->user()->type == RoleLevel::Admin;
    }

    public static function isDeveloper()
    {
        return auth()->user()->type == RoleLevel::Developer;
    }

    public static function greatherAdmin()
    {
        return true;

        return auth()->user()->type >= RoleLevel::Admin;
    }
}
