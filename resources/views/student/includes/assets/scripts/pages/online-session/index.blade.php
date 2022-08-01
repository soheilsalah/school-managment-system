<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){

    // datatable for all instructors
    $('#schedule-sessions').DataTable({
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
        ajax : "{{ route('student.datatable.schedule-sessions', $student->belongsToStudentClass->belongsToEducationalClass->id) }}",
        columns : [
            { data : 'instructor', name : 'instructor' },
            { data : 'subject', name : 'subject' },
            { data : 'start_url', name : 'start_url' },
            { data : 'join_url', name : 'join_url' },
            { data : 'start_at', name : 'start_at' },
        ],
    });
});
</script>