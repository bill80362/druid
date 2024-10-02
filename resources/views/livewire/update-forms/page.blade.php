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
                <textarea class="form-control" wire:model="content"></textarea>
                <small class="text-danger">@error('content') {{ $message }} @enderror</small>
            </div>
            <div class="mb-3">
                <label class="form-label">標籤</label>
                <select class="form-control" wire:model="page_tag_id" >
                    <option value="">請選擇</option>
                    @foreach($pageTags as $pageTag)
                        <option value="{{$pageTag->id}}">{{$pageTag->name}}</option>
                    @endforeach
                </select>
                <small class="text-danger">@error('name') {{ $message }} @enderror</small>
            </div>

            @foreach($customFields as $key => $customField)
                <div class="mb-3">
                    <label class="form-label">{{$customField["name"]}}</label>
                    @if($customField["type"]=="text")
                        <input type="text" class="form-control" wire:model="customFieldValue.{{$customField["id"]}}.value" >
                    @elseif($customField["type"]=="textarea")
                        <textarea class="form-control" wire:model="customFieldValue.{{$customField["id"]}}.value"></textarea>
                    @elseif($customField["type"]=="select")
                        <select class="form-control" wire:model="customFieldValue.{{$customField["id"]}}.value">
                            <option value="">請選擇</option>
                            @foreach( explode("\n",$customField["options"]) as $optionKey => $option )
                            <option value="{{$option}}">{{$option}}</option>
                            @endforeach
                        </select>
                    @endif

                    <small class="text-danger">@error('content') {{ $message }} @enderror</small>
                </div>
            @endforeach


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
