<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){
    
    $('#session-excersices').DataTable({
        'iDisplayLength': 10,
        "language": {
            "emptyTable" : "لا يوجد اي واجبات مدرسية",
            "search" : "بحث",
            "info" : "اظهار _START_ الي _END_ من اصل _TOTAL_ نتيجة",
            "lengthMenu" : "اظهار _MENU_ نتائج",
            "infoEmpty" : "0 نتائج بحث",
            "paginate": {
                "previous": "السابق",
                "next": "التالي",
            }
        },
    });
});
</script>