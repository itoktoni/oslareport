<?php

namespace App\Dao\Entities\Core;

use App\Dao\Enums\Core\LevelType;

trait SystemRoleEntity
{
    /**
     * Method field_description
     *
     * @return void
     */
    public static function field_description()
    {
        return 'system_role_description';
    }

    public function getFieldDescriptionAttribute()
    {
        return $this->{$this->field_description()};
    }

    /**
     * Method field_level
     *
     * @return void
     */
    public static function field_level()
    {
        return 'system_role_level';
    }

    public function getFieldLevelNameAttribute()
    {
        return LevelType::getDescription($this->{$this->field_level()});
    }

    public function getFieldLevelAttribute()
    {
        return $this->{$this->field_level()};
    }

    public static function field_name()
    {
        return 'system_role_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }
}
