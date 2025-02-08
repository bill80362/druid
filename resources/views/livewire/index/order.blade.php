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
                            <option value="{{$value}}">{{$value->text()}}</option>
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
            <th class="py-3 border-b border-gray-200 bg-gray-50 text-center">
                編號
            </th>
            <th class="py-3 border-b border-gray-200 bg-gray-50 text-center">
                狀態
            </th>
            <th class="py-3 border-b border-gray-200 bg-gray-50 text-center">
                金額
            </th>
            <th class="py-3 border-b border-gray-200 bg-gray-50 text-center">
                會員
            </th>
            <th class="py-3 border-b border-gray-200 bg-gray-50 text-center">
                商品
            </th>
            <th class="py-3 border-b border-gray-200 bg-gray-50 text-center">
                付款
            </th>
{{--            <th--}}
{{--                wire:click="sortBy('updated_at')" :sortDirection="$sortByColumn=='updated_at'?$sortByDirection:null"--}}
{{--                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">--}}
{{--                最後更新時間--}}
{{--                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="updated_at"  />--}}
{{--            </th>--}}
{{--            <th--}}
{{--                wire:click="sortBy('created_at')" :sortDirection="$sortByColumn=='created_at'?$sortByDirection:null"--}}
{{--                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">--}}
{{--                建立時間--}}
{{--                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="created_at"  />--}}
{{--            </th>--}}
            <th class="py-3 border-b border-gray-200 bg-gray-50 text-center">
                管理
            </th>
        </tr>
        </thead>

        <tbody class="bg-white">
        @foreach ($paginator->items() as $item)
            <tr>
                <td class="py-2 border-b border-gray-200 text-center">
                    <div class="text-sm font-medium text-gray-900">
                        {{ $item->id }}
                    </div>
                </td>
                <td class="py-2 border-b border-gray-200 text-center">
                    <div class="text-sm leading-5 text-gray-500">
                        {{ \App\Enum\OrderStatusEnum::tryFrom($item->status)->text() }}
                    </div>
                </td>
                <td class="py-2 border-b border-gray-200 text-center">
                    <div class="text-sm leading-5 text-gray-500">
                        ${{ $item->total }} 元
                    </div>
                </td>
                <td class="py-2 border-b border-gray-200 text-center">
                    <div class="text-sm leading-5 text-gray-500">
                    @if($item->member)
                        <div>
                            <a target="_blank" href="{{route("members.edit",["member"=>$item->member?->id??0])}}">
                                {{ $item->member?->name }}({{ $item->member?->level?->name }})
                            </a>
                        </div>
                        <div>{{ $item->member?->phone }}</div>
                    @else
                        <div>訪客</div>
                    @endif
                    </div>
                </td>
                <td class="py-2 border-b border-gray-200 text-left">
                    <div class="text-sm leading-5 text-gray-500">
                        @foreach($item->orderDetails??[] as $detail)
                            <div>
                                <a target="_blank" href="{{route("goods_details.edit",["goods_detail"=>$detail->goods_detail_id])}}">
                                {{$detail->name}}
                                [{{$detail->goods_sku}}]
                                </a>
                                {{$detail->price}}
                            </div>
                        @endforeach

                    </div>
                </td>
                <td class="py-2 border-b border-gray-200 text-left">
                    <div class="text-sm leading-5 text-gray-500">
                        @foreach($item->orderPayments??[] as $payment)
                            <div>
                                {{$payment->payment->name}} ${{$payment->money}} 元
                            </div>
                            <div>
                                {{$payment->memo}}
                            </div>
                        @endforeach

                    </div>
                </td>
{{--                <td--}}
{{--                    class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">--}}
{{--                    {{ $item->updated_at }}</td>--}}
{{--                <td--}}
{{--                    class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">--}}
{{--                    {{ $item->created_at }}</td>--}}

                <td
                    class="py-2 text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 text-center">
                    @can('訂單管理_修改')
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
