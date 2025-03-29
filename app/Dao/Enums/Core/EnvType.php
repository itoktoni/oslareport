<?php

namespace App\Dao\Enums\Core;

use App\Dao\Traits\StatusTrait;
use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum as Enum;

class EnvType extends Enum implements LocalizedEnum
{
    use StatusTrait;

    public const Local = 'local';

    public const Production = 'production';

    public const Staging = 'staging';

    public const Testing = 'testing';

    public const Mirror = 'mirror';
}
