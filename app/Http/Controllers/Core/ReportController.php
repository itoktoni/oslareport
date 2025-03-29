<?php

namespace App\Http\Controllers\Core;

use App\Dao\Enums\Core\BooleanType;
use App\Http\Controllers\Controller;
use Coderello\SharedData\Facades\SharedData;
use Plugins\Template;

abstract class ReportController extends Controller
{
    public static $service;

    public $model;

    public static $template;

    public static $share = [];

    protected function beforeForm() {}

    protected function beforeCreate() {}

    protected function beforeUpdate($code) {}

    protected function share($data = [])
    {
        $status = BooleanType::getOptions();
        $view = [
            'status' => $status,
            'model' => false,
        ];

        return self::$share = array_merge($view, self::$share, $data);
    }

    public function getData()
    {
        $query = $this->model->dataRepository();

        return $query;
    }

    public function getCreate()
    {
        $this->beforeForm();
        $this->beforeCreate();

        return view(Template::form(SharedData::get('template')))->with($this->share());
    }
}
