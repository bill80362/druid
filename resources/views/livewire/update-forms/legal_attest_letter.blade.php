<div class="p-3 text-gray-900">
    <div class="p-2 ">
        <form method="post" wire:submit="submit()">
            @csrf
            <div class="mb-3">
                <label class="form-label">收件人</label>
                <input type="text" class="form-control" wire:model="addressee1">
                <small class="text-danger">@error('addressee1') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">收件人郵遞區號</label>
                <input type="text" class="form-control" wire:model="postal_code1">
                <small class="text-danger">@error('postal_code1') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">收件人地址</label>
                <input type="text" class="form-control" wire:model="postal_address1">
                <small class="text-danger">@error('postal_address1') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">副本收件人</label>
                <input type="text" class="form-control" wire:model="addressee2">
                <small class="text-danger">@error('addressee2') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">副本收件人郵遞區號</label>
                <input type="text" class="form-control" wire:model="postal_code2">
                <small class="text-danger">@error('postal_code2') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">副本收件人地址</label>
                <input type="text" class="form-control" wire:model="postal_address2">
                <small class="text-danger">@error('postal_address2') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">寄件人</label>
                <input type="text" class="form-control" wire:model="sender">
                <small class="text-danger">@error('sender') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">寄件人郵遞區號</label>
                <input type="text" class="form-control" wire:model="sender_postal_code">
                <small class="text-danger">@error('sender_postal_code') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">寄件人地址</label>
                <input type="text" class="form-control" wire:model="sender_postal_address">
                <small class="text-danger">@error('sender_postal_address') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">內文</label>
                <input type="text" class="form-control" wire:model="content">
                <small class="text-danger">@error('content') {{ $message }} @enderror</small>
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
