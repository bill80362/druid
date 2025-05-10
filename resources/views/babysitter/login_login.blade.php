<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>我的保母資料</title>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
@if($errors->any() || Illuminate\Support\Facades\Session::has('success'))
    <div class="fixed-top">
        @foreach($errors as $error)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{$error}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
        @foreach(Illuminate\Support\Facades\Session::get('success',[]) as $success)
            <div class="alert alert-success alert-dismissible fade show m-2" role="alert" style="z-index: 99999;">
                <strong>{{$success}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    </div>
@endif
<form method="post" name="userId" action="{{route('babysitter.login.submit')}}">
    @csrf
    <input type="hidden" name="userId" value="{{request()->get('userId')}}">
    <div class="card m-3">
        <div class="card-header">
            我的保母資訊
        </div>
        <div class="card-body">
            <div class="form-group mb-2">
                <label>名稱</label>
                <input type="text" class="form-control" name="name" value="{{$item->name}}">
                <small class="text-danger">@error('name') {{ $message['name']??"" }} @enderror</small>
            </div>
            <div class="form-group mb-2">
                <label>手機</label>
                <input type="text" class="form-control" name="cellphone" value="{{$item->cellphone}}">
                <small class="text-danger">@error('cellphone') {{ $message['cellphone']??"" }} @enderror</small>
            </div>
            <div class="form-group mb-2">
                <label>地址</label>
                <input type="text" class="form-control" name="address" value="{{$item->address}}">
                <small class="text-danger">@error('address') {{ $message['address']??"" }} @enderror</small>
            </div>
            <div class="form-group mb-2">
                <label>可申請補助</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="apply_money1" name="apply_money" value="Y" @checked($item->apply_money=="Y")>
                        <label class="form-check-label" for="apply_money1">是</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="apply_money2" name="apply_money" value="N" @checked($item->apply_money=="N")>
                        <label class="form-check-label" for="apply_money2">否</label>
                    </div>
                </div>
            </div>
            <div class="form-group mb-2">
                <label>服務項目</label>
                <div>
                    @foreach(\App\Models\Babysitter\BabysitterService::get() as $key => $value)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="services{{$value->id}}" name="services[]" value="{{$value->id}}" @checked($item->services->pluck("id")->contains($value->id))>
                            <label class="form-check-label" for="services1">{{$value->name}}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="form-group mb-2">
                <label>說明</label>
                <textarea class="form-control" rows="6" name="info">{{$item->info}}</textarea>
            </div>
            <div class="form-group mb-2">
                <label>網址連結</label>
                <input type="text" class="form-control" name="url" value="{{$item->url}}">
            </div>
            <div class="form-group mb-2">
                <label>認證</label>
                <input type="text" class="form-control" name="certification" value="{{$item->certification}}">
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">送出</button>
        </div>
    </div>
</form>


<script>

</script>
</body>
</html>
