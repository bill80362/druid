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
                            <h3>歡迎使用德魯伊系統，系統架構介紹：</h3>
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
                                                    <h5 class="my-1">功能自訂欄位管理</h5>
                                                    <small class="text-body-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">根據指定的功能，可以自行設定延伸欄位，非邏輯性的欄位都可以自行開立欄位。舉例像是：商品描述、商品運送須知。</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">內容管理系統</h5>
                                    <div class="card-text">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">頁面</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">舉例：關於我們、最新消息都可以使用此功能。這邊只提供標題和內容，其他可以透過自訂欄位自行產生。 </small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">頁面標籤</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">使用標籤來分類群組，例如最新消息標籤，這樣前台拉資料可以根據標籤來拉取所有最新消息的資料</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">標籤自訂欄位管理</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">頁面根據設定的標籤，可以有自訂欄位</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">商品系統</h5>
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
                                                <small class="my-1">綁定小分類和商品，一個小分類有多個商品，一個商品可以設定多個小分類，根據小分類就可以關聯到大分類</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">訂單系統</h5>
                                    <div class="card-text">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">訂單</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">商品基本資料、規格設定(顏色、尺寸...等等)</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">訂單商品明細</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">訂單內的商品</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">訂單金流</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">訂單產生>金流付款>訂單付款完成</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">訂單物流</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">訂單付款完成>商品檢貨和QC>訂單出貨開始物流>訂單完成</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">訂單逆物流</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">訂單退回申請>訂單退回物流中>逆物流到貨>QC商品回庫存>逆物流訂單完成</small>
                                                <small class="my-1">商品未領貨退回>逆物流到貨>QC商品回庫存>逆物流訂單完成</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">門市結帳流程</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">一樣建立訂單，只是流程會與網購不同，金流接實體金流。物流選項也不同。</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">門市退貨流程</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">待討論</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">會員系統</h5>
                                    <div class="card-text">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">會員管理</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">會員基本資料、等級</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">會員分析</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">會員的各種分析，訂單、購買商品、累積消費、等級升降</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">會員購物金</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">會員購物金，適合像是退貨暫時放入購物金，再走申請退款流程。</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">會員紅利金</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">優惠贈送，可以拿來按比例折抵商品</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">會員等級折扣</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">根據等級購買商品，可以有折扣</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">結帳優惠系統</h5>
                                    <div class="card-text">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">小分類優惠規則</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">滿X打折、滿X折扣金額、滿Ａ送Ｂ、相同是否可以重複吃到優惠、優惠優先順序</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">優惠規則綁定小分類</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">優惠和商品的綁定，透過小分類</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">全館優惠</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">滿Ｘ打折、滿Ｘ折扣金額、贈品(小分類)、滿額加購(小分類)</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">折扣碼/優惠卷</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">讓全館優惠和小分類優惠可以設定</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">折扣碼/優惠卷綁定優惠</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">綁定全館或小分類</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">折扣碼/優惠卷限制條件</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">會員限制使用或使用次數</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">商品倉儲系統</h5>
                                    <div class="card-text">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">倉庫</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">多倉庫，門市，網路</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">庫存管理</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">商品規格出庫入庫、倉庫調撥、入庫成本、訂單商品出貨關聯出庫單、損外遺失報廢</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">倉庫綁定網路商店</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">例如蝦皮API串接，</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">分析報表</h5>
                                    <div class="card-text">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">會員分析</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">活動會員、冷會員</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">商品銷售分析</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">熱賣商品、追蹤商品</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">銷售利潤表</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">月份、年度</small>
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
