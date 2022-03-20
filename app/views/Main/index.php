<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="caption">
                    <h2>Ecommerce HTML Template</h2>
                    <div class="line-dec"></div>
                    <p>Pixie HTML Template can be converted into your desired CMS theme. Total <strong>5 pages</strong> included. You can use this Bootstrap v4.1.3 layout for any CMS.
                        <br><br>Please tell your friends about <a rel="nofollow" href="https://www.facebook.com/tooplate/">Tooplate</a> free template site. Thank you. Photo credit goes to <a rel="nofollow" href="https://www.pexels.com">Pexels website</a>.</p>
                    <div class="main-button">
                        <a href="#">Order Now!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner Ends Here -->

<!-- Featured Starts Here -->
<?php if ($featuredProducts): ?>
<div class="featured-items">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <div class="line-dec"></div>
                    <h1>Featured Items</h1>
                </div>
            </div>
            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    <?php foreach ($featuredProducts as $product): ?>
                        <div class="featured-item">
                            <a href="product/<?php echo $product->alias; ?>">
                            <img src="/assets/images/<?php echo $product->img; ?>" alt="<?php echo $product->alias; ?>">
                            <h4><?php echo $product->title; ?></h4>
                            <div class="price">
                                <h6>$<?php echo $product->price; ?></h6>
                                <?php if ($product->old_price > $product->price) : ?>
                                <h5>$<?php echo $product->old_price; ?></h5>
                                <?php endif; ?>
                            </div>
                            </a>
                            <div class="item-buy-button">
                                <?php if (array_key_exists($product->id, $productsInCart)): ?>
                                <div class="add-quantity-remove">
                                    <button class="remove-from-cart-link"
                                            data-id="<?php echo $product->id; ?>"
                                            href="cart/add?id=<?php echo $product->id; ?>">
                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                    </button>
                                    <span class="quantity-text">
                                        <?php echo $productsInCart[$product->id]['quantity']; ?> pcs
                                    </span>
                                    <button class="add-to-cart-link"
                                            data-id="<?php echo $product->id; ?>"
                                            href="cart/add?id=<?php echo $product->id; ?>">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <?php else: ?>
                                <div class="add-to-cart-button">
                                    <button class="add-to-cart-link"
                                            data-id="<?php echo $product->id; ?>"
                                            href="cart/add?id=<?php echo $product->id; ?>">
                                        Order
                                    </button>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<!-- Featured Ends Here -->