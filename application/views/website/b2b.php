<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B2B</title>
</head>

<body>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3 mt-5">
                <div id="accordion" class="accordion-style2 mb-0">
                    <?php foreach ($categories as $index => $category): 
    $catId = $category['category_id'];
    $collapseId = "collapseCat" . $catId;
    $headingId = "headingCat" . $catId;
  ?>
                    <div class="card">
                        <div class="card-header" id="<?php echo $headingId; ?>">
                            <h5 class="mb-0">
                                <button id="categoryid" class="btn btn-link  text-dark collapsed border border-none"
                                    data-bs-toggle="collapse" data-bs-target="#<?php echo $collapseId; ?>"
                                    aria-expanded="false" data-cat-id="<?php echo $catId; ?>"
                                    aria-controls="<?php echo $collapseId; ?>" data-cat-id="<?php echo $catId; ?>">
                                    <?php echo $category['category_name']; ?>
                                </button>
                            </h5>
                        </div>

                        <div id="<?php echo $collapseId; ?>" class="collapse"
                            aria-labelledby="<?php echo $headingId; ?>" data-bs-parent="#categoryAccordion">
                            <div class="card-body ps-3">
                                <ul class="list-style-5 mb-0">
                                    <?php foreach ($subcategories as $subcat): 
              if ($subcat['category_id'] == $catId): ?>
                                    <li><a href="#!" class="text-decoration-none text-dark " id="subcategoryid"
                                            data-cat-id="<?php echo $catId; ?>"
                                            data-subcat-id="<?php echo $subcat['id']; ?>"><?php echo $subcat['name']; ?></a>
                                    </li>
                                    <?php endif; endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>




                </div>
            </div>
            <!-- Left Sidebar Filters -->






            <div class="col-md-9">
                <!-- products -->
                <section class="bg-light-gray-new md section-border">
                    <div class="container">

                        <div class="section-heading title-style5">
                            <h3>Products</h3>
                            <div class="square">
                                <span class="separator-left bg-primary"></span>
                                <span class="separator-right bg-primary"></span>
                            </div>
                        </div>

                        <div class="row mt-n4" id="productContainer">
                            <?php foreach ($home as $product): ?>
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
                ?>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mt-4 product-item"
                                data-subcat-id="<?php echo $product['subcategory_id']; ?>">
                                <div class="service-box" data-src="img/7.jpg">
                                    <div class="project-grid-style2">
                                        <div class="project-details">
                                            <a href="<?php echo base_url('details/' . $product['product_id']); ?>">

                                                <img src="<?php echo base_url(); ?>uploads/product/<?php echo $product['image']; ?>"
                                                    alt="..." />
                                                <div class="portfolio-post-border"></div>
                                            </a>
                                            <!--<img src="<?php echo base_url();?>uploads/product/<?php echo $product['image']; ?>" alt="<?php echo $product['product_name']; ?>">-->
                                            <!--<div class="portfolio-post-border"></div>-->
                                        </div>
                                        <div class="portfolio-title text-center">
                                            <h4 class="portfolio-link"><a
                                                    href="<?php echo base_url('details/' . $product['product_id']); ?>"><?php echo $product['product_name']; ?></a>
                                            </h4>
                                            <p class="price-cart" data-price="<?=  $price; ?>">RS <?php echo  $price; ?>
                                            </p>

                                            <div class="d-flex align-items-center px-2 qty-area justify-content-center">
                                                <button class="btn btn-sm p-1 decrement-btn"
                                                    data-product-id="<?= $product['product_id']; ?>">−</button>
                                                <?php
                  $quantity = 1;
                  foreach ($cart as $item) {
                    if ($item['product_id'] == $product['product_id']) {
                      $quantity = $item['quantity'];
                      break;
                    }
                  }
              ?>
                                                <span data-qty><?= $quantity ?: 1; ?></span>
                                                <button class="btn btn-sm p-1 increment-btn"
                                                    data-product-id="<?= $product['product_id']; ?>">+</button>
                                            </div>

                                            <form method="post" id="add_cart_form" enctype="multipart/form-data">
                                                <input type="hidden" id="cart_product_id"
                                                    value="<?= $product['product_id']; ?>">
                                                <input type="hidden" id="quantity" value="1" class="qty-input">
                                                <input type="hidden" id="price" value="<?=  $price; ?>"
                                                    class="qty-price">
                                                <input type="hidden" id="product_price" value="<?=  $price; ?>">
                                                <input type="hidden" id="product_weight"
                                                    value="<?= $product['weight']; ?>">
                                                <input type="hidden" id="product_kg_g" value="<?= $product['kg_g']; ?>">
                                                <div class="d-flex justify-content-center gap-2 mt-2 product">
                                                    <?php if ($product['out_of_stock'] == 1): ?>
                                                    <button type="button"
                                                        class="btn btn-sm out-of-stock  d-flex align-items-center gap-1"
                                                        disabled>
                                                        Out of Stock
                                                    </button>
                                                    <?php else: ?>
                                                    <button type="submit"
                                                        class="btn btn-sm d-flex align-items-center gap-1"
                                                        title="Add to Cart">
                                                        <i class="fas fa-shopping-cart"></i> Add to Cart
                                                    </button>
                                                    <?php endif; ?>
                                                    <!-- <button type="submit" class="btn btn-sm d-flex align-items-center gap-1">
              <i class="fas fa-shopping-cart"></i> Add to Cart
            </button> -->
                                                    <button type="button" id="wishlist_button"
                                                        class="btn btn-sm d-flex align-items-center gap-1">
                                                        <i class="fas fa-heart"></i> Wishlist
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>

                            <!-- <div class="col-6 col-sm-6 col-md-6 col-lg-3 mt-4">
                        <div class="service-box" data-src="img/7.jpg">
                            <div class="project-grid-style2">
                                <div class="project-details">
                                    <img src="<?php echo base_url();?>assets/website/images/7.jpg" alt="...">
                                    <div class="portfolio-post-border"></div>
                                </div>
                                <div class="portfolio-title text-center">
                                    <h4 class="portfolio-link"><a href="#">Mirror</a></h4>
                                    <p>RS 2999</p>

                                     
    <div class="d-flex align-items-center border rounded px-2 qty-area">
        <button class="btn btn-sm p-1" onclick="decrementQuantity(this)">−</button>
        <span data-qty>1</span>
        <button class="btn btn-sm p-1" onclick="incrementQuantity(this)">+</button>
    </div>

                                    <div class="d-flex justify-content-center gap-2 mt-2 product">
                                        <button class="btn btn-sm   d-flex align-items-center gap-1" title="Add to Cart">
                                            <i class="fas fa-shopping-cart"></i> Add to Cart
                                        </button>
                                        <button class="btn btn-sm d-flex align-items-center gap-1" title="Add to Wishlist">
                                            <i class="fas fa-heart"></i> Wishlist
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->


                        </div>
                    </div>
                    <div class="container">
                        <div class="row justify-content-center mt-4">
                            <div class="col-auto">
                                <a href="<?php echo base_url(isset($product_id) ? 'product/' . $product_id : 'product'); ?>"
                                    class="butn"><span>More products</span></a>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>






</body>




</html>