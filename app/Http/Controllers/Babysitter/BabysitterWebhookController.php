<?php

namespace App\Http\Controllers\Babysitter;

use App\Http\Controllers\Controller;
use App\Models\Babysitter\Babysitter;
use App\Models\Babysitter\BabysitterSearchLog;
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
                    $replyMessage = "";
                    $babysitters = Babysitter::whereIn("status",["Y","I"])
                        ->with(["services","addressCity","addressRegion"])
                        ->whereHas("likes", fn($q) => $q->where("line_user_id", $lineUserId ))
                        ->get();
                    foreach ($babysitters as $i => $babysitter) {
                        $replyMessage .= ($i + 1) . ". " . $babysitter->name . "\n";
                        if($babysitter->cellphone){
                            $replyMessage .= $babysitter->cellphone . "\n";
                        }
                        $replyMessage .= $babysitter->addressCity?->name . $babysitter->addressRegion?->name . $babysitter->address . "\n";
                        if($babysitter?->services?->pluck('name')?->implode(',')){
                            $replyMessage .= $babysitter?->services?->pluck('name')?->implode('、') . "\n";
                        }
                        if($babysitter->url){
                            $replyMessage .= $babysitter->url . "\n";
                        }
                        $replyMessage .= "\n";
                    }
                    if(!$replyMessage){
                        $replyMessage = "目前沒有追蹤中的保母";
                    }
                }elseif($text=="家長注意事項"){
                    $replyMessage = "家長你好，感謝使用本系統，保母資訊來源為保母自行登錄，請自行評估保母是否為合法保母\n" .
                        "如有遇到有問題的保母，煩請通報管理員。\n" .
                        "此系統目前皆為免費，如果有遇到相關收費資訊，都是詐騙！\n" .
                        "如果真的遇到煩請通報管理員，謝謝。";
                }elseif($text=="保母注意事項"){
                    $replyMessage = "您好，感謝使用本系統，保母刊登之資料，請符合法規。\n" .
                        "保母如上傳包含個人資料，未來如果不想出現請在刊登介面自行刪除即可，本系統不會備份\n" .
                        "如有遭遇到檢舉或違反法規之情事，本系統有停止您刊登資料之權利。\n" .
                        "此系統目前皆為免費，如果有遇到相關收費資訊，都是詐騙！\n" .
                        "如果真的遇到煩請通報管理員，謝謝。";
                }elseif($text=="系統資訊"){
                    $replyMessage = "保母自行登錄數:".Babysitter::where("status","Y")->count()."\n";
                    $replyMessage .= "家長搜尋人數:".BabysitterSearchLog::select('line_user_id')->whereNotNull('line_user_id')->distinct()->count();
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
        return "你好，感謝使用本系統，保母資訊來源為保母自行登錄，請自行評估保母是否為合法保母\n" .
            "\n" .
            "此系統目前皆為免費，如果有遇到相關收費資訊，都是詐騙！\n" .
            "\n" .
            "如果真的遇到再通知我一下，謝謝。\n".
            "俊瑋 line_id:bill80362";
    }
}
