<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){

    // datatable for all instructors
    $('#instructors').DataTable({
        'iDisplayLength': 10,
        "language": {
            "emptyTable" : "لا يوجد لديك اي مدرسين",
            "search" : "بحث",
            "info" : "اظهار _START_ الي _END_ من اصل _TOTAL_ نتيجة",
            "lengthMenu" : "اظهار _MENU_ نتائج",
            "infoEmpty" : "0 نتائج بحث",
            "paginate": {
                "previous": "السابق",
                "next": "التالي",
            }
        },
        ajax : "{{ route('financial.datatable.rewards-and-incentives-for-instructors') }}",
        columns : [
            { data : 'name', name : 'name' },
            { data : 'email', name : 'email' },
            { data : 'rewards', name : 'rewards' },
        ],
    });
});
</script>