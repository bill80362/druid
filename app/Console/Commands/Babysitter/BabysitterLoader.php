<?php

namespace App\Console\Commands\Babysitter;

use App\Models\City;
use App\Services\Babysitter\LoadData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class BabysitterLoader extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '載入保母資訊，台中';

    /**
     * Execute the console command.
     */
    public function handle(LoadData $loadData)
    {
        //
        $citys = City::select(["id", "name"])
//            ->where("name",'台中市')
            ->with(["regions"])
            ->where("sort",">","1")
            ->orderBy("sort","desc")
            ->get();
        //
        foreach ($citys as $city) {
            $count = $city->regions?->count()??0;
            foreach ($city->regions??[] as $index => $region) {
                Log::info("正在執行{$city->name}{$region->name} 進度".($index+1)."/{$count}");
                $loadData->updateInfo($city->name, $region->name);
            }
        }

    }



}
