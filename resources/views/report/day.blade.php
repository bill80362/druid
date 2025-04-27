<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('訂單報表') }}
        </h2>
    </x-slot>
    <x-slot name="header_tool">

    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-3 text-gray-900">
                        <div class="p-2 font-semibold text-xl text-gray-800 leading-tight">
                            <h2>待付款訂單</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <td class="text-center">無</td>
                                </tr>
                            </table>
                        </div>
                        <div class="p-2 font-semibold text-xl text-gray-800 leading-tight">
                            <h2>每日業績:營業額(訂單數)</h2>
                        </div>
                        <x-full-calendar-order :dayReports="$dayReports"></x-full-calendar-order>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
