<section class="page-title-section bg-img cover-background">
    <div class="container">

        <div class="row">
            <div class="col-md-7">
                <h3>Product Details</h3>
            </div>
            <div class="col-md-5">
                <ul class="text-md-end text-start mt-2 mt-lg-0 ps-0">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="#!">Product Details</a></li>
                </ul>
            </div>
        </div>

    </div>
</section>



<section>
    <div class="container">
        <?php foreach ($productdetails as $product) { ?>

        <?php
        $price='';
        // Set price based on order type
        if ($ordertype == 'ws') {
            $price = $product['wholesale_price'];
        } elseif ($ordertype == 'rt') {
            $price = $product['retail_price'];
        } elseif ($ordertype == 'bb') {
            $price = $product['franchise_price'];
        }
        elseif ($ordertype == 'exp') {
            $price = $product['export_price'];
        }
        // else {
        //     $price = 0; // Default or fallback price
        // }
         ?>

        <!-- product section -->
        <div class="row mb-6 mb-md-7 mb-lg-9 product-item">
            <div class="col-lg-5 text-center text-lg-start mb-1-9 mb-lg-0 ">

                <!-- product left start -->
                <div class="xzoom-container">
                    <img class="xzoom5 mb-1-9" id="xzoom-magnific"
                        src="<?php echo base_url();?>uploads/product/<?php echo $product['image']; ?>"
                        xoriginal="<?php echo base_url();?>uploads/product/<?php echo $product['image']; ?>"
                        style="width: 100%;">
                    <div class="xzoom-thumbs m-0">


                        <?php if (!empty($product['image'])): ?>
                        <a href="<?php echo base_url('uploads/product/' . $product['image']); ?>">
                            <img class="xzoom-gallery5 xactive" width="80"
                                src="<?php echo base_url('uploads/product/' . $product['image']); ?>"
                                xpreview="<?php echo base_url('uploads/product/' . $product['image']); ?>"
                                title="The description goes here">
                        </a>
                        <?php endif; ?>


                        <?php if (!empty($product['image1'])): ?>
                        <a href="<?php echo base_url('uploads/product/' . $product['image1']); ?>">
                            <img class="xzoom-gallery5 xactive" width="80"
                                src="<?php echo base_url('uploads/product/' . $product['image1']); ?>"
                                xpreview="<?php echo base_url('uploads/product/' . $product['image1']); ?>"
                                title="The description goes here">
                        </a>
                        <?php endif; ?>

                        <?php if (!empty($product['image2'])): ?>
                        <a href="<?php echo base_url('uploads/product/' . $product['image2']); ?>">
                            <img class="xzoom-gallery5" width="80"
                                src="<?php echo base_url('uploads/product/' . $product['image2']); ?>"
                                title="The description goes here">
                        </a>
                        <?php endif; ?>

                        <?php if (!empty($product['image3'])): ?>
                        <a href="<?php echo base_url('uploads/product/' . $product['image3']); ?>">
                            <img class="xzoom-gallery5" width="80"
                                src="<?php echo base_url('uploads/product/' . $product['image3']); ?>"
                                title="The description goes here">
                        </a>
                        <?php endif; ?>
                    </div>

                    <!--<div class="xzoom-thumbs m-0">-->

                    <!--    <a href="<?php echo base_url();?>uploads/product/<?php echo $product['image1']; ?>"><img class="xzoom-gallery5 xactive" width="80" src="<?php echo base_url();?>uploads/product/<?php echo $product['image1']; ?>" xpreview="<?php echo base_url();?>uploads/product/<?php echo $product['image1']; ?>" title="The description goes here"></a>-->

                    <!--    <a href="<?php echo base_url();?>uploads/product/<?php echo $product['image2']; ?>"><img class="xzoom-gallery5" width="80" src="<?php echo base_url();?>uploads/product/<?php echo $product['image2']; ?>" title="The description goes here"></a>-->

                    <!--    <a href="<?php echo base_url();?>uploads/product/<?php echo $product['image3']; ?>"><img class="xzoom-gallery5" width="80" src="<?php echo base_url();?>uploads/product/<?php echo $product['image3']; ?>" title="The description goes here"></a>-->


                    <!--</div>-->
                </div>
                <!-- product left end -->

            </div>
            <div class="col-lg-7 ps-lg-2-7">
                <div class="product-detail portfolio-title">
                    <h3 class="mb-2"><?php echo $product['product_name']; ?></h3>
                    <div class="bg-primary separator-line-horrizontal-full mb-4"></div>
                    <!--<p class="rating-text display-30"><span>Sku:</span> <span><?php echo $product['product_id']; ?></span></p> -->
                    <p><?php echo $product['description']; ?></p>

                    <div class="mb-3 ">
                        <!-- <span class="me-3 display-26 font-weight-600 offer-price">$499.00</span> -->
                        <span class="display-26 font-weight-700 text-primary price-cart"
                            data-price="<?php echo $price; ?>">₹<?php echo  $price; ?></span>
                    </div>

                    <!-- <div class="row">
                                <div class="col-4 col-md-2">
                                    <label>Size:</label>

                                    <select class="mb-3 form-control form-select">
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                    </select>

                                </div>
                                <div class="col-6 col-lg-3 col-md-2">
                                    <div class="product-color">
                                        <label>Color:</label>
                                        <select class="mb-3 form-control form-select">
                                            <option value="Red">Red</option>
                                            <option value="Black">Black</option>
                                            <option value="Beige">Beige</option>
                                            <option value="White">White</option>
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                    <div class="row">
                        <div class="col-2 py-2 ">
                            <div class="d-flex align-items-center justify-content-between border border-1 rounded px-2 py-1 qty-area   w-100 w-md-auto"
                                id="none">
                                <button class="btn btn-sm btn-light decrement-btn"
                                    data-product-id="<?= $product['product_id']; ?>"
                                    style="background:#e3e3e3">−</button>
                                <?php
                                    $quantity = 1;
                                    foreach ($cart as $item) {
                                    if ($item['product_id'] == $product['product_id']) {
                                    $quantity = $item['quantity'];
                                    break;
                                     }
                                     }
                                    ?>

                                <span class="mx-2" data-qty><?= $quantity ?: 1; ?></span>
                                <button class="btn btn-sm btn-light increment-btn"
                                    data-product-id="<?= $product['product_id']; ?>"
                                    style="background:#e3e3e3">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <form method="post" id="add_cart_form" enctype="multipart/form-data">
                                <input type="hidden" id="cart_product_id" value="<?= $product['product_id']; ?>">
                                <input type="hidden" id="quantity" value="1" class="qty-input">
                                <input type="hidden" id="price" value="<?= $price; ?>" class="qty-price">
                                <input type="hidden" id="product_price" value="<?= $price; ?>">
                                <input type="hidden" id="product_weight" value="<?= $product['weight']; ?>">
                                <input type="hidden" id="product_kg_g" value="<?= $product['kg_g']; ?>">
                                <div class=" d-flex  gap-2 mt-2 product">
                                    <?php if ($product['out_of_stock'] == 1): ?>
                                    <button type="button"
                                        class="btn btn-sm out-of-stock  d-flex align-items-center gap-1" disabled>
                                        Out of Stock
                                    </button>
                                    <?php else: ?>
                                    <button type="submit" class="btn btn-sm d-flex align-items-center gap-1"
                                        title="Add to Cart" style="font-size: 14px;">
                                        <i class="fas fa-shopping-cart me-1"></i>
                                        Add to Cart
                                    </button>
                                    <?php endif; ?>
                                    <!-- <button type="submit" class="btn btn-sm d-flex align-items-center gap-1">
      <i class="fas fa-shopping-cart"></i> Add to Cart
    </button> -->
                                    <button type="button" id="wishlist_button"
                                        class="btn btn-sm d-flex align-items-center gap-1" style="font-size: 14px;">
                                        <i class="fas fa-heart"></i> Wishlist
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- end product section -->

        <!-- product description -->
        <div class="row mb-6 mb-lg-8 d-none">
            <div class="col-12">
                <div class="horizontaltab tab-style5" style="display: block; width: 100%; margin: 0px;">
                    <ul class="resp-tabs-list hor_1 text-start">
                        <li class="resp-tab-item hor_1 resp-tab-active" aria-controls="hor_1_tab_item-0" role="tab">
                            Description</li>
                        <!-- <li class="resp-tab-item hor_1" aria-controls="hor_1_tab_item-1" role="tab">Additional Info</li>
                                <li class="resp-tab-item hor_1" aria-controls="hor_1_tab_item-2" role="tab">Reviews (2)</li> -->
                    </ul>
                    <div class="resp-tabs-container hor_1">
                        <h2 class="resp-accordion hor_1 resp-tab-active" role="tab" aria-controls="hor_1_tab_item-0"
                            style="background: none;">
                            <span class="resp-arrow"></span>Description
                        </h2>
                        <div class="resp-tab-content hor_1 resp-tab-content-active" aria-labelledby="hor_1_tab_item-0"
                            style="display:block">
                            <p><?= $product['description']; ?></p>

                        </div>
                        <!-- <h2 class="resp-accordion hor_1" role="tab" aria-controls="hor_1_tab_item-1"><span class="resp-arrow"></span>Additional Info</h2><div class="resp-tab-content hor_1" aria-labelledby="hor_1_tab_item-1">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 mb-4 mb-lg-0">
                                            <ul class="list-style-5">
                                                <li><strong>Weight:</strong> 0.150 Kg</li>
                                                <li><strong>Dimensions:</strong> 90x60x90 Cm</li>
                                                <li><strong>Size:</strong> One Size Fits All</li>
                                                <li><strong>Color:</strong> Gray</li>
                                                <li><strong>Guarantee:</strong> 5 Years</li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6 ps-lg-1-9">
                                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto in ea voluptate velit.</p>
                                            <p class="m-0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto in ea voluptate velit.</p>
                                        </div>
                                    </div>

                                </div> -->

                    </div>
                </div>
            </div>
        </div>
        <!-- end product description -->

        <?php } ?>

    </div>
</section>