<?php

namespace App\Dao\Entities\Core;

use App\Facades\Model\UserModel;

trait TeamEntity
{
    /**
     * Method field_lead_id
     *
     * @return void
     */
    public static function field_lead_id()
    {
        return 'team_user_id';
    }

    public function getFieldLeadIdAttribute()
    {
        return $this->{$this->field_lead_id()};
    }

    public function getFieldLeadNameAttribute()
    {
        return $this->{UserModel::field_name()};
    }

    public static function field_domain()
    {
        return 'team_domain';
    }

    public function getFieldDomainAttribute()
    {
        return $this->{$this->field_domain()};
    }

    public static function field_name()
    {
        return 'team_name';
    }

    public function getFieldNameAttribute()
    {
        return $this->{$this->field_name()};
    }
}
