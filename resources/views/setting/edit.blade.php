<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$item?->name}}
        </h2>
    </x-slot>
    <x-slot name="header_tool">

    </x-slot>

    <div class="py-6">
        <form action="{{route('settings.update',["setting"=>$item?->id??1])}}" method="post">
            @csrf
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-3 text-gray-900">
                            <div class="row">
                                <div class="col-12 p-2">
                                    <div class="mb-3">
                                        <label class="form-label">會員點數1點折抵多少金額</label>
                                        <input type="text" class="form-control" name="point_to_money" value="{{$item?->content['point_to_money']??""}}">
                                        <small class="text-danger"></small>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">
                                            儲存
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </form>
    </div>
</x-app-layout>
