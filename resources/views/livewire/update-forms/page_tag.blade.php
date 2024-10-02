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

{{--            <div class="py-1">--}}
{{--                <hr>--}}
{{--            </div>--}}
{{--            <div class="row mb-3">--}}
{{--                <div class="col-12 col-lg-6">--}}
{{--                    <label class="form-label px-2">{{__("頁面")}}</label>--}}
{{--                    @foreach($pageOptions as $item)--}}
{{--                        <div class="form-check form-check-inline">--}}
{{--                            <input class="form-check-input" type="checkbox"--}}
{{--                                   wire:model="pages"--}}
{{--                                   id="inlineCheckbox{{$item->id}}"--}}
{{--                                   value="{{$item->id}}"--}}
{{--                            >--}}
{{--                            <label class="form-check-label" for="inlineCheckbox{{$item->id}}">{{$item->name}}</label>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}

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
