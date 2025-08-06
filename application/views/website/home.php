<!DOCTYPE html>
<html lang="en">

<head>
    <!-- metas -->
    <meta charset="utf-8" />
    <meta name="author" content="Chitrakoot Web" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="keywords" content="Woodsberg - lorem ipsum" />
    <meta name="description" content="Woodsberg - lorem ipsum" />

    <!-- title  -->
    <title>Woodsberg</title>

</head>

<body>
    <!-- PAGE LOADING
    ================================================== -->
    <div id="preloader"></div>

    <!-- MAIN WRAPPER
    ================================================== -->
    <div class="main-wrapper">
        <div class="alert alert-success alert-dismissible fade show custom-alert d-none" role="alert">
            <!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> -->
        </div>

        <!-- REVOLUTION SLIDER
        ================================================== -->
        <div class="rev_slider_wrapper">
            <div class="rev_slider" id="rev_slider_4" data-version="5.4.5">
                <ul>
                    <!-- slide 1 -->

                    <?php foreach ($slider as $product) { ?>

                    <li data-fstransition="fade" data-transition="scaledownfrombottom" data-easein="default"
                        data-easeout="default" data-slotamount="1" data-masterspeed="1200" data-delay="8000"
                        data-title="Interior Design">
                        <!-- overlay -->
                        <div class="opacity-light bg-black z-index-1"></div>

                        <!-- main image -->
                        <img src="<?php echo base_url();?>uploads/slider/<?php echo $product['image']; ?>" alt="..."
                            data-bgrepeat="no-repeat" data-bgfit="cover" data-bgparallax="7" class="rev-slidebg" />

                        <!-- hero subtitle -->
                        <div class="tp-caption small-text text-white slider-text text-uppercase font-weight-300"
                            data-x="30" data-y="center" data-voffset="[-102,-88,-98,-128]" data-fontsize="[21,21,21,21]"
                            data-lineheight="34" data-width="[600, 500, 400, 300]"
                            data-whitespace="[nowrap, nowrap, nowrap, normal]" data-frames='[{
                                    "delay":1000,
                                    "speed":900,
                                    "frame":"0",
                                    "from":"y:150px;opacity:0;",
                                    "ease":"Power3.easeOut",
                                    "to":"o:1;"
                                    },{
                                    "delay":"wait",
                                    "speed":1000,
                                    "frame":"999",
                                    "to":"opacity:0;","ease":"Power3.easeOut"
                                }]'>
                            <p class="white-space"><?php echo $product['title']; ?></p>
                        </div>

                        <!-- hero title -->
                        <div class="tp-caption hero-text text-white alt-font font-weight-300 text-uppercase" data-x="30"
                            data-y="center" data-voffset="[-28,-10,-20,-40]" data-fontsize="[72,62,52,46]"
                            data-lineheight="[72,62,52,46]" data-width="[none, none, none, 300]"
                            data-whitespace="[nowrap, nowrap, nowrap, normal]" data-frames='[{
                                    "delay":1100,
                                    "speed":900,
                                    "frame":"0",
                                    "from":"y:150px;opacity:0;",
                                    "ease":"Power3.easeOut",
                                    "to":"o:1;"
                                    },{
                                    "delay":"wait",
                                    "speed":1000,
                                    "frame":"999",
                                    "to":"opacity:0;","ease":"Power3.easeOut"
                                }]' data-splitout="none">

                            <?php echo $product['description']; ?>

                        </div>

                        <!-- button -->
                        <div class="tp-caption" data-x="30" data-y="center" data-voffset="[64,100,85,94]"
                            data-lineheight="55" data-hoffset="0" data-frames='[{
                                        "delay":1200,
                                        "speed":900,
                                        "frame":"0",
                                        "from":"y:150px;opacity:0;",
                                        "ease":"Power3.easeOut",
                                        "to":"o:1;"
                                        },{
                                        "delay":"wait",
                                        "speed":1000,
                                        "frame":"999",
                                        "to":"opacity:0;","ease":"Power3.easeOut"
                                    }]'>
                            <a href="<?php echo base_url(isset($product_id) ? 'product/' . $product_id : 'product'); ?>"
                                class="btn-style2 white">
                                <span>Shop</span>
                            </a>
                        </div>
                    </li>

                    <?php } ?>
                    <!-- end slide 1 -->


                </ul>
            </div>
        </div>


        <!-- Categories -->
        <section class="md section-border">
            <div class="container">
                <div class="section-heading">
                    <!-- <h2>Categories</h2> -->
                </div>
                <div class="owl-carousel owl-theme" id="services-carousel2">
                    <?php  for ($i = 0; $i < count($categories); $i += 2) 
{
echo '<div class="service-box">'; for ($j = $i; $j < $i + 2 && $j <
 count($categories); $j++) { ?>
                    <div class="project-grid-style2 text-center">
                        <div class="project-details card-img">
                            <img src="<?php echo base_url();?>uploads/categories/<?php echo $categories[$j]['category_img']; ?> "
                                width="200px" height="200px" alt=" ..." />
                            <div class="portfolio-icon">
                                <form method="post" action="<?php echo base_url('home/category'); ?>">
                                    <input type="hidden" name="category_id"
                                        value="<?php echo $categories[$j]['category_id']; ?>" />
                                    <a href="#" class="position-absolute start-50 top-50 translate-middle">
                                        <button type="submit"
                                            class="butn small position-absolute start-50 top-50 translate-middle">
                                            <?php echo $categories[$j]['category_name']; ?>
                                        </button>
                                    </a>
                                </form>
                            </div>
                            <div class="portfolio-post-border"></div>
                        </div>
                        <h6 class="mt-3">
                            <?php echo $categories[$j]['category_name']; ?>
                        </h6>
                    </div>
                    <?php
    }

    echo '</div>'; } ?>
                </div>
            </div>
        </section>

        <!--Categories-->

        <!-- products -->
        <section class="md section-border">
            <div class="container">
                <div class="section-heading">
                    <h2>Products</h2>
                </div>
                <div class="owl-carousel owl-theme" id="featured-product-carousel">
                    <?php
