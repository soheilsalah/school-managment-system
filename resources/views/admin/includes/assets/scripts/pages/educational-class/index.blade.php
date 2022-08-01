<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
<script src="{{ asset('assets/vendor_components/repeater/jquery.repeater.min.js') }}"></script>
<script>
$(document).ready(function(){
    // datatable for all educational classes
    $('#educational-classes').DataTable({
        'iDisplayLength': 10,
        "language": {
            "emptyTable" : "لا يوجد لديك اي صفوف تعليمية",
            "search" : "بحث",
            "info" : "اظهار _START_ الي _END_ من اصل _TOTAL_ نتيجة",
            "lengthMenu" : "اظهار _MENU_ نتائج",
            "infoEmpty" : "0 نتائج بحث",
            "paginate": {
                "previous": "السابق",
                "next": "التالي",
            }
        },
        ajax : "{{ route('admin.datatable.educational-classes') }}",
        columns : [
            { data : 'name', name : 'name' },
            { data : 'belong_to_educational_stage', name : 'belong_to_educational_stage' },
            { data : 'classrooms', name : 'classrooms' },
            { data : 'students', name : 'students' },
            { data : 'delete', name : 'delete' },
        ],
    });

    $('.select2').select2();

    $('.repeater-default').repeater({
        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        },
        isFirstItemUndeletable: true,
    });

    // create new create educational class
    $("#create-educational-class").on('submit', function(e){
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
            url : "{{ route('admin.ajax.educational-class.create') }}",
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
    $(document).on('keyup', '.update-educational-class-name', function(){

        var educational_class_id = $(this).data('educational-class-id');
        var educational_class_name = $(this).text();

        $.ajax({
            
            url : "{{ route('admin.ajax.educational-class.update-name') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "educational_class_id" : educational_class_id,
                "educational_class_name" : educational_class_name,
            }
        });
    });

    // delete educational class
    $(document).on('click', '.delete-educational-class', function(e){
        e.preventDefault()

        var educational_class_id = $(this).data("educational-class-id");
        
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
            url : "{{ route('admin.ajax.educational-class.delete') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "educational_class_id" : educational_class_id,
            },
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                    $(".tr_"+educational_class_id).empty();
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