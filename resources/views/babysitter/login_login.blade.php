<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>我的保母資料</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="card m-3">
    <div class="card-header">
        我的保母資訊
    </div>
    <div class="card-body">
        <div class="form-group mb-2">
            <label>名稱</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group mb-2">
            <label>手機</label>
            <input type="text" class="form-control" name="cellphone">
        </div>
        <div class="form-group mb-2">
            <label>LineID</label>
            <input type="text" class="form-control" name="line_id">
        </div>
        <div class="form-group mb-2">
            <label>地址</label>
            <input type="text" class="form-control" name="address">
        </div>
        <div class="form-group mb-2">
            <label>可申請補助</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="apply_money1" name="apply_money" value="Y">
                    <label class="form-check-label" for="apply_money1">是</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="apply_money2" name="apply_money" value="N">
                    <label class="form-check-label" for="apply_money2">否</label>
                </div>
            </div>
        </div>
        <div class="form-group mb-2">
            <label>服務項目</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="services1" name="services[]" value="A">
                    <label class="form-check-label" for="services1">全日托</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="services2" name="services[]" value="D">
                    <label class="form-check-label" for="services2">平日托</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="services3" name="services[]" value="N">
                    <label class="form-check-label" for="services3">夜托</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="services4" name="services[]" value="T">
                    <label class="form-check-label" for="services4">臨托</label>
                </div>
            </div>
        </div>
        <div class="form-group mb-2">
            <label>說明</label>
            <textarea class="form-control" rows="6" name="info"></textarea>
        </div>
        <div class="form-group mb-2">
            <label>網址連結</label>
            <input type="text" class="form-control" name="url">
        </div>
        <div class="form-group mb-2">
            <label>認證</label>
            <input type="text" class="form-control" name="certification">
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary">送出</button>
    </div>
</div>

<script>

</script>
</body>
</html>
