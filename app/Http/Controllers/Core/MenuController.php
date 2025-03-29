<?php

namespace App\Http\Controllers\Core;

use App\Dao\Enums\Core\BooleanType;
use App\Dao\Enums\Core\MenuType;
use App\Facades\Model\LinkModel;
use App\Facades\Model\MenuModel;
use App\Http\Requests\Core\MenuRequest;
use App\Http\Requests\Core\SortRequest;
use App\Services\Core\UpdateMenuService;
use App\Services\Master\CreateService;
use App\Services\Master\SingleService;
use Plugins\Helper;
use Plugins\Response;

class MenuController extends MasterController
{
    public function __construct(MenuModel $model, SingleService $service)
    {
        $this->model = $model::getModel();
        self::$service = self::$service ?? $service;
        self::$is_core = true;
    }

    protected function beforeForm()
    {
        $status = BooleanType::getOptions();
        $type = MenuType::getOptions();
        $link = LinkModel::getOptions();

        $files = Helper::getControllerFile();

        self::$share = [
            'status' => $status,
            'type' => $type,
            'model' => false,
            'link' => $link,
            'file' => $files,
            'action' => [

            ],
        ];
    }

    public function postCreate(MenuRequest $request, CreateService $service)
    {
        $data = $service->save($this->model, $request);

        return Response::redirectBack($data);
    }

    public function postUpdate($code, MenuRequest $request, UpdateMenuService $service)
    {
        $data = $service->update($this->model, $request, $code);
        if($data['status'])
        {
            return Response::redirectTo(moduleRoute(moduleCode('getUpdate'), ['code' => $data['data']->field_primary]));
        }

        return Response::redirectBack($data);
    }

    public function postSort(SortRequest $request)
    {
        $data = self::$service->sort($request);

        return Response::redirectBack($data);
    }

    public function getUpdate($code)
    {
        $this->beforeForm();
        $this->beforeUpdate($code);

        $data = $this->get($code, ['has_link']);
        $selected = $data->has_link->pluck('system_link_code') ?? [];

        $action = [];
        if ($data->field_type == MenuType::Menu) {
            $action = Helper::getFunction($data->field_controller, $data->field_primary);
        }

        return moduleView(modulePathForm(path: self::$is_core), $this->share([
            'model' => $data,
            'selected' => $selected,
            'action' => $action,
        ]));
    }
}
