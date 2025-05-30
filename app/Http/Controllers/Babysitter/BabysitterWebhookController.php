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
                $replyMessage = $this->basicMessage();
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

    public function basicMessage(): string
    {
        return "你好，感謝使用本系統，保母資訊來源為：\n" .
            "1.政府的媒合平台\n" .
            "https://ncwisweb.sfaa.gov.tw/home/nanny\n" .
            "2.保母自行登錄\n" .
            "\n" .
            "如果您是保母，請使用[保母登錄]功能，進行登錄，並定期打卡，有利於查找時優先曝光！\n" .
            "\n" .
            "如果您是家長，可直接使用[找保母]功能，開始進行查詢，請注意此系統沒有審核保母制度，請自行評估保母！\n" .
            "\n" .
            "此系統目前皆為免費，如果有遇到相關收費資訊，都是詐騙！\n" .
            "\n" .
            "如果真的遇到煩請通報管理員(line_id:bill80362)，謝謝。";
    }
}
