<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('orders.index')}}">{{ __('訂單管理管理') }}</a>

            > {{ __('編輯') }} : {{$item->name}}
        </h2>
    </x-slot>
    <x-slot name="header_tool">
        @can('訂單管理管理_刪除')
            <form method="post" action="{{route('orders.destroy',['order'=>$item->id])}}">
                @csrf
                @method('delete')
                <button class="btn btn-danger" onclick="confirm('是否確認刪除')">刪除</button>
            </form>
        @endcan
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <livewire:update-forms.order :id="$item->id" />
            </div>
        </div>
    </div>
</x-app-layout>