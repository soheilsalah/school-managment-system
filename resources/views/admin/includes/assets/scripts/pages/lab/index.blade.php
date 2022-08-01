<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){

    // datatable for all labs
    $('#labs').DataTable({
        'iDisplayLength': 10,
        "language": {
            "emptyTable" : "لا يوجد لديك اي معامل",
            "search" : "بحث",
            "info" : "اظهار _START_ الي _END_ من اصل _TOTAL_ نتيجة",
            "lengthMenu" : "اظهار _MENU_ نتائج",
            "infoEmpty" : "0 نتائج بحث",
            "paginate": {
                "previous": "السابق",
                "next": "التالي",
            }
        },
        ajax : "{{ route('admin.datatable.labs') }}",
        columns : [
            { data : 'name', name : 'name' },
            { data : 'educational_stage', name : 'educational_stage' },
            { data : 'educational_class', name : 'educational_class' },
            { data : 'subject', name : 'subject' },
        ],
    });
});
</script>