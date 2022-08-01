<script src="{{ asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>
	
<!-- EduAdmin App -->
<script src="{{ asset('js/template.js') }}"></script>
<script src="{{ asset('js/pages/dashboard4.js') }}"></script>

<script src="{{ asset('assets/vendor_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/perfect-scrollbar-master/perfect-scrollbar.jquery.min.js') }}"></script>
<script src='{{ asset('assets/vendor_components/fullcalendar/main.js') }}'></script>
<script src='{{ asset('assets/vendor_components/fullcalendar/lib/moment.min.js') }}'></script>
<script src='{{ asset('assets/vendor_components/fullcalendar/locales-all.js') }}'></script>
<script src="{{ asset('assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        
        initialView: 'dayGridMonth',
        locale: 'ar',
        events: {!! $datesJsonFomat !!},
        eventClick:  function(info) {

            $('#calendarModal').modal();
            console.log(info);
            $.ajax({
                url : "{{ route('parent.ajax.schedule-sessions.educational-class.preview-classroom-sessions') }}",
                type : "POST",
                data : {
                    "_token" : "{{ csrf_token() }}",
                    "title" : info.event.title,
                    "classroom_schedule_id" : info.event.groupId,
                },
                success : function(data)
                {
                    $("#display-session-res").html(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $("#error").modal({backdrop: 'static', keyboard: false});
                    $("#error").modal('show');
                }
            });
        },

        /*events: [
            {
                title: 'Released Ample Admin!',                
                start: '2022-08-08',
                end: '2022-08-08',
                className: 'bg-info'
            }, {
                title: 'This is today check date',
                start: today,
                end: today,
                className: 'bg-danger'
            }, {
                title: 'This is your birthday',                
                start: '2022-09-08',
                end: '2022-09-08',
                className: 'bg-info'
            },
                {
                title: 'Hanns birthday',                
                start: '2022-10-08',
                end: '2022-10-08',
                className: 'bg-danger'
            },{
                title: 'Like it?',
                start: new Date($.now() + 784800000),
                className: 'bg-success'
            }
        ]*/
    });

    calendar.render();
});
</script>