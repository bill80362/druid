<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config("app.name")}} 會員卡</title>
    <style>
        body, html {
            height: 100%;
            /*margin: 0;*/
            /*display: flex;*/
            justify-content: center;
            align-items: center;
            background-color: #f3f3f3;
            font-family: Arial, sans-serif;
        }
        .card {
            /*width: 90%;*/
            max-width: 600px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card-header {
            background-color: #3498db;
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 24px;
        }
        .card-body {
            padding: 20px;
        }
        .card-text {
            margin: 10px 0;
            font-size: 18px;
        }
        .card-text strong {
            color: #333;
        }
        .barcode {
            text-align: center;
            margin-top: 20px;
            /*width: 300px;*/
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
</head>
<body>
<div class="card m-3">
    <div class="card-header">
        {{$member?->level->name}}
    </div>
    <div class="card-body">
        <p class="card-text"><strong>名稱:</strong> {{$member?->name}}</p>
        <p class="card-text"><strong>電話:</strong> {{$member?->phone}}</p>
        <p class="card-text"><strong>生日:</strong> {{$member?->birthday}}</p>
        <div class="barcode">
            <svg id="barcode"></svg>
        </div>
    </div>
</div>
<div style="height: 20px;">

</div>
<div class="card">
    <div class="card-header">
        優惠券
    </div>
    <div class="card-body">
        @if($coupons?->count())
            @foreach($coupons as $coupon)
                <p class="card-text">
                    <strong>{{$coupon?->name}}</strong>
                    {{ \App\Enum\CouponTypeEnum::tryFrom($coupon->coupon_type)?->text() }}
                    @if($coupon->coupon_type=="M")
                        ${{$coupon->discount_money}} 元
                    @elseif($coupon->coupon_type=="R")
                        {{$coupon->discount_ratio}}%
                    @endif
                </p>
                <div class="barcode">
                    <svg id="coupon_barcode{{$coupon->id}}"></svg>
                </div>
            @endforeach
        @else
            <p class="card-text">沒有可以使用的優惠券</p>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        JsBarcode("#barcode", "{{$member?->slug}}", {
            format: "CODE128",
            displayValue: true,
            fontSize: 18,
            width:3,
            // height:60,
        });
        @foreach($coupons as $coupon)
            JsBarcode("#coupon_barcode{{$coupon->id}}", "{{$coupon?->coupon_code}}", {
                format: "CODE128",
                displayValue: true,
                fontSize: 18,
                width:3,
                // height:60,
            });
        @endforeach
    });
</script>
</body>
</html>
