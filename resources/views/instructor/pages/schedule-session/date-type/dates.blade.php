<div class="form-group">
    <label for="date">حدد التاريخ</label>
    <select class="form-control select2" multiple="multiple" name="date[]" id="date" data-placeholder="اختر تاريخ او تواريخ معينة" style="width: 100%;">
    @foreach($getTermDates as $getTermDate)
        <option value="{{ $getTermDate->format('Y-m-d') }}">{{ $getTermDate->format('Y-m-d') }}</option>
    @endforeach
    </select>
</div>
<script src="{{ asset('assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
<script>
    $('.select2').select2();
</script>