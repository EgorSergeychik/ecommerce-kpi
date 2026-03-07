<?php

namespace App\Support\Enums;

use App\Support\Traits\EnumToArray;

enum Locale: string
{
    use EnumToArray;

    case ENGLISH = 'en';
    case UKRAINIAN = 'uk';
}
