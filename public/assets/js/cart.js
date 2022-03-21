jQuery( document ).ready(function( $ ) {


    "use strict";

    $('body').on('click', '.add-to-cart-link', function (e) {
        e.preventDefault();
        var id = $(this).data('id'),
            quantity = 1;
        sendAjax(id, quantity, $(this));
    });

    $('body').on('click', '.remove-from-cart-link', function (e) {
        e.preventDefault();
        var id = $(this).data('id'),
            quantity = -1;
        sendAjax(id, quantity, $(this));
    });

    $('body').on('click', '.clear-cart-button', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/cart/clear',
            type: 'GET',
            success: function (res) {
                $('.cart').remove();
                $('.cart-heading').append(res);
            },
            error: function (e) {
                alert("Error! Can't clear a cart.");
            },
        });
    });

    function sendAjax(id, quantity, object) {
        $.ajax({
            url: '/cart/add',
            data: {id: id, quantity: quantity},
            type: 'GET',
            context: object,
            success: function (res) {
                setNewValue($(this), res);
                addAreaHandler($(this), res);
                refreshTotalCart();
            },
            error: function (e) {
                alert('Error! Try again later.');
            },
        });
    }

    function setNewValue(button, quantity) {
        findValueField(button).text(getNewQuantity(quantity));
    }

    function findValueField(button) {
        return $(button).siblings('.quantity-text');
    }

    function getNewQuantity(quantity) {
        return (quantity + ' pcs');
    }

    function addAreaHandler(button, quantity) {
        if (quantity == 0 && $(button).parent().hasClass('add-quantity-remove')) {
            changeCounterToButton(button);
        }
        if (quantity > 0 && $(button).parent().hasClass('add-to-cart-button')) {
            changeButtonToCounter(button);
        }
        if (quantity == 0 && $(button).parent().parent().hasClass('product-desc')) {
            removeProductFromCart(button);
        }
    }

    function changeCounterToButton(button) {
        $.ajax({
            url: '/cart/counter',
            data: {id: $(button).data('id')},
            type: 'GET',
            context: button,
            success: function (res) {
                $(button).parent().replaceWith(res);
            },
            error: function (e) {
                alert("Error! Can't change counter.");
            },
        });
    }

    function changeButtonToCounter(button) {
        $.ajax({
            url: '/cart/button',
            data: {id: $(button).data('id')},
            type: 'GET',
            context: button,
            success: function (res) {
                $(button).parent().replaceWith(res);
            },
            error: function (e) {
                alert("Error! Can't change button.");
            },
        });
    }

    function removeProductFromCart(button) {
        $(button).parent().parent().parent().remove();
    }

    function refreshTotalCart() {
        $.ajax({
            url: '/cart/refresh',
            type: 'GET',
            success: function (res) {
                totalCartReplace(res);
            },
            error: function (e) {
                alert("Error! Can't change cart.");
            },
        });
    }

    function totalCartReplace(json) {
        var totalCartInfo = JSON.parse(json);
        $('.quantity-in-total-cart').text(totalCartInfo['totalQuantity'] + ' products in your cart');
        $('.total-sum').text('Total sum is ' +  totalCartInfo['totalAmount'] + '$');
    }

});