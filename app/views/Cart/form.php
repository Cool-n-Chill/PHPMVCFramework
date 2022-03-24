<form action="" method="get" class="quantity-form">
    <label for="quantity">Quantity:</label>
    <input name="quantity" type="quantity" class="quantity-text" id="quantity"
           onfocus="if(this.value == '1') { this.value = ''; }"
           onBlur="if(this.value == '') { this.value = '1';}"
           value="1">
    <input type="submit" data-id="<?=$product->id;?>" class="button add-to-cart-link" value="Order Now!">
</form>
