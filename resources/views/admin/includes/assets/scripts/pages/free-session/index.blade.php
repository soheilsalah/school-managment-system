<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){
    // datatable for all free sessions
    $('#free-sessions').DataTable({
        'iDisplayLength': 10,
        "language": {
            "emptyTable" : "لا يوجد اي حصص مجانية لاي طالب",
            "search" : "بحث",
            "info" : "اظهار _START_ الي _END_ من اصل _TOTAL_ نتيجة",
            "lengthMenu" : "اظهار _MENU_ نتائج",
            "infoEmpty" : "0 نتائج بحث",
            "paginate": {
                "previous": "السابق",
                "next": "التالي",
            }
        },
        ajax : "{{ route('admin.datatable.free-sessions-for-students') }}",
        columns : [
            { data : 'student', name : 'student' },
            { data : 'number_of_free_sessions', name : 'number_of_free_sessions' },
        ],
    });

    // give free session for student
    $("#give-free-session-for-student").on('submit', function(e){
        e.preventDefault();
        
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
            url : "{{ route('admin.ajax.give-free-sessions-for-students') }}",
            type : "POST",
            data : new FormData(this),
            contentType : false,
            processData : false,
            cache : false,
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

    // update educational stage name
    $(document).on('keyup', '.update-free-session', function(){

        var free_session_id = $(this).data('free-session-id');
        var number_of_free_sessions = $(this).val();

        console.log(number_of_free_sessions);
        $.ajax({
            
            url : "{{ route('admin.ajax.free-session.update.number_of_sessions') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "free_session_id" : free_session_id,
                "number_of_free_sessions" : number_of_free_sessions,
            },
            success : function(data){

                $("#free_session_"+free_session_id+"_res").html(data);
            }
        });
    });

    // update educational stage description
    /*$(document).on('keyup', '.update-educational-stage-description', function(){

        var educational_stage_id = $(this).data('educational-stage-id');
        var educational_stage_description = $(this).text();

        $.ajax({
            
            url : "{{ route('admin.ajax.educational-stage.update-description') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "educational_stage_id" : educational_stage_id,
                "educational_stage_description" : educational_stage_description,
            }
        });
    });

    // delete educational stage
    $(document).on('click', '.delete-educational-stage', function(e){
        e.preventDefault()

        var educational_stage_id = $(this).data("educational-stage-id");
        
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
            url : "{{ route('admin.ajax.educational-stage.delete') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "educational_stage_id" : educational_stage_id,
            },
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                    $(".tr_"+educational_stage_id).empty();
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#loading").modal('hide');
                $("#error").modal({backdrop: 'static', keyboard: false});
                $("#error").modal('show');
            }
        });
    });*/
});
</script>