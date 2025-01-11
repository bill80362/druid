<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Line;
use App\Models\LineMessages;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function line(Request $request,$id)
    {
        $line = Line::findOrFail($id);

        $lineMessages = new LineMessages();
        $lineMessages->status = "I";
        $lineMessages->line_id = $line->id;
        $lineMessages->log = $request->getContent();
        $lineMessages->save();

//        $signature = base64_encode(hash_hmac('sha256', $request->getContent() , $line->secret, true));
//        if ($signature != $request->header('http_x_line_signature')) {
//            throw new \Exception("sign error");
//        }
//dd($request->get("events")[0]);
        foreach ($request->get("events")?:[] as $event){
            if ($event['message']['type'] == 'text') {
                //記錄訊息內容
                $lineMessages->type = "T";
                $lineMessages->message = $event['message']['text']??"";;
                $lineMessages->member_line_id = $event['source']['userId']??"";
//                $lineMessages->message_at = Carbon::createFromTimestamp($event['timestamp'])->format("Y-m-d H:i:s");
                $lineMessages->save();
            }
        }
    }
}
