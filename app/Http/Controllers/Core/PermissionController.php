<?php

namespace App\Http\Controllers\Core;

use App\Dao\Enums\Core\LevelType;
use App\Facades\Model\PermisionModel;
use App\Facades\Model\RoleModel;
use App\Facades\Model\UserModel;
use App\Http\Function\CreateFunction;
use App\Http\Function\UpdateFunction;
use App\Http\Requests\Core\SortRequest;
use App\Services\Master\SingleService;
use Plugins\Core;
use Plugins\Helper;
use Plugins\Response;

class PermissionController extends MasterController
{
    use CreateFunction;
    use UpdateFunction;

    public function __construct(PermisionModel $model, SingleService $service)
    {
        $this->model = $model::getModel();
        self::$service = self::$service ?? $service;
        self::$is_core = true;
    }

    protected function beforeForm()
    {
        $user = UserModel::getOptions();
        $level = LevelType::getOptions();
        $role = RoleModel::getOptions();
        $files = Helper::getControllerFile();

        self::$share = [
            'level' => $level,
            'user' => $user,
            'role' => $role,
            'model' => false,
            'file' => $files,
            'action' => [],
        ];
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

        $data = $this->get($code, ['has_user']);
        $module = Core::getControllerName($data->field_controller);

        $data_action = Core::getMethod($data->field_controller, $module) ?? [];
        $action = $data_action->pluck('primary', 'action')->toArray();

        return moduleView(modulePathForm(path: self::$is_core), $this->share([
            'model' => $data,
            'action' => array_merge($action, [$module.'.empty' => 'Empty Data', $module.'.sort' => 'Sort Data']),
        ]));
    }
}
