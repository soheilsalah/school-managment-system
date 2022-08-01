<div class="modal-header">
    <h4 class="modal-title">{{ $title }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
@if($classRoomScheduleSessions->count() == 0)
    <div class="jumbotron text-center">
        <h1>لا يوجد حصص في هذا اليوم</h1>
    </div>
@else
    <table class="table">
        <thead>
            <tr>
                <th>اسم الحصة</th>
                <th>المدرس</th>
                <th>ساعة البدء</th>
                <th>ساعة الانتهاء</th>
            </tr>
        </thead>
        <tbody>
        @foreach($classRoomScheduleSessions as $classRoomScheduleSession)
            <tr id="tr_{{$classRoomScheduleSession->id}}">
                <td>{{ $classRoomScheduleSession->belongsToSubject->name }}</td>
                <td>{{ $classRoomScheduleSession->belongsToInstructor->name }}</td>
                <td>{{ date('h:i a', strtotime($classRoomScheduleSession->start_at)) }}</td>
                <td>{{ date('h:i a', strtotime($classRoomScheduleSession->end_at)) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق النافذة</button>
</div>