<?php

namespace App\Enum;

enum PaymentTypeEnum: string
{
    case N = 'N';
    case S = 'S';
    public function text(): string
    {
        return match ($this){
            self::N => '無串接',
            self::S => 'LinePay測試用',
        };
    }
}
