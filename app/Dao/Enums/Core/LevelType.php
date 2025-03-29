<?php

namespace App\Dao\Enums\Core;

use App\Dao\Traits\StatusTrait;
use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum as Enum;

class LevelType extends Enum implements LocalizedEnum
{
    use StatusTrait;

    public const Pengguna = 1;

    public const Operator = 10;

    public const Operation = 11;

    public const Finance = 20;

    public const Admin = 30;

    public const Owner = 40;

    public const Developer = 100;
}
