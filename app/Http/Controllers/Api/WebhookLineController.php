<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

class WebhookLineController extends Controller
{
    public function line(Request $request,$slug)
    {
        $line = Line::where("slug",$slug)->firstOrFail();

        $lineMessages = new LineMessages();
        $lineMessages->user_id = $line->user_id;
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
                    //
                    $reply = Reply::where("name",$event['message']['text']??"")->first();
                    if($reply){
                        //
                        $member = Member::withSum('points','point')->withSum('orders','total')->with(["level"])->where("line_id",$event['source']['userId']??"")->first();
                        //
                        $replyContent = $reply->content;
                        if(str_contains($replyContent,'{{')){
                            if(!$member){
                                //系統設定
                                $setting = Setting::user()->first();
                                $systemSetting = $setting?->content;
                                $reply_without_register = $systemSetting["reply_without_register"]??"您的Line目前尚未綁定帳號，請先[綁定會員]或[建立新會員]";
                                $replyContent = $reply_without_register;
                            }else{
                                //點數
                                $point = $member?->points_sum_point??0;
                                $replyContent = str_replace('{{$point}}',$point,$replyContent);
                                //會員名字
                                $member_name = $member?->name;
                                $replyContent = str_replace('{{$member_name}}',$member_name,$replyContent);
                                //會員名字
                                $member_phone = $member?->phone;
                                $replyContent = str_replace('{{$member_phone}}',$member_phone,$replyContent);
                                //等級
                                $member_level = $member?->level?->name;
                                $replyContent = str_replace('{{$member_level}}',$member_level,$replyContent);
                                //距離下次升等還差
                                if(str_contains($replyContent,'{{$member_upgrade_gap}}')){
                                    $nextLevel = null;
                                    $upgrade_gap = 0;
                                    if($member?->level?->sort){
                                        $nextLevel = Level::where("sort",">",$member?->level?->sort)->orderBy("sort")->first();
                                    }
                                    if($nextLevel?->id){
                                        $gap = (int)$nextLevel->upgrade - (int)$member?->orders_sum_total;
                                        $upgrade_gap = max($gap,0);
                                    }
                                    $replyContent = str_replace('{{$member_upgrade_gap}}',$upgrade_gap,$replyContent);
                                }


                            }
                        }
                        //
                        $response_http = Http::withToken($line->access_token)->post("https://api.line.me/v2/bot/message/reply",[
                            'replyToken' => $event['replyToken']??"",
                            'messages' => [
                                [
                                    'type' => 'text',//限制300字
                                    'text' => $replyContent,
                                ]
                            ]
                        ]);
                    }
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
}
