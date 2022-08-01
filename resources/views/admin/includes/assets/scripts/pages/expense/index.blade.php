<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){

    // datatable for all expense services
    $('#expenses').DataTable({
        'iDisplayLength': 10,
        "language": {
            "emptyTable" : "لا يوجد لديك اي خدمات",
            "search" : "بحث",
            "info" : "اظهار _START_ الي _END_ من اصل _TOTAL_ نتيجة",
            "lengthMenu" : "اظهار _MENU_ نتائج",
            "infoEmpty" : "0 نتائج بحث",
            "paginate": {
                "previous": "السابق",
                "next": "التالي",
            }
        },
        ajax : "{{ route('admin.datatable.expenses') }}",
        columns : [
            { data : 'service_name', name : 'service_name' },
            { data : 'service_cost', name : 'service_cost' },
            { data : 'paid_every', name : 'paid_every' },
            { data : 'start_from_date', name : 'start_from_date' },
            { data : 'created_at', name : 'created_at' },
        ],
    });
});
</script>