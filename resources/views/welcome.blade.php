<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" />
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                            <h1>店小二</h1>
                        </div>
                        @if (Route::has('login'))
                            <livewire:welcome.navigation />
                        @endif
                    </header>

                    <main class="mt-6">
                        <div class="row">
{{--                            <div class="col-12 text-center py-10">--}}
{{--                                <h1>商品優惠管理+門市結帳+會員管理+LINE行銷</h1>--}}
{{--                            </div>--}}
                            <div>
                                <img src="/ptt/0215/1.jpg" />
                                <img src="/ptt/0215/2.jpg" />
                                <img src="/ptt/0215/3.jpg" />
                                <img src="/ptt/0215/4.jpg" />
                                <img src="/ptt/0215/5.jpg" />
                                <img src="/ptt/0215/6.jpg" />
                                <img src="/ptt/0215/7.jpg" />
                                <img src="/ptt/0215/8.jpg" />
                                <img src="/ptt/0215/9.jpg" />
                                <img src="/ptt/0215/10.jpg" />
                            </div>
                        </div>
                    </main>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        <h2>俊瑋 0921-515-408 Line:bill80362</h2>
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
