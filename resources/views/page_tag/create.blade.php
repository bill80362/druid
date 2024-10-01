<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('page_tags.index')}}">{{ __('頁面標籤管理') }}</a>

            > {{ __('新增') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <livewire:update-forms.page_tag :id="null" />
            </div>
        </div>
    </div>
</x-app-layout>
