<?php

namespace App\Console\Commands\GenerateTemplate;

use Binafy\LaravelStub\Facades\LaravelStub;
use Illuminate\Console\Command;
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
        $str = "blog";
        $text = "帳號";
        $stringSnake = Str::snake($str);//str_str
        $stringLowerCamel = Str::camel($str);//strStr
        $stringUpperCamel = Str::Studly($str);//StrStr
        $stringDash = Str::kebab($str);//str-str
        $stringLcFirst = Str::lcfirst($str);//str str
        $stringUcFirst = Str::ucfirst($str);//Str str
        $stringPlural = Str::plural($str);//複數


        //controller
        LaravelStub::from(__DIR__ . '/template/app/Http/Controllers/Controller.stub')
            ->to(base_path("/app/Http/Controllers/"))
            ->name($stringUcFirst."Controller")
            ->ext('php')
            ->replaces([
                'NAMESPACE' => 'App\Http\Controllers',
                'CLASS' => $stringUcFirst,
                'CLASS_CAMEL' => $stringUcFirst,
                'VIEW_FILE' => $stringUcFirst,
                'ROUTE_NAME' => $stringPlural,
                "TEXT" => $text,
            ])
            ->generate();
        //livewire/index/[user].blade.php

        //livewire/update-forms/[user].blade.php

        //[user]/create.blade.php

        //[user]/edit.blade.php

        //[user]/index.blade.php

        //
//        LaravelStub::from(__DIR__ . '/model.stub')
//            ->to(__DIR__)
//            ->name('AAAAABB')
//            ->ext('php')
//            ->replaces([
//                'NAMESPACE' => '\App\Http\Controllers',
//                'CLASS' => 'Abc'
//            ])
//            ->generate();

//        LaravelStub::from(__DIR__ . '/ex.blade.php')
//            ->to(__DIR__)
//            ->name('AAAAABB.blade')
//            ->ext('php')
//            ->replaces([
//                'NAMESPACEAAA' => 'aaa_aaa',
//            ])
//            ->generate();

    }
}
