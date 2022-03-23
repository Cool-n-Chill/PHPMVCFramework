<div class="shopping-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading cart-heading">
                    <div class="line-dec"></div>
                    <h1>Products in shopping cart</h1>
                    <?php if (!$products):?>
                    <p>Your shopping cart is empty</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($products): ?>
            <div class="col-md-9 cart">
                <div class="shopping-cart-list">
                    <div class="products-in-cart">
                        <? foreach ($products as $id => $product): ?>
                            <div class="product-info">
                                <div class="product-image">
                                    <a href="<?=PATH?>/product/<?php echo $product['alias']; ?>">
                                        <img src="/assets/images/<?php echo $product['img']; ?>" alt="<?php echo $product['alias']; ?>">
                                    </a>
                                </div>
                                <div class="product-desc">
                                    <a href="<?=PATH?>/product/<?php echo $product['alias']; ?>">
                                        <h4><?php echo $product['title']; ?></h4>
                                    </a>
                                    <div class="price">
                                        <h6>$<?php echo $product['price']; ?></h6>
                                    </div>
                                    <div class="add-quantity-remove">
                                        <button class="remove-from-cart-link"
                                                data-id="<?=$id;?>"
                                                href="cart/add?id=<?=$id;?>">
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </button>
                                        <span class="quantity">
                                            <?php echo $product['quantity']; ?> pcs
                                        </span>
                                        <button class="add-to-cart-link"
                                                data-id="<?=$id;?>"
                                                href="cart/add?id=<?=$id;?>">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 cart">
                    <div class="order">
                        <div class="total-amount">
                            <h3 class="title">Your cart</h3>
                            <p class="quantity-in-total-cart">
                                <?php echo $_SESSION['totalCart']['totalQuantity']; ?> products in your cart
                            </p>
                            <p class="total-sum">Total sum is <?php echo $_SESSION['totalCart']['totalAmount']; ?>$</p>
                        </div>
                        <div class="order-button">
                            <button class="order-products" href="cart/order">Order products</button>
                        </div>
                        <div class="clear-cart-button">
                            <button class="clear-cart" href="cart/clear">Remove all products</button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>