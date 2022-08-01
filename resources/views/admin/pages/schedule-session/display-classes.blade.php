<label for="educational_class">المرحلة التعليمية</label>
<select class="form-control select2" name="educational_class_id" id="educational_class" style="width: 100%;">
@foreach ($educationalStage->classes as $class)
    <option value="{{ $class->id }}">{{ $class->name }}</option>
@endforeach
</select>
<script>
$('.select2').select2();
</script>