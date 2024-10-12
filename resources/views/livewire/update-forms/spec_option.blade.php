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
                <label class="form-label">SKU</label>
                <input type="text" class="form-control" wire:model="sku">
                <small class="text-danger">@error('sku') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">描述</label>
                <input type="text" class="form-control" wire:model="content">
                <small class="text-danger">@error('content') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">狀態</label>
                <select class="form-control" wire:model="status">
                    <option value="">請選擇</option>
                    <option value="Y">開</option>
                    <option value="N">關</option>
                </select>
                <small class="text-danger">@error('status') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">規格群組</label>
                <select class="form-control" wire:model="spec_id">
                    <option value="">請選擇</option>
                    @foreach($specOptions as $specOption)
                        <option value="{{$specOption->id}}">{{$specOption->name}}</option>
                    @endforeach
                </select>
                <small class="text-danger">@error('spec_id') {{ $message }} @enderror</small>
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
