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
                    <button type="button" class="btn btn-sm btn-outline-primary">搜尋條件</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                    @foreach($paginator as $item)
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
                                <h6 class="card-subtitle mb-2 text-muted">{{$item->address}}</h6>
                                <p class="card-text my-2">{{$item->info}}</p>
                                <button type="button" class="btn btn-sm btn-primary card-link">追蹤</button>
                                @if($item->link)
                                    <a href="{{$item->link}}" class="card-link">詳細資訊</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
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


<script>

</script>
</body>
</html>
