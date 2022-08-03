<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){

    // datatable for all instructors
    $('#sessions-profits').DataTable({
        'iDisplayLength': 10,
        "language": {
            "emptyTable" : "لا يوجد لديك اي حصص",
            "search" : "بحث",
            "info" : "اظهار _START_ الي _END_ من اصل _TOTAL_ نتيجة",
            "lengthMenu" : "اظهار _MENU_ نتائج",
            "infoEmpty" : "0 نتائج بحث",
            "paginate": {
                "previous": "السابق",
                "next": "التالي",
            }
        },
        ajax : "{{ route('instructor.datatable.profits.my-sessions', $instructor->id) }}",
        columns : [
            { data : 'topic', name : 'topic' },
            { data : 'subject', name : 'subject' },
            { data : 'educational_class', name : 'educational_class' },
            { data : 'price', name : 'price' },
            { data : 'ended_at', name : 'ended_at' },
            { data : 'is_withdrawn', name : 'is_withdrawn' },
        ],
    });
});
</script>