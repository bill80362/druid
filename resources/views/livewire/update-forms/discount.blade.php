<div class="p-3 text-gray-900">
    <form method="post" wire:submit="submit()">
        @csrf
        <div class="row">
            <div class="col-6 p-2">
                <h3>基本設定</h3>
                <div class="mb-3">
                    <label class="form-label">名稱</label>
                    <input type="text" class="form-control" wire:model="name">
                    <small class="text-danger">@error('name') {{ $message }} @enderror</small>
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
                    <label class="form-label">折扣計算順序</label>
                    <input type="text" class="form-control" wire:model="sort">
                    <small class="text-danger">@error('sort') {{ $message }} @enderror</small>
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
                <h3>折扣內容</h3>
                <div class="mb-3">
                    <label class="form-label">類型</label>
                    <select class="form-control" wire:model="discount_type" >
                        <option value="">請選擇</option>
                        @foreach(\App\Enum\DiscountTypeEnum::cases() as $enum)
                            <option value="{{$enum}}">{{$enum->text()}}</option>
                        @endforeach
                    </select>
                    <small class="text-danger">@error('discount_type') {{ $message }} @enderror</small>
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
                <div class="mb-3">
                    <label class="form-label">固定金額</label>
                    <input type="text" class="form-control" wire:model="discount_static">
                    <small class="text-danger">@error('discount_static') {{ $message }} @enderror</small>
                </div>
            </div>
            <div class="col-6 p-2">
                <h3>折扣條件</h3>
                <div class="mb-3">
                    <label class="form-label">折扣條件</label>
                    <select class="form-control" wire:model="event_type" >
                        <option value="">請選擇</option>
                        @foreach(\App\Enum\DiscountEventTypeEnum::cases() as $enum)
                            <option value="{{$enum}}">{{$enum->text()}}</option>
                        @endforeach
                    </select>
                    <small class="text-danger">@error('event_type') {{ $message }} @enderror</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">滿額門檻</label>
                    <input type="number" class="form-control" wire:model="event_count_threshold" step="1">
                    <small class="text-danger">@error('event_count_threshold') {{ $message }} @enderror</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">滿件門檻</label>
                    <input type="number" class="form-control" wire:model="event_money_threshold" step="1">
                    <small class="text-danger">@error('event_money_threshold') {{ $message }} @enderror</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">折扣商品限定『未啟用』</label>
                    <select class="form-control" wire:model="discount_goods_status" >
                        <option value="">請選擇</option>
                        @foreach(\App\Enum\DiscountGoodsStatusEnum::cases() as $enum)
                            <option value="{{$enum}}">{{$enum->text()}}</option>
                        @endforeach
                    </select>
                    <small class="text-danger">@error('discount_goods_status') {{ $message }} @enderror</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">商品sku(逗號分隔)『未啟用』</label>
                    <input type="text" class="form-control" wire:model="discount_goods_sku">
                    <small class="text-danger">@error('discount_goods_sku') {{ $message }} @enderror</small>
                </div>
            </div>
        </div>
        <div class="row">
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
            </div>
        </div>
    </form>
    @if($actionMessage)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{$actionMessage}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
