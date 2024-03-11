<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
final class OrderStatus extends Enum implements LocalizedEnum
{
    const Waiting = 1;
    const Preparing = 2;
    const Ready = 3;
}
