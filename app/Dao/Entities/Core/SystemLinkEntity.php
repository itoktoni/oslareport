<?php

namespace App\Dao\Entities\Core;

trait SystemLinkEntity
{
    /**
     * Method field_description
     *
     * @return void
     */
    public static function field_description()
    {
        return 'system_link_description';
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
        return 'system_link_enable';
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
        return 'system_link_sort';
    }

    public function getFieldSortAttribute()
    {
        return $this->{self::field_sort()};
    }

    /**
     * Method field_url
     *
     * @return void
     */
    public static function field_url()
    {
        return 'system_link_url';
    }

    public function getFieldUrlAttribute()
    {
        return $this->{self::field_url()};
    }

    /**
     * Method field_controller
     *
     * @return void
     */
    public static function field_controller()
    {
        return 'system_link_controller';
    }

    public function getFieldControllerAttribute()
    {
        return $this->{self::field_controller()};
    }

    /**
     * Method field_action
     *
     * @return void
     */
    public static function field_action()
    {
        return 'system_link_action';
    }

    public function getFieldActionAttribute()
    {
        return $this->{self::field_action()};
    }

    /**
     * Method field_type
     *
     * @return void
     */
    public static function field_type()
    {
        return 'system_link_type';
    }

    public function getFieldTypeAttribute()
    {
        return $this->{self::field_type()};
    }
}
