<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                                @if($item->cellphone)
                                    <a href="tel:{{$item->cellphone}}" class="card-link btn btn-sm btn-outline-primary">撥打</a>
                                @endif
                                @if($item->url)
                                    <a target="_blank" href="{{$item->url}}" class="card-link btn btn-sm btn-outline-primary">詳細資訊</a>
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
                                    <option value="{{$value->id}}" @selected($value->id==request()->get("filter_city"))>{{$value->name}}</option>
                                @endforeach
                            </select>
                            <select class="form-control" name="filter_region" id="region" style="width: 120px;">
                                <option value="0">不限制</option>
                                @foreach(\App\Models\Region::where("city_id",request()->get("filter_city"))->get() as $value)
                                    <option value="{{$value->id}}" @selected($value->id==request()->get("filter_region"))>{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <small class="text-danger">@error('filter_city') {{ $message['filter_city']??"" }} @enderror</small>
                        <small class="text-danger">@error('filter_region') {{ $message['filter_region']??"" }} @enderror</small>
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
</script>
</body>
</html>
