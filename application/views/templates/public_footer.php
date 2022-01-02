
<!--====================  search overlay ====================-->
<div class="search-overlay" id="search-overlay">

<div class="search-overlay__header">
<div class="container">
    <div class="row align-items-center">
        <div class="col-lg-6 col-8">
            <div class="search-title">
                <h4 class="font-weight--normal">Search</h4>
            </div>
        </div>
        <div class="col-md-6 ms-auto col-4">
            <!-- search content -->
            <div class="search-content text-end">
                <span class="mobile-navigation-close-icon" id="search-close-trigger"><i class="icon-cross"></i></span>
            </div>
        </div>
    </div>
</div>
</div>
<div class="search-overlay__inner">
<div class="search-overlay__body">
    <div class="search-overlay__form">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 m-auto">
                    <form action="<?php echo base_url('landing/catalog')?>">
                        <div class="product-cats section-space--mb_60 text-center">
                            <label> <input type="radio" name="product_cat" value="" checked="checked"> <span class="line-hover">All</span> </label>
                            <label> <input type="radio" name="product_cat" value="decoration"> <span class="line-hover">Decoration</span> </label>
                            <label> <input type="radio" name="product_cat" value="furniture"> <span class="line-hover">Furniture</span> </label>
                            <label> <input type="radio" name="product_cat" value="table"> <span class="line-hover">Table</span> </label> <label> <input type="radio" name="product_cat" value="chair"> <span class="line-hover">Chair</span> </label>
                        </div>
                        <div class="search-fields">
                            <input type="text" placeholder="Search" name="key_word">
                            <button class="submit-button"><i class="icon-magnifier"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>

<?php if( $cart_items ) :?>
<?php $over_all_total = 0?>
<!--  offcanvas Minicart Start -->
<div class="offcanvas-minicart_wrapper" id="miniCart">
<div class="offcanvas-menu-inner">
    <div class="close-btn-box">
        <a href="#" class="btn-close"><i class="icon-cross2"></i></a>
    </div>
    <div class="minicart-content">
        <ul class="minicart-list">
            <?php $total = 0?>
            <?php foreach( $cart_items as $row ) : ?>
                <?php $total += $row['price'] * $row['quantity']?>
                <?php $over_all_total += $total?>
                <li class="minicart-product">
                    <a class="product-item_remove" href="<?php echo base_url('cart/delete/'.$row['id'])?>"><i class="icon-cross2"></i></a>
                    <a href="<?php echo base_url('productPublic/show/'.$row['id'])?>?is_cart_item" class="product-item_img">
                        <img class="img-fluid" src="<?php echo base_url($row['image'])?>" alt="Product Image"
                            style="width: 100px;">
                    </a>
                    <div class="product-item_content">
                        <a class="product-item_title" href="product-details.html">Plant pots</a>
                        <label>Qty : <span><?php echo $row['quantity']?></span> * <?php amountHTML($row['price'])?></label>
                        <label class="product-item_quantity">Total: <span>PHP <?php echo amountHTML( $row['price'] * $row['quantity']) ?></span></label>
                    </div>
                </li>
            <?php endforeach?>
        </ul>
    </div>
    <div class="minicart-item_total">
        <span class="font-weight--reguler">Subtotal:</span>
        <span class="ammount font-weight--reguler">PHP <?php echo amountHTML($over_all_total)?></span>
    </div>
    <div class="minicart-btn_area">
        <a href="<?php echo base_url('cart/index')?>" class="btn btn--full btn--border_1">View cart</a>
    </div>
    <div class="minicart-btn_area">
        <a href="checkout.html" class="btn btn--full btn--black">Checkout</a>
    </div>
</div>

<div class="global-overlay"></div>
</div>
<?php endif?>
<!--  offcanvas Minicart End -->



    
    <!--====================  End of search overlay  ====================-->


    <!--====================  scroll top ====================-->
    <a href="#" class="scroll-top" id="scroll-top">
        <i class="arrow-top icon-arrow-up"></i>
        <i class="arrow-bottom icon-arrow-up"></i>
    </a>
    <!--====================  End of scroll top  ====================-->

    <!-- JS
    ============================================ -->
    <!-- jQuery JS -->
    <script src="<?php echo base_url('tmp/assets/js/vendor/jquery-3.5.1.min.js')?>"></script>
    <script src="<?php echo base_url('tmp/assets/js/vendor/jquery-migrate-3.3.0.min.js')?>"></script>

    <!-- Modernizer JS -->
    <script src="<?php echo base_url('tmp/assets/js/vendor/modernizr-2.8.3.min.js')?>"></script>

    <!-- Bootstrap JS -->
    <script src="<?php echo base_url('tmp/assets/js/vendor/bootstrap.min.js')?>"></script>

    <!-- Fullpage JS -->
    <script src="<?php echo base_url('tmp/assets/js/plugins/fullpage.min.js')?>"></script>

    <!-- Slick Slider JS -->
    <script src="<?php echo base_url('tmp/assets/js/plugins/slick.min.js')?>"></script>

    <!-- Countdown JS -->
    <script src="<?php echo base_url('tmp/assets/js/plugins/countdown.min.js')?>"></script>

    <!-- Magnific Popup JS -->
    <script src="<?php echo base_url('tmp/assets/js/plugins/magnific-popup.js')?>"></script>

    <!-- Easyzoom JS -->
    <script src="<?php echo base_url('tmp/assets/js/plugins/easyzoom.js')?>"></script>

    <!-- ImagesLoaded JS -->
    <script src="<?php echo base_url('tmp/assets/js/plugins/images-loaded.min.js')?>"></script>

    <!-- Isotope JS -->
    <script src="<?php echo base_url('tmp/assets/js/plugins/isotope.min.js')?>"></script>

    <!-- YTplayer JS -->
    <script src="<?php echo base_url('tmp/assets/js/plugins/YTplayer.js')?>"></script>

    <!-- Instagramfeed JS -->
    <!-- <script src="assets/js/plugins/jquery.instagramfeed.min.js"></script> -->

    <!-- Ajax Mail JS -->
    <script src="<?php echo base_url('tmp/assets/js/plugins/ajax.mail.js')?>"></script>

    <!-- wow JS -->
    <script src="<?php echo base_url('tmp/assets/js/plugins/wow.min.js')?>"></script>



    <!-- Plugins JS (Please remove the comment from below plugins.min.js for better website load performance and remove plugin js files from avobe) -->

    <!--
    <script src="assets/js/plugins/plugins.min.js"></script>
    -->

    <!-- Main JS -->
    <script src="<?php echo base_url('tmp/assets/js/main.js')?>"></script>


</body>

</html>