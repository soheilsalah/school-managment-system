<div class="form-group">
    <label for="classroom">اختر الفصل</label>
    <select class="form-control select2" name="classroom_id" id="classroom" style="width: 100%;">
    @foreach($classrooms as $classroom)
        <option value="{{ $classroom->id }}" {{ isset($classroom->studentCLass->class_room_id) && $classroom->studentCLass->class_room_id == $classroom->id ? 'selected' : null }}>{{ $classroom->name }}</option>
    @endforeach
    </select>
</div>