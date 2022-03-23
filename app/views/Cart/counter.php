<div class="add-quantity-remove">
    <button class="remove-from-cart-link"
            data-id="<?php echo $product->id; ?>"
            href="cart/add?id=<?php echo $product->id; ?>">
        <i class="fa fa-minus" aria-hidden="true"></i>
    </button>
    <span class="quantity">
        <?php echo $_SESSION['cart'][$product->id]['quantity']; ?> pcs
    </span>
    <button class="add-to-cart-link"
            data-id="<?php echo $product->id; ?>"
            href="cart/add?id=<?php echo $product->id; ?>">
        <i class="fa fa-plus" aria-hidden="true"></i>
    </button>
</div>