<?php

namespace App\Enum;

enum MemberStatusEnum: string
{
    case n = 'n';
    case black = 'black';
    case stop = 'stop';

    public function text(): string
    {
        return match ($this){
            self::n => '正常',
            self::black => '黑名單',
            self::stop => '停用',
        };
    }
}
