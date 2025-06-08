<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $city?->name }}{{ $region?->name }}找保母 - 專業保母媒合平台，免費登錄、迅速媒合</title>
    <meta name="description" content="尋找{{ $city?->name }}{{ $region?->name }}保母，讓您安心工作無後顧之憂。免費登錄、迅速媒合。">
    <meta name="keywords" content="保母, 托育, 照顧, 保姆, 育兒, {{ $city?->name}}, {{ $region?->name }}">
    <link rel="icon" href="{{ asset('/logo/logo_50.png') }}" type="image/png">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $city?->name }}{{ $region?->name }}找保母 - 專業保母媒合平台，免費登錄、迅速媒合">
    <meta property="og:description" content="尋找{{ $city?->name }}{{ $region?->name }}保母，免費登錄、迅速媒合。">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $city?->name }}{{ $region?->name }}找保母 - 專業保母媒合平台，免費登錄、迅速媒合">
    <meta property="twitter:description" content="尋找{{ $city?->name }}{{ $region?->name }}保母，免費登錄、迅速媒合。">

    <link rel="canonical" href="{{ url()->current() }}">

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

<div class="card m-3">
    <div class="card-header">
        <div class="flex justify-content-between">
            <div class="d-flex align-items-center">
                <img src="{{ asset('/logo/logo_50.png') }}" alt="logo" class="me-2" />
                <div>
                    {{ $city?->name }}{{ $region?->name }}找保母、免費登錄、迅速媒合 <a target="_blank" href="https://goodbodytw.com">https://goodbodytw.com</a>
                </div>
            </div>
            <div>
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">搜尋條件</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if($userId)
            <div class="row">
                <div class="col-12 mb-2">
                    <h5 class="text-danger">注意：衛福部的網站被line視為不安全，因此出現『此網站不安全』，請選擇使用預設瀏覽器開啟就可以了。(不是每個手機都會發生)</h5>
                    <h5 class="text-danger">另一個方式，不要使用Line瀏覽器，使用一般瀏覽器到<a target="_blank" href="https://goodbodytw.com">https://goodbodytw.com</a>進行尋找保母</h5>
                    <h5 class="text-danger">如為自行登錄，需自行注意是否為合法可申請補助之保母</h5>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12 mb-2">
                    <h5 class="text-danger">如果您是保母，歡迎<a target="_blank" href="https://lin.ee/fJCswPC">加入Line(ID:@926shklf)</a>，進行免費登錄，就可以在這邊被找到囉！</h5>
                    <h5 class="text-danger">如為自行登錄，需自行注意是否為合法可申請補助之保母</h5>
                </div>
            </div>
        @endif
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
                            <p class="card-text my-2">
                                @if($item->status=="Y")
                                    資料來源：自行登錄<br/>
                                @endif
                                {!! nl2br($item?->info??'') !!}
                            </p>
                            @if($userId)
                                {{--追蹤--}}
                                <button type="button" class="card-link btn btn-sm btn-danger ms-1 likeBtn " @style(['display:none'=>!in_array($item->id,$likeIds)]) data-id="{{$item->id}}" data-like-type="2">取消追蹤</button>
                                <button type="button" class="card-link btn btn-sm btn-outline-primary ms-1 likeBtn " @style(['display:none'=>in_array($item->id,$likeIds)])  data-id="{{$item->id}}" data-like-type="1">追蹤</button>
                            @else
                                <button type="button" class="card-link btn btn-sm btn-outline-primary ms-1 " onclick="alert('請使用line才能開啟此功能')">追蹤</button>
                            @endif

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
<div style="height: 100px;"></div>


<!-- Modal -->
<form>
    @if($userId)
        <input type="hidden" name="userId" value="{{$userId}}">
    @endif
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
                    @if($userId)
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
                    @endif
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

    @if($userId)
    // 處理所有追蹤按鈕的點擊事件
    document.querySelectorAll('.likeBtn').forEach(button => {
        button.addEventListener('click', function() {
            const userId = '{{$userId}}';
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
    @endif

</script>

<!-- 結構化資料標記 -->
<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Service",
      "name": "{{ $city?->name }}{{ $region?->name }}找保母，專業保母媒合平台，免費登錄、迅速媒合",
      "description": "提供{{ $city?->name }}{{ $region?->name }}地區的專業保母媒合服務，幫助家長尋找合適的托育人員。",
      "provider": {
        "@type": "Organization",
        "name": "專業保母媒合平台",
        "url": "{{ url('/') }}"
      },
      "areaServed": "{{ $city?->name }}{{ $region?->name }}",
      "serviceType": "托育媒合服務"
    }
</script>

</body>
</html>

