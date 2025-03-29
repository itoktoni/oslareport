<?php

namespace App\Http\Requests\Core;

use App\Dao\Traits\ValidationTrait;
use App\Facades\Model\LinkModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class LinkRequest extends FormRequest
{
    use ValidationTrait;

    public function validation(): array
    {
        return [
            'system_link_name' => 'required|unique:system_link|min:1',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            LinkModel::field_primary() => $this->{LinkModel::field_primary()} ?? Str::snake($this->{LinkModel::field_name()}),
            LinkModel::field_url() => $this->{LinkModel::field_url()} ?? Str::snake($this->{LinkModel::field_name()}),
        ]);
    }
}
