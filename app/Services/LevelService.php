<?php

namespace App\Services;

use App\Models\Level;
use App\Models\Member;
use App\Models\Order;
use Carbon\Carbon;

class LevelService
{
    public function update($member_id)
    {
        //上一期的日期範圍
        $lastPeriodStart = Carbon::now()->modify("-1 year")->startOfYear()->startOfDay();
        $lastPeriodEnd = Carbon::now()->modify("-1 year")->endOfYear()->endOfDay();
        $lastOrders = Order::where("status","finish")
            ->where("created_at",">=",$lastPeriodStart)
            ->where("created_at","<=",$lastPeriodEnd)
            ->get();
        $lastOrdersSumTotal = $lastOrders->sum("total");
        //本期的日期範圍
        $thisPeriodStart = Carbon::now()->startOfYear()->startOfDay();
        $thisPeriodEnd = Carbon::now()->endOfYear()->endOfDay();
        $thisOrders = Order::where("status","finish")
            ->where("created_at",">=",$thisPeriodStart)
            ->where("created_at","<=",$thisPeriodEnd)
            ->get();
        $thisOrdersSumTotal = $thisOrders->sum("total");
        //等級
        $levels = Level::orderBy("sort")->get();
        //初始等級
        $newLevel = $levels->first();
        //上一期的日期範圍，代表最低等級
        foreach ($levels as $key => $level){
            if($key==0) continue;
            if( $lastOrdersSumTotal > ((int)$level?->upgrade) ){
                $newLevel = $level;
            }
        }
        //本期的日期範圍，代表可以升級
        foreach ($levels as $key => $level){
            if($key==0) continue;
            if($newLevel->sort < $level->sort){
                if( $thisOrdersSumTotal > ((int)$level?->upgrade) ){
                    $newLevel = $level;
                }
            }
        }
        //本期的等級，代表最高等級
        $member = Member::find($member_id);
        $member->level_id = $newLevel->id;
        $member->save();
        //
        return $member;
    }
}
