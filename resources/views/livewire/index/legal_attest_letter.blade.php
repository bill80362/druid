<div class="p-3 text-gray-900">
    <div class="p-2 ">
        <form>
            <div class="row">
                <div class="col-12 col-md-3">
                    <input class="form-control form-control-sm w-100" type="text" wire:model.live="addressee1" placeholder="收件人1" />
                </div>
                <div class="col-12 col-md-3">
                    <input class="form-control form-control-sm w-100" type="text" wire:model.live="content" placeholder="描述" />
                </div>

            </div>
        </form>
    </div>
    <div class="alert alert-primary w-full" wire:loading>載入中...</div>
    <table class="w-full">
        <thead>
        <tr>
            <th
                wire:click="sortBy('addressee1')" :sortDirection="$sortByColumn=='addressee1'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                收件人
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="addressee1" />
            </th>
            <th
                wire:click="sortBy('postal_code1')" :sortDirection="$sortByColumn=='postal_code1'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                收件人郵遞區號
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="postal_code1" />
            </th>
            <th
                wire:click="sortBy('postal_code1')" :sortDirection="$sortByColumn=='postal_address1'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                收件人地址
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="postal_address1" />
            </th>
            <th
                wire:click="sortBy('content')" :sortDirection="$sortByColumn=='content'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                內文
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="content"  />
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
                        {{ $item->addressee1 }}
                    </div>
                </td>
                <td class="px-6 py-2 border-b border-gray-200 text-center">
                    <div class="text-sm leading-5 text-gray-500">{{ $item->postal_code1 }}</div>
                </td>
                <td class="px-6 py-2 border-b border-gray-200 text-center">
                    <div class="text-sm leading-5 text-gray-500">{{ $item->postal_address1 }}</div>
                </td>
                <td class="px-6 py-2 border-b border-gray-200 text-center">
                    <div class="text-sm leading-5 text-gray-500">{{ $item->content }}</div>
                </td>
                <td
                    class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">
                    {{ $item->updated_at }}</td>
                <td
                    class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">
                    {{ $item->created_at }}</td>

                <td
                    class="px-6 py-2 text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 text-center">
                    @can('存證信函管理_修改')
                        <a class="btn btn-sm btn-primary" href="{{route('legal_attest_letters.edit',["legal_attest_letter"=>$item->id])}}">編輯</a>
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
