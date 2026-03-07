<?php

namespace App\Support\Traits;

/** @mixin \BackedEnum */
trait EnumToArray
{
    public static function values(): array
    {
        return array_map(
            fn (self $enum) => $enum->value,
            self::cases()
        );
    }
}
