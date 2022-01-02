
<div id="main-wrapper">
<div class="site-wrapper-reveal">
    <div class="hero-box-area">
        <div class="container">
            <div class="row ">
                <div class="col-lg-12">

                    <!-- Hero Slider Area Start -->
                    <div class="hero-area hero-slider-7">
                        <?php foreach( $random_products as $key => $row ) : ?>
                            <div class="single-hero-slider-7">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="hero-content-wrap">
                                                <div class="hero-text-7 mt-lg-5">
                                                    <h6 class="mb-20">
                                                        <?php echo $company_name?>
                                                    </h6>
                                                    <div class="col-md-8">
                                                        <h3><?php echo $row['name']?></h3>
                                                    </div>
                                                    <div class="button-box section-space--mt_60">
                                                        <a href="<?php echo base_url('productPublic/show/'.$row['id'])?>" class="text-btn-normal font-weight--reguler font-lg-p">Discover now</a>
                                                    </div>
                                                </div>
                                                <div class="inner-images">
                                                    <div class="image-one">
                                                        <img src="<?php echo base_url($row['image'])?>" width="443" height="244" class="img-fluid" 
                                                        alt="Image">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach?>
                    </div>
                    <!-- Hero Slider Area End -->

                </div>
            </div>
        </div>
    </div>

    <div class="about-us-area section-space--ptb_120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-us-content_6 text-center">
                        <h2><?php echo $company_name?></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Banner Video Area Start -->
   <!--  <div class="banner-video-area overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-video-box">
                        <img src="assets/images/bg/video-banner2.webp" alt="">
                        <div class="video-icon">
                            <a href="https://www.youtube.com/watch?v=fkoEj95puX0" class="popup-youtube"><i class="linear-ic-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Banner Video Area End -->

    <!-- Product Area Start -->
    <div class="product-wrapper section-space--ptb_120">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="section-title text-lg-start text-center mb-20">
                        <h3 class="section-title">Popular Products</h3>
                    </div>
                </div>
            </div>

            <div class="tab-content mt-30">
                <div class="tab-pane fade show active" id="tab_list_01">
                    <!-- product-slider-active -->
                    <div class="row">
                        <?php foreach( $random_products as $key => $row) :?>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <!-- Single Product Item Start -->
                                <div class="single-product-item text-center">
                                    <div class="products-images">
                                        <a href="<?php echo base_url('productPublic/show/'.$row['id'])?>" class="product-thumbnail">
                                            <img src="<?php echo base_url($row['image'])?>" class="img-fluid" alt="Product Images" width="300" height="300">
                                            <?php if($row['stock_quantity'] >= $row['min_stock']) :?>
                                              <span class="ribbon onsale ">
                                                Available: <?php echo $row['stock_quantity']?>
                                               </span>
                                              <div class="available_bar"><span style="width:17%"></span></div>
                                            <?php else:?>
                                             <span class="ribbon out-of-stock ">
                                                Out Of Stock
                                             </span>
                                            <?php endif?>
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h6 class="prodect-title"><a href="<?php echo base_url('productPublic/show/'.$row['id'])?>"><?php echo $row['name']?></a></h6>
                                        <div class="prodect-price">
                                            <span class="new-price">PHP <?php echo $row['price']?></span> 
                                        </div>
                                    </div>
                                </div><!-- Single Product Item End -->
                            </div>
                        <?php endforeach?>
                    </div>
                </div>
                <div class="tab-pane" id="tab_list_02">
                    <div class="row ">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_1-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                        <span class="ribbon out-of-stock ">
                                    Out Of Stock
                                </span>
                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Teapot with black tea</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£40.00</span> - <span class="old-price"> £635.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_9-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Teapot with black tea</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£20.00</span> - <span class="old-price"> £135.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab_list_03">
                    <div class="row ">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_2-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Simple Chair</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£40.00</span> - <span class="old-price"> £45.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/10-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Gray nancy chair</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£70.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/11-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Wooden chair</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£80.00</span> - <span class="old-price"> £195.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab_list_04">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_1-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                        <span class="ribbon out-of-stock ">
                                    Out Of Stock
                                </span>
                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Teapot with black tea</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£40.00</span> - <span class="old-price"> £635.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_2-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Simple Chair</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£70.00</span> - <span class="old-price"> £95.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_3-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Smooth Disk</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£46.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_4-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                        <span class="ribbon onsale">
                                -14%
                                </span>
                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Wooden Flowerpot</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£40.00</span> - <span class="old-price"> £635.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_5-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Living room & Bedroom lights</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£60.00</span> - <span class="old-price"> £69.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_6-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Gray lamp</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£80.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_7-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Decoration wood</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£50.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_8-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Teapot with black tea</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£20.00</span> - <span class="old-price"> £135.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade" id="tab_list_05">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_3-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Smooth Disk</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£46.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>


                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_6-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Gray lamp</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£80.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_7-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Decoration wood</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£50.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_8-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Teapot with black tea</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£20.00</span> - <span class="old-price"> £135.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab_list_08">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_7-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Decoration wood</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£50.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_8-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Teapot with black tea</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£20.00</span> - <span class="old-price"> £135.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_4-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                        <span class="ribbon onsale">
                                -14%
                                </span>
                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Wooden Flowerpot</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£40.00</span> - <span class="old-price"> £635.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Product Item Start -->
                            <div class="single-product-item text-center">
                                <div class="products-images">
                                    <a href="product-details.html" class="product-thumbnail">
                                        <img src="assets/images/product/1_5-300x300.webp" class="img-fluid" alt="Product Images" width="300" height="300">

                                    </a>
                                    <div class="product-actions">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#prodect-modal"><i class="p-icon icon-plus"></i><span class="tool-tip">Quick View</span></a>
                                        <a href="product-details.html"><i class="p-icon icon-bag2"></i> <span class="tool-tip">Add to cart</span></a>
                                        <a href="wishlist.html"><i class="p-icon icon-heart"></i> <span class="tool-tip">Browse Wishlist</span></a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h6 class="prodect-title"><a href="product-details.html">Living room & Bedroom lights</a></h6>
                                    <div class="prodect-price">
                                        <span class="new-price">£60.00</span> - <span class="old-price"> £69.00</span>
                                    </div>
                                </div>
                            </div><!-- Single Product Item End -->
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- Product Area End -->
<!--====================  footer area ====================-->
<div class="footer-area-wrapper bg-white">
    
    <div class="footer-copyright-area border-top section-space--ptb_30">
        <div class="container-fluid container-fluid--cp-100">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 order-md-1 order-2">
                    <span class="copyright-text text-center text-md-start">&copy; <?php echo date('Y') . ' '.$company_name ?>. <a  href="#" target="_blank">All Rights Reserved.</a></span>

                </div>

                <div class="col-lg-6 col-md-6 order-md-2 order-1">
                    <div class="footer-bottom-social">
                        <h6 class="title">Follow Us On Social</h6>
                        <ul class="list footer-social-networks ">
                            <li class="item">
                                <a href="https://twitter.com" target="_blank" aria-label="Twitter">
                                    <i class="social social_facebook"></i>
                                </a>
                            </li>
                            <li class="item">
                                <a href="https://facebook.com" target="_blank" aria-label="Facebook">
                                    <i class="social social_twitter"></i>
                                </a>
                            </li>
                            <li class="item">
                                <a href="https://instagram.com" target="_blank" aria-label="Instagram">
                                    <i class="social social_tumblr"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--====================  End of footer area  ====================-->










