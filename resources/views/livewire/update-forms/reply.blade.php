<div class="p-3 text-gray-900">
    <div class="p-2 ">
        <form method="post" wire:submit="submit()">
            @csrf
            <div class="mb-3">
                <label class="form-label">偵測文字</label>
                <input type="text" class="form-control" wire:model="name">
                <small class="text-danger">@error('name') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">回應訊息</label>
                <button type="button" class="btn btn-sm btn-primary" wire:click="addPointText()">加入顯示點數</button>
                <button type="button" class="btn btn-sm btn-primary" wire:click="addMemberNameText()">加入會員名字</button>
                <button type="button" class="btn btn-sm btn-primary" wire:click="addMemberPhoneText()">加入會員電話</button>
                <button type="button" class="btn btn-sm btn-primary" wire:click="addMemberLevelText()">加入會員等級</button>
                <button type="button" class="btn btn-sm btn-primary" wire:click="addMemberUpgradeGapText()">加入會員升等差距</button>
                <textarea class="form-control" id="content" wire:model="content" rows="5"></textarea>
                <small class="text-danger">@error('content') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <div class="flex justify-content-between">
                    <div>
                        <button type="submit" class="btn btn-primary">
                            儲存
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
