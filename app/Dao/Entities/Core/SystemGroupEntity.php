<?php

namespace App\Dao\Entities\Core;

trait SystemGroupEntity
{
    /**
     * Method field_description
     *
     * @return void
     */
    public static function field_description()
    {
        return 'system_group_description';
    }

    public function getFieldDescriptionAttribute()
    {
        return $this->{$this->field_description()};
    }

    /**
     * Method field_enable
     *
     * @return void
     */
    public static function field_enable()
    {
        return 'system_group_enable';
    }

    public function getFieldEnableAttribute()
    {
        return $this->{$this->field_enable()};
    }

    /**
     * Method field_sort
     *
     * @return void
     */
    public static function field_sort()
    {
        return 'system_group_sort';
    }

    public function getFieldSortAttribute()
    {
        return $this->{self::field_sort()};
    }

    /**
     * Method field_icon
     *
     * @return void
     */
    public static function field_icon()
    {
        return 'system_group_icon';
    }

    public function getFieldIconAttribute()
    {
        return $this->{self::field_icon()};
    }

    /**
     * Method field_url
     *
     * @return void
     */
    public static function field_url()
    {
        return 'system_group_url';
    }

    public function getFieldUrlAttribute()
    {
        return $this->{self::field_url()};
    }

    public static function field_name()
    {
        return 'system_group_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }
}
