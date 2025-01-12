<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Line;
use App\Models\LineMessages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class WebhookFbController extends Controller
{
    public function verify(Request $request)
    {
        $mode = $request->get('hub_mode');
        $verify_token = $request->get('hub_verify_token');
        $challenge = $request->get('hub_challenge');

        if($mode=="subscribe" && $verify_token=="druid"){
            return response($challenge);
        }
        return response("error",403);
    }
    public function webhook(Request $request){
        Log::info("臉書webhook",[
            "data" => $request->all(),
            "fullUrl" => $request->fullUrl(),
            "content" => $request->getContent(),
            "header" => $request->header(),
        ]);
        return response("OK");
    }

}
