<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Line;
use App\Models\LineMessages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class WebhookLineController extends Controller
{
    public function line(Request $request,$id)
    {
        $line = Line::findOrFail($id);

        $lineMessages = new LineMessages();
        $lineMessages->status = "I";
        $lineMessages->line_id = $line->id;
        $lineMessages->log = json_encode([
            "header" => $request->header(),
            "body" => $request->getContent(),
        ]);
        $lineMessages->save();

        $signature = base64_encode(hash_hmac('sha256', $request->getContent() , $line->secret, true));
        if ($signature != $request->header('x-line-signature')) {
            throw new \Exception("sign error");
        }

        foreach ($request->get("events")?:[] as $event){
            if ($event['message']['type'] == 'text') {
                //記錄訊息內容
                $lineMessages->type = "T";
                $lineMessages->message = $event['message']['text']??"";
                $lineMessages->member_line_id = $event['source']['userId']??"";
                $lineMessages->message_at = Carbon::createFromTimestampMs($event['timestamp'])->setTimezone(config("app.timezone"))->format("Y-m-d H:i:s");
                $lineMessages->save();
            }elseif ($event['message']['type'] == 'image') {
                $lineMessages->type = "I";
                $lineMessages->message = $event['message']['id']??"";
                $lineMessages->member_line_id = $event['source']['userId']??"";
                $lineMessages->message_at = Carbon::createFromTimestampMs($event['timestamp'])->setTimezone(config("app.timezone"))->format("Y-m-d H:i:s");
                $lineMessages->save();
            }
        }
    }
    public function image($id,$image)
    {
        $line = Line::findOrFail($id);
        $http_response = Http::withToken($line->access_token)->get("https://api-data.line.me/v2/bot/message/{$image}/content");
        $response = Response::make($http_response->body());
        $response->header("content-type",$http_response->header("content-type"));
        return $response;
    }
}
