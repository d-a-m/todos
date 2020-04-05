<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TokenHelper
{
    /**
     * @return string
     */
    public static function generateToken(): string
    {
        $token = Hash::make(Str::random(60));
        return $token;
    }
}