</div>
</div>




<!-- Modal -->
<div class="product-modal-box modal fade" id="prodect-modal" tabindex="-1" role="dialog">
<div class="modal-dialog  modal-dialog-centered" role="document">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span class="icon-cross" aria-hidden="true"></span></button>
    </div>
    <div class="modal-body container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="quickview-product-active mr-lg-5">
                    <a href="#" class="images">
                        <img src="assets/images/product/2-570x570.webp" class="img-fluid" alt="">
                    </a>
                    <a href="#" class="images">
                        <img src="assets/images/product/3-600x600.webp" class="img-fluid" alt="">
                    </a>
                    <a href="#" class="images">
                        <img src="assets/images/product/4-768x768.webp" class="img-fluid" alt="">
                    </a>
                </div>
                <!-- Thumbnail Large Image End -->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="product-details-content quickview-content-wrap ">

                    <h5 class="font-weight--reguler mb-10">Teapot with black tea</h5>
                    <div class="quickview-ratting-review mb-10">
                        <div class="quickview-ratting-wrap">
                            <div class="quickview-ratting">
                                <i class="yellow icon_star"></i>
                                <i class="yellow icon_star"></i>
                                <i class="yellow icon_star"></i>
                                <i class="yellow icon_star"></i>
                                <i class="yellow icon_star"></i>
                            </div>
                            <a href="#"> 2 customer review</a>
                        </div>
                    </div>
                    <h3 class="price">£59.99</h3>

                    <div class="stock in-stock mt-10">
                        <p>Available: <span>In stock</span></p>
                    </div>

                    <div class="quickview-peragraph mt-10">
                        <p>At vero accusamus et iusto odio dignissimos blanditiis praesentiums dolores molest.</p>
                    </div>


                    <div class="quickview-action-wrap mt-30">
                        <div class="quickview-cart-box">
                            <div class="quickview-quality">
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" type="text" name="qtybutton" value="0">
                                </div>
                            </div>

                            <div class="quickview-button">
                                <div class="quickview-cart button">
                                    <a href="product-details.html" class="btn--lg btn--black font-weight--reguler text-white">Add to cart</a>
                                </div>
                                <div class="quickview-wishlist button">
                                    <a title="Add to wishlist" href="#"><i class="icon-heart"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="product_meta mt-30">
                        <div class="sku_wrapper item_meta">
                            <span class="label"> SKU: </span>
                            <span class="sku"> 502 </span>
                        </div>
                        <div class="posted_in item_meta">
                            <span class="label">Categories: </span><a href="#">Furniture</a>, <a href="#">Table</a>
                        </div>
                        <div class="tagged_as item_meta">
                            <span class="label">Tag: </span><a href="#">Pottery</a>
                        </div>
                    </div>

                    <div class="product_socials section-space--mt_60">
                        <span class="label">Share this items :</span>
                        <ul class="helendo-social-share socials-inline">
                            <li>
                                <a class="share-twitter helendo-twitter" href="#" target="_blank"><i class="social_twitter"></i></a>
                            </li>
                            <li>
                                <a class="share-facebook helendo-facebook" href="#" target="_blank"><i class="social_facebook"></i></a>
                            </li>
                            <li>
                                <a class="share-google-plus helendo-google-plus" href="#" target="_blank"><i class="social_googleplus"></i></a>
                            </li>
                            <li>
                                <a class="share-pinterest helendo-pinterest" href="#" target="_blank"><i class="social_pinterest"></i></a>
                            </li>
                            <li>
                                <a class="share-linkedin helendo-linkedin" href="#" target="_blank"><i class="social_linkedin"></i></a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- Modal end -->

