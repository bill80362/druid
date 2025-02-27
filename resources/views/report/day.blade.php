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
                            <h2>每日營業額</h2>
                        </div>
                        <div class="p-2">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                timeZone: 'Asia/Taipei',
                locale: 'tw',
                events: @json($dayReports),
            });
            calendar.render();
        });

    </script>
</x-app-layout>
