<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header">						
                <h4 class="box-title">جميع الحصص في {{ $educationalClass->name }}</h4>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="schedule-sessions" class="table table-striped table-bordered display" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الحصة</th>
                                <th>المادة</th>
                                <th>تاريخ بدء الحصة</th>
                                <th>سعر الحصة</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($scheduleSessions as $scheduleSession)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input check-session" type="checkbox" id="schedule_session_{{ $scheduleSession->id }}" value="{{ $scheduleSession->id }}">
                                        <label class="form-check-label" for="schedule_session_{{ $scheduleSession->id }}"></label>
                                    </div>
                                </td>
                                <td>{{ $scheduleSession->topic }}</td>
                                <td>{{ $scheduleSession->belongsToSubject->name }}</td>
                                <td>{{ date('Y-m-d', strtotime($scheduleSession->start_at)) }}</td>
                                <td>{{ $scheduleSession->price.' EGP' }}</td>
                            </tr>
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
                <h4 class="box-title">الحصص التي تم اختيارها</h4>
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
                        <tbody id="checked_session_res"></tbody>
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
        "emptyTable" : "لا يوجد لديك اي حصص",
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

$(document).on('change', '.check-session', function(){

    var schedule_sessions = [];

    var myTable = $('#schedule-sessions').DataTable();

    var rowcollection = myTable.$(".check-session:checkbox:checked", {"page": "all"});

    rowcollection.each(function(index,elem){

        schedule_sessions.push($(this).val());
    });

    $.ajax({
        url : "{{ route('parent.ajax.subscription.selected-sesssions') }}",
        type : "POST",
        data : {
            "_token" : "{{ csrf_token() }}",
            "schedule_sessions" : schedule_sessions,
        },
        success : function(data)
        {
            $("#checked_session_res").html(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            
            $("#checked_session_res").html('error');
        }
    });
});

$("#make-payment").on('click', function(){

    var sum = $("#sum").data("sum");

    alert(sum);
});
</script>