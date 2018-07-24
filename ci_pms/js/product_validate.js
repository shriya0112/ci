$(document).ready(function() {
    // For Validating Select Box
    $.validator.addMethod("valueNotEquals", function(value, element, arg) {
        return arg !== value;
    });
    // For Validating Number Of Image Files maximum 5
    $.validator.addMethod("maxFilesToSelect", function(value, element, params) {

        var fileCount = element.files.length;
        if (fileCount > params) {
            return false;
        } else {
            return true;
        }
    }, 'Select no more than 5 files');
    //To Validate Final Price After Calculated Discount With Respect To Actual Price
    $.validator.addMethod("discount_calculate", function(value, element) {
            console.log(element);
            var actual_price = $("#actual_price").val();
            var discount_percent = $("#discount_in_percentage").val();
            if (discount_percent == "") {
                discount_percent = 0;
                console.log('discount_percent' + discount_percent);
            }
            if ($.isNumeric(actual_price) && actual_price > 0) {
                var final_price = parseFloat(actual_price) - (parseFloat(actual_price) * parseFloat(discount_percent) / 100);
                $("#final_price").val(final_price);
                return true;
            } else {

                $("#final_price").val('NaN');
                return false;
            }

        }, ''),

        $('#pvalidate').validate({
            debug: true,
            rules: {
                pc_name: {
                    valueNotEquals: "0"
                },
                psc_name: {
                    valueNotEquals: "0"
                },
                name: "required",
                actual_price: {
                    required: true,
                    min: 0,
                    discount_calculate: true

                },
                discount_in_percentage: {
                    required: true,
                    min: 0,
                    max: 100,
                    discount_calculate: true
                },
                image_name1: {
                    required: true
                },
                "image_name[]": {
                    maxFilesToSelect: 5,
                },
                brand_name: "required",
                seller_name: "required",

            },
            messages: {
                pc_name: {
                    valueNotEquals: "Please Select A Category"
                },
                psc_name: {
                    valueNotEquals: "Please Select A Sub-Category"
                },
                actual_price: {
                    required: "This field is required",
                    digits: 'Please Enter Positive Number',
                    min: 0
                },
                discount_percent: {
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
                // do other things for a valid form
                form.submit();
            }

        });

});