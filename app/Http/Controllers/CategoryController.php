<?php

namespace App\Http\Controllers;

use App\Facades\Model\CategoryModel;
use App\Http\Controllers\Core\MasterController;
use App\Http\Function\CreateFunction;
use App\Http\Function\UpdateFunction;
use App\Services\Master\SingleService;

class CategoryController extends MasterController
{
    use CreateFunction;
    use UpdateFunction;

    public function __construct(CategoryModel $model, SingleService $service)
    {
        self::$service = self::$service ?? $service;
        $this->model = $model::getModel();
    }
}
