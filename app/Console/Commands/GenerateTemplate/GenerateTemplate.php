<?php

namespace App\Console\Commands\GenerateTemplate;

use Binafy\LaravelStub\Facades\LaravelStub;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class GenerateTemplate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:gt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '產生模板';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $str = "page";
        $text = "頁面";
        $stringSnake = Str::snake($str);//str_str
        $stringLowerCamel = Str::camel($str);//strStr
        $stringUpperCamel = Str::Studly($str);//StrStr
        $stringDash = Str::kebab($str);//str-str
        $stringLcFirst = Str::lcfirst($str);//str str
        $stringUcFirst = Str::ucfirst($str);//Str str
        $stringPlural = Str::plural($str);//複數
        //replaces array
        $replacesArray = [
            'NAMESPACE' => 'App\Http\Controllers',
            'CLASS' => $stringUcFirst,
            'CLASS_CAMEL' => $stringUcFirst,
            'VIEW_FILE' => $stringUcFirst,
            'ROUTE_NAME' => $stringPlural,
            "TEXT" => $text,
        ];

        //controller
        LaravelStub::from(__DIR__ . '/template/app/Http/Controllers/Controller.stub')
            ->to(base_path("/app/Http/Controllers/"))
            ->name($stringUcFirst."Controller")
            ->ext('php')
            ->replaces($replacesArray)
            ->generate();
        //model
        Artisan::call("make:model {$stringUcFirst} --migration ");
        //livewire/index/[user].blade.php
        LaravelStub::from(__DIR__ . '/template/resources/views/livewire/index/stub.stub')
            ->to(base_path("/resources/views/livewire/index/"))
            ->name($stringLcFirst)
            ->ext('blade.php')
            ->replaces($replacesArray)
            ->generate();
        //livewire/update-forms/[user].blade.php
        LaravelStub::from(__DIR__ . '/template/resources/views/livewire/update-forms/stub.stub')
            ->to(base_path("/resources/views/livewire/update-forms/"))
            ->name($stringLcFirst)
            ->ext('blade.php')
            ->replaces($replacesArray)
            ->generate();
        //[user]/create.blade.php

        //[user]/edit.blade.php

        //[user]/index.blade.php
    }
}
