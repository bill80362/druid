<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('商品匯入') }}
        </h2>
    </x-slot>
    <x-slot name="header_tool">

    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-3 text-gray-900">
                        <div class="mb-3">
                            <label class="form-label">匯入excel檔案</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="mb-3">
                            <div>
                                <small class="text-danger">注意事項</small>
                            </div>
                            <div>
                                <small class="text-danger">1.請先匯出取得檔案，再進行匯入</small>
                            </div>
                            <div>
                                <small class="text-danger">2.根據id，空直代表新增，有值代表修改</small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="flex justify-content-between">
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        匯入
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
