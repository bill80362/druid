<?php

namespace App\Enum\Babysitter;

enum BabySitterStatusEnum: string
{
    case Y = 'Y';
    case N = 'N';
    case I = 'I';
    public function text(): string
    {
        return match ($this){
            self::Y => '顯示',
            self::N => '隱藏',
            self::I => '官方',
        };
    }
}
