<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){

    // datatable for all students
    $('#students').DataTable({
        'iDisplayLength': 10,
        "language": {
            "emptyTable" : "لا يوجد لديك اي طالب",
            "search" : "بحث",
            "info" : "اظهار _START_ الي _END_ من اصل _TOTAL_ نتيجة",
            "lengthMenu" : "اظهار _MENU_ نتائج",
            "infoEmpty" : "0 نتائج بحث",
            "paginate": {
                "previous": "السابق",
                "next": "التالي",
            }
        },
        ajax : "{{ route('parent.datatable.students') }}",
        columns : [
            { data : 'name', name : 'name' },
            { data : 'educational_stage', name : 'educational_stage' },
            { data : 'class', name : 'class' },
            { data : 'classroom', name : 'classroom' },
            { data : 'created_at', name : 'created_at' },
        ],
    });
});
</script>