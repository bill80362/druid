<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('要綁定會員') }}的Line ID: <input type="text" id="head_line_id" value="{{request()->get("bind_line_id")}}" onchange="bindLineId(this.value)">
        </h2>
    </x-slot>
    <x-slot name="header_tool">
{{--        @can('會員管理_新增')--}}
{{--            <a class="btn btn-primary" href="{{route('members.create')}}">新增</a>--}}
{{--        @endcan--}}
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <livewire:index.bind_line_member />
            </div>
        </div>
    </div>

    <script>
        bindLineId('{{request()->get("bind_line_id")}}');
        function bindLineId(newValue){
            document.querySelectorAll('input.line_id').forEach(i=>i.value=newValue)
        }
    </script>
</x-app-layout>
