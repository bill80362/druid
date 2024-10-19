<?php

namespace App\Console\Commands\GenerateTemplate;

use App\Models\Permission;
use App\Models\PermissionGroup;
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
        //路由 Route::resource('pages', \App\Http\Controllers\PageController::class);
        //選單 navigation2.blade.php
//        [
//            "title" => __("頁面管理"),
//            "href" => route('pages.index'),
//            "active" => request()->routeIs('pages.index'),
//        ],
        //
        $str = "goods_spec_option";
        $text = "商品明細";
        //
        $stringSnake = Str::snake($str);//str_str
        $stringLowerCamel = Str::camel($str);//strStr
        $stringUpperCamel = Str::Studly($str);//StrStr
//        $stringDash = Str::kebab($str);//str-str
//        $stringLcFirst = Str::lcfirst($str);//str str
//        $stringUcFirst = Str::ucfirst($str);//Str str
//        $stringPlural = Str::plural($str);//複數
        //
        $permissionGroupMaxId = 7;
        $permissionMaxId = $permissionGroupMaxId*4;
        //replaces array
        $replacesArray = [
            'NAMESPACE' => 'App\Http\Controllers',
            'CLASS' => $stringUpperCamel,
            'CLASS_CAMEL' => $stringUpperCamel,
            'VIEW_FILE' => $stringSnake,
            'ROUTE_NAME' => Str::plural($stringSnake),
            'VAR_NAME' => $stringLowerCamel,
            'ROUTE_VAR_NAME' => $stringSnake,
            "TEXT" => $text,
            //
            "PERMISSION_GROUP_ID" => $permissionGroupMaxId+1,
            "PERMISSION_ID_READ" => $permissionMaxId+1,
            "PERMISSION_ID_CREATE" => $permissionMaxId+2,
            "PERMISSION_ID_UPDATE" => $permissionMaxId+3,
            "PERMISSION_ID_DELETE" => $permissionMaxId+4,
        ];

        //controller
        LaravelStub::from(__DIR__ . '/template/app/Http/Controllers/Controller.stub')
            ->to(base_path("/app/Http/Controllers/"))
            ->name($stringUpperCamel."Controller")
            ->ext('php')
            ->replaces($replacesArray)
            ->generate();
        //model
        Artisan::call("make:model {$stringUpperCamel} --migration ");
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
        LaravelStub::from(__DIR__ . '/template/database/migrations/0002_01_01_000001_insert_permissions_table.stub')
            ->to(base_path("/database/migrations/"))
            ->name("0002_01_01_000001_insert_permissions_table_".$stringSnake)
            ->ext('php')
            ->replaces($replacesArray)
            ->generate();
    }
}
