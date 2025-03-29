<?php

namespace App\Facades\Model;

use Illuminate\Support\Facades\Facade;

class PermisionModel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return getClass(__CLASS__);
    }
}
