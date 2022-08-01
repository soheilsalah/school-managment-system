<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script>
$(document).ready(function(){
    // datatable for all educational stages
    $('#educational-stages').DataTable({
        'iDisplayLength': 10,
        "language": {
            "emptyTable" : "لا يوجد لديك اي مرحلة تعليمية",
            "search" : "بحث",
            "info" : "اظهار _START_ الي _END_ من اصل _TOTAL_ نتيجة",
            "lengthMenu" : "اظهار _MENU_ نتائج",
            "infoEmpty" : "0 نتائج بحث",
            "paginate": {
                "previous": "السابق",
                "next": "التالي",
            }
        },
        ajax : "{{ route('instructor.datatable.educational-classes') }}",
        columns : [
            { data : 'educational_class_name', name : 'educational_class_name' },
            { data : 'classroom', name : 'classroom' },
            { data : 'subject', name : 'subject' },
        ],
    });
});
</script>