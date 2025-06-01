<?php

namespace App\Console\Commands\Log;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RunningLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '單純紀錄一筆log';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info("running log...");

    }



}
