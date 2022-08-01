<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
<script>
$(document).ready(function(){
    // datatable for all subjects
    $('#subjects').DataTable({
        'iDisplayLength': 10,
        "language": {
            "emptyTable" : "لا يوجد لديك اي مواد تعليمية",
            "search" : "بحث",
            "info" : "اظهار _START_ الي _END_ من اصل _TOTAL_ نتيجة",
            "lengthMenu" : "اظهار _MENU_ نتائج",
            "infoEmpty" : "0 نتائج بحث",
            "paginate": {
                "previous": "السابق",
                "next": "التالي",
            }
        },
        ajax : "{{ route('admin.datatable.subjects') }}",
        columns : [
            { data : 'name', name : 'name' },
            { data : 'classess', name : 'classess' },
            { data : 'delete', name : 'delete' },
        ],
    });

    $('.select2').select2();

    // create new subject and append subject in educational class or classes
    $("#create-subject").on('submit', function(e){
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
            url : "{{ route('admin.ajax.subject.create') }}",
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
    $(document).on('keyup', '.update-subject-name', function(){

        var subject_id = $(this).data('subject-id');
        var subject_name = $(this).text();

        $.ajax({
            
            url : "{{ route('admin.ajax.subject.update-name') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "subject_id" : subject_id,
                "subject_name" : subject_name,
            }
        });
    });


    // delete subject
    $(document).on('click', '.delete-subject', function(e){
        e.preventDefault()

        var subject_id = $(this).data("subject-id");
        
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
            url : "{{ route('admin.ajax.subject.delete') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "subject_id" : subject_id,
            },
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                    $(".tr_"+subject_id).empty();
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