<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header">						
                <h4 class="box-title">جميع المواد في {{ $educationalClass->name }}</h4>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="schedule-sessions" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المادة</th>
                                <th>عدد الحصص داخل المادة</th>
                                <th>سعر اجمالي الحصص</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($educationalClassSubjects as $educationalClassSubject)
                            @php
                                $sum = 0;
                            @endphp
                            @if($educationalClassSubject->scheduleSessions->count() > 0)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input check-subject" type="checkbox" id="educational_class_subject_{{ $educationalClassSubject->id }}" value="{{ $educationalClassSubject->id }}">
                                        <label class="form-check-label" for="educational_class_subject_{{ $educationalClassSubject->id }}"></label>
                                    </div>
                                </td>
                                <td>{{ $educationalClassSubject->belongsToSubject->name }}</td>
                                <td>{{ $educationalClassSubject->scheduleSessions->count() }}</td>
                                <td>
                                @foreach($educationalClassSubject->scheduleSessions as $scheduleSession)
                                    @php
                                        $sum += $scheduleSession->price
                                    @endphp
                                @endforeach
                                    {{ $sum.' EGP' }}
                                </td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">المواد التي تم اختيارها</h4>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>اسم الحصة</th>
                                <th class="w-200">سعرها</th>
                            </tr>
                        </thead>
                        <tbody id="checked_subject_res"></tbody>
                    </table>
                </div>

                <hr>

                <div class="row">
                    <div class="col-lg-7 col-md-6 col-12">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">رقم الفيزا</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                                    <input type="text" class="form-control" id="exampleInputuname" placeholder="Card Number"> </div>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <div class="form-group">
                                        <label>تاريخ الانتهاء</label>
                                        <input type="text" class="form-control" name="Expiry" placeholder="MM / YY" required=""> </div>
                                </div>
                                <div class="col-5 pull-right">
                                    <div class="form-group">
                                        <label>ال CV كود</label>
                                        <input type="text" class="form-control" name="CVC" placeholder="CVC" required=""> </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>اسم الحاصل علي الكارد</label>
                                        <input type="text" class="form-control" name="nameCard" placeholder="NAME AND SURNAME"> </div>
                                </div>
                            </div>
                            <button class="btn btn-success" id="make-payment">Make Payment</button>
                        </form>
                    </div>
                    <div class="col-lg-5 col-md-6 col-12">
                        <h3 class="box-title mt-10">معلومات عامة</h3>
                        <h2><i class="fa fa-cc-visa text-info"></i>
                            <i class="fa fa-cc-mastercard text-danger"></i>
                        </h2>
                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock.</p>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// datatable for all instructors
$('#schedule-sessions').DataTable({
    'iDisplayLength': 10,
    "language": {
        "emptyTable" : "لا يوجد لديك اي مواد",
        "search" : "بحث",
        "info" : "اظهار _START_ الي _END_ من اصل _TOTAL_ نتيجة",
        "lengthMenu" : "اظهار _MENU_ نتائج",
        "infoEmpty" : "0 نتائج بحث",
        "paginate": {
            "previous": "السابق",
            "next": "التالي",
        }
    }
});

$(document).on('change', '.check-subject', function(){

    var subjects = [];

    var myTable = $('#schedule-sessions').DataTable();

    var rowcollection = myTable.$(".check-subject:checkbox:checked", {"page": "all"});

    rowcollection.each(function(index,elem){

        subjects.push($(this).val());
    });

    $.ajax({
        url : "{{ route('parent.ajax.subscription.selected-subjects') }}",
        type : "POST",
        data : {
            "_token" : "{{ csrf_token() }}",
            "subjects" : subjects,
        },
        success : function(data)
        {
            $("#checked_subject_res").html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            
            $("#checked_subject_res").html('error');
        }
    });
});

$("#make-payment").on('click', function(){

    var sum = $("#sum").data("sum");

    alert(sum);
});
</script>