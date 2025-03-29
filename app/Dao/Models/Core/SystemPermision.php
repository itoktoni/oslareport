<?php

namespace App\Dao\Models\Core;

use App\Dao\Builder\DataBuilder;
use App\Dao\Entities\Core\SystemPermisionEntity;
use App\Facades\Model\PermisionModel;
use App\Facades\Model\UserModel;
use Plugins\Core;

class SystemPermision extends SystemModel
{
    use SystemPermisionEntity;

    protected $table = 'system_permision';

    protected $primaryKey = 'system_permision_id';

    protected $fillable = [
        'system_permision_id',
        'system_permision_role',
        'system_permision_code',
        'system_permision_controller',
        'system_permision_module',
        'system_permision_user',
        'system_permision_level',
    ];

    public $sortable = [
        'system_permision_role_code',
        'system_permision_code',
        'system_permision_controller',
        'system_permision_module',
    ];

    public function fieldDatatable(): array
    {
        return [
            DataBuilder::build(PermisionModel::field_key())->name('ID')->show(false),
            DataBuilder::build(PermisionModel::field_role())->name('Role'),
            DataBuilder::build(PermisionModel::field_module())->name('Module'),
            DataBuilder::build(PermisionModel::field_code())->name('Code'),
            DataBuilder::build(PermisionModel::field_level())->name('Level'),
            DataBuilder::build(PermisionModel::field_user())->name('User'),
        ];
    }

    public function has_user()
    {
        return $this->hasOne(UserModel::getModel(), UserModel::field_primary(), PermisionModel::field_user());
    }

    public static function boot()
    {
        parent::saving(function ($model) {
            $model->{self::field_module()} = Core::getControllerName($model->{self::field_controller()});
        });
        parent::boot();
    }
}
