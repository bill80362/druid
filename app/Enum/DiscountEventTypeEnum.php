<?php

namespace App\Enum;

enum DiscountEventTypeEnum: string
{
    case N = 'N';
    case M = 'M';
    case C = 'C';
    case E = 'E';
    case B = 'B';
    public function text(): string
    {
        return match ($this){
            self::N => '不限定',
            self::M => '滿額',
            self::C => '滿件',
            self::E => '滿額或滿件',
            self::B => '滿額且滿件',
        };
    }
}
