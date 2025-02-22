<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.scss', 'resources/js/app.js'])

        <!--編輯器-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/froala_editor_3.2.6-1/css/froala_editor.css">
        <link rel="stylesheet" href="/froala_editor_3.2.6-1/css/froala_style.css">
        <link rel="stylesheet" href="/froala_editor_3.2.6-1/css/plugins/code_view.css">
        <link rel="stylesheet" href="/froala_editor_3.2.6-1/css/plugins/image_manager.css">
        <link rel="stylesheet" href="/froala_editor_3.2.6-1/css/plugins/image.css">
        <link rel="stylesheet" href="/froala_editor_3.2.6-1/css/plugins/table.css">
        <link rel="stylesheet" href="/froala_editor_3.2.6-1/css/plugins/video.css">
        <link rel="stylesheet" href="/froala_editor_3.2.6-1/css/plugins/colors.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
        <!-- Include the fonts. -->
        <link href='https://fonts.googleapis.com/css?family=Noto+Sans+TC' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Noto+Serif+SC' rel='stylesheet' type='text/css'>
        <style>
            /*Unlicensed隱藏*/
            /*.fr-wrapper > div:first-child {*/
            /*    display: none;*/
            /*}*/

            .collapse {
                visibility: visible;
            }

        </style>


    </head>
    <body class="font-sans antialiased">
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

        <div class="min-h-screen bg-gray-100">
            <livewire:layout.navigation2 />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-content-between">
                        <div>
                            {{ $header }}
                        </div>
                        <div>
                            {{ $header_tool??"" }}
                        </div>
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

    <script>
        //警示視窗自動關閉
        document.addEventListener('DOMContentLoaded', (event) => {
            setTimeout(() => {
                var elements = document.getElementsByClassName('alert-dismissible');
                for (var i = 0; i < elements.length; i++) {
                    elements[i].style.display = 'none';
                }
            }, 3000);
        });
    </script>

    </body>
</html>
