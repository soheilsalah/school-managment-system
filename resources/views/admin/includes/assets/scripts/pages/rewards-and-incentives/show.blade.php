<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/repeater/jquery.repeater.min.js') }}"></script>
<script>
$(document).ready(function(){

    // datatable to view all instructor reward(s)
    $('#rewards').DataTable({
        'iDisplayLength': 10,
        "language": {
            "emptyTable" : "لا يوجد اي مكافآة خاصة بالمدرس {{ $instructor->name }}",
            "search" : "بحث",
            "info" : "اظهار _START_ الي _END_ من اصل _TOTAL_ نتيجة",
            "lengthMenu" : "اظهار _MENU_ نتائج",
            "infoEmpty" : "0 نتائج بحث",
            "paginate": {
                "previous": "السابق",
                "next": "التالي",
            }
        },
        ajax : "{{ route('admin.datatable.instructor.rewards', $instructor->slug) }}",
        columns : [
            { data : 'reward_name', name : 'reward_name' },
            { data : 'reward_amount', name : 'reward_amount' },
            { data : 'rewarded_at', name : 'rewarded_at' },
            { data : 'isWithdrawn', name : 'isWithdrawn' },
            { data : 'delete', name : 'delete' },
        ],
    });

    $('.repeater-default').repeater({
        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        },
        isFirstItemUndeletable: true,
    });

    // create reward or rewards for instructor
    $("#create-instructor-reward").on('submit', function(e){
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
            url : "{{ route('admin.ajax.instructor.rewards.create') }}",
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

    // ajax call to remove reward from instructor
    $(document).on('click', '.remove-instructor-reward', function(e){
        e.preventDefault();
        
        var instructor_reward_id = $(this).data('instructor-reward-id');

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
            url : "{{ route('admin.ajax.instructor.reward.remove') }}",
            type : "POST",
            data : {
                "_token" : "{{ csrf_token() }}",
                "instructor_reward_id" : instructor_reward_id,
            },
            success : function(data)
            {
                $("#loading").modal('hide');
                $("#resModal").modal({backdrop: 'static', keyboard: false});
                $("#res").html(data);
                $("#onCloseModal").click(function(){
                    $("#resModal").modal('hide');
                    $(".tr_"+instructor_reward_id).empty();
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