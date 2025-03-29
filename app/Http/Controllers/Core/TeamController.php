<?php

namespace App\Http\Controllers\Core;

use App\Facades\Model\TeamModel;
use App\Facades\Model\UserModel;
use App\Http\Function\CreateFunction;
use App\Http\Function\UpdateFunction;
use App\Http\Requests\Core\GeneralRequest;
use App\Services\Core\UpdateTeamService;
use App\Services\Master\SingleService;
use Plugins\Response;

class TeamController extends MasterController
{
    use CreateFunction;
    use UpdateFunction;

    public function __construct(TeamModel $model, SingleService $service)
    {
        self::$service = self::$service ?? $service;
        $this->model = $model::getModel();
        self::$is_core = true;
    }

    protected function beforeForm()
    {
        $user = UserModel::getOptions();

        self::$share = [
            'user' => $user,
        ];
    }

    public function getUpdate($code)
    {
        $this->beforeForm();

        $data = $this->get($code, ['has_lead']);
        $selected = $data->has_user->pluck('id') ?? [];

        return moduleView(modulePathForm(path: self::$is_core), $this->share([
            'model' => $data,
            'selected' => $selected,
        ]));
    }

    public function postUpdate($code, GeneralRequest $request, UpdateTeamService $service)
    {
        $data = $service->update($this->model, $request, $code);

        return Response::redirectBack($data);
    }
}
