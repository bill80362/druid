<div class="p-3 text-gray-900">
    <div class="p-2 ">
        <form method="post" wire:submit="submit()">
            @csrf
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label">名稱</label>
                        <input type="text" class="form-control" wire:model="name">
                        <small class="text-danger">@error('name') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">折扣碼</label>
                        <input type="text" class="form-control" wire:model="coupon_code">
                        <small class="text-danger">@error('coupon_code') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">狀態</label>
                        <select class="form-control" wire:model="status" >
                            <option value="">請選擇</option>
                            @foreach(\App\Enum\StatusEnum::cases() as $enum)
                                <option value="{{$enum}}">{{$enum->text()}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">@error('status') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">折扣時段開始</label>
                        <input type="date" class="form-control" wire:model="discount_start">
                        <small class="text-danger">@error('discount_start') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">折扣時段結束</label>
                        <input type="date" class="form-control" wire:model="discount_end">
                        <small class="text-danger">@error('discount_end') {{ $message }} @enderror</small>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label">類型</label>
                        <select class="form-control" wire:model="coupon_type" >
                            <option value="">請選擇</option>
                            @foreach(\App\Enum\CouponTypeEnum::cases() as $enum)
                                <option value="{{$enum}}">{{$enum->text()}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">@error('coupon_type') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">折抵多少錢</label>
                        <input type="text" class="form-control" wire:model="discount_money">
                        <small class="text-danger">@error('discount_money') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">打幾折%(ex:90代表100x90%=90)</label>
                        <input type="number" class="form-control" wire:model="discount_ratio" max="100">
                        <small class="text-danger">@error('discount_ratio') {{ $message }} @enderror</small>
                    </div>
                </div>
                <div class="col-12">
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
                </div>
            </div>
        </form>
    </div>
</div>
