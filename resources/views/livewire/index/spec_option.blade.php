<div class="p-3 text-gray-900">
    <div class="p-2 ">
        <form>
            <div class="row">
                <div class="col-12 col-md-3">
                    <input class="form-control form-control-sm w-100" type="text" wire:model.live="name" placeholder="名稱" />
                </div>
                <div class="col-12 col-md-3">
                    <input class="form-control form-control-sm w-100" type="text" wire:model.live="sku" placeholder="SKU" />
                </div>
{{--                <div class="col-12 col-md-3">--}}
{{--                    <input class="form-control form-control-sm w-100" type="text" wire:model.live="content" placeholder="描述" />--}}
{{--                </div>--}}
                <div class="col-12 col-md-3">
                    <select class="form-control form-control-sm w-100" wire:model.live="status">
                        <option value="">狀態：未限制</option>
                        <option value="Y">狀態：開</option>
                        <option value="N">狀態：開</option>
                    </select>
                </div>
                <div class="col-12 col-md-3">
                    <select class="form-control form-control-sm w-100" wire:model.live="spec_id">
                        <option value="">規格群組：未限制</option>
                        @foreach($specOptions as $specOption)
                            <option value="{{$specOption->id}}">規格群組：{{$specOption->name}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </form>
    </div>
    <div class="alert alert-primary w-full" wire:loading>載入中...</div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th
                    wire:click="sortBy('name')" :sortDirection="$sortByColumn=='name'?$sortByDirection:null"
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                    名稱
                    <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="name" />
                </th>
                <th
                    wire:click="sortBy('sku')" :sortDirection="$sortByColumn=='sku'?$sortByDirection:null"
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                    SKU
                    <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="sku"  />
                </th>
                <th
                    wire:click="sortBy('content')" :sortDirection="$sortByColumn=='content'?$sortByDirection:null"
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                    描述
                    <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="content"  />
                </th>
                <th
                    wire:click="sortBy('status')" :sortDirection="$sortByColumn=='status'?$sortByDirection:null"
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                    狀態
                    <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="status"  />
                </th>
                <th
                    wire:click="sortBy('spec_id')" :sortDirection="$sortByColumn=='spec_id'?$sortByDirection:null"
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                    規格群組
                    <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="spec_id"  />
                </th>
                <th
                    wire:click="sortBy('updated_at')" :sortDirection="$sortByColumn=='updated_at'?$sortByDirection:null"
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                    最後更新時間
                    <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="updated_at"  />
                </th>
                <th
                    wire:click="sortBy('created_at')" :sortDirection="$sortByColumn=='created_at'?$sortByDirection:null"
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                    建立時間
                    <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="created_at"  />
                </th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                    管理
                </th>
            </tr>
            </thead>

            <tbody class="bg-white">
            @foreach ($paginator->items() as $item)
                <tr>
                    <td class="px-6 py-2 border-b border-gray-200">
                        <div class="text-sm font-medium leading-5 text-gray-900">
                            {{ $item->name }}
                        </div>
                    </td>
                    <td class="px-6 py-2 border-b border-gray-200 text-center">
                        <div class="text-sm leading-5 text-gray-500">{{ $item->sku }}</div>
                    </td>
                    <td class="px-6 py-2 border-b border-gray-200 text-center">
                        <div class="text-sm leading-5 text-gray-500">{{ $item->content }}</div>
                    </td>
                    <td class="px-6 py-2 border-b border-gray-200 text-center">
                        <div class="text-sm leading-5 text-gray-500">{{ $item->status=="Y"?"開":"關" }}</div>
                    </td>
                    <td class="px-6 py-2 border-b border-gray-200 text-center">
                        <div class="text-sm leading-5 text-gray-500">{{ $item->spec?->name }}</div>
                    </td>

                    <td
                        class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">
                        {{ $item->updated_at }}</td>
                    <td
                        class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">
                        {{ $item->created_at }}</td>

                    <td
                        class="px-6 py-2 text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 text-center">
                        @can('規格選項管理_修改')
                            <a class="btn btn-sm btn-primary" href="{{route('spec_options.edit',["spec_option"=>$item->id])}}">編輯</a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="p-2">
        {!! $paginator->links() !!}
    </div>
</div>
