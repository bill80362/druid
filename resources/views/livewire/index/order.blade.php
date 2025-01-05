<div class="p-3 text-gray-900">
    <div class="p-2 ">
        <form>
            <div class="row">
                <div class="col-12 col-md-3">
                    <input class="form-control form-control-sm w-100" type="text" wire:model.live="name" placeholder="名稱" />
                </div>
                <div class="col-12 col-md-3">
                    <select class="form-control form-control-sm w-100" wire:model.live="status" >
                        <option value="">狀態:不限制</option>
                        @foreach(\App\Enum\OrderStatusEnum::cases() as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
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
                wire:click="sortBy('id')" :sortDirection="$sortByColumn=='id'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                編號
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="id" />
            </th>
            <th
                wire:click="sortBy('status')" :sortDirection="$sortByColumn=='status'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                狀態
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="status"  />
            </th>
            <th
                wire:click="sortBy('total')" :sortDirection="$sortByColumn=='total'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                金額
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="total"  />
            </th>
            <th
                wire:click="sortBy('receiver_name')" :sortDirection="$sortByColumn=='receiver_name'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                收件人
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="receiver_name"  />
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
                        {{ $item->id }}
                    </div>
                </td>
                <td class="px-6 py-2 border-b border-gray-200 text-center">
                    <div class="text-sm leading-5 text-gray-500">
                        {{ \App\Enum\OrderStatusEnum::tryFrom($item->status)->text() }}
                    </div>
                </td>
                <td class="px-6 py-2 border-b border-gray-200 text-center">
                    <div class="text-sm leading-5 text-gray-500">{{ $item->total }}</div>
                </td>
                <td class="px-6 py-2 border-b border-gray-200 text-center">
                    <div class="text-sm leading-5 text-gray-500">{{ $item->receiver_name }}</div>
                </td>
                <td
                    class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">
                    {{ $item->updated_at }}</td>
                <td
                    class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">
                    {{ $item->created_at }}</td>

                <td
                    class="px-6 py-2 text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 text-center">
                    @can('訂單管理管理_修改')
                        <a class="btn btn-sm btn-primary" href="{{route('orders.edit',["order"=>$item->id])}}">編輯</a>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="p-2">
        {!! $paginator->links() !!}
    </div>
</div>
