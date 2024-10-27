# Druid 
* 為了希望快速開發，先準備這個開頭

## 環境初始化 livewire+breeze套入帳號管理

* composer require livewire/livewire
* composer require laravel/breeze --dev
* php artisan breeze:install
* 選 Livewire (Volt Class API) with Alpine
* php artisan migrate
* php artisan livewire:publish --config
* config/livewire.php 修改 'layout' => 'layouts.app'

## 安裝bootstrap在vite上

* npm install -D bootstrap@5.3.3
* npm install -D sass
* npm install
* 檔案 app.css 改 app.scss
* vite.config.js 改 app.scss
* resources/js/app.js 加上import 'bootstrap';
* 有三頁引用vire的app.css都改成app.scss
* @vite(['resources/sass/app.scss', 'resources/js/app.js'])
* npm run build

## 安裝列表篩選器

* composer require spatie/laravel-query-builder

## 建立中繼表
*  php artisan make:model PagePageTag -p --migration

## 開發環境下看ER圖
* php artisan erd:generate
* http://127.0.0.1:8000/laravel-erd

## 圖片軟連結
* php artisan storage:link
