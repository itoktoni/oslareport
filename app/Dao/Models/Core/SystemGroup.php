<?php

namespace App\Dao\Models\Core;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\Core\SystemGroupEntity;
use App\Facades\Model\MenuModel;
use App\Facades\Model\RoleModel;

class SystemGroup extends SystemModel
{
    use SystemGroupEntity;

    protected $table = 'system_group';

    protected $primaryKey = 'system_group_code';

    protected $keyType = 'string';

    protected $fillable = [
        'system_group_code',
        'system_group_name',
        'system_group_sort',
        'system_group_enable',
        'system_group_url',
        'system_group_icon',
        'system_group_description',
    ];

    public $sortable = [
        'system_group_code',
        'system_group_name',
        'system_group_sort',
    ];

    protected $casts = [
        'system_group_sort' => 'integer',
    ];

    public static function field_name()
    {
        return 'system_group_name';
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build($this->field_key())->name('Code'),
            DataBuilder::build($this->field_name())->name('Name')->sort(),
            DataBuilder::build($this->field_icon())->name('Icon')->sort(),
            DataBuilder::build($this->field_url())->name('Url')->sort(false),
            DataBuilder::build($this->field_sort())->name('Sort')->sort()->class('column-active'),
            DataBuilder::build($this->field_enable())->name('Enable')->show(false),
        ];
    }

    public function has_menu()
    {
        return $this->belongsToMany(MenuModel::getModel(), 'system_group_connection_menu', 'system_group_code', 'system_menu_code');
    }

    public function has_role()
    {
        return $this->belongsToMany(RoleModel::getModel(), 'system_group_connection_role', 'system_group_code', 'system_role_code');
    }
}
