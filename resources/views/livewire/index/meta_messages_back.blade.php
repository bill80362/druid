<div class="p-3 text-gray-900">
    <div class="p-2 ">
        <form>
            <div class="row">
                <div class="col-12 col-md-3">
                    <input class="form-control form-control-sm w-100" type="text" wire:model.live="message" placeholder="訊息" />
                </div>

            </div>
        </form>
    </div>
    <div class="alert alert-primary w-full" wire:loading>載入中...</div>
    <table class="w-full">
        <thead>
        <tr>
            <th
                wire:click="sortBy('name')" :sortDirection="$sortByColumn=='meta_id'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                Meta帳號
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="meta_id" />
            </th>
            <th
                wire:click="sortBy('status')" :sortDirection="$sortByColumn=='status'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                類型
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="status"  />
            </th>
            <th
                wire:click="sortBy('type')" :sortDirection="$sortByColumn=='type'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                訊息類型
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="type"  />
            </th>
            <th
                wire:click="sortBy('message')" :sortDirection="$sortByColumn=='message'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                訊息
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="message"  />
            </th>
            <th
                wire:click="sortBy('member_meta_id')" :sortDirection="$sortByColumn=='member_meta_id'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                會員
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="member_meta_id"  />
            </th>
            <th
                wire:click="sortBy('message_at')" :sortDirection="$sortByColumn=='message_at'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                訊息時間
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="message_at"  />
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
                        {{ $item->meta?->name }}
                    </div>
                </td>
                <td class="px-6 py-2 border-b border-gray-200 text-center">
                    <div class="text-sm leading-5 text-gray-500">{{ $item->status=="I"?"詢問":"回覆" }}</div>
                </td>
                <td class="px-6 py-2 border-b border-gray-200 text-center">
                    <div class="text-sm leading-5 text-gray-500">
                        {{$item->type=="T"?"文字":""}}
                        {{$item->type=="I"?"圖片":""}}
                    </div>
                </td>
                <td class="px-6 py-2 border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-500">
                        @if($item->type=="I")
                            <img src="/api/meta/image/{{$item->meta_id}}/{{ $item->message }}" />
                        @else
                            {{ $item->message }}
                        @endif

                    </div>
                </td>
                <td class="px-6 py-2 border-b border-gray-200 text-center">
                    <div class="text-sm leading-5 text-gray-500">{{ $item->member?->name }}</div>
                </td>
                <td
                    class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">
                    {{ $item->message_at }}</td>

                <td
                    class="px-6 py-2 text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 text-center">
                    @can('Meta對話記錄管理_修改')
                        <a class="btn btn-sm btn-primary" href="{{route('meta_messages.edit',["meta_message"=>$item->id])}}">編輯</a>
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