<!-- Modal -->
<div class="header-login-register-wrapper modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
    <div class="modal-box-wrapper">
        <div class="helendo-tabs">
            <ul class="nav" role="tablist">
                <li class="tab__item nav-item active">
                    <a class="nav-link active" data-bs-toggle="tab" href="#tab_list_06" role="tab">Login</a>
                </li>
                <li class="tab__item nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab_list_07" role="tab">Our Register</a>
                </li>

            </ul>
        </div>
        <div class="tab-content content-modal-box">
            <div class="tab-pane fade show active" id="tab_list_06" role="tabpanel">
                <form action="#" class="account-form-box">
                    <h6>Login your account</h6>
                    <div class="single-input">
                        <input type="text" placeholder="Username">
                    </div>
                    <div class="single-input">
                        <input type="password" placeholder="Password">
                    </div>
                    <div class="checkbox-wrap mt-10">
                        <label class="label-for-checkbox inline mt-15">
                            <input class="input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever"> <span>Remember me</span>
                        </label>
                        <a href="#" class=" mt-10">Lost your password?</a>
                    </div>
                    <div class="button-box mt-25">
                        <a href="#" class="btn btn--full btn--black">Log in</a>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="tab_list_07" role="tabpanel">

                <form action="#" class="account-form-box">
                    <h6>Register An Account</h6>
                    <div class="single-input">
                        <input type="text" placeholder="Username">
                    </div>
                    <div class="single-input">
                        <input type="text" placeholder="Email address">
                    </div>
                    <div class="single-input">
                        <input type="password" placeholder="Password">
                    </div>
                    <p class="mt-15">Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a href="#" class="privacy-policy-link" target="_blank">privacy policy</a>.</p>
                    <div class="button-box mt-25">
                        <a href="#" class="btn btn--full btn--black">Register</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
</div>



<!-- Modal -->
<div class="header-login-register-wrapper modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
    <div class="modal-box-wrapper">
        <div class="helendo-tabs">
            <ul class="nav" role="tablist">
                <li class="tab__item nav-item active">
                    <a class="nav-link active" data-bs-toggle="tab" href="#tab_list_06" role="tab">Login</a>
                </li>
                <li class="tab__item nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab_list_07" role="tab">Our Register</a>
                </li>

            </ul>
        </div>
        <div class="tab-content content-modal-box">
            <div class="tab-pane fade show active" id="tab_list_06" role="tabpanel">
                <form action="#" class="account-form-box">
                    <h6>Login your account</h6>
                    <div class="single-input">
                        <input type="text" placeholder="Username">
                    </div>
                    <div class="single-input">
                        <input type="password" placeholder="Password">
                    </div>
                    <div class="checkbox-wrap mt-10">
                        <label class="label-for-checkbox inline mt-15">
                            <input class="input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever"> <span>Remember me</span>
                        </label>
                        <a href="#" class=" mt-10">Lost your password?</a>
                    </div>
                    <div class="button-box mt-25">
                        <a href="#" class="btn btn--full btn--black">Log in</a>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="tab_list_07" role="tabpanel">

                <form action="#" class="account-form-box">
                    <h6>Register An Account</h6>
                    <div class="single-input">
                        <input type="text" placeholder="Username">
                    </div>
                    <div class="single-input">
                        <input type="text" placeholder="Email address">
                    </div>
                    <div class="single-input">
                        <input type="password" placeholder="Password">
                    </div>
                    <p class="mt-15">Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a href="#" class="privacy-policy-link" target="_blank">privacy policy</a>.</p>
                    <div class="button-box mt-25">
                        <a href="#" class="btn btn--full btn--black">Register</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
</div>
