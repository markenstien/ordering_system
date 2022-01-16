
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
                        <p> <strong>Bake & Wrap</strong> is one of only a handful few enduring Craft Bake shops in Quezon City. We have assembled our notoriety on consolidating great quality conventional heating with a great incentive for cash.
                        We offer our clients a full scope of Cake Boxes, Bread Mold, Cake Toppers, Baking Tools, and Cake Decorations.
                        Our baking materials are all brand new and in good quality, we care about are customers and make sure that all of our customers receiving what they expect and even get them surprise with satisfaction they will get.
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
                                            <span class="new-price">PHP <?php echo amountHTML($row['price'])?></span> 
                                        </div>
                                    </div>
                                </div><!-- Single Product Item End -->
                            </div>
                        <?php endforeach?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Product Area End -->

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
