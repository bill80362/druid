<?php

namespace App\Console\Commands\Babysitter;

use App\Models\City;
use App\Models\Region;
use App\Services\Babysitter\LoadData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BabysitterCityTown extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:city';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '載入縣市區域代碼';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $citySlug = [
            '新北市' => '4bc1e2f27af6e832017af6eeff7a0172',
            '台北市' => '4bc1e2f27af6e832017af6eeff750170',
            '桃園市' => '4bc1e2f27af6e832017af6eeff7d0173',
            '台中市' => '4bc1e2f27af6e832017af6eeff860176',
            '台南市' => '4bc1e2f27af6e832017af6eeff4a0162',
            '高雄市' => '4bc1e2f27af6e832017af6eeff8c0178',
            '宜蘭縣' => '4bc1e2f27af6e832017af6eeff580166',
            '新竹縣' => '4bc1e2f27af6e832017af6eeff890177',
            '苗栗縣' => '4bc1e2f27af6e832017af6eeff72016f',
            '彰化縣' => '4bc1e2f27af6e832017af6eeff5d0168',
            '南投縣' => '4bc1e2f27af6e832017af6eeff830175',
            '雲林縣' => '4bc1e2f27af6e832017af6eeff6f016e',
            '嘉義縣' => '4bc1e2f27af6e832017af6eeff63016a',
            '屏東縣' => '4bc1e2f27af6e832017af6eeff3e015d',
            '台東縣' => '4bc1e2f27af6e832017af6eeff67016b',
            '花蓮縣' => '4bc1e2f27af6e832017af6eeff600169',
            '澎湖縣' => '4bc1e2f27af6e832017af6eeff770171',
            '基隆市' => '4bc1e2f27af6e832017af6eeff460160',
            '新竹市' => '4bc1e2f27af6e832017af6eeff480161',
            '嘉義市' => '4bc1e2f27af6e832017af6eeff43015f',
            '連江縣' => '4bc1e2f27af6e832017af6eeff6c016d',
            '金門縣' => '4bc1e2f27af6e832017af6eeff38015c',
        ];
        $cities = City::get();
        foreach ($cities as $city) {
            $city->slug = $citySlug[$city->name]??'';
            $city->save();
        }
        //
        foreach (["台北市","新北市","台中市","台南市","新竹市","新竹縣","桃園市","基隆市"] as $cityName) {
            $json = Storage::get($cityName.'.json');
            if($json){
                $json = json_decode($json, true);
                $json = collect($json)->pluck("id", "name")->toArray();
                $regions = Region::whereHas("city",fn($q)=>$q->where("name",$cityName))->get();
                foreach ($regions as $region) {
                    $region->slug = $json[$region->name]??'';
                    $region->save();
                }
            }
        }



    }



}
