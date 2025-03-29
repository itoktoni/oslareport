<?php

namespace App\Dao\Traits;

trait RedirectAuth
{
    public function redirectAuthCustom()
    {
        if (empty(auth()->user()->role)) {
            return route('public');
        }

        return route('home');
    }
}
