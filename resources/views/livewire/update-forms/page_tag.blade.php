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
                <label class="form-label">描述</label>
                <input type="text" class="form-control" wire:model="content">
                <small class="text-danger">@error('content') {{ $message }} @enderror</small>
            </div>

            <div class="py-1">
                <hr>
            </div>

            <div class="row mb-3">
                <h5 class="card-title">{{__("編輯自訂欄位")}}</h5>
                @foreach($customFields as $key => $item)
                    <div class="col-12 col-lg-3 card m-2">
                        <div class="card-body">
                            <div class="card-text">
                                <div class="mb-2">
                                    <label class="form-label">{{__("名稱")}}</label>
                                    <input type="text" class="form-control" wire:model="customFields.{{$key}}.name">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">{{__("排序")}}</label>
                                    <input type="text" class="form-control" wire:model="customFields.{{$key}}.sort">
                                    {{--                        <small class="text-danger">@error('customFields.') {{ $message }} @enderror</small>--}}
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">{{__("類型")}}</label>
                                    <select class="form-control" wire:model="customFields.{{$key}}.type">
                                        <option value="text">單行文字</option>
                                        <option value="textarea">多行文字</option>
                                        <option value="select">下拉</option>
                                        <option value="checkbox">多選</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">{{__("選項")}}</label>
                                    <textarea class="form-control" wire:model="customFields.{{$key}}.options"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="py-1">
                <hr>
            </div>

            <div class="row mb-3">
                <h5 class="card-title">{{__("新增自訂欄位")}}</h5>
                <div class="col-12 col-lg-3 card m-2">
                    <div class="card-body">
                        <div class="card-text">
                            <div class="mb-2">
                                <label class="form-label">{{__("名稱")}}</label>
                                <input type="text" class="form-control" wire:model="customFieldNew.name">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">{{__("排序")}}</label>
                                <input type="text" class="form-control" wire:model="customFieldNew.sort">
                                {{--                        <small class="text-danger">@error('customFields.') {{ $message }} @enderror</small>--}}
                            </div>
                            <div class="mb-2">
                                <label class="form-label">{{__("類型")}}</label>
                                <select class="form-control" wire:model="customFieldNew.type">
                                    <option value="text">單行文字</option>
                                    <option value="textarea">多行文字</option>
                                    <option value="select">下拉</option>
                                    <option value="checkbox">多選</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">{{__("選項")}}</label>
                                <textarea class="form-control" wire:model="customFieldNew.options"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
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
