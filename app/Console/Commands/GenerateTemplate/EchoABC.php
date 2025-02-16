<?php

namespace App\Console\Commands\GenerateTemplate;

use App\Models\Member;
use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Services\LevelService;
use Binafy\LaravelStub\Facades\LaravelStub;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class EchoABC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:e';

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
        //
//        $user_id = "9532529716780604";
//        $app = "966078551515097";
//        $access_token = "EAANupLDjX9kBO41EDjL3mkBiuEZBDZBfNu0OBZBgFqCmjFy0RWrT94dsDDPgyzykq0LN75WO8RFpUc42Ln0Dqnf7t6NyvpSWQAmz1moqPrO4nE2dS231HZB5p8pEnh8SuKr8yMr5EbZA6WScNBiyby4bGo4npnmej6XNWrA0YiDdirS3bJUbVNGbbcNX1zp8AkOMkqaSPXjiZAjshAenSS3uvJaAcZD";
//        $secret = "d86b5be7b8ffe4543b0eb15118964141";
//        $appsecret_proof = hash_hmac('sha256', $access_token, $secret);
        //
//        $http_response = Http::get("https://graph.facebook.com/v21.0/{$user_id}?app={$app}&access_token={$access_token}&appsecret_proof={$appsecret_proof}");
//        print_r($http_response->getHeaders());
//        echo $http_response->body();
//        print_r($http_response->json());
        //
        $levelService->update(2);
    }
}
