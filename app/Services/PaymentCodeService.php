<?php

namespace App\Services;

use App\Models\Fee;

class PaymentCodeService
{
    public static function generateProcessNumber(int $length = 12): string
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';

        do {
            $code = '';
            for ($i = 0; $i < $length; $i++) {
                $code.= $characters[rand(0, strlen($characters) - 1)];

                if(strlen($code) % 4 == 0)
                    $code .= '-';
            }
        } while (Fee::where('process_number', $code)->exists());

        return $code;
    }
}
