<div class="form-check form-check-inline">
    <input class="form-check-input day-of-the-week" type="checkbox" id="all" value="all">
    <label class="form-check-label" for="all">جميع ايام الاسبوع</label>
</div>

<div class="form-check form-check-inline">
    <input class="form-check-input day-of-the-week" type="checkbox" id="0" name="days[]" value="0">
    <label class="form-check-label" for="0">كل يوم احد</label>
</div>

<div class="form-check form-check-inline">
    <input class="form-check-input day-of-the-week" type="checkbox" id="1" name="days[]" value="1">
    <label class="form-check-label" for="1">كل يوم اثنين</label>
</div>

<div class="form-check form-check-inline">
    <input class="form-check-input day-of-the-week" type="checkbox" id="2" name="days[]" value="2">
    <label class="form-check-label" for="2">كل يوم ثلاثاء</label>
</div>

<div class="form-check form-check-inline">
    <input class="form-check-input day-of-the-week" type="checkbox" id="3" name="days[]" value="3">
    <label class="form-check-label" for="3">كل يوم اربعاء</label>
</div>

<div class="form-check form-check-inline">
    <input class="form-check-input day-of-the-week" type="checkbox" id="4" name="days[]" value="4">
    <label class="form-check-label" for="4">كل يوم خميس</label>
</div>

<script>
$("#all").on('change', function(e){
       
    if($(this).is(':checked')){

        $(".day-of-the-week").prop('checked', true);
    }else{
        
        $(".day-of-the-week").prop('checked', false);
    }
});
</script>