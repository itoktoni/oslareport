<?php

namespace App\Facades\Model;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Dao\Models\Core\User
 */
class UserModel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return getClass(__CLASS__);
    }
}
