<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

//Artisan::command('inspire', function () {
//    $this->comment(Inspiring::quote());
//})->purpose('Display an inspiring quote')->hourly();

Artisan::command('running-log', function () {
    $this->comment(\App\Console\Commands\Log\RunningLog::class);
})->purpose('排程運行中紀錄')->everyMinute();

Artisan::command('load-data', function () {
    $this->comment(\App\Console\Commands\Babysitter\BabysitterLoader::class);
})->purpose('載入保母資訊')->everyTwoHours();
