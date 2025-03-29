<?php

namespace App\Http\Controllers\Core;

use App\Dao\Models\Core\SystemMenu;
use App\Facades\Model\GroupModel;
use App\Http\Requests\Core\GroupsRequest;
use App\Services\Core\UpdateGroupService;
use App\Services\Master\CreateService;
use App\Services\Master\SingleService;
use Plugins\Response;

class GroupsController extends MasterController
{
    public function __construct(GroupModel $model, SingleService $service)
    {
        $this->model = $model::getModel();
        self::$service = self::$service ?? $service;
        self::$is_core = true;
    }

    public function postCreate(GroupsRequest $request, CreateService $service)
    {
        $data = $service->save($this->model, $request);

        return Response::redirectBack($data);
    }

    public function postUpdate($code, GroupsRequest $request, UpdateGroupService $service)
    {
        $data = $service->update($this->model, $request, $code);

        return Response::redirectBack($data);
    }

    protected function beforeForm()
    {

        $menu = SystemMenu::getOptions();

        self::$share = [
            'menu' => $menu,
        ];
    }

    public function getUpdate($code)
    {
        $this->beforeForm();
        $this->beforeUpdate($code);

        $data = $this->get($code, ['has_menu', 'has_menu.has_link']);
        $selected = $data->has_menu->pluck('system_menu_code') ?? [];

        return moduleView(modulePathForm(path: self::$is_core), $this->share([
            'model' => $data,
            'selected' => $selected,
        ]));
    }
}
