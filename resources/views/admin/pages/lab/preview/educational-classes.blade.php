<div class="form-group">
    <label for="educational_class">اختر الصف التعليمي</label>
    <select name="educational_class_id" class="form-control" id="educational_class">
    @foreach($educationalClasses as $educationalClass)
        @if($lab != null)
        <option value="{{ $educationalClass->id }}" {{ $lab->educational_class_id == $educationalClass->id ? 'selected' : null }}>{{ $educationalClass->name }}</option>
        @else
        <option value="{{ $educationalClass->id }}">{{ $educationalClass->name }}</option>
        @endif
    @endforeach
    </select>
</div>