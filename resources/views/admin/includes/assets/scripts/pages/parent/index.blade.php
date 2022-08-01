<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){

    // datatable for all instructors
    $('#parents').DataTable({
        'iDisplayLength': 10,
        "language": {
            "emptyTable" : "لا يوجد لديك اي أولياء الأمور",
            "search" : "بحث",
            "info" : "اظهار _START_ الي _END_ من اصل _TOTAL_ نتيجة",
            "lengthMenu" : "اظهار _MENU_ نتائج",
            "infoEmpty" : "0 نتائج بحث",
            "paginate": {
                "previous": "السابق",
                "next": "التالي",
            }
        },
        ajax : "{{ route('admin.datatable.parents') }}",
        columns : [
            { data : 'name', name : 'name' },
            { data : 'email', name : 'email' },
            { data : 'students', name : 'students' },
            { data : 'created_at', name : 'created_at' },
        ],
    });
});
</script>