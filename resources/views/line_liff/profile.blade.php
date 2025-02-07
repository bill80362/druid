<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config("app.name")}} 會員卡</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
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
<div class="card">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        JsBarcode("#barcode", "{{$member?->slug}}", {
            format: "CODE128",
            displayValue: true,
            fontSize: 18,
            width:3,
            // height:60,
        });
    });
</script>
</body>
</html>
