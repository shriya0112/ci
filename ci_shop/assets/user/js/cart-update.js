$(document).ready(function() {
    $(".btn-cart-update").click(function() {
        var id = $(this).attr('data-id');
        var quantity = ($("#quantity" + id).val());
        var data = "product_id=" + id + "&quantity=" + quantity;
        console.log(data);
        $.ajax({
            type: "POST",
            data: data,
            url: BASE_URL + 'user/cart/add/',
            beforeSend: function() {
                console.log(data);
            },
            error: function(xhr, status, error) {
                console.log(xhr);
            },
            success: function(response) {
                window.location.reload();
            },
        });
    });
    $(".btn-cart-delete").click(function() {
        var id = $(this).attr('data-id');
        var data = "product_id=" + id;
        console.log(data);
        $.ajax({
            type: "POST",
            data: data,
            url: BASE_URL + 'user/cart/delete/',
            beforeSend: function() {
                console.log(data);
            },
            error: function(xhr, status, error) {
                console.log(xhr);
            },
            success: function(response) {
                window.location.reload();
            },
        });
    });
});