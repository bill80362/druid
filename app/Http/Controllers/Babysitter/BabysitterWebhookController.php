<?php

namespace App\Http\Controllers\Babysitter;

use App\Http\Controllers\Controller;
use App\Models\Babysitter\Babysitter;
use App\Models\Level;
use App\Models\Line;
use App\Models\LineMessages;
use App\Models\Member;
use App\Models\Reply;
use App\Models\Setting;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class BabysitterWebhookController extends Controller
{
    public function line(Request $request)
    {
        $secret = config('babysitter.line_secret');
        $accessToken = config('babysitter.line_access_token');

        $signature = base64_encode(hash_hmac('sha256', $request->getContent() , $secret, true));
        if ($signature != $request->header('x-line-signature')) {
            throw new \Exception("sign error");
        }

        Log::info("Line Webhook",$request->all());

        foreach ($request->get("events")?:[] as $event){
            if ($event['message']['type'] == 'text') {
                //
                $type = $event['message']['type']??"";
                $text = $event['message']['text']??"";
                $lineUserId = $event['source']['userId']??"";
                $timestamp = $event['timestamp']??"";
                $timestampCarbon = Carbon::createFromTimestampMs($event['timestamp']??"")->setTimezone(config("app.timezone"));
                $replyToken = $event['replyToken']??"";
                $replyMessage = "請使用操作面板給予指令，謝謝。";
                //回應訊息
                if($text=="保母打卡"){
                    if($this->signIn($lineUserId,Carbon::now())){
                        $replyMessage = "打卡成功";
                    }else{
                        $replyMessage = "打卡失敗";
                    }
                }
                //
                try{
                    //
                    $response_http = Http::withToken($accessToken)->post("https://api.line.me/v2/bot/message/reply",[
                        'replyToken' => $replyToken,
                        'messages' => [
                            [
                                'type' => 'text',//限制300字
                                'text' => $replyMessage,
                            ]
                        ]
                    ]);
                }catch (Exception $e){
                    Log::debug("Line回應錯誤訊息:".$e->getMessage());
                }
            }elseif ($event['message']['type'] == 'image') {

            }
        }

        return response("OK");
    }
    public function image($slug,$image)
    {
        $line = Line::where("slug",$slug)->firstOrFail();
        //
//        $line = Line::findOrFail($id);
        $http_response = Http::withToken($line->access_token)->get("https://api-data.line.me/v2/bot/message/{$image}/content");
        $response = Response::make($http_response->body());
        $response->header("content-type",$http_response->header("content-type"));
        return $response;
    }

    /**
     * 保母打卡
    */
    public function signIn(string $lineUserId,Carbon $timestamp): bool
    {
        //取得保母資料
        $babysitter = Babysitter::where("line_id",$lineUserId)->first();
        if (!$babysitter) {
            return false;
        }
        //打卡時間
        $babysitter->sign_at = $timestamp;
        $babysitter->save();
        return true;
    }
}
