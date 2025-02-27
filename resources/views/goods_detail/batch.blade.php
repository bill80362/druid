<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('商品快速編輯') }}
        </h2>
    </x-slot>
    <x-slot name="header_tool">
        <button class="btn btn-primary" onclick="document.getElementById('myForm').submit();">儲存</button>
{{--        @can('商品明細管理_新增')--}}
{{--            <a class="btn btn-primary" href="{{route('goods_details.create')}}">新增</a>--}}
{{--        @endcan--}}
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 text-gray-900">
                    <form method="post" id="myForm">
                        @csrf
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead>
                                <tr>
                                    <th>名稱</th>
                                    <th>SKU</th>
                                    <th>價格</th>
                                    <th>狀態</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white">
                                @foreach ($items as $item)
                                    <tr>
                                        <td><input type="text" name="goods_detail_update[{{$item->id}}][name]" value="{{ $item->name }}"></td>
                                        <td><input type="text" name="goods_detail_update[{{$item->id}}][sku]" value="{{ $item->sku }}"></td>
                                        <td><input type="text" name="goods_detail_update[{{$item->id}}][price]" value="{{ $item->price }}"></td>
                                        <td>
                                            @foreach(\App\Enum\StatusEnum::cases() as $enum)
                                                <label>
                                                    <input type="radio" name="goods_detail_update[{{$item->id}}][status]" value="{{$enum->value}}" @checked($item->status==$enum->value) >
                                                    <span class="ml-1">{{$enum->text()}}</span>
                                                </label>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="h4 p-2"><hr /></td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="goods_detail_create[name][]" value=""></td>
                                    <td><input type="text" name="goods_detail_create[sku][]" value=""></td>
                                    <td><input type="text" name="goods_detail_create[price][]" value=""></td>
                                    <td>
                                        預設停用
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="p-3">
                            <button type="button" class="w-100 btn btn-primary" id="addBtn" >複製新增欄位</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        document.getElementById('addBtn').addEventListener('click', function() {
            // Get the table body by ID
            var tbody = document.getElementById('myTable').getElementsByTagName('tbody')[0];
            // Get the last row
            var lastRow = tbody.rows[tbody.rows.length - 1];
            // Clone the last row
            var newRow = lastRow.cloneNode(true);
            // Append the cloned row to the table body
            tbody.appendChild(newRow);
        });
    </script>
</x-app-layout>
