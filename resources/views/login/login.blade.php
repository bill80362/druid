<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    <!-- Styles -->
    @vite(['resources/css/app.scss', 'resources/js/app.js'])

    <style>
        html,
        body {
            height: 100%;
        }

        .form-signin {
            max-width: 450px;
            padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

    </style>
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">

<main class="form-signin w-100 m-auto">
    <form method="post">
        @csrf
        <h1 class="h3 mb-3 fw-normal">
            會員透過LINE官方帳號串接綁定
            快加入 @640niflo<br />
            登入試用<br />
            demo@demo.com<br />
            12345678
        </h1>

        <div class="form-floating">
            <input type="text" class="form-control" name="email" id="floatingInput" placeholder="帳號" value="demo@demo.com">
            <label for="floatingInput">帳號</label>
            <small class="text-danger">@error('email') {{ $message }} @enderror</small>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="密碼" value="12345678">
            <label for="floatingPassword">密碼</label>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">登入</button>
        <p class="mt-4 text-body-secondary">有問題請聯絡：</p>
        <p class="text-body-secondary">俊瑋 0921-515408<br/>Line_ID bill80362</p>
    </form>
</main>

</body>
</html>
