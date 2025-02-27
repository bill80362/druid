<div class="p-3 text-gray-900">
    <div class="p-2 ">
        <form>
            <div class="row">
                <div class="col-12 col-md-3">
                    <input class="form-control form-control-sm w-100" type="text" wire:model.live="name" placeholder="名稱" />
                </div>
                <div class="col-12 col-md-3">
                    <input class="form-control form-control-sm w-100" type="text" wire:model.live="email" placeholder="Email" />
                </div>

            </div>
        </form>
    </div>
    <div class="alert alert-primary w-full" wire:loading>載入中...</div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th
                    wire:click="sortBy('name')" :sortDirection="$sortByColumn=='name'?$sortByDirection:null"
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                    名稱
                    <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="name" />
                </th>
                <th
                    wire:click="sortBy('email')" :sortDirection="$sortByColumn=='email'?$sortByDirection:null"
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                    Email
                    <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="email"  />
                </th>
                <th
                    wire:click="sortBy('remember_token')" :sortDirection="$sortByColumn=='remember_token'?$sortByDirection:null"
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                    remember_token
                    <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="remember_token"  />
                </th>
                <th
                    wire:click="sortBy('updated_at')" :sortDirection="$sortByColumn=='updated_at'?$sortByDirection:null"
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                    最後更新時間
                    <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="updated_at"  />
                </th>
                <th
                    wire:click="sortBy('created_at')" :sortDirection="$sortByColumn=='created_at'?$sortByDirection:null"
                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-center">
                    建立時間
                    <x-table-sort-icon :sortByColumn="$sortByColumn" :sortByDirection="$sortByDirection" column="created_at"  />
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
    </div>

    <div class="p-2">
        {!! $paginator->links() !!}
    </div>
</div>