for ($i = 0; $i < count($home); $i += 2) {
    echo '<div class="service-box product-item ">';
    
    for ($j = $i; $j < $i + 2 && $j < count($home); $j++) {
        $product = $home[$j];

        // Set dynamic price
        if ($ordertype == 'ws') {
            $price = $product['wholesale_price'];
        } elseif ($ordertype == 'rt') {
            $price = $product['retail_price'];
        } elseif ($ordertype == 'bb') {
            $price = $product['franchise_price'];
        }

        $final_price = $price;
      $seasonal_percentage = '';
    if ($ordertype == 'rt' && !empty($product['seasonal_percentage'])) {
    $seasonal_percentage = $product['seasonal_percentage'];
    $discount = ($price * $seasonal_percentage) / 100;
    $final_price = $price - $discount;
    
}



                    // $seasonal_percentage = $product['seasonal_percentage'];
                    // $final_price = $price;

                    // if ($seasonal_percentage) {
                    // $discount = ($price * $seasonal_percentage) / 100;
                    // $final_price = $price - $discount;
                    // }

                    // Get quantity from cart
                    $quantity = 1;
                    foreach ($cart as $item) {
                    if ($item['product_id'] == $product['product_id']) {
                    $quantity = $item['quantity'];
                    break;
                    }
                    }
                    ?>


                    <div class="project-grid-style2">
                        <div class="project-details card-img">
                            <?php
  $isBestseller = false;
  foreach ($bestseller as $bs) {
    if ($bs['product_id'] == $product['product_id']) {
      $isBestseller = true;
      break;
    }
  }
?>
                            <a href="<?php echo base_url('details/' . $product['product_id']); ?>">
                                <?php if ($isBestseller): ?>
                                <div class="label-offer bg-primary">Best Seller</div>
                                <?php endif; ?>

                                <img src="<?php echo base_url(); ?>uploads/product/<?php echo $product['image']; ?>"
                                    alt="..." width="300px" height="300px" />
                            </a>
                            <a href="<?php echo base_url('details/' . $product['product_id']); ?>">
                                <div class="portfolio-post-border"></div>
                            </a>
                        </div>
                        <div class="portfolio-title text-center">
                            <h4 class="portfolio-link"><a data-id="<?= $product['product_id']; ?>"
                                    href="<?php echo base_url('details/' . $product['product_id']); ?>"
                                    data-id="<?= $product['product_id']; ?>"><?php echo $product['product_name']; ?></a>
                            </h4>

                            <p class="price-cart" data-price="<?= $final_price; ?>">
                                RS <?= $final_price ?>
                                <?php if ($seasonal_percentage) : ?>
                                <span class=" text-decoration-line-through ms-2" style="font-size: 14px;">
                                    RS <?=$price; ?>
                                </span>

                                <?php endif; ?>
                            </p>




                            <div class="d-flex align-items-center  px-2 qty-area justify-content-center">
                                <button class="btn btn-sm p-1 decrement-btn"
                                    data-product-id="<?= $product['product_id']; ?>">
                                    −
                                </button>
                                <span data-qty><?= $quantity ?></span>
                                <button class="btn btn-sm p-1 increment-btn"
                                    data-product-id="<?= $product['product_id']; ?>">
                                    +
                                </button>
                            </div>

                            <form method="post" class="mt-2" id="add_cart_form" enctype="multipart/form-data">
                                <input type="hidden" id="cart_product_id" value="<?= $product['product_id']; ?>">
                                <input type="hidden" id="quantity" value="1" class="qty-input">
                                <input type="hidden" id="price"
                                    value="<?= isset($final_price) ? $final_price : $price; ?>" class="qty-price" />
                                <input type="hidden" id="product_price"
                                    value="<?= isset($final_price) ? $final_price : $price; ?>" />

                                <!-- <input type="hidden" id="product_stock" value="<?= $product['stock']; ?>"> -->
                                <input type="hidden" id="product_weight" value="<?= $product['weight']; ?>">
                                <input type="hidden" id="product_kg_g" value="<?= $product['kg_g']; ?>">
                                <div class="d-flex justify-content-center gap-2 mt-2 product">
                                    <?php if ($product['out_of_stock'] == 1): ?>
                                    <button type="button"
                                        class="btn btn-sm out-of-stock d-flex align-items-center gap-1" disabled>
                                        <i class="fas fa-times-circle"></i> Out of Stock
                                    </button>
                                    <?php else: ?>
                                    <button type="submit" class="btn btn-sm d-flex align-items-center gap-1">
                                        <i class="fas fa-shopping-cart"></i> Add to Cart
                                    </button>
                                    <?php endif; ?>

                                    <button type="button" class="btn btn-sm d-flex align-items-center gap-1 "
                                        id="wishlist_button">
                                        <i class="fas fa-heart"></i> Wishlist
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php
    }

    echo '</div>';
}
?>

                </div>
            </div>
        </section>

        <!--products-->



        <!--Best seller Products
        ================================================== -->
        <section class="md section-border">
            <div class="container">
                <div class="section-heading">
                    <h2>Best sellers</h2>
                </div>
                <div class="owl-carousel owl-theme product-item" id="services-carousel">
                    <?php foreach ($bestseller as $product) { ?>
                    <?php
                          // Set price based on order type
if ($ordertype == 'ws') 
{
   $price = $product['wholesale_price'];
 } 
elseif ($ordertype == 'rt') 
{
 $price = $product['retail_price'];
} 
elseif ($ordertype == 'bb') 
{
 $price = $product['franchise_price'];
 } 
 $final_price = $price;
 
 $seasonal_percentage = '';
if ($ordertype == 'rt' && !empty($product['seasonal_percentage'])) 
{
    $seasonal_percentage = $product['seasonal_percentage'];
    $discount = ($price * $seasonal_percentage) / 100;
    $final_price = $price - $discount;
}
     
?>
                    <div class="service-box"
                        data-src="<?php echo base_url();?>uploads/product/<?php echo $product['image']; ?>">
                        <div class="project-grid-style2">
                            <div class="project-details card-img">
                                <img src="<?php echo base_url();?>uploads/product/<?php echo $product['image']; ?>"
                                    alt="..." width="300px" height="300px" />
                                <a href="<?php echo base_url('details/' . $product['product_id']); ?>">
                                    <div class="portfolio-post-border"></div>
                                </a>
                            </div>
                            <div class="portfolio-title text-center">
                                <h4 class="portfolio-link">
                                    <a data-id="<?= $product['product_id']; ?>"
                                        href="<?php echo base_url('home/productpage/' . $product['product_id'])?>"><?php echo $product['product_name']; ?></a>
                                </h4>

                                <p class="price-cart" data-price="<?= $final_price; ?>">
                                    RS <?= $final_price ?>
                                    <?php if ( $ordertype == 'rt' && $seasonal_percentage) : ?>
                                    <span class=" text-decoration-line-through ms-2" style="font-size: 14px;">
                                        RS <?=$price; ?>
                                    </span>
                                    <!-- <span class="badge bg-success ms-2"><?= $seasonal_percentage; ?>%</span> -->
                                    <?php endif; ?>
                                </p>

                                <!-- <p class="price-cart" data-price="<?=  $price ?>">
                    RS
                    <?php echo $price ?>
                  </p> -->

                                <!-- Quantity Selector -->
                                <div class="d-flex align-items-center  px-2 qty-area justify-content-center">
                                    <button class="btn btn-sm p-1 decrement-btn" min-value="1"
                                        data-product-id="<?= $product['product_id']; ?>">
                                        −
                                    </button>
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
                                        data-product-id="<?= $product['product_id']; ?>">
                                        +
                                    </button>
                                </div>

                                <!-- Add to Cart and Wishlist ICON + TEXT BUTTONS -->
                                <form method="post" id="add_cart_form" enctype="multipart/form-data">
                                    <input type="hidden" id="cart_product_id" value="<?= $product['product_id']; ?>" />
                                    <input type="hidden" id="quantity" value="1" class="qty-input" />

                                    <input type="hidden" id="price"
                                        value="<?= isset($final_price) ? $final_price : $price; ?>" class="qty-price" />
                                    <input type="hidden" id="product_price"
                                        value="<?= isset($final_price) ? $final_price : $price; ?>" />
                                    <!-- <input
                      type="hidden"
                      id="price"
                      value="<?=  $price; ?>"
                      class="qty-price"
                    />
                    <input
                      type="hidden"
                      id="product_price"
                      value="<?=  $price; ?>"
                    /> -->
                                    <!-- <input type="hidden" id="product_stock" value="<?= $product['stock']; ?>"> -->
                                    <input type="hidden" id="product_weight" value="<?= $product['weight']; ?>" />
                                    <input type="hidden" id="product_kg_g" value="<?= $product['kg_g']; ?>" />
                                    <div class="d-flex justify-content-center gap-2 mt-2 product">
                                        <?php if ($product['out_of_stock'] == 1): ?>
                                        <button type="button"
                                            class="btn btn-sm out-of-stock d-flex align-items-center gap-1" disabled>
                                            <i class="fas fa-times-circle"></i> Out of Stock
                                        </button>
                                        <?php else: ?>
                                        <button type="submit" class="btn btn-sm d-flex align-items-center gap-1"
                                            title="Add to Cart">
                                            <i class="fas fa-shopping-cart"></i> Add to Cart
                                        </button>
                                        <?php endif; ?>
                                        <!-- <button type="submit" class="btn btn-sm d-flex align-items-center gap-1">
      <i class="fas fa-shopping-cart"></i> Add to Cart
    </button> -->
                                        <button type="button" class="btn btn-sm d-flex align-items-center gap-1"
                                            id="wishlist_button">
                                            <i class="fas fa-heart"></i> Wishlist
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <!--Best seller Products-->

        <!--Offer Products
        ================================================== -->
        <section class="md section-border">
            <div class="container">
                <div class="section-heading">
                    <h2>Seasonal Offers</h2>
                </div>



                <div class="owl-carousel owl-theme product-item" id="services-carousel1">
                    <?php foreach ($seasonaloffer as $product) { ?>
                    <?php
                          // Set price based on order type
                            if ($ordertype == 'ws') {
                                $price = $product['wholesale_price'];
                            } elseif ($ordertype == 'rt') {
                                $price = $product['retail_price'];
                            } elseif ($ordertype == 'bb') {
                                $price = $product['franchise_price'];
                            } 

                            $final_price = $price;
                            $seasonal_percentage = '';
                            if ($ordertype == 'rt' && !empty($product['seasonal_percentage'])) {
    $seasonal_percentage = $product['seasonal_percentage'];
    $discount = ($price * $seasonal_percentage) / 100;
    $final_price = $price - $discount;
}



// $seasonal_percentage = $product['seasonal_percentage'];
// $final_price = $price;

// if ($seasonal_percentage) {
//     $discount = ($price * $seasonal_percentage) / 100;
//     $final_price = $price - $discount;
// }
                           ?>

                    <div class="service-box"
                        data-src="<?php echo base_url();?>uploads/product/<?php echo $product['image']; ?>">
                        <div class="project-grid-style2">
                            <div class="project-details card-img">
                                <img src="<?php echo base_url();?>uploads/product/<?php echo $product['image']; ?>"
                                    alt="..." width="300px" height="300px" />
                                <a href="<?php echo base_url('home/productpage/' . $product['product_id'])?>">
                                    <div class="portfolio-post-border"></div>
                                </a>
                            </div>
                            <div class="portfolio-title text-center">
                                <h4 class="portfolio-link">
                                    <a data-id="<?= $product['product_id']; ?>"
                                        href="<?php echo base_url('home/productpage/' . $product['product_id'])?>"><?php echo $product['product_name']; ?></a>
                                </h4>


                                <p class="price-cart" data-price="<?= $final_price; ?>">
                                    RS <?= $final_price ?>
                                    <?php if ($ordertype == 'rt' && !empty($seasonal_percentage)) : ?>
                                    <span class=" text-decoration-line-through ms-2" style="font-size: 14px;">
                                        RS <?=$price; ?>
                                    </span>
                                    <!-- <span class="badge bg-success ms-2"><?= $seasonal_percentage; ?>%</span> -->
                                    <?php endif; ?>
                                </p>


                                <!-- Quantity Selector -->
                                <div class="d-flex align-items-center  px-2 qty-area justify-content-center">
                                    <button class="btn btn-sm p-1 decrement-btn"
                                        data-product-id="<?= $product['product_id']; ?>">
                                        −
                                    </button>
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
                                        data-product-id="<?= $product['product_id']; ?>">
                                        +
                                    </button>
                                </div>

                                <!-- Add to Cart and Wishlist ICON + TEXT BUTTONS -->
                                <form method="post" id="add_cart_form" enctype="multipart/form-data">
                                    <input type="hidden" id="cart_product_id" value="<?= $product['product_id']; ?>" />
                                    <input type="hidden" id="quantity" value="1" class="qty-input" />
                                    <input type="hidden" id="price"
                                        value="<?= isset($final_price) ? $final_price : $price; ?>" class="qty-price" />
                                    <input type="hidden" id="product_price"
                                        value="<?= isset($final_price) ? $final_price : $price; ?>" />
                                    <!-- <input type="hidden" id="product_stock" value="<?= $product['stock']; ?>"> -->
                                    <input type="hidden" id="product_weight" value="<?= $product['weight']; ?>" />
                                    <input type="hidden" id="product_kg_g" value="<?= $product['kg_g']; ?>" />

                                    <input type="hidden" id="product_token"
                                        value="<?= $product['seasonal_percentage']; ?>">
                                    <div class="d-flex justify-content-center gap-2 mt-2 product">
                                        <?php if ($product['out_of_stock'] == 1): ?>
                                        <button type="button"
                                            class="btn btn-sm out-of-stock d-flex align-items-center gap-1" disabled>
                                            <i class="fas fa-times-circle"></i> Out of Stock
                                        </button>
                                        <?php else: ?>
                                        <button type="submit" class="btn btn-sm d-flex align-items-center gap-1"
                                            title="Add to Cart">
                                            <i class="fas fa-shopping-cart"></i>
                                            Add to Cart
                                        </button>
                                        <?php endif; ?>
                                        <!-- <button type="submit" class="btn btn-sm d-flex align-items-center gap-1">
                             <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button> -->
                                        <button type="button" class="btn btn-sm d-flex align-items-center gap-1"
                                            id="wishlist_button">
                                            <i class="fas fa-heart"></i> Wishlist
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <!--Offer Products-->

        <!-- TESTIMONIAL
        ================================================== -->
        <section class="parallax md" data-overlay-dark="8" data-background="">
            <div class="container">
                <div class="section-heading title-style5">
                    <h3>Happy Customers</h3>
                    <div class="square">
                        <span class="separator-left bg-primary"></span>
                        <span class="separator-right bg-primary"></span>
                    </div>
                </div>

                <div class="owl-carousel owl-theme testimonial-style3">
                    <?php foreach ($testimonial as $product) { ?>
                    <div class="mx-auto">
                        <div class="testimonial-item">
                            <div class="testimonial-review">
                                <p class="font-weight-500">
                                    <?php echo $product['description']; ?>
                                </p>
                            </div>
                            <div class="testimonial-left-col">
                                <div class="testimonial-pic">
                                    <div class="testimonial-separator"></div>
                                    <img src="<?php echo base_url();?>uploads/testimonial/<?php echo $product['image']; ?>"
                                        alt="..." />
                                </div>

                                <div class="client-info">
                                    <h6><?php echo $product['name']; ?></h6>
                                    <span><?php echo $product['position']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>




</body>

<!-- modal for out of stock -->

<div class="modal fade" id="stockModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-md" style="margin-top:88px">

        <div class="modal-content">

            <div class="modal-header">

                <h1 class="modal-title fs-5" id="exampleModalLabel">Out of Stock</h1>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">

                <!-- if response within jquery -->



            </div>

            <div class="modal-footer">



            </div>



            </form>

        </div>

    </div>

</div>

<script>
// Handle button clicks


// Optional: Pause on hover
const carousel = document.getElementById('heroSlider');
carousel.addEventListener('mouseenter', function() {
    bootstrap.Carousel.getInstance(carousel).pause();
});

carousel.addEventListener('mouseleave', function() {
    bootstrap.Carousel.getInstance(carousel).cycle();
});
</script>

<!-- modal for out of stock -->

</html>