<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('優惠券管理') }}
        </h2>
    </x-slot>
    <x-slot name="header_tool">
        @can('優惠券管理_新增')
            <a class="btn btn-primary" href="{{route('coupons.create')}}">新增</a>
        @endcan
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <livewire:index.coupon />
            </div>
        </div>
    </div>
</x-app-layout>
