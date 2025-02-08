<x-app-layout>
    <x-slot name="header">
        <span class="font-semibold text-gray-800 leading-tight">
{{--            <a href="{{route('orders.index')}}">{{ __('訂單管理') }}</a>--}}
            <a class="btn btn-secondary mx-2" href="{{route('orders.index')}}"> < </a>
            訂單狀態:
            @if($item->status=="created")
                <span class="text-danger h2">{{\App\Enum\OrderStatusEnum::tryFrom($item->status)->text()}}</span>
            @elseif($item->status=="finish")
                <span class="text-info h2">{{\App\Enum\OrderStatusEnum::tryFrom($item->status)->text()}}</span>
            @else
                <span class="text-primary h2">{{\App\Enum\OrderStatusEnum::tryFrom($item->status)->text()}}</span>
            @endif
            | 建立時間:
            {{$item->created_at}}
        </span>
    </x-slot>
    <x-slot name="header_tool">
        @can('訂單管理_刪除')
            @if($item->status=="finish")
                <form method="post" action="{{route('orders.destroy',['order'=>$item->id])}}">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger" onclick="confirm('是否確認取消')">取消</button>
                </form>
            @endif
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
