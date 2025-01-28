<?php

namespace App\Enum;

enum DiscountGoodsStatusEnum: string
{
    case N = 'N';
    case I = 'I';
    case E = 'E';
    public function text(): string
    {
        return match ($this){
            self::N => '不限定',
            self::I => '限定',
            self::E => '排除',
        };
    }
}
