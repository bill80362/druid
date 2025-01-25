<?php

namespace App\Enum;

enum StatusEnum: string
{
    case N = 'N';
    case Y = 'Y';
    public function text(): string
    {
        return match ($this){
            self::N => '隱藏',
            self::Y => '顯示',
        };
    }
}
