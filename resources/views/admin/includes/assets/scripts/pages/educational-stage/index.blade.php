<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){
    // datatable for all educational stages
    $('#educational-stages').DataTable({
        'iDisplayLength': 10,
        "language": {
            "emptyTable" : "لا يوجد لديك اي مرحلة تعليمية",
            "search" : "بحث",
            "info" : "اظهار _START_ الي _END_ من اصل _TOTAL_ نتيجة",
            "lengthMenu" : "اظهار _MENU_ نتائج",
            "infoEmpty" : "0 نتائج بحث",
            "paginate": {
                "previous": "السابق",
                "next": "التالي",
            }
        },
        ajax : "{{ route('admin.datatable.educational-stages') }}",
        columns : [
            { data : 'name', name : 'name' },
            { data : 'classess', name : 'classess' },
            { data : 'students', name : 'students' },
            { data : 'description', name : 'description' },
            { data : 'delete', name : 'delete' },
        ],
    });

    // create new educational stage
    $("#create-educational-stage").on('submit', function(e){
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
            url : "{{ route('admin.ajax.educational-stage.create') }}",
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
    $(document).on('keyup', '.update-educational-stage-name', function(){

        var educational_stage_id = $(this).data('educational-stage-id');
        var educational_stage_name = $(this).text();

        $.ajax({
            
            url : "{{ route('admin.ajax.educational-stage.update-name') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "educational_stage_id" : educational_stage_id,
                "educational_stage_name" : educational_stage_name,
            }
        });
    });

    // update educational stage description
    $(document).on('keyup', '.update-educational-stage-description', function(){

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
    });
});
</script>