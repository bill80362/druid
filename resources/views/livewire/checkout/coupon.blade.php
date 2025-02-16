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
                        <option value="Y">狀態:顯示</option>
                        <option value="N">狀態:隱藏</option>
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
                    wire:click="sortBy('coupon_code')" :sortDirection="$sortByColumn=='coupon_code'?$sortByDirection:null"
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                    折扣碼
                    <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="coupon_code"  />
                </th>
                <th
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                    折扣時段
                    <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="規格選項"  />
                </th>
                <th
                    wire:click="sortBy('price')" :sortDirection="$sortByColumn=='price'?$sortByDirection:null"
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                    折扣內容
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
                        <div class="text-sm leading-5 text-gray-500">{{ $item->coupon_code }}</div>
                    </td>
                    <td class="px-6 py-2 border-b border-gray-200 text-center">
                        <div class="text-sm leading-5 text-gray-500">
                            {{ $item->discount_start->format("Y-m-d H:i:s") }}~{{ $item->discount_end->format("Y-m-d H:i:s")  }}
                        </div>
                    </td>
                    <td class="px-6 py-2 border-b border-gray-200 text-center">
                        <div class="text-sm leading-5 text-gray-500">
                            {{ \App\Enum\CouponTypeEnum::tryFrom($item->coupon_type)?->text() }}
                            @if($item->coupon_type=="M")
                                ${{$item->discount_money}} 元
                            @elseif($item->coupon_type=="R")
                                {{$item->discount_ratio}}%
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-2 border-b border-gray-200 text-center">
                        <div class="text-sm leading-5 text-gray-500">{{ \App\Enum\StatusEnum::tryFrom($item->status)?->text() }}</div>
                    </td>
                    <td
                        class="px-6 py-2 text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 text-center">
                        @if($item->orders->where("member_id",$member_id)->where("status","!=","cancel")->count())
                            <span class="text-danger">{{$item->orders->where("member_id",$member_id)->where("status","!=","cancel")->first()->created_at->format("Y-m-d")}}已使用</span>
                        @else
                            <a class="btn btn-sm btn-primary" href="{{route('checkout.add.goods',["event_data"=>$item->coupon_code,"event"=>"刷入折扣碼"])}}">選擇</a>
                        @endif
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
