<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;
/**
 * @method static self statusSuccess()
 * @method static self statusFailed()
 */
final class ApiResponseEnum extends Enum
{
    public static function values(): array
    {
        return [
            'statusSuccess' => 'success',
            'statusFailed' => 'failed',
        ];
    }
}
