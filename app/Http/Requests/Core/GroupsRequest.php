<?php

namespace App\Http\Requests\Core;

use App\Dao\Traits\ValidationTrait;
use App\Facades\Model\GroupModel;
use Illuminate\Support\Str;

class GroupsRequest extends GeneralRequest
{
    use ValidationTrait;

    public function prepareForValidation()
    {
        $this->merge([
            GroupModel::field_primary() => Str::snake($this->system_group_name),
        ]);
    }

    public function validation(): array
    {
        return [
            'system_group_name' => 'required|min:3|unique:system_group',
        ];
    }
}
