<?php

namespace App\Dao\Enums\Core;

use App\Dao\Traits\StatusTrait;
use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum as Enum;

class BooleanType extends Enum implements LocalizedEnum
{
    use StatusTrait;

    public const Yes = 1;

    public const No = 0;
}
