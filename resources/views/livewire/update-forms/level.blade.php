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
                <label class="form-label">等級排序</label>
                <input type="text" class="form-control" wire:model="sort">
                <small class="text-danger">@error('sort') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">升等門檻</label>
                <input type="text" class="form-control" wire:model="upgrade">
                <small class="text-danger">@error('upgrade') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">續等門檻</label>
                <input type="text" class="form-control" wire:model="degrade">
                <small class="text-danger">@error('degrade') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">消費滿多少送1點(累加)</label>
                <input type="text" class="form-control" wire:model="point_from_money">
                <small class="text-danger">@error('point_from_money') {{ $message }} @enderror</small>
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
