<script>
$(document).ready(function(){

    var educational_stage_id = $("#educational_stage").val();

    $.ajax({
        url : "{{ route('admin.ajax.lab.preview.educational-classes') }}",
        type : "POST",
        data : {
            "_token" : "{{ csrf_token() }}",
            "educational_stage_id" : educational_stage_id,
        },
        success : function(data)
        {
            $("#edcucation-classes-res").html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {

            $("#edcucation-classes-res").html("خطاء من السيرفر");
        }
    });

    $("#educational_stage").on('change', function(){
        
        var educational_stage_id = $(this).val();

        $.ajax({
            url : "{{ route('admin.ajax.lab.preview.educational-classes') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "educational_stage_id" : educational_stage_id,
            },
            success : function(data)
            {
                $("#edcucation-classes-res").html(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {

                $("#edcucation-classes-res").html("خطاء من السيرفر");
            }
        });
    });

    $("#create-lab").on('submit', function(e){
        e.preventDefault();
        
        var thumbnailFileExtension = ['png', 'jpg', 'jpeg'];

        if ($.inArray($("#thumbnail").val().split('.').pop().toLowerCase(), thumbnailFileExtension) == -1) {

            alert("خطاء : يجب ان يكون صورة المعمل بالخاصية الاتية "+thumbnailFileExtension.join(', '));

        }else{

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
                url : "{{ route('admin.ajax.lab.create') }}",
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
        }
    });
});
</script>