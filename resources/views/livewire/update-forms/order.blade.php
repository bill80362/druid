<div class="p-3 text-gray-900">
    <div class="p-2 ">
        <form method="post" wire:submit="submit()">
            @csrf
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <h4>訂單處理</h4>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">狀態</label>
                        <select class="form-control" wire:model="status" >
                            <option value="">請選擇</option>
                            @foreach(\App\Enum\OrderStatusEnum::cases() as $enum)
                                <option value="{{$enum}}">{{$enum->text()}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">@error('status') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">訂單備註(會員可看到)</label>
                        <input type="text" class="form-control" wire:model="memo">
                        <small class="text-danger">@error('memo') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">管理者內部備註(會員不會看到)</label>
                        <input type="text" class="form-control" wire:model="memo_admin">
                        <small class="text-danger">@error('memo_admin') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">行銷代碼</label>
                        <input type="text" class="form-control" wire:model="promotion_code">
                        <small class="text-danger">@error('promotion_code') {{ $message }} @enderror</small>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <h4>訂單資訊</h4>
                    </div>
                    <div class="mb-3">
                        <div>訂單時間：2022-02-02 12:12:12</div>
                        <div class="mb-3"></div>
                        <div>訂單金額</div>
                        <div>訂單明細小計：{{$detail_subtotal}}</div>
                        <div>金流手續費：{{$payment_fee}}</div>
                        <div>物流手續費：{{$shipping_fee}}</div>
                        <div>訂單總金額：{{$total}}</div>
                        <div class="mb-3"></div>
                        <div>金流(3)</div>
                        <div>類型：信用卡</div>
                        <div>服務商：綠界</div>
                        <div>服務商編號：A123456789</div>
                        <div>狀態：未付款</div>
                        <div>金額：1000</div>
                        <div>付款時間：2022-02-02 12:12:12</div>
                        <div class="mb-3"></div>
                        <div>物流</div>
                        <div>類型：宅配</div>
                        <div>第三方類型：綠界</div>
                        <div>第三方編號：A123456789</div>
                        <div>狀態：未付款</div>
                        <div>金額：1000</div>
                        <div>付款時間：2022-02-02 12:12:12</div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <h4>收件人資訊</h4>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">收件人</label>
                        <input type="text" class="form-control" wire:model="receiver_name">
                        <small class="text-danger">@error('receiver_name') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">收件人手機</label>
                        <input type="text" class="form-control" wire:model="receiver_phone">
                        <small class="text-danger">@error('receiver_phone') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">收件人郵遞區號</label>
                        <input type="text" class="form-control" wire:model="receiver_postal_code">
                        <small class="text-danger">@error('receiver_postal_code') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">收件人地址</label>
                        <input type="text" class="form-control" wire:model="receiver_address">
                        <small class="text-danger">@error('receiver_address') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">收件人備註</label>
                        <input type="text" class="form-control" wire:model="receiver_memo">
                        <small class="text-danger">@error('receiver_memo') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">訂購會員</label>
                        <input type="text" class="form-control" wire:model="member_id">
                        <small class="text-danger">@error('member_id') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">購買人</label>
                        <input type="text" class="form-control" wire:model="buyer_name">
                        <small class="text-danger">@error('buyer_name') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">購買人電話</label>
                        <input type="text" class="form-control" wire:model="buyer_phone">
                        <small class="text-danger">@error('buyer_phone') {{ $message }} @enderror</small>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <h4>發票</h4>
                    </div>
                </div>
            </div>

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
            @if($actionMessage)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{$actionMessage}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </form>
    </div>
</div>
