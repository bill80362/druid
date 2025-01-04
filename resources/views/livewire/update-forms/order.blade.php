<div class="p-3 text-gray-900">
    <div class="p-2 ">
        <form method="post" wire:submit="submit()">
            @csrf
            <div class="mb-3">
                <label class="form-label">狀態</label>
                <input type="text" class="form-control" wire:model="status">
                <small class="text-danger">@error('status') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">會員</label>
                <input type="text" class="form-control" wire:model="member_id">
                <small class="text-danger">@error('member_id') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">明細小計</label>
                <input type="text" class="form-control" wire:model="detail_subtotal">
                <small class="text-danger">@error('detail_subtotal') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">金流手續費</label>
                <input type="text" class="form-control" wire:model="payment_fee">
                <small class="text-danger">@error('payment_fee') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">物流手續費</label>
                <input type="text" class="form-control" wire:model="shipping_fee">
                <small class="text-danger">@error('shipping_fee') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">訂單金額</label>
                <input type="text" class="form-control" wire:model="total">
                <small class="text-danger">@error('total') {{ $message }} @enderror</small>
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
                <label class="form-label">訂單備註</label>
                <input type="text" class="form-control" wire:model="memo">
                <small class="text-danger">@error('memo') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">管理者備註</label>
                <input type="text" class="form-control" wire:model="memo_admin">
                <small class="text-danger">@error('memo_admin') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">行銷代碼</label>
                <input type="text" class="form-control" wire:model="promotion_code">
                <small class="text-danger">@error('promotion_code') {{ $message }} @enderror</small>
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
