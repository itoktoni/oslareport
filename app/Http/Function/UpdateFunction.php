<?php

namespace App\Http\Function;

use App\Http\Requests\Core\GeneralRequest;
use App\Services\Master\UpdateService;
use Plugins\Response;

trait UpdateFunction
{
    public function postUpdate($code, GeneralRequest $request, UpdateService $service)
    {
        $data = $service->update($this->model, $request, $code);

        return Response::redirectBack($data);
    }
}
