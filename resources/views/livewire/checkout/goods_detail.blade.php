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
                <div class="col-12 col-md-3">
                    <select class="form-control form-control-sm w-100" wire:model.live="status" >
                        <option value="">狀態:不限制</option>
                        <option value="Y">狀態:顯示</option>
                        <option value="N">狀態:隱藏</option>
                    </select>
                </div>

            </div>
        </form>
    </div>
    <div class="alert alert-primary w-full" wire:loading>載入中...</div>
    <table class="w-full">
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
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                規格選項
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="規格選項"  />
            </th>
            <th
                wire:click="sortBy('price')" :sortDirection="$sortByColumn=='price'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                價格
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="price"  />
            </th>
            <th
                wire:click="sortBy('status')" :sortDirection="$sortByColumn=='status'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                狀態
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="status"  />
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
                    <div class="text-sm leading-5 text-gray-500">
                        {{$item->specOptions->map(fn($i)=>$i->name)->implode(",")}}
                    </div>
                </td>
                <td class="px-6 py-2 border-b border-gray-200 text-center">
                    <div class="text-sm leading-5 text-gray-500">{{ $item->price }}</div>
                </td>
                <td class="px-6 py-2 border-b border-gray-200 text-center">
                    <div class="text-sm leading-5 text-gray-500">{{ $item->status=="Y"?"顯示":"隱藏" }}</div>
                </td>

                <td
                    class="px-6 py-2 text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 text-center">
                    @if($item->sku)
                        <a class="btn btn-sm btn-primary" href="{{route('checkout.add.goods',["event_data"=>$item->sku,"event"=>"刷入商品"])}}">選擇</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="p-2">
        {!! $paginator->links() !!}
    </div>
</div>
