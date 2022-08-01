<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){
    // datatable for all educational stages
    $('#my-books').DataTable({
        'iDisplayLength': 10,
        "language": {
            "emptyTable" : "لا يوجد لديك اي كتب خاصة بك",
            "search" : "بحث",
            "info" : "اظهار _START_ الي _END_ من اصل _TOTAL_ نتيجة",
            "lengthMenu" : "اظهار _MENU_ نتائج",
            "infoEmpty" : "0 نتائج بحث",
            "paginate": {
                "previous": "السابق",
                "next": "التالي",
            }
        },
        ajax : "{{ route('instructor.datatable.library.my-books') }}",
        columns : [
            { data : 'book_name', name : 'book_name' },
            { data : 'isPublished', name : 'isPublished' },
            { data : 'created_at', name : 'created_at' },
        ],
    });
});
</script>