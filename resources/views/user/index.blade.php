<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('帳號管理') }}
        </h2>
    </x-slot>
    <x-slot name="header_tool">
        @can('帳號管理_新增')
            <a class="btn btn-primary" href="{{route('users.create')}}">新增</a>
        @endcan
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 text-gray-900">
                    <div class="p-2 ">
                        <form>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <input class="form-control form-control-sm w-100" type="text" name="filter[name]" value="{{request()->get("filter")["name"]??""}}" placeholder="名稱">
                                </div>
                                <div class="col-12 col-md-3">
                                    <input class="form-control form-control-sm w-100" type="text" name="filter[email]" value="{{request()->get("filter")["email"]??""}}" placeholder="Email">
                                </div>
                                <div class="col-12 col-md-3">
                                    <button class="btn btn-sm btn-primary w-100" type="submit">查詢</button>
                                </div>
                            </div>



                        </form>
                    </div>
                    <table class="w-full">
                        <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                                名稱
                            </th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                                Email
                            </th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                                remember_token
                            </th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                                最後更新時間
                            </th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                                建立時間
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                                管理
                            </th>
                        </tr>
                        </thead>

                        <tbody class="bg-white">
                        @foreach ($paginator->items() as $item)
                            <tr>
                                <td class="px-6 py-2 border-b border-gray-200">
                                    <div class="text-sm font-medium leading-5 text-gray-900">
                                        {{ $item->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-2 border-b border-gray-200 text-center">
                                    <div class="text-sm leading-5 text-gray-500">{{ $item->email }}</div>
                                </td>

                                <td class="px-6 py-2 border-b border-gray-200 text-center">
                                    <div class="text-sm leading-5 text-gray-900">{{ $item->remember_token }}</div>
                                </td>

                                <td
                                    class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">
                                    {{ $item->updated_at }}</td>
                                <td
                                    class="px-6 py-2 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 text-center">
                                    {{ $item->created_at }}</td>

                                <td
                                    class="px-6 py-2 text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200 text-center">
                                    @can('帳號管理_修改')
                                    <a class="btn btn-sm btn-primary" href="{{route('users.edit',["user"=>$item->id])}}">編輯</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="p-2">
                        {!! $paginator->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
