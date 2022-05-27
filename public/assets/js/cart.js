jQuery( document ).ready(function( $ ) {


    "use strict";

    $('body').on('click', '.add-to-cart-link', function (e) {
        e.preventDefault();
        var id = $(this).data('id'),
            quantity = $('input.quantity-text').val() ? $('input.quantity-text').val() : 1,
            url = String(window.location.href);
        sendAjaxAdd(id, quantity, url, $(this));
    });

    $('body').on('click', '.remove-from-cart-link', function (e) {
        e.preventDefault();
        var id = $(this).data('id'),
            quantity = -1,
            url = window.location.href;
        sendAjaxAdd(id, quantity, url, $(this));
    });

    function sendAjaxAdd(id, quantity, url, object) {
        $.ajax({
            url: '/cart/add',
            data: {id: id, quantity: quantity, url: url},
            type: 'GET',
            context: object,
            success: function (res) {
                if (!isJson(res)) {
                    alert('You must be logged in for adding to cart.');
                }
                res = JSON.parse(res);
                setNewValue($(this), res.quantity);
                replaceOrderButtons(object, res.html);
                totalCartReplace(res.totalCart);
                ifProductRemoved(object, res.quantity, getControllerFromUrl(url));
                ifProductWasLastInCart(res.totalCart);
            },
            error: function (e) {
                alert('Error! Try again later.');
            },
        });
    }

    $('body').on('click', '.clear-cart-button', function (e) {
        e.preventDefault();
        sendAjaxClear();
    });

    function sendAjaxClear() {
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
    }

    function setNewValue(button, quantity) {
        findValueField(button).text(getNewQuantity(quantity));
    }

    function findValueField(button) {
        return $(button).siblings('.quantity');
    }

    function getNewQuantity(quantity) {
        return (quantity + ' pcs');
    }

    function replaceOrderButtons(button, replace) {
        if (replace != ''){
            $(button).parent().replaceWith(replace);
        }
    }

    function totalCartReplace(json) {
        $('.quantity-in-total-cart').text(json.totalQuantity + ' products in your cart');
        $('.total-sum').text('Total sum is ' +  json.totalAmount + '$');
    }

    function ifProductRemoved(button, quantity, controller) {
        if (quantity == 0 && controller == 'cart') {
            removeProductFromCart(button);
        }
    }

    function getControllerFromUrl(url) {
        return url.split('/')[3];
    }

    function removeProductFromCart(button) {
        $(button).parent().parent().parent().remove();
    }

    function ifProductWasLastInCart(totalCartObject) {
        if (totalCartObject.totalQuantity == 0) {
            sendAjaxClear();
        }
    }

    function isJson(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }

});