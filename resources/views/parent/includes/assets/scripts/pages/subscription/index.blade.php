<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){

    var plan = $('.choose_plan:checked').val();

    $.ajax({
        url : "{{ route('parent.ajax.subscription.preview-plans') }}",
        type : "POST",
        data : {
            "_token" : "{{ csrf_token() }}",
            "plan" : plan,
            "educational_class_id" : "{{ $studentClass->educational_class_id }}",
        },
        success : function(data)
        {
            $("#subscription_plan_res").html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            
            $("#subscription_plan_res").html('error');
        }
    });

    $(".choose_plan").on('change', function(){

        var plan = $(this).val();
        
        $.ajax({
            url : "{{ route('parent.ajax.subscription.preview-plans') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "plan" : plan,
                "educational_class_id" : "{{ $studentClass->educational_class_id }}",
            },
            success : function(data)
            {
                $("#subscription_plan_res").html(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                
                $("#subscription_plan_res").html('error');
            }
        });
    });
});
</script>