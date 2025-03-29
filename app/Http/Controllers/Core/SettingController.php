<?php

namespace App\Http\Controllers\Core;

use App\Actions\ActionSaveSetting;
use App\Dao\Enums\Core\BooleanType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Core\SettingRequest;
use App\Services\Core\CreateSettingService;
use Plugins\Response;

class SettingController extends Controller
{
    protected function share($data = [])
    {
        $view = [
            'model' => false,
            'active' => BooleanType::getOptions(),
        ];

        return array_merge($view, $data);
    }

    public function getCreate()
    {
        return moduleView(modulePathForm(path: true), $this->share());
    }

    public function postCreate(SettingRequest $request, CreateSettingService $service)
    {
        $data = $service->save($request);

        return Response::redirectBack($data);
    }
}
