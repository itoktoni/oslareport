<?php

namespace App\Dao\Enums\Core;

use App\Dao\Traits\StatusTrait;
use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum as Enum;

class MenuType extends Enum implements LocalizedEnum
{
    use StatusTrait;

    public const Menu = 1;

    public const Group = 2;

    public const Internal = 3;

    public const External = 4;

    public const Devider = 5;
}
