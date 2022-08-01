<script src="{{ asset('assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>
<script>
$(document).ready(function(){

    $.ajax({
        url : "{{ route('admin.ajax.library.book.book-category.preview') }}",
        type : "POST",
        data : {
            "_token" : "{{ csrf_token() }}",
            "category_input_opt" : $('input[name="switch_category_input"]:checked').val(),
        },
        success : function(data)
        {
            $("#book-category-res").html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $("#book-category-res").html(thrownError);
        }
    });

    // ajax to preview book category input option
    $(".switch-category-input").on('change', function(){

        category_input_opt = $(this).val();

        $.ajax({
            url : "{{ route('admin.ajax.library.book.book-category.preview') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "category_input_opt" : category_input_opt,
            },
            success : function(data)
            {
                $("#book-category-res").html(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $("#book-category-res").html(thrownError);
            }
        });
    });
    
    $.ajax({
        url : "{{ route('admin.ajax.library.book.price-options.preview') }}",
        type : "POST",
        data : {
            "_token" : "{{ csrf_token() }}",
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

        $.ajax({
            url : "{{ route('admin.ajax.library.book.price-options.preview') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
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

    // create new book
    $("#create-new-book").on('submit', function(e){
        e.preventDefault();
        
        var pdfFileExtension = ['pdf'];
        var thumbnailFileExtension = ['png', 'jpg', 'jpeg'];

        if ($.inArray($("#pdf").val().split('.').pop().toLowerCase(), pdfFileExtension) == -1) {
            alert("خطاء : يجب ان يكون الكتاب بخاصية "+pdfFileExtension.join(', '));

        }else if ($.inArray($("#thumbnail").val().split('.').pop().toLowerCase(), thumbnailFileExtension) == -1) {

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
                url : "{{ route('admin.ajax.library.book.create') }}",
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