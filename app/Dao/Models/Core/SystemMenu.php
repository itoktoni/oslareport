<?php

namespace App\Dao\Models\Core;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\Core\SystemMenuEntity;
use App\Dao\Enums\Core\MenuType;
use App\Facades\Model\LinkModel;
use Illuminate\Support\Str;
use Plugins\Core;

class SystemMenu extends SystemModel
{
    use SystemMenuEntity;

    protected $table = 'system_menu';

    protected $primaryKey = 'system_menu_code';

    protected $with = ['has_link'];

    protected $keyType = 'string';

    protected $fillable = [
        'system_menu_code',
        'system_menu_name',
        'system_menu_url',
        'system_menu_controller',
        'system_menu_action',
        'system_menu_type',
        'system_menu_sort',
        'system_menu_description',
        'system_menu_enable',
        'system_menu_can_delete',
    ];

    public $sortable = [
        'system_menu_code',
        'system_menu_name',
        'system_menu_action',
        'system_menu_controller',
        'system_menu_sort',
    ];

    protected $casts = [
        'system_menu_enable' => 'integer',
        'system_menu_can_delete' => 'integer',
    ];

    public static function field_name()
    {
        return 'system_menu_name';
    }

    public function fieldSearching()
    {
        return $this->field_name();
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

    public function has_link()
    {
        return $this->belongsToMany(LinkModel::getModel(), 'system_menu_connection_link', 'system_menu_code', 'system_link_code');
    }

    public static function boot()
    {
        parent::creating(function ($model) {
            if (empty($model->{SystemMenu::field_action()}) && ($model->{SystemMenu::field_type()} == MenuType::Menu))
            {
                $act = '.getTable';
                $name = strtolower($model->{SystemMenu::field_name()});

                if (str_contains($name, 'report'))
                {
                    $act = '.getCreate';
                }

                $model->{SystemMenu::field_action()} = ($model->{SystemMenu::field_url()}).$act;
            }
        });

        parent::saving(function ($model)
        {
            if ($model->{SystemMenu::field_type()} == MenuType::Menu)
            {
                $model->{SystemMenu::field_primary()} = ($model->{SystemMenu::field_url()});

                if (empty($model->{SystemMenu::field_url()}))
                {
                    $model->{SystemMenu::field_url()} = ($model->{SystemMenu::field_url()});
                }

                if($model->{SystemMenu::field_action()})
                {
                    $link = explode('.', ($model->{SystemMenu::field_action()}));
                    $model->{SystemMenu::field_action()} = ($model->{SystemMenu::field_url()}).'.'.$link[1];
                }
            }
            else
            {
                $model->{SystemMenu::field_primary()} = Str::snake($model->{SystemMenu::field_name()});
            }
        });

        parent::boot();
    }
}
