<div>

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

    @if($details)
    <hr />
    <div class="p-3 text-gray-900">
        <div class="">
            <label class="form-label px-2">商品明細列表</label>
            <form wire:submit="updateDetails()">
                @foreach($details as $key => $item)
                    <div class="row">
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
    <hr />
    <div class="p-3 text-gray-900">
        <div class="">
            <label class="form-label px-2">快速建立商品明細</label>
            @foreach($detailCanBuilds as $key => $item)
            <form wire:submit="createDetail({{$key}})">
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



