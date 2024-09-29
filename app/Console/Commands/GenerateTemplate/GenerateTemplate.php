<?php

namespace App\Console\Commands\GenerateTemplate;

use Binafy\LaravelStub\Facades\LaravelStub;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
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
            'VIEW_FILE' => $stringSnake,
            'ROUTE_NAME' => $stringPlural,
            'VAR_NAME' => $stringLowerCamel,
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
            ->name($stringSnake)
            ->ext('blade.php')
            ->replaces($replacesArray)
            ->generate();
        //livewire/update-forms/[user].blade.php
        LaravelStub::from(__DIR__ . '/template/resources/views/livewire/update-forms/stub.stub')
            ->to(base_path("/resources/views/livewire/update-forms/"))
            ->name($stringSnake)
            ->ext('blade.php')
            ->replaces($replacesArray)
            ->generate();
        //
        File::exists(base_path("/resources/views/{$stringSnake}/")) || File::makeDirectory(base_path("/resources/views/{$stringSnake}/"));
        //[user]/create.blade.php
        LaravelStub::from(__DIR__ . '/template/resources/views/page/create.stub')
            ->to(base_path("/resources/views/{$stringSnake}/"))
            ->name("create")
            ->ext('blade.php')
            ->replaces($replacesArray)
            ->generate();
        //[user]/edit.blade.php
        LaravelStub::from(__DIR__ . '/template/resources/views/page/edit.stub')
            ->to(base_path("/resources/views/{$stringSnake}/"))
            ->name("edit")
            ->ext('blade.php')
            ->replaces($replacesArray)
            ->generate();
        //[user]/index.blade.php
        LaravelStub::from(__DIR__ . '/template/resources/views/page/index.stub')
            ->to(base_path("/resources/views/{$stringSnake}/"))
            ->name("index")
            ->ext('blade.php')
            ->replaces($replacesArray)
            ->generate();
        //app/Livewire/Index/[User].php
        LaravelStub::from(__DIR__ . '/template/app/Livewire/Index/stub.stub')
            ->to(base_path("/app/Livewire/Index/"))
            ->name($stringUpperCamel)
            ->ext('php')
            ->replaces($replacesArray)
            ->generate();
        //app/Livewire/UpdateForms/[User].php
        LaravelStub::from(__DIR__ . '/template/app/Livewire/UpdateForms/stub.stub')
            ->to(base_path("/app/Livewire/UpdateForms/"))
            ->name($stringUpperCamel)
            ->ext('php')
            ->replaces($replacesArray)
            ->generate();
        //permission migrate

    }
}
