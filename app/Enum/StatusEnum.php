<?php

namespace App\Enum;

enum StatusEnum: string
{
    case N = 'N';
    case Y = 'Y';
    public function text(): string
    {
        return match ($this){
            self::N => '停用',
            self::Y => '啟用',
        };
    }
}
