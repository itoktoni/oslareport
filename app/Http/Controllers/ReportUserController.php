<?php

namespace App\Http\Controllers;

use App\Facades\Model\UserModel;
use App\Http\Controllers\Core\ReportController;
use App\Jobs\JobExportCsvUser;
use Illuminate\Http\Request;

class ReportUserController extends ReportController
{
    public $data;

    public function __construct(UserModel $model)
    {
        $this->model = $model::getModel();
    }

    public function getData()
    {
        $query = $this->model->dataRepository();

        return $query;
    }

    public function getPrint(Request $request)
    {
        set_time_limit(0);

        $this->data = $this->getData($request);

        return moduleView(modulePathPrint(), $this->share([
            'data' => $this->data,
        ]));
    }
}
