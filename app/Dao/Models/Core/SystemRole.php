<?php

namespace App\Dao\Models\Core;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\Core\SystemRoleEntity;
use App\Facades\Model\GroupModel;
use App\Facades\Model\RoleModel;
use Illuminate\Support\Str;

class SystemRole extends SystemModel
{
    use SystemRoleEntity;

    protected $table = 'system_role';

    protected $primaryKey = 'system_role_code';

    protected $keyType = 'string';

    protected $fillable = [
        'system_role_code',
        'system_role_name',
        'system_role_level',
        'system_role_description',
    ];

    public $sortable = [
        'system_role_code',
        'system_role_name',
        'system_role_level',
        'system_role_description',
    ];

    protected $casts = [
        'system_role_code' => 'string',
    ];

    public static function field_name()
    {
        return 'system_role_name';
    }

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build(RoleModel::field_key())->name('Code')->sort(),
            DataBuilder::build(RoleModel::field_name())->name('Name')->show(true)->sort(),
            DataBuilder::build(RoleModel::field_level())->name('Level')->show(true)->sort(),
            DataBuilder::build(RoleModel::field_description())->name('Description')->show(true),
        ];
    }

    public function has_group()
    {
        return $this->belongsToMany(GroupModel::getModel(), 'system_group_connection_role', 'system_role_code', 'system_group_code');
    }

    public static function boot()
    {
        parent::creating(function ($model) {
            if (empty($model->{SystemRole::field_primary()})) {
                $model->{SystemRole::field_primary()} = Str::camel($model->{SystemRole::field_name()});
            }
        });
        parent::boot();
    }
}
