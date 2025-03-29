<?php

namespace App\Http\Controllers\Core;

use App\Dao\Enums\Core\BooleanType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Core\DeleteRequest;
use App\Services\Master\DeleteService;
use Plugins\Response;

class MasterController extends Controller
{
    public static $service;

    public $model;

    public static $template;

    public static $is_core = false;

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

    public function getDelete()
    {
        $code = request()->get('code');
        $data = self::$service->delete($this->model, $code);

        return Response::redirectBack($data);
    }

    public function postDelete(DeleteRequest $request, DeleteService $service)
    {
        $code = $request->get('code');
        $data = $service->delete($this->model, $code);

        return Response::redirectBack($data);
    }

    public function getTable()
    {
        $data = $this->getData();

        return moduleView(modulePathTable(core: self::$is_core), [
            'data' => $data,
            'fields' => $this->model::getModel()->getShowField(),
        ]);
    }

    public function postTable()
    {
        if (request()->exists('delete')) {
            $code = array_unique(request()->get('code'));
            $data = self::$service->delete($this->model, $code);
        }

        if (request()->exists('sort')) {
            $sort = array_unique(request()->get('sort'));
            $data = self::$service->sort($this->model, $sort);
        }

        return Response::redirectBack($data);
    }

    public function getCreate()
    {
        $this->beforeForm();
        $this->beforeCreate();

        return moduleView(modulePathForm(path: self::$is_core), $this->share());
    }

    public function getUpdate($code)
    {
        $this->beforeForm();
        $this->beforeUpdate($code);

        return moduleView(modulePathForm(path: self::$is_core), $this->share([
            'model' => $this->get($code),
        ]));
    }

    public function get($code = null, $relation = null)
    {
        $relation = $relation ?? request()->get('relation');
        if ($relation) {
            return self::$service->get($this->model, $code, $relation);
        }

        return self::$service->get($this->model, $code);
    }
}
