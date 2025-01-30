<div class="p-3 text-gray-900">
    <div class="p-2 ">
        <form method="post" wire:submit="submit()">
            @csrf
            <div class="mb-3">
                <label class="form-label">名稱</label>
                <input type="text" class="form-control" wire:model="name">
                <small class="text-danger">@error('name') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">會員編號</label>
                <input type="text" class="form-control" wire:model="member_id">
                <small class="text-danger">@error('member_id') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">點數</label>
                <input type="text" class="form-control" wire:model="point">
                <small class="text-danger">@error('point') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">訂單編號</label>
                <input type="text" class="form-control" wire:model="order_id">
                <small class="text-danger">@error('order_id') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">優惠編號</label>
                <input type="text" class="form-control" wire:model="discount_id">
                <small class="text-danger">@error('discount_id') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <div class="flex justify-point-between">
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
