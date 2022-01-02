<div class="site-wrapper-reveal border-bottom">

    <!-- cart start -->
    <div class="cart-main-area  section-space--ptb_90">
        <div class="container">
            <?php flash()?>
            <?php if($cart_items) :?>
            <div class="row">
                <form action="<?php echo base_url('cart/updateMultiple')?>" method="post">
                <div class="col-lg-12">
                        <div class="table-content table-responsive cart-table-content header-color-gray">
                            <table>
                                <thead>
                                    <tr class="bg-gray">
                                        <th></th>
                                        <th></th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price"> Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $cart_total_amount = 0?>
                                    <?php foreach( $cart_items as $key => $row) :?>
                                        <?php $item_price = $row['price'] * $row['quantity']?>
                                        <?php $cart_total_amount += $item_price?>
                                        <input type="hidden" name="item[<?php echo $row['id']?>][id]" value="<?php echo $row['id']?>">
                                        <tr>
                                            <td></td>
                                            <td class="product-img">
                                                <a href="<?php echo base_url('productPublic/show/'.$row['id'])?>?is_cart_item=true"><img src="<?php echo base_url($row['image'])?>" alt=""
                                                    style="width: 100%;"></a>
                                            </td>
                                            <td class="product-name">
                                                <a href="#"><?php echo $row['name']?></a>
                                                <?php if( isset($row['attr_key_pair']) ) :?>
                                                   <label> <?php
                                                        $key_pair = (array) $row['attr_key_pair'];
                                                        echo implode(',' , $key_pair);
                                                    ?></label>
                                                <?php endif?>
                                            </td>

                                            <td class="product-price"><span class="amount">PHP <?php echo amountHTML($row['price'])?></span></td>

                                            <td class="cart-quality">
                                                <div class="quickview-quality quality-height-dec2">
                                                    <div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box" type="text" name="item[<?php echo $row['id']?>][quantity]" value="<?php echo $row['quantity']?>">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="price-total">
                                                <span class="amount">PHP <?php echo amountHTML($item_price)?></span>
                                            </td>
                                            <td class="product-remove">
                                                <a href="<?php echo base_url('cart/delete/'.$row['id'])?>"><i class="icon-cross2"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach?>
                                </tbody>
                            </table>
                        </div>
                    
                        <div class="shoping-update-area row">
                            <div class="continue-shopping-butotn col-6 mt-30">
                                <a href="<?php echo base_url('landing/catalog')?>" class="btn btn--lg btn--black"><i class="icon-arrow-left"></i> Continue Shopping </a>
                            </div>
                            <div class="update-cart-button col-6 text-end mt-30">
                                <button type="submit" class="btn btn--lg btn--border_1">Update cart</button>
                            </div>
                        </div>
                    </form>
                    <div class="cart-buttom-area">
                        <div class="row">
                            <div class="col-lg-6">
                            </div>
                            <div class="col-lg-6">
                                <div class="cart_totals section-space--mt_60 ms-md-auto">
                                    <div class="grand-total-wrap">
                                        <div class="grand-total-content">
                                            <ul>
                                                <li>Total <span>PHP <?php echo amountHTML($cart_total_amount)?></span> </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="grand-btn mt-30">
                                        <a href="<?php echo base_url('cart/checkout')?>" class="btn--black btn--full text-center btn--lg">Proceed to checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else:?>
                    <p>No Items <a href="<?php echo base_url('landing/catalog')?>">Add now</a></p>
                <?php endif?>
            </div>
        </div>
    </div>
    <!-- cart end -->

</div>

<!--====================  footer area ====================-->
<div class="footer-area-wrapper">
    <div class="footer-area section-space--ptb_120">
        <div class="container">
            <div class="row footer-widget-wrapper">
                <div class="col-lg-4 col-md-4 col-sm-6 footer-widget">
                    <h6 class="footer-widget__title mb-20">Address</h6>
                    <ul class="footer-widget__list">
                        <li><i class="icon_pin"></i> Helendo, Chicago, USA 2018</li>
                        <li> <i class="icon_phone"></i><a href="tel:846677028028" class="hover-style-link">+846677028028</a></li>

                    </ul>
                    <ul class="list footer-social-networks mt-25">

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
                <div class="col-lg-3 col-md-4 col-sm-6 footer-widget">
                    <h6 class="footer-widget__title mb-20">Help & Information</h6>
                    <ul class="footer-widget__list">
                        <li><a href="#" class="hover-style-link">Help & Contact Us</a></li>
                        <li><a href="#" class="hover-style-link">Returns & Refunds</a></li>
                        <li><a href="#" class="hover-style-link">Online Stores</a></li>
                        <li><a href="#" class="hover-style-link">Terms & Conditions</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 footer-widget">
                    <h6 class="footer-widget__title mb-20">About Us</h6>
                    <ul class="footer-widget__list">
                        <li><a href="#" class="hover-style-link">About Us</a></li>
                        <li><a href="#" class="hover-style-link">What We Do</a></li>
                        <li><a href="#" class="hover-style-link">FAQ Page</a></li>
                        <li><a href="#" class="hover-style-link">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 footer-widget">
                    <h6 class="footer-widget__title mb-20">Newsletter</h6>
                    <div class="footer-widget__newsletter mt-30">
                        <input type="text" placeholder="Your email address">
                        <button class="submit-button"><i class="icon-arrow-right"></i></button>
                    </div>
                    <ul class="footer-widget__footer-menu  section-space--mt_60 d-none d-lg-block">
                        <li><a href="#">Term & Condition</a></li>
                        <li><a href="#">Policy</a></li>
                        <li><a href="#">Map</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright-area section-space--pb_30">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-5 text-center text-md-start">
                    <ul class="footer-widget__footer-menu">
                        <li><a href="#">Term & Condition</a></li>
                        <li><a href="#">Policy</a></li>
                        <li><a href="#">Map</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-2 text-center">
                    <div class="footer-logo">
                        <a href="#"><img src="assets/images/logo/logo.svg" alt="Logo images"></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5 order-md-3">
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
            <div class="row">
                <div class="col-lg-12">
                    <span class="copyright-text text-center  section-space--mt_40">&copy; 2021 Helendo. <a  href="https://hasthemes.com/" target="_blank">All Rights Reserved.</a></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--====================  End of footer area  ====================-->
