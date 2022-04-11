<!-- Page Content-->
<!-- Items Starts Here-->
<div class="featured-page">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12">
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
                <div class="section-heading">
                    <div class="line-dec"></div>
                    <h1>Featured Items</h1>
                </div>
            </div>
            <div class="col-md-8 col-sm-12">
                <div id="filters" class="button-group">
                    <button class="btn btn-primary" data-filter="*">All Products</button>
                    <button class="btn btn-primary" data-filter=".new">Newest</button>
                    <button class="btn btn-primary" data-filter=".low">Low Price</button>
                    <button class="btn btn-primary" data-filter=".high">Hight Price</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="featured container no-gutter">
<?php if ($products): ?>
    <div class="row posts">
        <?php foreach ($products as $product): ?>
        <div id="<?=$product->id?>" class="item new col-md-4">
            <a href="<?=PATH . '/product/' . $product->alias?>">
                <div class="featured-item">
                    <img src="/assets/images/<?=$product->img?>" alt="<?=$product->alias?>">
                    <h4><?=$product->title?></h4>
                    <h6>$<?=$product->price?></h6>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
</div>
<?php echo $paginationView; ?>
<!-- Featred Page Ends Here-->
