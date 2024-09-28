<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('首頁') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <h3>歡迎使用德魯伊系統，系統架介紹如下：</h3>
                        </div>
                        <div class="col-4 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">核心架構</h5>
                                    <div class="card-text">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">帳號管理</h5>
                                                    <small class="text-primary">已完成</small>
                                                </div>
                                                <small class="my-1">後台、登入登出、我的資料，管理平台基礎操作</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">權限管理</h5>
                                                    <small class="text-primary">已完成</small>
                                                </div>
                                                <small class="my-1">帳號能夠設定功能的操作行為，讀取、新增、修改、刪除</small>
                                            </a>
{{--                                            <a href="#" class="list-group-item list-group-item-action">--}}
{{--                                                <div class="d-flex w-100 justify-content-between">--}}
{{--                                                    <h5 class="my-1">系統設定</h5>--}}
{{--                                                    <small class="text-body-secondary">未製作</small>--}}
{{--                                                </div>--}}
{{--                                                <small class="my-1">管理平台的相關設定，包含標題、icon、平台名稱</small>--}}
{{--                                            </a>--}}
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">自訂欄位管理</h5>
                                                    <small class="text-body-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">根據指定的功能，可以自行設定延伸欄位</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">商品</h5>
                                    <div class="card-text">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">商品主檔</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">商品基本資料、規格設定(顏色、尺寸...等等)</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">商品規格</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">(商品+各規格)產生商品規格</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">商品大分類</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">大分類，第一層分類</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">商品小分類</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">小分類，第二層分類</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">商品小分類歸類商品</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">綁定小分類和商品，一個小分類有多個商品，一個商品可以在多個小分類，根據小分類也可以關聯到大分類</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
