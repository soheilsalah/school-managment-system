<script src='{{ asset('assets/fullcalendar/lib/main.js') }}'></script>
<script src='{{ asset('assets/>fullcalendar/lib/locales/ar.js') }}'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: {!! $events !!},
        dayMaxEvents: 2,
        locale: 'ar',
        dateClick: function(data) {

            console.log(data.dateStr);
        },
        eventClick: function(info) {
            
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) 
                    {
                        if (evt.lengthComputable) {
                            var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                            //Do something with upload progress here
                            $("#loading").modal({backdrop: 'static', keyboard: false});
                            
                            $("#progressbar").attr('aria-valuenow', percentComplete).css('width', percentComplete + '%').text(percentComplete + '%');
                        }
                }, false);
                return xhr;
                },
                url : "{{ route('instructor.ajax.preview-schedule-session') }}",
                type : "POST",
                data : {
                    "_token" : "{{ csrf_token() }}",
                    "id" : info.event.id,
                },
                success : function(data)
                {
                    $("#loading").modal('hide');
                    $("#resModal").modal({backdrop: 'static', keyboard: false});
                    $("#res").html(data);
                    $("#onCloseModal").click(function(){
                        $("#resModal").modal('hide');
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $("#loading").modal('hide');
                    $("#error").modal({backdrop: 'static', keyboard: false});
                    $("#error").modal('show');
                }
            });
        }
    });
    
    calendar.render();
});
</script>