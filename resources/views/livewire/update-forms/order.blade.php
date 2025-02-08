<div class="p-3 text-gray-900">
    <div class="p-2 ">
        <form method="post" wire:submit="submit()">
            @csrf
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <h4>訂單編輯</h4>
                    </div>
{{--                    <div class="mb-3">--}}
{{--                        <label class="form-label">狀態</label>--}}
{{--                        <select class="form-control" wire:model="status" >--}}
{{--                            <option value="">請選擇</option>--}}
{{--                            @foreach(\App\Enum\OrderStatusEnum::cases() as $enum)--}}
{{--                                <option value="{{$enum}}">{{$enum->text()}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <small class="text-danger">@error('status') {{ $message }} @enderror</small>--}}
{{--                    </div>--}}
                    <div class="mb-3">
                        <label class="form-label">訂單備註</label>
                        <textarea class="form-control" wire:model="memo"></textarea>
                        <small class="text-danger">@error('memo') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">管理者內部備註</label>
                        <textarea class="form-control" wire:model="memo_admin"></textarea>
                        <small class="text-danger">@error('memo_admin') {{ $message }} @enderror</small>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <h4>訂單金額</h4>
                    </div>
                    <div class="mb-3">
                        <div>訂單明細小計：{{$detail_subtotal}}</div>
                        <div>點數折抵金額：{{(int)$points?->where("point",">","0")?->first()?->point * $pointToMoney}}</div>
                        <div>訂單總金額：{{$total}}</div>
                    </div>
                    <div class="mb-3">
                        <h4>付款方式</h4>
                    </div>
                    <div class="mb-3">
                        @foreach($orderPayments??[] as $orderPayment)
                            <div>{{$orderPayment?->payment?->name}}:{{$orderPayment?->money??0}}元</div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <h4>會員資訊</h4>
                    </div>
                    <div class="mb-3">
                        <div>名稱：{{$member?->name}}</div>
                        <div>手機：{{$member?->phone}}</div>
                        <div>等級：{{$member?->level?->name}}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="mb-3">
                        <div class="flex justify-content-between">
                            <div wire:dirty>
                                <button type="submit" class="btn btn-primary">
                                    儲存
                                    <div wire:loading>
                                        儲存中
                                    </div>
                                </button>
                                <button type="button" class="btn btn-secondary" wire:click="$refresh">取消</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="mb-3">
                        <h4>訂單商品</h4>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>商品</th>
                            <th>SKU</th>
                            <th>原價</th>
                            <th>折扣後</th>
                            <th>使用優惠</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orderDetails as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->goods_sku}}</td>
                                <td>{{$item->price_origin}}</td>
                                <td>{{$item->price}}</td>
                                <td>
                                    @foreach($item->discount_log??[] as $discount)
                                        <span class="badge bg-secondary">{{$discount["name"]??""}}</span>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if($actionMessage)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{$actionMessage}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </form>
    </div>
</div>
