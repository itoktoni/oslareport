<?php

namespace App\Http\Controllers\Core;

use App\Dao\Enums\Core\BooleanType;
use App\Dao\Enums\Core\MenuType;
use App\Facades\Model\LinkModel;
use App\Http\Requests\Core\LinkRequest;
use App\Services\Master\CreateService;
use App\Services\Master\SingleService;
use App\Services\Master\UpdateService;
use Plugins\Helper;
use Plugins\Response;

class LinkController extends MasterController
{
    public function __construct(LinkModel $model, SingleService $service)
    {
        $this->model = $model::getModel();
        self::$service = self::$service ?? $service;
        self::$is_core = true;
    }

    protected function beforeForm()
    {
        $status = BooleanType::getOptions();
        $type = MenuType::getOptions([
            MenuType::Internal,
            MenuType::External,
            MenuType::Menu,
        ]);
        $link = LinkModel::getOptions();

        $files = Helper::getControllerFile();

        self::$share = [
            'status' => $status,
            'type' => $type,
            'model' => false,
            'link' => $link,
            'file' => $files,
            'action' => [],
        ];
    }

    public function postCreate(LinkRequest $request, CreateService $service)
    {
        $data = $service->save($this->model, $request);

        return Response::redirectBack($data);
    }

    public function postUpdate($code, LinkRequest $request, UpdateService $service)
    {
        $data = $service->update($this->model, $request, $code);
        if($data['status'])
        {
            return Response::redirectTo(moduleRoute(moduleCode('getUpdate'), ['code' => $data['data']->field_primary]));
        }

        return Response::redirectBack($data);
    }

    public function getUpdate($code)
    {
        $this->beforeForm();
        $this->beforeUpdate($code);

        $data = $this->get($code);
        $action = Helper::getFunction($data->field_controller, $data->field_primary) ?? [];

        return moduleView(modulePathForm(path: self::$is_core), $this->share([
            'model' => $data,
            'action' => $action,
        ]));
    }
}
