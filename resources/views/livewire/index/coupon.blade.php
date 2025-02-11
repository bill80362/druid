<div class="p-3 text-gray-900">
    <div class="p-2 ">
        <form>
            <div class="row">
                <div class="col-12 col-md-3">
                    <input class="form-control form-control-sm w-100" type="text" wire:model.live="name" placeholder="名稱" />
                </div>
                <div class="col-12 col-md-3">
                    <input class="form-control form-control-sm w-100" type="text" wire:model.live="coupon_code" placeholder="折扣碼" />
                </div>
                <div class="col-12 col-md-3">
                    <select class="form-control form-control-sm w-100" wire:model.live="status" >
                        <option value="">狀態:不限制</option>
                        @foreach(\App\Enum\StatusEnum::cases() as $enum)
                            <option value="{{$enum}}">{{$enum?->text()}}</option>
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
                wire:click="sortBy('name')" :sortDirection="$sortByColumn=='name'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                名稱
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="name" />
            </th>
            <th
                wire:click="sortBy('coupon_code')" :sortDirection="$sortByColumn=='coupon_code'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                折扣碼
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="coupon_code"  />
            </th>
            <th
                wire:click="sortBy('status')" :sortDirection="$sortByColumn=='status'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                狀態
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="status"  />
            </th>
            <th
                wire:click="sortBy('discount_start')" :sortDirection="$sortByColumn=='discount_start'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                折扣時段
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="discount_start"  />
            </th>
{{--            <th--}}
{{--                wire:click="sortBy('sort')" :sortDirection="$sortByColumn=='sort'?$sortByDirection:null"--}}
{{--                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">--}}
{{--                折扣計算順序--}}
{{--                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="sort"  />--}}
{{--            </th>--}}
{{--            <th--}}
{{--                wire:click="sortBy('event_type')" :sortDirection="$sortByColumn=='event_type'?$sortByDirection:null"--}}
{{--                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">--}}
{{--                條件--}}
{{--                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="event_type"  />--}}
{{--            </th>--}}
{{--            <th--}}
{{--                wire:click="sortBy('discount_goods_status')" :sortDirection="$sortByColumn=='discount_goods_status'?$sortByDirection:null"--}}
{{--                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">--}}
{{--                限定商品--}}
{{--                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="discount_goods_status"  />--}}
{{--            </th>--}}
            <th
                wire:click="sortBy('coupon_type')" :sortDirection="$sortByColumn=='coupon_type'?$sortByDirection:null"
                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                折扣內容
                <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="coupon_type"  />
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
                <td class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">
                    {{ $item->coupon_code }}
                </td>
                <td class="px-6 py-2 border-b border-gray-200 text-center">
                    <div class="text-sm leading-5 text-gray-500">{{ \App\Enum\StatusEnum::tryFrom($item->status)?->text() }}</div>
                </td>
                <td class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">
                    {{ $item->discount_start->format("Y-m-d") }}~{{ $item->discount_end->format("Y-m-d")  }}
                </td>
{{--                <td class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">--}}
{{--                    {{ $item->sort }}--}}
{{--                </td>--}}
{{--                <td class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">--}}
{{--                    {{ \App\Enum\DiscountEventTypeEnum::tryFrom($item->event_type)?->text() }}--}}
{{--                </td>--}}
{{--                <td class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">--}}
{{--                    {{ \App\Enum\DiscountGoodsStatusEnum::tryFrom($item->discount_goods_status)?->text() }}--}}
{{--                </td>--}}
                <td class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">
                    {{ \App\Enum\CouponTypeEnum::tryFrom($item->coupon_type)?->text() }}
                    @if($item->coupon_type=="M")
                        ${{$item->discount_money}} 元
                    @elseif($item->coupon_type=="R")
                        {{$item->discount_ratio}}%
                    @endif
                </td>

{{--                <td--}}
{{--                    class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">--}}
{{--                    {{ $item->updated_at }}</td>--}}
{{--                <td--}}
{{--                    class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">--}}
{{--                    {{ $item->created_at }}</td>--}}

                <td
                    class="px-6 py-2 text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 text-center">
                    @can('優惠券管理_修改')
                        <a class="btn btn-sm btn-primary" href="{{route('coupons.edit',["coupon"=>$item->id])}}">編輯</a>
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
