<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){

    // datatable for all instructors
    $('#exams').DataTable({
        'iDisplayLength': 10,
        "language": {
            "emptyTable" : "لا يوجد اي امتحانات",
            "search" : "بحث",
            "info" : "اظهار _START_ الي _END_ من اصل _TOTAL_ نتيجة",
            "lengthMenu" : "اظهار _MENU_ نتائج",
            "infoEmpty" : "0 نتائج بحث",
            "paginate": {
                "previous": "السابق",
                "next": "التالي",
            }
        },
        ajax : "{{ route('student.datatable.exams', $student->belongsToStudentClass->belongsToEducationalClass->id) }}",
        columns : [
            { data : 'exam', name : 'exam' },
            { data : 'subject', name : 'subject' },
            { data : 'join_exam', name : 'join_exam' },
        ],
    });
});
</script>