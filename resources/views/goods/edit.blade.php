<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('goods.index')}}">{{ __('電商主商品管理') }}</a>

            > {{ __('編輯') }} : {{$item->name}}
        </h2>
    </x-slot>
    <x-slot name="header_tool">
        <div class="d-flex">
            <a class="btn btn-primary mr-2" href="{{route('goods.edit2',['goods'=>$item])}}">商品描述</a>
            @can('電商主商品管理_刪除')
                <form method="post" action="{{route('goods.destroy',['goods'=>$item->id])}}">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger mr-2" onclick="confirm('是否確認刪除')">刪除</button>
                </form>
            @endcan
        </div>

    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <livewire:update-forms.goods :id="$item->id" />
            </div>
        </div>
    </div>

</x-app-layout>
