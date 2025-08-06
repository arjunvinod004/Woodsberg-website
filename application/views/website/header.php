<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Woodsberg</title>
    <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/plugins1.css"> -->

    <!-- plugins -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/plugins1.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/plugins/magnifypopup.css">
    <link href="<?php echo base_url();?>assets/website/css/styles1.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/plugins/xzoom.css">

    <!-- revolution slider css -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/slider-settings.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/slider-layers.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/slider-navigation.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/lighbox.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/themefy-icons.css">

    <!-- <link rel="stylesheet" href="https://fabrex.websitelayout.net/css/plugins/lightgallery.css">  -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/website/css/search.css">





</head>

<body>
    <?php
// 1. Determine price based on order type
if ($ordertype == 'ws') {
    // $price = $product['wholesale_price'];
    $redirect_url = base_url('wholesale');
} elseif ($ordertype == 'rt') {
    // $price = $product['retail_price'];
    $redirect_url = base_url(); // Homepage or retail landing
} elseif ($ordertype == 'bb') {
    // $price = $product['franchise_price'];
    $redirect_url = base_url('b2b');
} elseif ($ordertype == 'exp') {
    // $price = $product['export_price'];
    $redirect_url = base_url('export');
}

else {
    // $price = $product['retail_price']; // default fallback
    $redirect_url = base_url();
}
?>

    <!-- <?php if ($ordertype == 'bb'): ?>
    <p>You're in B2B mode</p>
<?php elseif ($ordertype == 'ws'): ?>
    <p>You're in Wholesale mode</p>
<?php else: ?>
    <p>You're in Retail mode</p>
<?php endif; ?> -->
    <header class="header-style3">

        <div class="navbar-default">

            <!-- top search -->
            <div class="top-search bg-primary">
                <div class="container">
                    <form class="search-form" action="<?php echo base_url(); ?>website/product/search" method="get"
                        accept-charset="utf-8">
                        <div class="input-group">
                            <span class="input-group-addon close-search">
                                <i class="fas fa-times mt-1"></i>
                            </span>
                            <input type="text" class="search-form_input form-control" name="search" autocomplete="off"
                                placeholder="Search product....">
                            <!-- <span class="input-group-addon close-search"><i class="fas fa-times mt-1"></i></span> -->
                            <button class="search-form_submit fas fa-search text-white" type="submit"></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end top search -->
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="menu_area alt-font">
                            <nav class="navbar navbar-expand-lg navbar-light p-0">

                                <div class="navbar-header navbar-header-custom">
                                    <!-- logo -->
                                    <a href="<?php echo base_url();?>" class="navbar-brand logo6"><img id="logo"
                                            src="<?php echo base_url();?>assets/website/images/woodsberg1.png"
                                            alt="logo"></a>
                                    <!-- end logo -->
                                </div>

                                <div class="navbar-toggler"></div>

                                <!-- menu area -->
                                <ul class="navbar-nav ms-auto" id="nav" style="display: none;">
                                    <li><a href="<?php echo $redirect_url;?>">Home</a></li>
                                    <?php foreach ($headercategory as $category): ?>
                                    <li>
                                        <a
                                            href="<?php echo base_url('product/' . $category['category_id']); ?>"><?php echo $category['category_name']; ?></a>
                                        <?php
                                                    $hasSub = false;
                                                    foreach ($subcategories as $sub) 
                                                    {
                                                        if ($sub['category_id'] == $category['category_id']) 
                                                        {
                                                            $hasSub = true;
                                                            break;
                                                        }
                                                    }
                                                ?>


                                        <?php if ($hasSub): ?>
                                        <ul>
                                            <?php foreach ($subcategories as $sub): ?>
                                            <?php if ($sub['category_id'] == $category['category_id']): ?>
                                            <li><a
                                                    href="<?php echo base_url('product/' . $category['category_id'] . '/' . $sub['id']); ?>"><?= $sub['name']; ?></a>
                                            </li>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php endif; ?>
                                    </li>
                                    <?php endforeach; ?>
                                    <li><a href="<?php echo base_url();?>home/contact">Contact</a></li>
                                    <!-- <?php echo base_url();?>home/contact -->



                                </ul>
                                <!-- end menu area -->

                                <!-- atribute navigation -->
                                <div class="attr-nav">
                                    <ul>
                                        <li class="dropdown me-3 me-lg-0">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class="fas fa-shopping-cart"></i>
                                                <span class="badge bg-primary"></span>
                                            </a>
                                            <ul class="dropdown-menu cart-list" id="cart_item">

                                            </ul>
                                        </li>
                                        <li class="search" id="search"><a href="#!"><i class="fas fa-search"></i></a>
                                        </li>
                                        <li><a href="<?php echo base_url();?>cart/wishlist"> <i
                                                    class="fas fa-heart"></i>
                                                <span class="badges bg-primary"></span>
                                            </a></li>

                                    </ul>
                                </div>
                                <!-- end atribute navigation -->

                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>
    <div class="alert alert-success  alert-dismissible fade show  custom-alert d-none " role="alert"
        style="float: right;"></div>
</body>

</html>