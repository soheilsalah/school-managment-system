<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){

    // datatable for all instructors
    $('#schedule-sessions').DataTable({
        'iDisplayLength': 10,
        "language": {
            "emptyTable" : "لا يوجد لديك اي حصص",
            "search" : "بحث",
            "info" : "اظهار _START_ الي _END_ من اصل _TOTAL_ نتيجة",
            "lengthMenu" : "اظهار _MENU_ نتائج",
            "infoEmpty" : "0 نتائج بحث",
            "paginate": {
                "previous": "السابق",
                "next": "التالي",
            }
        },
        ajax : "{{ route('admin.datatable.schedule-sessions') }}",
        columns : [
            { data : 'educational_stage', name : 'educational_stage' },
            { data : 'educational_class', name : 'educational_class' },
            { data : 'instructor', name : 'instructor' },
            { data : 'subject', name : 'subject' },
            { data : 'start_url', name : 'start_url' },
            { data : 'join_url', name : 'join_url' },
            { data : 'start_at', name : 'start_at' },
            { data : 'delete', name : 'delete' },
        ],
    });

    // delete meeting
    $(document).on('click', '.delete-meeting', function(e){
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
            url : "{{ route('admin.ajax.delete-session') }}",
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
                    $(".tr_"+schedule_session_id).empty();
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