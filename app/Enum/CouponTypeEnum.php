<?php

namespace App\Enum;

enum CouponTypeEnum: string
{
    case M = 'M';
    case R = 'R';
//    case S = 'S';
    public function text(): string
    {
        return match ($this){
            self::M => '折抵',
            self::R => '打折',
//            self::S => '固定',
        };
    }
}
