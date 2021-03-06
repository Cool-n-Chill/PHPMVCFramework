<!-- Page Content -->
<!-- Single Starts Here -->
<div class="single-product" xmlns="http://www.w3.org/1999/html">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
            <nav aria-label="breadcrumbs">
                <ol class="breadcrumb">
                    <?php foreach ($breadcrumbs as $breadcrumb): ?>
                        <?php if (end($breadcrumbs) == $breadcrumb): ?>
                            <li class="breadcrumb-item active" aria-current="page">
                                <?php echo $breadcrumb; ?>
                            </li>
                        <?php else: ?>
                            <li class="breadcrumb-item">
                                <a href="<?=PATH . '/category/' . $breadcrumb?>"><?php echo $breadcrumb; ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ol>
            </nav>
          <div class="line-dec"></div>
          <h1>Single Product</h1>
        </div>
      </div>
      <div class="col-md-6">
        <div class="product-slider">
          <div id="slider" class="flexslider">
            <ul class="slides">
                <?php foreach ($gallery as $image): ?>
                    <li>
                        <img src="/assets/images/<?php echo $image['image']; ?>" />
                    </li>
                <?php endforeach; ?>
              <!-- items mirrored twice, total of 12 -->
            </ul>
          </div>
          <div id="carousel" class="flexslider">
            <ul class="slides">
                <?php foreach ($gallery as $image): ?>
                    <li>
                        <img src="/assets/images/<?php echo $image['image']; ?>" />
                    </li>
                <?php endforeach; ?>
              <!-- items mirrored twice, total of 12 -->
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="right-content">
          <h4><?php echo($product->title); ?></h4>
          <h6><?php echo($product->price); ?>$</h6>
          <?php if ($product->old_price): ?>
            <h5><?php echo($product->old_price); ?>$</h5>
          <?php endif; ?>
          <p><?php echo($product->content); ?></p>
          <span><?php echo($product->quantity); ?> left on stock</span>

            <?php if (array_key_exists($product->id, $productsInCart)): ?>
                <div class="add-quantity-remove">
                    <button class="remove-from-cart-link"
                            data-id="<?php echo $product->id; ?>"
                            href="cart/add?id=<?php echo $product->id; ?>">
                        <i class="fa fa-minus" aria-hidden="true"></i>
                    </button>
                    <span class="quantity">
                        <?php echo $productsInCart[$product->id]['quantity']; ?> pcs
                    </span>
                    <button class="add-to-cart-link"
                            data-id="<?php echo $product->id; ?>"
                            href="cart/add?id=<?php echo $product->id; ?>">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                </div>
            <?php else: ?>
                <form action="" method="get" class="quantity-form">
                    <label for="quantity">Quantity:</label>
                    <input name="quantity" type="quantity" class="quantity-text" id="quantity"
                           onfocus="if(this.value == '1') { this.value = ''; }"
                           onBlur="if(this.value == '') { this.value = '1';}"
                           value="1">
                    <input type="submit" data-id="<?=$product->id;?>" class="button add-to-cart-link" value="Order Now!">
                </form>
            <?php endif; ?>

          <div class="down-content">
            <div class="categories">
              <h6>Category:
                  <span>
                      <?php foreach ($categorys as $category): ?>
                      <a href="#"><?php echo $category['title']; ?> </a>
                      <?php endforeach; ?>
                  </span>
              </h6>
            </div>
            <div class="share">
              <h6>Share: <span><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-linkedin"></i></a><a href="#"><i class="fa fa-twitter"></i></a></span></h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Single Page Ends Here -->

<!-- Similar Starts Here -->
<?php if ($related_products): ?>
<div class="featured-items">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <div class="line-dec"></div>
                    <h1>You May Also Like</h1>
                </div>
            </div>
            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    <?php foreach ($related_products as $related_product): ?>
                        <a href="<?php echo $related_product['alias']; ?>">
                            <div class="featured-item">
                                <img src="/assets/images/<?php echo $related_product['img']; ?>" alt="<?php echo $related_product['alias']; ?>">
                                <h4><?php echo $related_product['title']; ?></h4>
                                <h6>$<?php echo $related_product['price']; ?></h6>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<!-- Similar Ends Here -->