<?php

namespace App\Dao\Entities\Core;

trait SystemPermisionEntity
{
    /**
     * Method field_role
     *
     * @return void
     */
    public static function field_role()
    {
        return 'system_permision_role';
    }

    public function getFieldRoleAttribute()
    {
        return $this->{$this->field_role()};
    }

    /**
     * Method field_code
     *
     * @return void
     */
    public static function field_code()
    {
        return 'system_permision_code';
    }

    public function getFieldCodeAttribute()
    {
        return $this->{$this->field_code()};
    }

    /**
     * Method field_user
     *
     * @return void
     */
    public static function field_user()
    {
        return 'system_permision_user';
    }

    public function getFieldUserAttribute()
    {
        return $this->{$this->field_user()};
    }

    /**
     * Method field_level
     *
     * @return void
     */
    public static function field_level()
    {
        return 'system_permision_level';
    }

    public function getFieldLevelAttribute()
    {
        return $this->{self::field_level()};
    }

    /**
     * Method field_module
     *
     * @return void
     */
    public static function field_module()
    {
        return 'system_permision_module';
    }

    public function getFieldModuleAttribute()
    {
        return $this->{self::field_module()};
    }

    /**
     * Method field_controller
     *
     * @return void
     */
    public static function field_controller()
    {
        return 'system_permision_controller';
    }

    public function getFieldControllerAttribute()
    {
        return $this->{self::field_controller()};
    }
}
