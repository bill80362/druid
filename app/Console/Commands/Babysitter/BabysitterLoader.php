<?php

namespace App\Console\Commands\Babysitter;

use App\Models\Babysitter\Babysitter;
use App\Models\City;
use App\Services\LevelService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class BabysitterLoader extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:b';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '載入保母資訊';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $city = City::select(["id", "name"])
            ->where("name",'高雄市')
            ->with(["regions"])->first();
        //
        $count = $city->regions?->count()??0;
        foreach ($city->regions??[] as $index => $region) {
            if($index<=2) continue;
            echo "正在執行{$city->name}{$region->name} 進度".($index+1)."/{$count}".PHP_EOL;
            $this->updateInfo($city->name, $region->name);
        }
    }

    public function updateInfo($city, $town)
    {
        //
        list($html, $cookies, $headers) = $this->get("https://ncwisweb.sfaa.gov.tw/home/nanny");
        //
        $csrf = "";
        if (preg_match('/<meta\s+name="_csrf"\s+content="([^"]+)"\s*\/?>/i', $html, $matches)) {
            $csrf = $matches[1];
        }
        // 將 Cookie 夾帶到下一次請求
        $cookieString = "";
        foreach ($cookies as $key => $value) {
            $cookieString .= $key . "=" . $value . "; ";
        }
        $html = $this->post($csrf, $cookieString, $city, $town, 0);
        //頁碼資訊
        preg_match_all('/ 筆資料．第 <span\s\s                class="text-danger">(\d*)\/(\d*)<\/span> 頁．每頁顯示 15 筆\s\s/', $html, $matches);
//        $nowPage = $matches[1][0];
        $total = $matches[2][0];
        //
        $data = $this->getInfo($html,$city, $town);
        for ($page = 1; $page < $total; $page++) {
//            sleep(rand(1, 1));
            $html = $this->post($csrf, $cookieString, $city, $town, $page);
            $infos = $this->getInfo($html,$city, $town);
            $data = array_merge($infos, $data);
        }
//        dd($data);
        //
        foreach ($data as $key => $value) {
            $babysitter = Babysitter::where("certification", $value["id"])->firstOrNew();
            $babysitter->status = "I";
            $babysitter->apply_money = "Y";
            $babysitter->certification = $value["id"];
            $babysitter->name = $value["name"];
            $babysitter->city = $value["city_id"];
            $babysitter->region = $value["region_id"];
            $babysitter->address = $value["address"];
            $babysitter->info = "資料來源：衛生部托育媒合平台[".date("Y-m-d H:i:s")."]";
//            $babysitter->url = $value["url"];
            $babysitter->save();
        }
    }

    public function get($uri)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
            "Accept-Language: zh-TW,zh-CN;q=0.9,zh;q=0.8,en-US;q=0.7,en;q=0.6",
            "Cache-Control: no-cache",
            "Connection: keep-alive",
            "DNT: 1",
            "Pragma: no-cache",
            "Sec-Fetch-Dest: document",
            "Sec-Fetch-Mode: navigate",
            "Sec-Fetch-Site: none",
            "Sec-Fetch-User: ?1",
            "Upgrade-Insecure-Requests: 1",
            "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36",
            "sec-ch-ua: \"Google Chrome\";v=\"135\", \"Not-A.Brand\";v=\"8\", \"Chromium\";v=\"135\"",
            "sec-ch-ua-mobile: ?0",
            "sec-ch-ua-platform: \"macOS\""
        ]);
        curl_setopt($ch, CURLOPT_COOKIE, "_gid=GA1.3.823419246.1746203196; JSESSIONID=C4EFD358288E84E839EF9E4DD3684C26; ROUTEID=jvm1; vo=iieAiCJaV_wRg1kXqMNuPdskaoZZ3Z4EP2YdHPKVYAu3dv6indnmu8H8NyTp_HUQCMakk1NDWj_ntdlgX9yQJ-Zr6DkEgMtnBoaTiw2rrL2vI3x5ZBFtlZoaMo0nqTHn5SqYTROZDgBlvxl2uiQhWJyQnF0Ea_CCv8XZLOF99j1zGcMZKs7FMGBFTUy-yYV1DxsgBULAcymeuUC4fvsqKQq51uRKrYlfLSCR9-y8n9DqL32T7AWRFp8zlcNM0uwxXioGCBcXwrGoQiJxPk3BdDJ2ID-390vaigonMVB1cTG1tOE2N1pgyx1GHPYiq_iyeLUgS_dIGR1VNky7Zd1pJG6pGyhPeW0C6DdSj3gocrvecANcJvxHpr8Su27AY6zfiBRetAloNw28KJn9mfuJ7YxIZG2TjO7k5LFL4r32iM5IvVvD91R-N_1UPZXfYhIhwpWxvIx62fNGrxyVPq--rQrhNx4OLK9INULl4xKAZLi_UDyZyN0NI80KU9i1QjhrTSYW6--WvfG98MajdD9cB9yVMB1JoVVyjDjlrQ1Z9kFXJbqG4821b7ZI9cBQFRO34Fu6oTlMYHU2Ga0n_XRWiwJfbR0b5jTEDMVJPHkYnKnOFSj5EXf5HqFfxgVLIRSX5WWLCKXY647EkMY0K0BZmsBttHY943WZMfF7PArAMXFdyu8eycf6PaFe_12wJESH06qtJ3sDok40Jes1SmFdgiuoopyYgrX_c17Xvq19iJcyrG-KQEylwzUrki-lCtgbtbKXEtb_4YTctEDANBw0FZkAhnRpgVXe4wScMctLIJKs2Ri3kg59ePuUFbiyUhoU; _ga_TL7YY1ZX56=GS1.1.1746240172.7.1.1746241750.0.0.0; _ga=GA1.1.1206555531.1741867961");

        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        //
        curl_setopt($ch, CURLOPT_HEADER, 1);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return ['Error:' . curl_error($ch), [], []];
        }

        // Separate headers and body
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $headers = substr($response, 0, $headerSize);
        $body = substr($response, $headerSize);

        // Parse cookies from headers
        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $headers, $matches);
        $cookies = [];
        foreach ($matches[1] as $cookie) {
            parse_str($cookie, $cookieArray);
            $cookies = array_merge($cookies, $cookieArray);
        }

        curl_close($ch);

        return [$body, $cookies, $headers];
    }

    public function post($csrf, $cookieString, $cityName, $townName ,$page = 0)
    {
        $cityIdSlug = [
            '新北市' => '4bc1e2f27af6e832017af6eeff7a0172',
            '台北市' => '4bc1e2f27af6e832017af6eeff750170',
            '桃園市' => '4bc1e2f27af6e832017af6eeff7d0173',
            '台中市' => '4bc1e2f27af6e832017af6eeff860176',
            '台南市' => '4bc1e2f27af6e832017af6eeff4a0162',
            '高雄市' => '4bc1e2f27af6e832017af6eeff8c0178',
            '宜蘭縣' => '4bc1e2f27af6e832017af6eeff580166',
            '新竹縣' => '4bc1e2f27af6e832017af6eeff890177',
            '苗栗縣' => '4bc1e2f27af6e832017af6eeff72016f',
            '彰化縣' => '4bc1e2f27af6e832017af6eeff5d0168',
            '南投縣' => '4bc1e2f27af6e832017af6eeff830175',
            '雲林縣' => '4bc1e2f27af6e832017af6eeff6f016e',
            '嘉義縣' => '4bc1e2f27af6e832017af6eeff63016a',
            '屏東縣' => '4bc1e2f27af6e832017af6eeff3e015d',
            '台東縣' => '4bc1e2f27af6e832017af6eeff67016b',
            '花蓮縣' => '4bc1e2f27af6e832017af6eeff600169',
            '澎湖縣' => '4bc1e2f27af6e832017af6eeff770171',
            '基隆市' => '4bc1e2f27af6e832017af6eeff460160',
            '新竹市' => '4bc1e2f27af6e832017af6eeff480161',
            '嘉義市' => '4bc1e2f27af6e832017af6eeff43015f',
            '連江縣' => '4bc1e2f27af6e832017af6eeff6c016d',
            '金門縣' => '4bc1e2f27af6e832017af6eeff38015c',
        ];
        //
        $cityId = $cityIdSlug[$cityName];
        $json = Storage::get('台中市.json');
        $json = json_decode($json, true);
        $json = collect($json)->pluck("id", "name")->toArray();
        $townId = $json["北區"]??'';
        //
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://ncwisweb.sfaa.gov.tw/home/nanny");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "_csrf={$csrf}&cityId={$cityId}&townId={$townId}&latitude=&longitude=&locateType=1&address=&distance=1.0&targetKind=1&careStatus=&cwregno=&cwregno2=&langFlag=&page=" . $page);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
            "Accept-Language: zh-TW,zh-CN;q=0.9,zh;q=0.8,en-US;q=0.7,en;q=0.6",
            "Cache-Control: no-cache",
            "Connection: keep-alive",
            "Content-Type: application/x-www-form-urlencoded",
//            "Cookie: JSESSIONID=C4EFD358288E84E839EF9E4DD3684C26",
            "Cookie: {$cookieString}",
            "DNT: 1",
            "Origin: https://ncwisweb.sfaa.gov.tw",
            "Pragma: no-cache",
            "Referer: https://ncwisweb.sfaa.gov.tw/home/nanny",
            "Sec-Fetch-Dest: document",
            "Sec-Fetch-Mode: navigate",
            "Sec-Fetch-Site: same-origin",
            "Sec-Fetch-User: ?1",
            "Upgrade-Insecure-Requests: 1",
            "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36",
            "sec-ch-ua: \"Google Chrome\";v=\"135\", \"Not-A.Brand\";v=\"8\", \"Chromium\";v=\"135\"",
            "sec-ch-ua-mobile: ?0",
            "sec-ch-ua-platform: \"macOS\"",
        ]);
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            return 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        return $response;
    }

    public function getInfo($html, $city, $town)
    {
        //地址
        $cities = City::select(["id", "name"])
            ->where("name",$city)
            ->with([
                "regions" => fn ($q) => $q->where("name", $town),
            ])->get();
        //保母
        preg_match_all('/保母編號\/姓名｜">(.*)<br>(.*)<\/td>\s\s/', $html, $matches);
        $ids = $matches[1] ?? [];
        $names = $matches[2] ?? [];
        //地址
        preg_match_all('/托育服務地址｜">\d*(.*)<\/td>\s\s/', $html, $matches);
        $addresses = $matches[1] ?? [];
        //詳細地址
        preg_match_all('/\'\/home\/nanny\/detail(.*)\'/', $html, $matches);
        $urls = $matches[1] ?? [];
        //
        $data = [];
        foreach ($ids as $key => $detailUrl) {
            //
            $city_id = 0;
            $region_id = 0;
            $address = $addresses[$key] ?? "";
            $address = str_replace("臺", "台", $address);
            //
            foreach ($cities as $city) {
                if (str_starts_with($address, $city->name)) {
                    //
                    $city_id = $city->id;
                    $address = str_replace($city->name, "", $address);
                    //
                    foreach ($city->regions ?? [] as $region) {
                        if (str_contains($address, $region->name)) {
                            $region_id = $region->id;
                            $address = str_replace($region->name, "", $address);
                        }
                    }
                }
            }
            //有地址和區域才登錄
            if($city_id && $region_id){
                $data[] = [
                    "id" => $ids[$key] ?? "",
                    "name" => $names[$key] ?? "",
                    "city_id" => $city_id,
                    "region_id" => $region_id,
                    "address" => $address,
                    "url" => "https://ncwisweb.sfaa.gov.tw/home/nanny/detail" . $urls[$key] ?? "",
                ];
            }
        }
        //
        return $data;
    }

}
