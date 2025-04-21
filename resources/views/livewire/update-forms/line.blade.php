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
                <label class="form-label">狀態</label>
                <select class="form-control" wire:model="status" >
                    <option value="">請選擇</option>
                    <option value="Y">啟用</option>
                    <option value="N">停用</option>
                </select>
                <small class="text-danger">@error('status') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3 text-primary">
                <h1>從Line console(https://developers.line.biz/console)複製過來</h1>
            </div>
            <div class="mb-3">
                <label class="form-label">專案 > Line Login > Basic settings > Channel secret</label>
                <input type="text" class="form-control" wire:model="secret">
                <small class="text-danger">@error('secret') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">專案 > Line Login > LIFF > LIFF ID</label>
                <input type="text" class="form-control" wire:model="liff_id">
                <small class="text-danger">@error('liff_id') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">專案 > Messaging API > Messaging API > Channel access token </label>
                <input type="text" class="form-control" wire:model="access_token">
                <small class="text-danger">@error('access_token') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3 text-primary">
                <h1>從這邊貼到Line Console</h1>
            </div>
            <div class="mb-3">
                <label class="form-label">專案 > Line Login > LIFF > Endpoint URL</label>
                <input type="text" class="form-control" value="{{$slug?'https://goodbodytw.com/line_liff/login/'.$slug:''}}" disabled>
                <small class="text-danger">@error('slug') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">專案 > Messaging API > Messaging API > Webhook URL </label>
                <input type="text" class="form-control" value="{{$slug?'https://goodbodytw.com/api/webhook/line/'.$slug:''}}" disabled>
                <small class="text-danger">@error('slug') {{ $message }} @enderror</small>
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
