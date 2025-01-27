@inject('levelModel', 'App\Models\Level')

<div class="p-3 text-gray-900">
    <div class="p-2 ">
        <form method="post" wire:submit="submit()">
            @csrf
            <div class="row">
                <div class="col-6">
                    <h3>設定</h3>
                    <div class="mb-3">
                        <label class="form-label">狀態</label>
                        <select class="form-control" wire:model="status" >
                            <option value="">請選擇</option>
                            @foreach(\App\Enum\MemberStatusEnum::cases() as $enum)
                                <option value="{{$enum}}">{{$enum->text()}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">@error('status') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">等級</label>
                        <select class="form-control" wire:model="level_id" >
                            <option value="">請選擇</option>
                            @foreach($levelModel->orderBy("sort")->get() as $level)
                                <option value="{{$level->id}}">{{$level->name}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">@error('level_id') {{ $message }} @enderror</small>
                    </div>
                    <h3>基本資料</h3>
                    <div class="mb-3">
                        <label class="form-label">名字</label>
                        <input type="text" class="form-control" wire:model="name">
                        <small class="text-danger">@error('name') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">電話</label>
                        <input type="text" class="form-control" wire:model="phone">
                        <small class="text-danger">@error('phone') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">郵遞區號</label>
                        <input type="text" class="form-control" wire:model="postal_code">
                        <small class="text-danger">@error('postal_code') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">地址</label>
                        <input type="text" class="form-control" wire:model="address">
                        <small class="text-danger">@error('address') {{ $message }} @enderror</small>
                    </div>
                </div>
                <div class="col-6">
                    <h3>第三方登入</h3>
                    <div class="mb-3">
                        <label class="form-label">LineID</label>
                        <input type="text" class="form-control" wire:model="line_id">
                        <small class="text-danger">@error('line_id') {{ $message }} @enderror</small>
                    </div>
                    <h3>官網</h3>
                    <div class="mb-3">
                        <label class="form-label">帳號</label>
                        <input type="text" class="form-control" wire:model="account">
                        <small class="text-danger">@error('account') {{ $message }} @enderror</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">密碼</label>
                        <input type="text" class="form-control" wire:model="password">
                        <small class="text-danger">@error('password') {{ $message }} @enderror</small>
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
            @if($actionMessage)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{$actionMessage}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </form>
    </div>
</div>
