<?php

namespace App\Dao\Models\Core;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\Core\SystemLinkEntity;
use App\Dao\Enums\Core\MenuType;
use Illuminate\Support\Str;
use Plugins\Core;

class SystemLink extends SystemModel
{
    use SystemLinkEntity;

    protected $table = 'system_link';

    protected $primaryKey = 'system_link_code';

    protected $keyType = 'string';

    protected $fillable = [
        'system_link_code',
        'system_link_name',
        'system_link_action',
        'system_link_controller',
        'system_link_sort',
        'system_link_description',
        'system_link_enable',
        'system_link_url',
        'system_link_type',
    ];

    public $sortable = [
        'system_link_code',
        'system_link_name',
        'system_link_controller',
        'system_link_sort',
    ];

    protected $casts = [
        'system_link_sort' => 'integer',
        'system_link_name' => 'string',
    ];

    public static function field_name()
    {
        return 'system_link_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build($this->field_primary())->name('Code')->sort(),
            DataBuilder::build($this->field_name())->name('Name')->show()->sort(),
            DataBuilder::build($this->field_controller())->name('Controller')->sort(),
            DataBuilder::build($this->field_description())->name('Description')->show(false),
            DataBuilder::build($this->field_url())->name('Url')->sort(),
            DataBuilder::build($this->field_sort())->name('Sort')->sort()->class('column-active'),
        ];
    }

    public static function boot()
    {
        parent::creating(function ($model) {
            if (empty($model->{SystemLink::field_action()}) && ($model->{SystemLink::field_type()} == MenuType::Menu))
            {
                $act = '.getTable';
                $name = $model->{SystemLink::field_name()};

                if (str_contains($name, 'report'))
                {
                    $act = '.getCreate';
                }

                $model->{SystemLink::field_action()} = ($model->{SystemLink::field_url()}).$act;
            }
        });

        parent::saving(function ($model)
        {
            if ($model->{SystemLink::field_type()} == MenuType::Menu)
            {
                $model->{SystemLink::field_primary()} = ($model->{SystemLink::field_url()});

                if (empty($model->{SystemLink::field_url()}))
                {
                    $model->{SystemLink::field_url()} = ($model->{SystemLink::field_url()});
                }

                if($model->{SystemLink::field_action()})
                {
                    $link = explode('.', ($model->{SystemLink::field_action()}));
                    $model->{SystemLink::field_action()} = ($model->{SystemLink::field_url()}).'.'.$link[1];
                }

            }

            else
            {
                $model->{SystemLink::field_primary()} = Str::snake($model->{SystemLink::field_name()});
            }
        });

        parent::boot();
    }
}
