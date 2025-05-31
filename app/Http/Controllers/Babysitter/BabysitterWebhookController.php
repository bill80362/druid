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
            if (!empty($event['message']['type']) && $event['message']['type'] == 'text') {
                //
                $type = $event['message']['type']??"";
                $text = $event['message']['text']??"";
                $lineUserId = $event['source']['userId']??"";
                $timestamp = $event['timestamp']??"";
                $timestampCarbon = Carbon::createFromTimestampMs($event['timestamp']??"")->setTimezone(config("app.timezone"));
                $replyToken = $event['replyToken']??"";
                $replyMessage = "歡迎使用下方功能區選單";
                //回應訊息
                if($text=="保母打卡"){
                    if($this->signIn($lineUserId,Carbon::now())){
                        $replyMessage = "打卡成功";
                    }else{
                        $replyMessage = "打卡失敗，請先登錄保母資訊。";
                    }
                }elseif($text=="追蹤保母"){
                    $replyMessage = "抱歉，此功能尚未製作";
                }elseif($text=="家長注意事項"){
                    $replyMessage = $this->basicMessage();
                }elseif($text=="保母注意事項"){
                    $replyMessage = $this->basicMessage();
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
            }elseif (!empty($event['message']['type']) && $event['message']['type'] == 'image') {

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
            "家長找保母建議，先根據地區查詢後，如果有自行登錄的保母可以先詢問，其次才是去[衛福部托育媒合平台]找尋\n" .
            "透過此系統可以先鎖定目標地區的保母基本資訊，再到[衛福部托育媒合平台]看看是否有聯絡方式\n" .
            "真的沒有再打到[服務中心]看看是否有該保母的聯絡方式，[服務中心]也會給妳當下可以的保母\n" .
            "\n" .
            "此系統目前皆為免費，如果有遇到相關收費資訊，都是詐騙！\n" .
            "\n" .
            "如果真的遇到再通知我一下，謝謝。\n".
            "\n" .
            "俊瑋 line_id:bill80362";
    }
}
