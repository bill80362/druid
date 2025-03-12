<?php

namespace App\Services\LinePay;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class LinePayPos
{
    public function __construct(
        public string $channelId = "12345678",
        public string $channelSecret = "12345678",
        public string $deviceType = "pos",
        public string $deviceProfileId = "pos",
        public string $orderIdPreCode = "pos",
    ){}

    /**
     * @throws ConnectionException
     * @throws Exception
     */
    public function pay($productName, $amount, $orderId, $oneTimeKey)
    {
        $url = "https://sandbox-api-pay.line.me/v2/payments/oneTimeKeys/pay";
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-LINE-ChannelId' => $this->channelId,
            'X-LINE-ChannelSecret' => $this->channelSecret,
            'X-LINE-MerchantDeviceType' => $this->deviceType,
            'X-LINE-MerchantDeviceProfileId' => $this->deviceProfileId,
        ])->post($url, [
            "productName" => $productName,
            "amount" => $amount,
            "currency" => "TWD",
            "orderId" => $this->orderIdPreCode . $orderId,
            "oneTimeKey" => $oneTimeKey,
            "capture" => true,//true:一次性直接付款，false:需要再callCapture API才算付款完成
            //
//            "extras" => [
//                "addFriends" => [
//                    "type" => "LINE_AT",
//                    "idList" => ["@aaa", "@bbb"],
//                ],
//                "branchName" => "需要付款的商店/分店名稱(僅會顯示前100字元)",
//                "branchId" => "",
//            ],
        ]);
        //
        $responseJson = $response->json();
        if ($responseJson['returnCode'] != '0000') {
            throw new Exception($responseJson['returnMessage']);
        }
        //
        return $responseJson;
    }

    public function check($orderId)
    {
        $url = "https://sandbox-api-pay.line.me/v2/payments/orders/$orderId/check";
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-LINE-ChannelId' => $this->channelId,
            'X-LINE-ChannelSecret' => $this->channelSecret,
            'X-LINE-MerchantDeviceType' => $this->deviceType,
            'X-LINE-MerchantDeviceProfileId' => $this->deviceProfileId,
        ])->get($url);
        //
        $responseJson = $response->json();
        if ($responseJson['returnCode'] != '0000') {
            throw new Exception($responseJson['returnMessage']);
        }
        //
        return $responseJson;
    }

}
