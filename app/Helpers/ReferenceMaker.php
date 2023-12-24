<?php

namespace App\Helpers;

class ReferenceMaker
{
    public static function makeNumericReferenceId(): int
    {
        return abs(crc32(uniqid()));
    }
}
