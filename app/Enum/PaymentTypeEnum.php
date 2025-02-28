<?php

namespace App\Enum;

enum PaymentTypeEnum: string
{
    case N = 'N';
    public function text(): string
    {
        return match ($this){
            self::N => '無串接',
        };
    }
}
