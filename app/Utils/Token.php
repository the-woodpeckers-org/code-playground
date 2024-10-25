<?php

namespace App\Utils;

use Illuminate\Support\Str;

class Token
{
    public static function generatePasswordToken(): string {
        return Str::random(16);
    }
}
