<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Line;
use App\Models\LineMessages;
use App\Models\Meta;
use App\Models\MetaMessage;
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
    public function webhook(Request $request,$id){
        //
        $meta = Meta::findOrFail($id);
        //
        $metaMessage = new MetaMessage();
        $metaMessage->status = "I";
        $metaMessage->meta_id = $meta->id;
        $metaMessage->log = json_encode([
            "header" => $request->header(),
            "body" => $request->getContent(),
            "fullUrl" => $request->fullUrl(),
        ]);
        $metaMessage->save();
        //驗證

        //
        $entry = $request->get("entry");
        foreach ($entry as $event){
            if(!empty($event["id"])){
                $metaMessage->type = "T";
                $metaMessage->message = $event['messaging'][0]['message']["text"]??"";
                $metaMessage->member_meta_id = $event['sender']['id']??"";
                $metaMessage->message_at = Carbon::createFromTimestampMs($event["time"]??"")->format("Y-m-d H:i:s");
                $metaMessage->save();
            }
        }

        return response("OK");
    }

}
