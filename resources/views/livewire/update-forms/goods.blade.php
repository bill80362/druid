<div class="row">

    <div class="col-12 col-md-6 p-3 text-gray-900">
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
                <div class="row mb-3">
                    <div class="col-12 col-lg-6">
                        <label class="form-label px-2">規格群組</label>
                        @foreach($specOptions as $specOption)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox"
                                       wire:model="specIds"
                                       id="inlineCheckbox{{$specOption->id}}"
                                       value="{{$specOption->id}}"
                                >
                                <label class="form-check-label" for="inlineCheckbox{{$specOption->id}}">{{$specOption->name}}</label>
                            </div>
                        @endforeach
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
    <div class="col-12 col-md-6">
        <div class="p-2 ">
            商品圖片
        </div>
        <div class="row">
            <div class="col-12">
                <form wire:submit="uploadPhotos()">
                    <input type="file" wire:model="uploads" multiple>
                    @error('uploads.*') <span class="error">{{ $message }}</span> @enderror
                    <button class="btn btn-sm btn-primary" type="submit">上傳</button>
                </form>
            </div>
            @foreach($photos as $photo)
            <div class="col-3">
                <picture>
                    <img class="img-fluid img-thumbnail" src="{{asset("storage/".$photo["name"]??"")}}">
                </picture>
                <div>
                    <button href="#" class="btn btn-primary btn-sm" wire:click="upPhoto({{ $photo['id'] }})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
                        </svg>
                    </button>
                    <button href="#" class="btn btn-primary btn-sm" wire:click="downPhoto({{ $photo['id'] }})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                        </svg>
                    </button>
                    <button href="#" class="btn btn-danger btn-sm float-end" wire:click="deletePhoto({{ $photo['id'] }})" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                        </svg>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @if($details)
    <div style="height: 10px;"></div>
    <div class="col-12 p-3 text-gray-900">
        <div class="">
            <label class="form-label px-2">商品明細列表</label>
            <form wire:submit="updateDetails()">
                @foreach($details as $key => $item)
                    <div class="row">
                        <div class="col-12">
                            規格選項：[{{collect($item["spec_options"])->pluck('name')->implode('] x [')}}]
                        </div>
                        <div class="col-12 col-md-3 mb-2">
                            <input class="form-control form-control-sm w-100" type="text" wire:model="details.{{$key}}.name" placeholder="名稱" />
                        </div>
                        <div class="col-12 col-md-3 mb-2">
                            <input class="form-control form-control-sm w-100" type="text" wire:model="details.{{$key}}.sku" placeholder="SKU" />
                        </div>
                        <div class="col-12 col-md-2 mb-2">
                            <input class="form-control form-control-sm w-100" type="text" wire:model="details.{{$key}}.price" placeholder="價格" />
                        </div>
                        <div class="col-12 col-md-1 mb-2">
                            <input class="form-control form-control-sm w-100" type="text" wire:model="details.{{$key}}.sort" placeholder="排序" />
                        </div>
                        <div class="col-12 col-md-2 mb-2">
                            <select class="form-control form-control-sm w-100" wire:model="details.{{$key}}.status" >
                                <option value="Y">顯示</option>
                                <option value="N">隱藏</option>
                            </select>
                        </div>
                    </div>
                @endforeach
                <div class="mb-3">
                    <div class="flex justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-sm btn-primary">
                                儲存
                                <div wire:loading>
                                    儲存中
                                </div>
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary" wire:click="$refresh">取消</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif

    @if($detailCanBuilds)
    <div style="height: 10px;"></div>
    <div class="col-12 p-3 text-gray-900">
        <div class="">
            <label class="form-label px-2">快速建立商品明細</label>
            @foreach($detailCanBuilds as $key => $item)
            <form wire:submit="createDetail({{$key}})">
                <input type="hidden" wire:model="detailCanBuilds.{{$key}}.spec" placeholder="排序" />
                <div class="row">
                    <div class="col-12 col-md-3 mb-2">
                        <input class="form-control form-control-sm w-100" type="text" wire:model="detailCanBuilds.{{$key}}.name" placeholder="名稱" />
                    </div>
                    <div class="col-12 col-md-3 mb-2">
                        <input class="form-control form-control-sm w-100" type="text" wire:model="detailCanBuilds.{{$key}}.sku" placeholder="SKU" />
                    </div>
                    <div class="col-12 col-md-2 mb-2">
                        <input class="form-control form-control-sm w-100" type="text" wire:model="detailCanBuilds.{{$key}}.price" placeholder="價格" />
                    </div>
                    <div class="col-12 col-md-1 mb-2">
                        <input class="form-control form-control-sm w-100" type="text" wire:model="detailCanBuilds.{{$key}}.sort" placeholder="排序" />
                    </div>
                    <div class="col-12 col-md-2 mb-2">
                        <select class="form-control form-control-sm w-100" wire:model="detailCanBuilds.{{$key}}.status" >
                            <option value="Y">顯示</option>
                            <option value="N">隱藏</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-1 mb-2">
                        <button type="submit" class="btn btn-sm btn-primary">建立</button>
                    </div>
                </div>
            </form>
            @endforeach
        </div>
    </div>
    @endif

</div>



