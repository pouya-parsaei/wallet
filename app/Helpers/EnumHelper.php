<?php

namespace App\Helpers;

class EnumHelper
{
    public static function getValuesAsArray($enum)
    {
        return array_column($enum::cases(), 'value');
    }
}
