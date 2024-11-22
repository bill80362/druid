<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('legal_attest_letters.index')}}">{{ __('存證信函管理') }}</a>

            > {{ __('編輯') }} : {{$item->id}}
        </h2>
    </x-slot>
    <x-slot name="header_tool">
        @can('存證信函管理_刪除')
            <form method="post" action="{{route('legal_attest_letters.destroy',['legal_attest_letter'=>$item->id])}}">
                @csrf
                @method('delete')
                <button class="btn btn-danger" onclick="confirm('是否確認刪除')">刪除</button>
            </form>
        @endcan
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <livewire:update-forms.legal_attest_letter :id="$item->id" />
            </div>
        </div>
    </div>
</x-app-layout>
