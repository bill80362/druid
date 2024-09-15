<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('users.index')}}">{{ __('帳號管理') }}</a>

            > {{ __('帳號新增') }} : {{$item->name}}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 text-gray-900">
                    <div class="p-2 ">
                        <form method="post" action="{{route('users.store',['user'=>$item->id])}}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">名稱</label>
                                <input type="text" class="form-control" name="name" value="{{$item->name}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">密碼</label>
                                <input type="text" class="form-control" name="password" value="{{$item->password}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{$item->email}}">
                            </div>
                            <div class="mb-3">
                                <div class="flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">新增</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
