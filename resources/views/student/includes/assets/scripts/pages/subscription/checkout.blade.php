<script>
$(document).ready(function(){
    
    $("#make-payment").on('click', function(){

        var sum = $("#sum").data("sum");

        alert(sum);
    });
});
</script>