<script src="https://meet.jit.si/external_api.js"></script>
<script>
$(document).ready(function(){

    $(".field  ").prop('readonly', true);

    alert($(".field  ").val());

    // Set the date we're counting down to
    var countDownDate = new Date("{{ date('M d, Y H:i:s', strtotime($scheduleSession->end_at)) }}").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        var str = "باقي علي انتهاء الحصة : " + days + " يوم و " + hours + " ساعة و " + minutes + " دقيقة و " + seconds + " ثانية";
        document.getElementById("demo").innerHTML = str;

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);

    const domain = 'meet.jit.si';
    const options = {
        roomName: "{{ $scheduleSession->meeting_id }}",
        userInfo: {
            email: "{{ Auth::guard('instructor')->user()->email }}",
            displayName: "{{ Auth::guard('instructor')->user()->name }}",
        },
        parentNode: document.querySelector('#meet'),
    };

    apiObj = new JitsiMeetExternalAPI(domain, options);

    $("#end-session").on('click', function(e){
        e.preventDefault();
        
        var schedule_session_id = $(this).data("schedule-session-id");

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
            url : "{{ route('instructor.ajax.end-session') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "schedule_session_id" : schedule_session_id,
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
    });
});
</script>