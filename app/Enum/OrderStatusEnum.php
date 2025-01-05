<?php

namespace App\Enum;

enum OrderStatusEnum: string
{
    case created = 'created';
    case pay = 'pay';
    case ship = 'ship';
    case cod = 'cod';
    case arrive = 'arrive';
    case delivery = 'delivery';
    case finish = 'finish';
    case cancel = 'cancel';

    public function text(): string
    {
        return match ($this){
            self::created => '已建立，待付款',
            self::pay => '已付款，待出貨',
            self::ship => '已出貨',
            self::cod => '已出貨，未付款',
            self::arrive => '已到貨，待取貨',
            self::delivery => '已取貨，待結案',
            self::finish => '結案',
            self::cancel => '取消',
        };
    }
}
