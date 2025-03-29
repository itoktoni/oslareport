<?php

namespace App\Http\Requests\Core;

use App\Dao\Traits\ValidationTrait;
use App\Facades\Model\MenuModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class MenuRequest extends FormRequest
{
    use ValidationTrait;

    public function validation(): array
    {
        return [
            'system_menu_name' => 'required|unique:system_menu|min:1',
            'system_menu_type' => 'required',
        ];
    }

    public function prepareForValidation()
    {
        $merge = [];
        if (empty($this->{MenuModel::field_url()})) {
            $merge = [
                MenuModel::field_url() => $this->{MenuModel::field_url()} ?? Str::snake($this->{MenuModel::field_name()}),
            ];
        }

        $this->merge($merge);
    }
}
