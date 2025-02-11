<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('coupons.index')}}">{{ __('優惠券管理') }}</a>

            > {{ __('編輯') }} : {{$item->name}}
        </h2>
    </x-slot>
    <x-slot name="header_tool">
        @can('優惠券管理_刪除')
            <form method="post" action="{{route('coupons.destroy',['coupon'=>$item->id])}}">
                @csrf
                @method('delete')
                <button class="btn btn-danger" onclick="confirm('是否確認刪除')">刪除</button>
            </form>
        @endcan
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <livewire:update-forms.coupon :id="$item->id"/>
            </div>
        </div>
    </div>
{{--    <div class="py-3">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                <div class="p-3 text-gray-900">--}}
{{--                    <div class="p-2 row">--}}
{{--                        <div class="col-12 p-2">--}}
{{--                            <form>--}}
{{--                                <div class="col-md-3 mb-3">--}}
{{--                                    <label class="form-label">產生不具名抵用券數量</label>--}}
{{--                                    <input type="number" class="form-control" name="no_name_count">--}}
{{--                                </div>--}}
{{--                                <div class="col-md-3">--}}
{{--                                    <button type="submit" class="btn btn-primary">--}}
{{--                                        產生--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</x-app-layout>
