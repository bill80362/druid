<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>找保母</title>
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
            <div class="flex justify-content-between">
                <div>
                    找保母
                </div>
                <div>
                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">搜尋條件</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-2">
                    <h5 class="text-danger">注意：衛福部的網站被line視為不安全，因此出現『此網站不安全』，請選擇使用預設瀏覽器開啟就可以了。</h5>
                </div>
            </div>
            <div class="row">
                @foreach($paginator as $item)
                <div class="col-12 col-md-6 col-lg-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="flex justify-content-between mb-2">
                                    <div>{{$item->name}}</div>
                                    <div>
                                        @foreach($item?->services??[] as $service)
                                            <span class="badge bg-primary">{{$service->name}}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <h6 class="card-subtitle mb-2">{{$item->cellphone}}</h6>
                                <h6 class="card-subtitle mb-2 text-muted">{{$item->addressCity?->name}}{{$item->addressRegion?->name}}{{$item->address}}</h6>
                                <p class="card-text my-2">{!! nl2br($item?->info??'') !!}</p>
                                {{--追蹤--}}
                                <button type="button" class="card-link btn btn-sm btn-danger ms-1 likeBtn " @style(['display:none'=>!in_array($item->id,$likeIds)]) data-id="{{$item->id}}" data-like-type="2">取消追蹤</button>
                                <button type="button" class="card-link btn btn-sm btn-outline-primary ms-1 likeBtn " @style(['display:none'=>in_array($item->id,$likeIds)])  data-id="{{$item->id}}" data-like-type="1">追蹤</button>
                            @if($item->cellphone)
                                    <a href="tel:{{$item->cellphone}}" class="card-link btn btn-sm btn-outline-primary ms-1">撥打</a>
                                @endif
                                @if($item->url)
                                    <a target="_blank" href="{{$item->url}}" class="card-link btn btn-sm btn-outline-primary ms-1">詳細資訊</a>
                                @endif
                            </div>
                        </div>

                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12">
                    {{ $paginator->links() }}
                </div>
            </div>

        </div>
        <div class="card-footer">

        </div>
    </div>
    <div style="height: 100px;">

    </div>
</form>

<!-- Modal -->
<form>
    <input type="hidden" name="userId" value="{{request()->get('userId')}}">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">篩選</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label>地區</label>
                        <div class="input-group">
                            <select class="form-control" name="filter_city" id="city" style="width: 120px;" onchange="updateRegionOptions(this.value)">
                                <option value="0">不限制</option>
                                @foreach(\App\Models\City::get() as $value)
                                    <option value="{{$value->id}}" @selected($value->id==$filter_city)>{{$value->name}}</option>
                                @endforeach
                            </select>
                            <select class="form-control" name="filter_region" id="region" style="width: 120px;">
                                <option value="0">不限制</option>
                                @foreach(\App\Models\Region::where("city_id",$filter_city)->get() as $value)
                                    <option value="{{$value->id}}" @selected($value->id==$filter_region)>{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <small class="text-danger">@error('filter_city') {{ $message['filter_city']??"" }} @enderror</small>
                        <small class="text-danger">@error('filter_region') {{ $message['filter_region']??"" }} @enderror</small>
                    </div>
                    <div class="form-group mb-2">
                        <label>追蹤</label>
                        <div class="input-group">
                            <select class="form-control" name="filter_show_like">
                                <option value="0" @selected(1!=$filter_show_like)>全部</option>
                                <option value="1" @selected(1==$filter_show_like)>追蹤中</option>
                            </select>
                        </div>
                        <small class="text-danger">@error('filter_show_like') {{ $message['filter_show_like']??"" }} @enderror</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">篩選</button>
                    <a href="{{route('babysitter.search')}}" class="btn btn-secondary">清空</a>
                </div>
            </div>
        </div>
    </div>
</form>



<script>
    const cityRegion = @json($cities);

    function updateRegionOptions(cityId) {
        const regionSelect = document.getElementById('region');
        regionSelect.innerHTML = ''; // Clear existing options

        //
        const option = document.createElement('option');
        option.value = '0';
        option.textContent = '不限制';
        regionSelect.appendChild(option)
        //
        cityRegion.forEach(city => {
            if (city.id == cityId) {
                city.regions.forEach(region => {
                    const option = document.createElement('option');
                    option.value = region.id;
                    option.textContent = region.name;
                    regionSelect.appendChild(option);
                });
            }
        });
    }

    // 處理所有追蹤按鈕的點擊事件
    document.querySelectorAll('.likeBtn').forEach(button => {
        button.addEventListener('click', function() {
            const userId = '{{request()->get('userId')}}';
            const babysitterId = this.getAttribute('data-id');
            const likeType = this.getAttribute('data-like-type');

            fetch('{{route("babysitter.search.like")}}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    like_type: likeType,
                    line_user_id: userId,
                    babysitter_id: babysitterId
                })
            })
            .then(response => response.json())
            .then(data => {
                // 找到 data-like-type 的另一顆按鈕
                const anotherType = likeType%2+1;
                const likeButton = document.querySelector(`button[data-like-type="${anotherType}"][data-id="${babysitterId}"]`);
                if (likeButton) {
                    // 移除 display: none
                    likeButton.style.display = '';
                }
                // 隱藏當前點擊的按鈕
                this.style.display = 'none';

                console.log('成功:', data);
            })
            .catch(error => {
                console.error('錯誤:', error);
            });
        });
    });
</script>
</body>
</html>

