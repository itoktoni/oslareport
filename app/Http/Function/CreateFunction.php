<?php

namespace App\Http\Function;

use App\Http\Requests\Core\GeneralRequest;
use App\Services\Master\CreateService;
use Plugins\Response;

trait CreateFunction
{
    public function postCreate(GeneralRequest $request, CreateService $service)
    {
        $data = $service->save($this->model, $request);
        return Response::redirectBack($data);
    }
}
