<?php

namespace App\Console\Commands\Babysitter;

use App\Models\Babysitter\Babysitter;
use App\Models\Babysitter\BabysitterService;
use App\Models\City;
use App\Services\LevelService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BabysitterServiceLoad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '載入保母資訊';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [
            ["id" => 1, "name" => "平日托"],
            ["id" => 2, "name" => "全日托"],
            ["id" => 3, "name" => "夜托"],
            ["id" => 4, "name" => "臨托"],
        ];

        foreach ($data as $item){
            $b = BabysitterService::findOrNew($item["id"]);
            $b->id = $item["id"];
            $b->name = $item["name"];
            $b->save();
        }
    }
}
