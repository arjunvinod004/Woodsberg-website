 
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>footer</title>
 </head>
 <body>
    <footer class="bg-img background-size-contain" data-overlay-dark="9" data-background="">
            <div class="container">
                <div class="row mt-n1-9">

                    <div class="col-lg-4 col-md-6 mt-1-9">
                        <div class="pe-md-1-9 borders-bottom border-md-end border-md-bottom-0 border-color-light-white pb-1-9 pb-md-0 h-100">
                            <h3 class="footer-title-style7">Contact Us</h3>
                            <ul class="footer-list mb-0 ps-0">
                            <?php foreach ($store as $product) { ?>
                                

                                <li>
                                    <span class="d-inline-block vertical-align-top"><i class="fas fa-map-marker-alt text-primary"></i></span>
                                    <span class="d-inline-block w-85 vertical-align-top ps-2"><?php echo $product['store_address']; ?></span>
                                </li>
                                <li>
                                    <span class="d-inline-block vertical-align-top"><i class="fas fa-mobile-alt text-primary"></i></span>
                                    <span class="d-inline-block w-85 vertical-align-top ps-2"><?php echo $product['store_phone']; ?></span>
                                </li>
                                <li>
                                    <span class="d-inline-block vertical-align-top"><i class="far fa-envelope text-primary"></i></span>
                                    <span class="d-inline-block w-85 vertical-align-top ps-2"><?php echo $product['store_email']; ?></span>
                                </li>

                            <?php } ?>
                                <!-- <li>
                                    <span class="d-inline-block vertical-align-top"><i class="fas fa-globe text-primary"></i></span>
                                    <span class="d-inline-block w-85 vertical-align-top ps-2">www.woodsberg.com</span>
                                </li> -->
                            </ul>
                            <div class="footer-social-icons small mt-3">
                                <ul class="mb-0 ps-0">
                                    <li><a href="#!"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#!"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="#!"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-6 mt-1-9">
                        <div class="pe-md-1-9 borders-bottom border-md-end border-md-bottom-0 border-color-light-white pb-1-9 pb-md-0 h-100">
                        <div class="h-100">
                            <h3 class="footer-title-style7">About Us</h3>
                            <p class="mb-4">We believe each home, each family’s story, has never been easier to tell. From the perfect sofa for family movie nights or a new accent chair to freshen up a new reading space. Or maybe it’s a new mattress and bedroom set to get the good night of sleep you deserve</p>
                        </div>
                    </div>
                    </div>


                  <div class="col-lg-4 col-md-6 mt-1-9">
                      
                        <div class="h-100">
                            <h3 class="footer-title-style7">Quick Links</h3>
                            <ul class="footer-list mb-0 ps-0">
                            <?php foreach ($footercategory as $category) {?>
                                <li>
                                    <a href="<?php echo base_url('product/' . $category['category_id']); ?>"><?php echo $category['category_name'] ?></a>
                                </li>
                                <?php }?>
                        
                               
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="footer-bar  border-top border-color-light-white position-relative z-index-1">
                <div class="container">
                    <p class="mb-0">&copy; <span class="current-year"></span> WoodsBerg is Powered by <a href="https://www.coinoneglobal.com/" target="_blank" class="text-light-gray">Coinone</a></p>
                </div>
            </div>
        </footer>




        <div class="footer">
             <a href="<?php echo base_url(); ?>" title="Home"><i class="fas fa-home"></i> Home</a>
            <a href="<?php echo base_url(); ?>cart/wishlist" title="Wishlist"><i class="fas fa-heart"></i> Wishlist</a>
            <a href="<?php echo base_url(isset($product_id) ? 'product/' . $product_id : 'product'); ?>" title="Products"><i class="fas fa-plus"></i> Products</a>
            <a href="https://wa.me/9544942242" title="Chat"><i class="fa fa-comment"></i> Chat</a>
            <!-- <a href="#" title="Profile"><i class="fas fa-user"></i> Profile</a> -->
        </div>
 </body>
    <!-- SCROLL TO TOP
    ================================================== -->
    <a href="#!" class="scroll-to-top"><i class="fas fa-angle-up" aria-hidden="true"></i></a>
      <!-- whatsapp icon -->
    <a href="https://wa.me/9544942242" class="whatsapp-float" target="_blank">
        <img src="https://img.icons8.com/color/48/000000/whatsapp--v1.png" alt="WhatsApp Chat">
      </a>
      <!-- Whatsapp icon -->

    <!-- all js include start -->

    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/website/js/jquery.js"></script>

    <!-- popper js -->
    <script src="<?php echo base_url();?>assets/website/js/popper.js"></script>

    <!-- bootstrap -->
    <script src="<?php echo base_url();?>assets/website/js/bootstrap.min.js"></script>

    <!-- core.min.js -->
    <script src="<?php echo base_url();?>assets/website/js/core.min.js"></script>


    <!-- revolution slider js files start -->
    <script src="<?php echo base_url();?>assets/website/js/themepunch.tools.min.js"></script>
    <script src="<?php echo base_url();?>assets/website/js/themepunch.revolution.min.js"></script>
    <!-- <script src="<?php echo base_url();?>assets/website/js/revolution.extension.action.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/website/js/revolution.extension.carousel.min.js"></script> -->
    <script src="<?php echo base_url();?>assets/website/js/revolution.extension.layeranimation.min.js"></script>
    <script src="<?php echo base_url();?>assets/website/js/revolution.extension.navigation.min.js"></script>
    <script src="<?php echo base_url();?>assets/website/js/revolution.extension.parallax.min.js"></script>
    <script src="<?php echo base_url();?>assets/website/js/revolution.extension.slideanims.min.js"></script>
    
    <!-- theme core scripts -->
    <script src="<?php echo base_url();?>assets/website/js/main.js"></script>
    <script src="<?php echo base_url();?>assets/admin/js/adminscript.js"></script>
     <script src="<?php echo base_url();?>assets/website/js/xzoom.js"></script>
    <!-- <script src="<?php echo base_url();?>assets/website/js/hammer.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/website/js/plugins.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/website/js/script.js"></script> -->
    <script src="<?php echo base_url();?>assets/website/js/setup.js"></script>
 </html>
 
 
 
       
