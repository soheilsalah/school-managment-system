<script>
// Set the date we're counting down to
var countDownDate = new Date("{{ date('M d, Y H:i:s', strtotime($scheduleSession->start_at)) }}").getTime();
var sessionEndAt = new Date("{{ date('M d, Y H:i:s', strtotime($scheduleSession->end_at)) }}").getTime();
var getCurrentDateTime = new Date().getTime();

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
  var str = "سوف تبداء الحصة في : " + days + " يوم و " + hours + " ساعة و " + minutes + " دقيقة و " + seconds + " ثانية";
  document.getElementById("demo").innerHTML = str;

  // If the count down is finished, write some text
  if(distance < 0) {
    
    if(sessionEndAt > getCurrentDateTime){

      var remainingTimeForSessionToEnd = sessionEndAt - now;

       // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(remainingTimeForSessionToEnd / (1000 * 60 * 60 * 24));
      var hours = Math.floor((remainingTimeForSessionToEnd % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((remainingTimeForSessionToEnd % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((remainingTimeForSessionToEnd % (1000 * 60)) / 1000);

      // Display the result in the element with id="demo"
      var str = "باقي علي انتهاء الحصة : " + days + " يوم و " + hours + " ساعة و " + minutes + " دقيقة و " + seconds + " ثانية";
      document.getElementById("demo").innerHTML = str + '<br> <button type="button" class="btn btn-success mt-4 font-weight-bold" id="start-session" data-schedule-session-id="{{$scheduleSession->id}}">قم ببدء الحصة</button>';

      if(remainingTimeForSessionToEnd < 0){

        clearInterval(x);
        document.getElementById("demo").innerHTML = "تم الانتهاء من الحصة";
      }
    }else{

      clearInterval(x);
      document.getElementById("demo").innerHTML = "تم الانتهاء من الحصة";
    }
  }

}, 1000);

$(document).on('click', "#start-session", function(e){
	e.preventDefault();
	
	var schedule_session_id = $(this).data("schedule-session-id")

	$.ajax({
		url : "{{ route('admin.ajax.start-session') }}",
		type : "POST",
		data : {
			"_token" : "{{ csrf_token() }}",
			"schedule_session_id" : schedule_session_id,
		},
		success : function(data)
		{
			$("#success_res").html(data);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			
			alert('خطاء من السيرفر');
		}
	});
});
</script>