<script type="text/javascript">
    $(document).ready(function() {
//To Validate Final Price After Calculated Discount With Respect To Actual Price
$.validator.addMethod("discount_calculate", function(value, element) {
    var actual_price = $("#price").val();
    var discount_percent = $("#discount").val();
    if ($.isNumeric(actual_price) && actual_price > 0) {
        var final_price = parseFloat(actual_price) - (parseFloat(actual_price) * parseFloat(discount_percent) / 100);
        $("#selling_price").text(final_price);
        return true;
    }

}, ''),

$('#productform').validate({
    debug: true,
    rules: {
        name: "required",
        price: {
            required: true,
            min: 0,
            discount_calculate: true
        },
        discount: {
            required: true,
            min: 0,
            max: 100,
            discount_calculate: true
        },
    },
    messages: {        
        price: {
            required: "This field is required",
            digits: 'Please Enter Positive Number',
            min: 0
        },
        discount: {
            digits: 'Please enter positive number.',
            min: 0,
            max: 'Please enter value less than or equal to 100.',
        },
    },
    errorClass: "help-inline",
    highlight: function(element, errorClass, validClass) {
        $(element).parents('.controls').addClass('error');
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).parents('.controls').removeClass('error');
    },
    submitHandler: function(form) {
        form.submit();
    }
});
});  
</script>