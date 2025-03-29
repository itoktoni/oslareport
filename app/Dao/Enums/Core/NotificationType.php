<?php

namespace App\Dao\Enums\Core;

use App\Dao\Traits\StatusTrait;
use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum as Enum;

class NotificationType extends Enum implements LocalizedEnum
{
    use StatusTrait;

    public const Success = 'success';

    public const Warning = 'warning';

    public const Info = 'info';

    public const Question = 'question';

    public const Error = 'error';
}
