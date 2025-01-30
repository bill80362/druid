<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            門市結帳 | 結帳金額 {{$shoppingCartGoodsItems?->sum("discount_price")}} | 已付款 {{$shoppingCartPaymentItems->sum("money")}} | 還需支付 {{$shoppingCartGoodsItems?->sum("discount_price")-$shoppingCartPaymentItems->sum("money")}}
        </h2>
    </x-slot>
    <x-slot name="header_tool">
        <button class="btn btn-primary" type="button" onclick="document.getElementById('orderForm').submit();">結帳</button>
        <button class="btn btn-outline-secondary" type="button">選擇會員</button>
        <button class="btn btn-outline-secondary" type="button">選擇商品</button>
        <button class="btn btn-outline-secondary" type="button">選擇折扣</button>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 text-gray-900">
                    <div class="row">
                        <div class="col-4">
                            <form action="{{route("checkout.add.goods")}}">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="商品sku" name="goods_detail_sku">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">刷入商品</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="折扣碼">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button">刷入折扣碼</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <form action="{{route("checkout.set.member")}}">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="結帳會員卡號" name="member_slug">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">刷入卡號</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-8 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title flex justify-content-between">
                                        <div>
                                            結帳商品 ({{$shoppingCartGoodsItems?->count()}})
                                        </div>
                                        <div>
                                            小計 $ {{$shoppingCartGoodsItems?->sum("discount_price")}}
                                        </div>
                                    </h5>
                                    <div class="card-text">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>商品</th>
                                                <th>SKU</th>
                                                <th>原價</th>
                                                <th>折扣後</th>
                                                <th>使用優惠</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($shoppingCartGoodsItems as $item)
                                                <tr>
                                                    <td>{{$item->goodsDetail->name}}</td>
                                                    <td>{{$item->goodsDetail->sku}}</td>
                                                    <td>{{$item->goodsDetail->price}}</td>
                                                    <td>{{$item->discount_price}}</td>
                                                    <td>
                                                        @foreach($discountLogs[$item->id]??[] as $discount)
                                                            <span class="badge bg-secondary">{{$discount["name"]}}</span>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-outline-secondary" href="{{route("checkout.remove.goods")}}?id={{$item->id}}">移除</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title flex justify-content-between">
                                        <div>
                                            使用會員結帳
                                        </div>
                                        <div class="card-tool">
                                            @if($member)
                                                <a class="btn btn-outline-secondary" href="{{route("checkout.reset.member")}}">取消</a>
                                            @else
                                                <a class="btn btn-outline-secondary" target="_blank" href="{{route("members.create")}}">新增</a>
                                            @endif
                                        </div>
                                    </h5>
                                    <div class="card-text">
                                        @if($member)
                                            <table class="table table-striped">
                                                <tr>
                                                    <td>卡號</td>
                                                    <td>{{$member?->slug}}</td>
                                                </tr>
                                                <tr>
                                                    <td>名字</td>
                                                    <td>{{{$member?->name}}}</td>
                                                </tr>
                                                <tr>
                                                    <td>手機</td>
                                                    <td>{{{$member?->phone}}}</td>
                                                </tr>
                                                <tr>
                                                    <td>剩餘點數</td>
                                                    <td>300</td>
                                                </tr>
                                                <tr>
                                                    <td>歷史訂單</td>
                                                    <td>$300 (5)</td>
                                                </tr>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">使用優惠</h5>
                                    <div class="card-text">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>項目</th>
                                                <th>代碼</th>
                                                <th>優惠說明</th>
                                                <th>折抵金額</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">付款</h5>
                                    <div class="card-text">
                                        <form action="{{route("checkout.add.payment")}}">
                                            <div class="input-group mb-3">
                                                <select class="form-control" name="payment_id">
                                                    @foreach($paymentItems as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                <input type="text" class="form-control" placeholder="金額" name="money">
                                                <input type="text" class="form-control" placeholder="備註" name="memo">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="submit">新增</button>
                                                </div>
                                            </div>
                                        </form>
                                        <table class="table table-striped">
                                            <tr>
                                                <td>付款方式</td>
                                                <td>金額</td>
                                                <td>備註</td>
                                                <td>操作</td>
                                            </tr>
                                            @foreach($shoppingCartPaymentItems as $item)
                                                <tr>
                                                    <td>{{$item->payment->name}}</td>
                                                    <td>{{$item->money}}</td>
                                                    <td>{{$item->memo}}</td>
                                                    <td><a class="btn btn-sm btn-outline-secondary" href="{{route("checkout.remove.payment")}}?id={{$item->id}}">移除</a></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                        <form method="post" id="orderForm">
                                            @csrf
                                            <label>結帳備註</label>
                                            <div class="mb-3">
                                                <textarea class="form-control" name="memo"></textarea>
                                            </div>
                                            <button class="btn btn-primary w-full" type="submit">結帳</button>
                                        </form>
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
