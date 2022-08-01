<!-- Date range -->
<div class="form-group">
    <label for="datarange">بدء الحصة من تاريه معين حتي تاريخ معين</label>

    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control pull-right" name="datarange" id="datarange" required>
    </div>
    <!-- /.input group -->
</div>
<!-- /.Date range -->

<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" value="" id="check_all" checked>
    <label class="form-check-label" for="check_all">
        جميع ايام الاسبوع
    </label>
</div>

<div class="form-check form-check-inline">
    <input class="form-check-input days" name="days[]" type="checkbox" value="0" id="sunday">
    <label class="form-check-label" for="sunday">
        الاحد
    </label>
</div>

<div class="form-check form-check-inline">
    <input class="form-check-input days" name="days[]" type="checkbox" value="1" id="monday">
    <label class="form-check-label" for="monday">
        الاثنين
    </label>
</div>

<div class="form-check form-check-inline">
    <input class="form-check-input days" name="days[]" type="checkbox" value="2" id="tuesday">
    <label class="form-check-label" for="tuesday">
        الثلاثاء
    </label>
</div>

<div class="form-check form-check-inline">
    <input class="form-check-input days" name="days[]" type="checkbox" value="3" id="wednesday">
    <label class="form-check-label" for="wednesday">
        الاربعاء
    </label>
</div>

<div class="form-check form-check-inline">
    <input class="form-check-input days" name="days[]" type="checkbox" value="4" id="thursday">
    <label class="form-check-label" for="thursday">
        الخميس
    </label>
</div>

<script src="{{ asset('assets/vendor_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script>

$('#datarange').daterangepicker();

if($("#check_all").is(':checked')){

    $(".days").each(function(){
        $(this).prop('checked', true);
    });
}

$("#check_all").on('change', function(){

    if($(this).is(':checked')){
        $(".days").each(function(){
            $(this).prop('checked', true);
        });
    }else{
        $(".days").each(function(){
            $(this).prop('checked', false);
        });
    }
});

$(".days").on('change', function(){

$("#check_all").prop('checked', false);
});
</script>