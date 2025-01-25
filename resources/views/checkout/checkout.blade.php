<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            門市結帳 | 結帳金額 1000元
        </h2>
    </x-slot>
    <x-slot name="header_tool">
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
                                            小計 $ {{$shoppingCartGoodsItems?->sum("price")}}
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
                                                    <td>{{$item->goodsDetail->price}}</td>
                                                    <td></td>
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
                                                <th>使用優惠</th>
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
                                        <div class="input-group mb-3">
                                            <select class="form-control">
                                                <option>LINE PAY</option>
                                                <option>信用卡</option>
                                                <option>金額找補</option>
                                                <option>會員點數折抵</option>
                                            </select>
                                            <input type="text" class="form-control" placeholder="金額" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <input type="text" class="form-control" placeholder="備註" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button">新增</button>
                                            </div>
                                        </div>
                                        <table class="table table-striped">
                                            <tr>
                                                <td>付款方式</td>
                                                <td>金額</td>
                                                <td>備註</td>
                                                <td>操作</td>
                                            </tr>
                                            <tr>
                                                <td>LINE_PAY</td>
                                                <td>500</td>
                                                <td></td>
                                                <td><button class="btn btn-sm btn-outline-secondary" type="button">移除</button></td>
                                            </tr>
                                            <tr>
                                                <td>現金</td>
                                                <td>500</td>
                                                <td></td>
                                                <td><button class="btn btn-sm btn-outline-secondary" type="button">移除</button></td>
                                            </tr>
                                        </table>
                                        <label>結帳備註</label>
                                        <div class="mb-3">
                                            <textarea class="form-control"></textarea>
                                        </div>
                                        <button class="btn btn-primary w-full" type="button">結帳</button>
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
