<script src="{{ asset('assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>
<script>
$(document).ready(function(){

    $.ajax({
        url : "{{ route('admin.ajax.library.book.price-options.preview') }}",
        type : "POST",
        data : {
            "_token" : "{{ csrf_token() }}",
            "book_id" : $('input[name="preview_price_opt"]:checked').data('book-id'),
            "book_price_opt" : $('input[name="preview_price_opt"]:checked').val(),
        },
        success : function(data)
        {
            $("#book-price-res").html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#book-price-res").html(thrownError);
        }
    });

    // ajax to preview book price options
    $(".preview-price-opt").on('change', function(){

        book_price_opt = $(this).val();
        book_id = $(this).data("book-id");

        $.ajax({
            url : "{{ route('admin.ajax.library.book.price-options.preview') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "book_id" : book_id,
                "book_price_opt" : book_price_opt,
            },
            success : function(data)
            {
                $("#book-price-res").html(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#book-price-res").html(thrownError);
            }
        });
    });

    // update book info
    $("#update-book-info").on('submit', function(e){
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
            url : "{{ route('admin.ajax.library.book.info.update') }}",
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

    // update book price
    $("#update-book-price").on('submit', function(e){
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
            url : "{{ route('admin.ajax.library.book.price.update') }}",
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

    // update book thumbnail
    $("#update-book-thumbnail").on('submit', function(e){
        e.preventDefault();
        
        var thumbnailFileExtension = ['png', 'jpg', 'jpeg'];

        if ($.inArray($("#thumbnail").val().split('.').pop().toLowerCase(), thumbnailFileExtension) == -1) {

            alert("خطاء : يجب ان يكون غلاف الكتاب بالخاصية الاتية "+thumbnailFileExtension.join(', '));
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
                url : "{{ route('admin.ajax.library.book.thumbnail.update') }}",
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
    
    // update book pdf
    $("#update-book-pdf").on('submit', function(e){
        e.preventDefault();
        
        var pdfFileExtension = ['pdf'];

        if ($.inArray($("#pdf").val().split('.').pop().toLowerCase(), pdfFileExtension) == -1) {

            alert("خطاء : يجب ان يكون نوع الكتاب بخاصية  "+pdfFileExtension.join(', '));
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
                url : "{{ route('admin.ajax.library.book.pdf.update') }}",
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

    // delete book
    $("#delete-book").on('submit', function(e){
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
            url : "{{ route('admin.ajax.library.book.delete') }}",
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