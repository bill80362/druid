<div class="p-3 text-gray-900">
    <div class="p-2 ">
        <form method="post" wire:submit="submit()">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">名稱</label>
                        <input type="text" class="form-control" wire:model="name">
                        <small class="text-danger">@error('name') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SKU</label>
                        <input type="text" class="form-control" wire:model="sku">
                        <small class="text-danger">@error('sku') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">價格</label>
                        <input type="text" class="form-control" wire:model="price">
                        <small class="text-danger">@error('price') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">狀態</label>
                        <select class="form-control" wire:model="status" >
                            <option value="">請選擇</option>
                            <option value="Y">顯示</option>
                            <option value="N">隱藏</option>
                        </select>
                        <small class="text-danger">@error('status') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">排序</label>
                        <input type="text" class="form-control" wire:model="sort">
                        <small class="text-danger">@error('sort') {{ $message }} @enderror</small>
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
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">規格</label>
                        <input type="text" class="form-control" disabled value="{{implode(" x ",array_column($spec_options,"name"))}}">
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
