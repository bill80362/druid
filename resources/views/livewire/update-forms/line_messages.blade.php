<div class="p-3 text-gray-900">
    <div class="p-2 ">
        <form method="post" wire:submit="submit()">
            @csrf
            <div class="mb-3">
                <label class="form-label">Line帳號</label>
                <input type="text" class="form-control" wire:model="line_id">
                <small class="text-danger">@error('line_id') {{ $line_id }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">類型</label>
                <input type="text" class="form-control" wire:model="status">
                <small class="text-danger">@error('status') {{ $status }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">訊息類型</label>
                <input type="text" class="form-control" wire:model="type">
                <small class="text-danger">@error('type') {{ $type }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">訊息</label>
                <input type="text" class="form-control" wire:model="message">
                <small class="text-danger">@error('message') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">會員</label>
                <input type="text" class="form-control" wire:model="member_line_id">
                <small class="text-danger">@error('member_line_id') {{ $member_line_id }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">訊息時間</label>
                <input type="text" class="form-control" wire:model="message_at">
                <small class="text-danger">@error('message_at') {{ $message_at }} @enderror</small>
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
