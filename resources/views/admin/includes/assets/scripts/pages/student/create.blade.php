<script src="{{ asset('assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
<script>
$(document).ready(function(){

    $('.select2').select2();

    // create new student
    $("#create-student").on('submit', function(e){
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
            url : "{{ route('admin.ajax.student.create') }}",
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