<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;
final class OrderStatus extends Enum implements LocalizedEnum
{
    const Preparing = 1;
    const Ready = 2;

    public static function getDescription($value): string
    {
        // Si el valor es un string, intenta convertirlo a entero
        $value = is_numeric($value) ? (int)$value : $value;

        return parent::getDescription($value);
    }
}
