<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('users.index')}}">{{ __('帳號管理') }}</a>

            > {{ __('帳號編輯') }} : {{$item->name}}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 text-gray-900">
                    <div class="p-2 ">
                        <form method="post" action="{{route('users.update',['user'=>$item->id])}}">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label class="form-label">名稱</label>
                                <input type="text" class="form-control" name="name" value="{{$item->name}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">密碼</label>
                                <input type="text" class="form-control" name="password" placeholder="空白代表不修改">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{$item->email}}">
                            </div>
                            <div class="mb-3">
                                <div class="flex justify-content-between">
                                    <div>
                                        <button type="submit" class="btn btn-primary">儲存</button>
                                        <a class="btn btn-secondary" href="{{route('users.edit',['user'=>$item])}}" >取消</a>
                                    </div>
                                    <div>
                                        <form method="post" action="{{route('users.destroy',['user'=>$item->id])}}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" onclick="confirm('是否確認刪除')">刪除</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
