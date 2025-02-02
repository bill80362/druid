<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Line;
use App\Models\LineMessages;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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
            "fullUrl" => $request->fullUrl(),
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
                //回應訊息
                try{
                    $response_http = Http::withToken($line->access_token)->post("https://api.line.me/v2/bot/message/reply",[
                        'replyToken' => $event['replyToken']??"",
                        'messages' => [
                            [
                                'type' => 'text',//限制300字
                                'text' => '這是'.config('app.name')."自動回應文字範本\n我是換行",
                            ]
                        ]
                    ]);
                }catch (Exception $e){
                    Log::debug("Line回應錯誤訊息:".$e->getMessage());
                }
            }elseif ($event['message']['type'] == 'image') {
                $lineMessages->type = "I";
                $lineMessages->message = $event['message']['id']??"";
                $lineMessages->member_line_id = $event['source']['userId']??"";
                $lineMessages->message_at = Carbon::createFromTimestampMs($event['timestamp'])->setTimezone(config("app.timezone"))->format("Y-m-d H:i:s");
                $lineMessages->save();
            }
        }

        return response("OK");
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
