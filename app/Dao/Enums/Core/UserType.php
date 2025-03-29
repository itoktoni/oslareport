<?php

namespace App\Dao\Enums\Core;

use App\Dao\Traits\StatusTrait;
use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum as Enum;

class UserType extends Enum implements LocalizedEnum
{
    use StatusTrait;

    public const FromUser = 1;

    public const CustomField = 2;
}
