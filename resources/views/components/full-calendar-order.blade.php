@props(['dayReports'=>$dayReports])

<div>
    <div id='calendar'></div>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                timeZone: 'Asia/Taipei',
                locale: 'tw',
                events: @json($dayReports),
                height: 'auto',
                contentHeight: 'auto',
                eventClick: function(info) {
                    alert(info.event.title);
                    //修改當下的event
                    // info.el.style.borderColor = 'red';
                }
            });
            calendar.render();
        });

    </script>

</div>
