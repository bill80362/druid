<?php

namespace App\Console\Commands\GenerateTemplate;

use App\Models\Member;
use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\User;
use App\Services\LevelService;
use Binafy\LaravelStub\Facades\LaravelStub;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class resetPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:r';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '產生模板';

    /**
     * Execute the console command.
     */
    public function handle(LevelService $levelService)
    {
        $user = User::find(1001);
        $user->fill(['password' => Hash::make("12345678")])->save();
        $user->save();
    }
}
