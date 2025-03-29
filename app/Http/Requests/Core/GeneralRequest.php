<?php

namespace App\Http\Requests\Core;

use App\Dao\Traits\ValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class GeneralRequest extends FormRequest
{
    use ValidationTrait;

    public $model;

    public function __construct()
    {
        $this->model = request()->route()->getController()->model ?? false;
    }

    public function validation(): array
    {
        return $this->model ? [$this->model->field_name() => 'required'] : [];
    }
}
