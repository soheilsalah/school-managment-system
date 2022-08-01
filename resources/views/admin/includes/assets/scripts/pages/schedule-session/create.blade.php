<script src="{{ asset('assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>

<script>
$(document).ready(function(){
    
    //Timepicker
    $('.timepicker').timepicker({
        showInputs: false
    });


    $('.select2').select2();

    $.ajax({
        type : "POST",
        url : "{{ route('admin.ajax.is-session-recurrsive') }}",
        data : {
            "_token" : "{{ csrf_token() }}",
            "is_recurrsive" : $("#is_recurrsive").is(':checked') ? 1 : 0,
        },
        beforeSend : function(){
            $("#is_recurrsive_res").html('<div style="margin-top: 30px;">يتم عرض الخيارات</div>')
        },
        success: function(data){

            $("#is_recurrsive_res").html(data);
        },
        error : function(){
            $("#is_recurrsive_res").html('<div style="margin-top: 30px;" class="text-danger">خطاء في عرض الخيارات</div>');
        },
    });

    $("#is_recurrsive").on('change', function(){

        $.ajax({
            type : "POST",
            url : "{{ route('admin.ajax.is-session-recurrsive') }}",
            data : {
                "_token" : "{{ csrf_token() }}",
                "is_recurrsive" : $(this).is(':checked') ? 1 : 0,
            },
            beforeSend : function(){
                $("#is_recurrsive_res").html('<div style="margin-top: 30px;">يتم عرض الخيارات</div>')
            },
            success: function(data){

                $("#is_recurrsive_res").html(data);
            },
            error : function(){
                $("#is_recurrsive_res").html('<div style="margin-top: 30px;" class="text-danger">خطاء في عرض الخيارات</div>');
            },
        });
    });

    // display educational classes when ready
    $.ajax({
        type : "POST",
        url : "{{ route('admin.ajax.create-session.display-all-educational-classes') }}",
        data : {
            "_token" : "{{ csrf_token() }}",
            "educational_stage_id" : $("#educational_stage").val(),
        },
        beforeSend : function(){
            $("#educational-class-res").html('<div style="margin-top: 30px;">يتم عرض الصفوف</div>')
        },
        success: function(data){

            $("#educational-class-res").html(data);
        },
        error : function(){
            $("#educational-class-res").html('<div style="margin-top: 30px;" class="text-danger">خطاء في عرض الصفوف</div>');
        },
    });

    // display educational classes when change educational stage
    $("#educational_stage").on('change', function(){

        var educational_stage_id = $(this).val();

        $.ajax({
            type : "POST",
            url : "{{ route('admin.ajax.create-session.display-all-educational-classes') }}",
            data : {
                "_token" : "{{ csrf_token() }}",
                "educational_stage_id" : educational_stage_id,
            },
            beforeSend : function(){
                $("#educational-class-res").html('<div style="margin-top: 30px;">يتم عرض الصفوف</div>')
            },
            success: function(data){

                $("#educational-class-res").html(data);
            },
            error : function(){
                $("#educational-class-res").html('<div style="margin-top: 30px;" class="text-danger">خطاء في عرض الصفوف</div>');
            },
        });
    });

    // create new session
    $("#create-session").on('submit', function(e){
        e.preventDefault();
        
        if($("#homework").val() != ''){

            var file = $("#homework").val();
            var ext = file.split(".");
            ext = ext[ext.length-1].toLowerCase();      
            var arrayExtensions = ["doc", "docx", "odt"];
    
            if (arrayExtensions.lastIndexOf(ext) == -1) {
                $("#resModal").modal('show');
                $("#res").html('<i class="fa fa-times text-danger" style="font-size: 100px;"></i><h3>نوع الملف يجب ان يكون doc, docx او odt</h3>');
                return false;
            }
        }

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
            url : "{{ route('admin.ajax.create-session') }}",
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
});
</script>