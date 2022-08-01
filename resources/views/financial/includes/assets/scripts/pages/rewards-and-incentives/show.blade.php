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
        ajax : "{{ route('financial.datatable.instructor.rewards', $instructor->slug) }}",
        columns : [
            { data : 'reward_name', name : 'reward_name' },
            { data : 'reward_amount', name : 'reward_amount' },
            { data : 'rewarded_at', name : 'rewarded_at' },
            { data : 'isWithdrawn', name : 'isWithdrawn' },
        ],
    });
});
</script>