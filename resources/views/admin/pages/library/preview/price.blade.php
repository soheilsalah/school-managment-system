<div class="form-group row">
    <div class="col-4">
        <label for="price">سعر الكتاب</label>
        <input type="number" class="form-control" name="price" id="price" min="0" pattern="[0-9]+" value="{{ $book != null ? $book->price : null }}" required>
    </div>
    <div class="col-4">
        <label for="discount">
            هل يوجد تخفيض
            <small class="text-danger font-weight-bold">بالنسبة المئوية</small>
        </label>
        <input type="number" class="form-control" name="discount" id="discount" min="0" max="99" value="{{ $book != null ? $book->discount : null }}" pattern="[0-9]+">
    </div>
    <div class="col-4">
        <label for="price_after_discount">
            السعر بعد التخفيض
        </label>
        <input type="number" class="form-control" name="price_after_discount" id="price_after_discount" min="0" max="99" value="{{ $book != null ? $book->price_after_discount : null }}" pattern="[0-9]+" readonly>
    </div>
</div>
<script>
$("#discount").on('keyup', function(){

    var price = $("#price").val();
    var discount = $(this).val();
    var price_after_discount = price - (price * discount / 100);

    if(discount > 99){
        
        $("#price_after_discount").val(0);
        $("#discount").val(0);

    }else if(discount == 0){
        $("#price_after_discount").val(0);
        $("#discount").val(0);
    }else{

        $("#price_after_discount").val(price_after_discount);
    }
});

$("#price").on('keyup', function(){

    var price = $(this).val();
    var discount = $("#discount").val();
    var price_after_discount = price - (price * discount / 100);

    if(discount > 99){
        
        $("#price_after_discount").val(0);
        $("#discount").val(0);

    }else if(discount == 0){
        $("#price_after_discount").val(0);
        $("#discount").val(0);
    }else{
        
        $("#price_after_discount").val(price_after_discount);
    }
});
</script>