<?php

namespace App\Console\Commands\GenerateTemplate;

use App\Models\Permission;
use App\Models\PermissionGroup;
use Binafy\LaravelStub\Facades\LaravelStub;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class EchoABC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:echo';

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
        echo Carbon::createFromTimestampMs(1736573010905)->format("Y-m-d H:i:s").PHP_EOL;
    }
}
