<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config("app.name")}} 會員卡</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center bg-light" style="height: 100vh;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2>新會員註冊</h2>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger text-center">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
{{--                    <div class="alert alert-danger text-center" role="alert">--}}
{{--                        會員手機已註冊過了，請告知店家協助綁定帳號即可--}}
{{--                    </div>--}}
                    <form action="/line_liff/register" method="post">
                        @csrf
                        <input type="hidden" name="line_id" value="{{request()->get("userId")}}">
                        <div class="mb-3">
                            <label for="name" class="form-label">姓名</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">電話</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">送出</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
