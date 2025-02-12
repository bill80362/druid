<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            結帳金額 {{$shoppingCartGoodsItems?->sum("discount_price")}}元
            | 優惠券折抵{{$coupon_discount}}元
            | 點數折抵{{$memberUsePoint*$pointToMoney}}元
            | 已付款{{$shoppingCartPaymentItems->sum("money")}}元
            | 還需支付{{$shoppingCartGoodsItems?->sum("discount_price")-$coupon_discount-$shoppingCartPaymentItems->sum("money")-$memberUsePoint*$pointToMoney}}元
        </h2>
    </x-slot>
    <x-slot name="header_tool">
        <button class="btn btn-primary" type="button" onclick="document.getElementById('orderForm').submit();">結帳</button>

        <!-- 選擇商品 -->
        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#choseGoodsModal">
            選擇商品
        </button>
        <div class="modal modal-lg fade" id="choseGoodsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">選擇商品</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <livewire:checkout.goods_detail />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉視窗</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 選擇會員 -->
        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#choseMemberModal">
            選擇會員
        </button>
        <div class="modal modal-lg fade" id="choseMemberModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">選擇會員</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <livewire:checkout.member />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉視窗</button>
                    </div>
                </div>
            </div>
        </div>


    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 text-gray-900">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{route("checkout.add.goods")}}">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="商品/折扣碼/會員卡號" name="event_data">
                                    <div class="input-group-append">
                                        <input type="submit" class="btn btn-outline-secondary" name="event" value="刷入商品" />
                                    </div>
                                    <div class="input-group-append">
                                        <input type="submit" class="btn btn-outline-secondary" name="event" value="刷入折扣碼" />
                                    </div>
                                    <div class="input-group-append">
                                        <input type="submit" class="btn btn-outline-secondary" name="event" value="刷入會員卡號" />
                                    </div>
                                </div>
                            </form>
                        </div>
{{--                        <div class="col-4">--}}
{{--                            <form action="{{route("checkout.set.member")}}">--}}
{{--                                <div class="input-group mb-3">--}}
{{--                                    <input type="text" class="form-control" placeholder="結帳會員卡號" name="member_slug">--}}
{{--                                    <div class="input-group-append">--}}
{{--                                        <button class="btn btn-outline-secondary" type="submit">刷入卡號</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
                        <div class="col-8 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title flex justify-content-between">
                                        <div>
                                            結帳商品 ({{$shoppingCartGoodsItems?->count()}})
                                        </div>
                                        <div>
                                            小計 ${{$shoppingCartGoodsItems?->sum("discount_price")}} 元
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
                                                    <td>{{$member?->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>手機</td>
                                                    <td>{{$member?->phone}}</td>
                                                </tr>
                                                <tr>
                                                    <td>生日</td>
                                                    <td>{{$member?->birthday}}</td>
                                                </tr>
                                                <tr>
                                                    <td>消費累積</td>
                                                    <td>{{$member?->orders_sum_total}}</td>
                                                </tr>
                                                @if($nextLevel)
                                                    <tr>
                                                        <td>距離[{{$nextLevel->name}}]</td>
                                                        <td>{{(int)$member?->level->upgrade-(int)$member?->orders_sum_total}}</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td>剩餘點數</td>
                                                    <td>{{$member?->points_sum_point}}</td>
                                                </tr>

                                            </table>
                                        @endif
                                        @if($member?->points_sum_point)
                                            <div>
                                                <form method="post" action="{{route("checkout.use.point")}}">
                                                    <input type="hidden" name="member_slug" value="{{$member->slug}}">
                                                    @csrf
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="use_point" value="{{$member?->points_sum_point}}" max="{{$member?->points_sum_point}}">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="submit">使用點數</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title flex justify-content-between">
                                        <div>
                                            使用優惠
                                        </div>
                                        <div>
                                            ${{$coupon_discount+$memberUsePoint*$pointToMoney}} 元
                                        </div>
                                    </h5>
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
                                            @if($levelPoint)
                                                <tr>
                                                    <td>贈送點數{{$levelPoint}}點</td>
                                                    <td>-</td>
                                                    <td>會員等級贈點</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                </tr>
                                            @endif
                                            @if($coupon)
                                                <tr>
                                                    <td>使用優惠券{{$coupon->name}}</td>
                                                    <td>{{$coupon->coupon_code}}</td>
                                                    <td>
                                                        {{ \App\Enum\CouponTypeEnum::tryFrom($coupon->coupon_type)?->text() }}
                                                        @if($coupon->coupon_type=="M")
                                                            ${{$coupon->discount_money}} 元
                                                        @elseif($coupon->coupon_type=="R")
                                                            {{$coupon->discount_ratio}}%
                                                        @endif
                                                    </td>
                                                    <td>
                                                        ${{$coupon_discount}} 元
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-outline-secondary">移除</a>
                                                    </td>
                                                </tr>
                                            @endif
                                            @if($memberUsePoint)
                                                <tr>
                                                    <td>使用點數{{$memberUsePoint}}點</td>
                                                    <td>-</td>
                                                    <td>使用點數</td>
                                                    <td>${{$memberUsePoint*$pointToMoney}} 元</td>
                                                    <td>
                                                        <form method="post" action="{{route("checkout.use.point")}}">
                                                            @csrf
                                                            <input type="hidden" name="member_slug" value="{{$member->slug}}">
                                                            <input type="hidden" name="use_point" value="0">
                                                            <button class="btn btn-sm btn-outline-secondary" type="submit">移除</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
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
                                            付款
                                        </div>
                                        <div>
                                            ${{$shoppingCartPaymentItems->sum("money")}} 元
                                        </div>
                                    </h5>
                                    <div class="card-text">
                                        <form action="{{route("checkout.add.payment")}}">
                                            <div class="input-group mb-3">
                                                <select class="form-control" name="payment_id">
                                                    @foreach($paymentItems as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                <input type="text" class="form-control" placeholder="金額" name="money" value="{{$shoppingCartGoodsItems?->sum("discount_price")-$coupon_discount-$shoppingCartPaymentItems->sum("money")-$memberUsePoint*$pointToMoney}}">
                                                <input type="text" class="form-control" placeholder="備註" name="memo">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit">新增</button>
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
