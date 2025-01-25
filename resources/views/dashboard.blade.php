<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('使用說明書') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-12 col-md-6 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">系統設定</h5>
                                    <div class="card-text">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">帳號管理</h5>
                                                    <small class="text-primary">已完成</small>
                                                </div>
                                                <small class="my-1">針對此系統的登入身份進行管理</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">規格群組</h5>
                                                    <small class="text-primary">已完成</small>
                                                </div>
                                                <small class="my-1">商品的規格，例如顏色、尺寸、規格</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">規格選項</h5>
                                                    <small class="text-primary">已完成</small>
                                                </div>
                                                <small class="my-1">例如顏色有紅色、黑色、白色，尺寸有小、中、大</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">Line帳號</h5>
                                                    <small class="text-primary">已完成</small>
                                                </div>
                                                <small class="my-1">會員Line登入串接，Line官方帳號詢問問題，系統也能抓到。</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">Meta串接</h5>
                                                    <small class="text-primary">已完成</small>
                                                </div>
                                                <small class="my-1">可以抓到facebook(FB)/instagram(IG)的粉絲帳號私人對話記錄</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">臉書直播</h5>
                                                    <small class="text-info">評估中</small>
                                                </div>
                                                <small class="my-1">可以抓到直播間的聊天室對話</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">設定串接對話對應行為</h5>
                                                    <small class="text-info">評估中</small>
                                                </div>
                                                <small class="my-1">LINE/FB/IG/直播間的對話內容，實行應對方案，可能是回應會員點數、訂單資訊、自訂下單(599 +1 自動完成下單)</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">批次管理</h5>
                                    <div class="card-text">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">商品匯出</h5>
                                                    <small class="text-primary">已完成</small>
                                                </div>
                                                <small class="my-1">匯出包含商品各項內容，會根據工作表(sheet)分開</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">商品匯入</h5>
                                                    <small class="text-primary">已完成</small>
                                                </div>
                                                <small class="my-1">請先匯出，編輯後再進行匯入，新增或修改的依據是id，空值代表新增，有值代表修改，欄位順序請依匯出順序不可變動。</small>
                                            </a>
{{--                                            <a href="#" class="list-group-item list-group-item-action">--}}
{{--                                                <div class="d-flex w-100 justify-content-between">--}}
{{--                                                    <h5 class="my-1">標籤自訂欄位管理</h5>--}}
{{--                                                    <small class="text-primary">已完成</small>--}}
{{--                                                </div>--}}
{{--                                                <small class="my-1">頁面根據設定的標籤，可以有自訂欄位</small>--}}
{{--                                            </a>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">商品管理</h5>
                                    <div class="card-text">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">主商品</h5>
                                                    <small class="text-primary">已完成</small>
                                                </div>
                                                <small class="my-1">門市系統請不要使用，未來保留給電子商務用</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">商品明細</h5>
                                                    <small class="text-primary">已完成</small>
                                                </div>
                                                <small class="my-1">商品條碼(sku)，每個商品(各種規格)都是獨立的sku，舉例：洋裝(黑)(F)DRESSBLACKF、洋裝(紅)(F)DRESSREDF，建議使用批次匯入編輯</small>
                                            </a>
{{--                                            <a href="#" class="list-group-item list-group-item-action">--}}
{{--                                                <div class="d-flex w-100 justify-content-between">--}}
{{--                                                    <h5 class="my-1">商品標籤</h5>--}}
{{--                                                    <small class="text-secondary">評估中</small>--}}
{{--                                                </div>--}}
{{--                                                <small class="my-1">將商品貼上標籤，連動對應的功能</small>--}}
{{--                                            </a>--}}
{{--                                            <a href="#" class="list-group-item list-group-item-action">--}}
{{--                                                <div class="d-flex w-100 justify-content-between">--}}
{{--                                                    <h5 class="my-1">商品分類</h5>--}}
{{--                                                    <small class="text-secondary">評估中</small>--}}
{{--                                                </div>--}}
{{--                                                <small class="my-1">將商品分類，連動對應的功能</small>--}}
{{--                                            </a>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">訂單系統</h5>
                                    <div class="card-text">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">主訂單資訊</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">商品基本資料、規格設定(顏色、尺寸...等等)</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">訂單消費明細</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">商品、優惠、其他項目</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">訂單金流</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">對應金流付款</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">訂單物流</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">出貨單(撿貨>出貨>到貨>退貨)</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">銷退單</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">消費明細、金流、物流</small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 p-2">
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

                        <div class="col-12 col-md-6 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">結帳優惠系統</h5>
                                    <div class="card-text">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">標籤優惠規則</h5>
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

                        <div class="col-12 col-md-6 p-2">
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
                        <div class="col-12 col-md-6 p-2">
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


                        <div class="col-12 col-md-6 p-2">

                        </div>

                        <div class="col-12 col-md-6 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">存證信函寄送服務</h5>
                                    <div class="card-text">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">存證信函管理</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">建立存證信函>預覽內容</small>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="my-1">存證信函寄送(訂單)</h5>
                                                    <small class="text-secondary">評估中</small>
                                                </div>
                                                <small class="my-1">選擇存證信函>寄送>付款(綠界)</small>
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
