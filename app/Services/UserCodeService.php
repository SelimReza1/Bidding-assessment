<?php

namespace App\Services;

use App\Models\Bidder;

class UserCodeService
{
    public static function getNewCode(): string
    {
        $new_code = random_int(100, 999);

        if (Bidder::where('user_code', $new_code)->first()) {
            return static::getNewCode();
        }
        return $new_code;
    }
}
