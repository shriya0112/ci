<section class="shop_grid_area section-padding-80">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-9">
                <div class="row">
                    <?php 
                    $i=0;
                    foreach ($product_info as $key => $value) {
                        if ($i<=count($product_info)) {
                            ?>
                            <!-- Single Product -->
                            <div class="col-12 col-sm-6 col-lg-4">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="<?php echo $product_info[$i]['cover_image']? base_url('assets/user/shop/').$product_info[$i]['cover_image']:base_url('assets/user/images/no-image.png'); ?>" alt="">
                                </div>
                                <!-- Product Description -->
                                <div class="product-description">
                                    <a href="single-product-details.html">
                                        <h6><?php echo $product_info[$i]['name']; ?></h6>
                                    </a>
                                    <p class="product-price"><span class="old-price">&#x20B9; <?php echo $product_info[$i]['price']; ?></span>&#x20B9; <?php echo $product_info[$i]['selling_price']; ?></p>
                                    <a href='<?php echo base_url('user/cart/add/'.aes256encrypt($product_info[$i]['product_id'])); ?>' class='btn btn-primary'>Add to Cart</a> 
                                </div>
                            </div>
                            <?php
                        }
                        $i++;
                    } ?>
                </div>
            </div>
        </div>
    </div>
</section>

