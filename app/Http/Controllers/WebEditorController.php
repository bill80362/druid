<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class WebEditorController extends Controller
{
    public function upload()
    {
        $filePath = Storage::disk("public")->putFile("editor",request()->file('file'));
        return new JsonResponse([
            "link" => "/storage/".$filePath,
        ]);
    }

    /***編輯器上傳圖片***/
    public function editor(){
        //Middleware
        $WebData = $this->oMiddleware->WebData;
        //
        if( (!$WebData["WebID"])){
            exit("權限不足、上傳失敗");
        }
        //
        $oDiskSizeChecker = new \Service\DiskSizeChecker($WebData["WebID"]);
        list($TotalUsed,) = $oDiskSizeChecker->getUsed();
        $QuotaImageBype = $WebData["QuotaImage"]*1024*1024;
        if($TotalUsed>=$QuotaImageBype){
            echo '{"code":1000,"message":"上傳額度已滿'.$WebData["QuotaImage"].'MB"}';
            exit();
        }
        //
        if (!is_dir(SITE_PATH . "/www/uploads/editor/".$WebData["WebID"])) {
            mkdir(SITE_PATH . "/www/uploads/editor/".$WebData["WebID"], 0777);
        }
        //
        try {
            //開放591的webp檔案，也要可以上傳
            \FroalaEditor\Image::$defaultUploadOptions["validation"]["allowedExts"][] = "webp";
            \FroalaEditor\Image::$defaultUploadOptions["validation"]["allowedMimeTypes"][] = "image/webp";
            $response = \FroalaEditor_Image::upload('/uploads/editor/'.$WebData["WebID"].'/');
//            $response->link = "http://admin.billc.work/" . $response->link;
            echo stripslashes(json_encode($response));
        } catch (Exception $e) {
            http_response_code(404);
        }
    }
}
