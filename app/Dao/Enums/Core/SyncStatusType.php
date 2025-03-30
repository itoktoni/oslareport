<?php

namespace App\Dao\Enums\Core;

use App\Dao\Traits\StatusTrait;
use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum as Enum;

class SyncStatusType extends Enum implements LocalizedEnum
{
    use StatusTrait;

    public const Sync = 'success';

    public const Pending = 'danger';

    public const Progress = 'primary';


}
