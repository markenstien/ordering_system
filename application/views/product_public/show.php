<div class="site-wrapper-reveal">
    <div class="single-product-wrap section-space--pt_90 border-bottom">
        <div class="container">
            <?php flash()?>
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                    <!-- Product Details Left -->
                    <div class="product-details-left">
                        <div class="product-details-images-2 slider-lg-image-2">

                            <div class="easyzoom-style">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="<?php echo base_url($product['image'])?>" class="poppu-img">
                                        <img src="<?php echo base_url($product['image'])?>" class="img-fluid" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="product-details-thumbs-2 slider-thumbs-2">
                            <?php foreach( $product['galleries'] as $key => $row ):?>
                                <div class="sm-image"><img src="<?php echo base_url('assets/images/sample_image/'.$row['filename'])?>" alt="product image thumb" style="width: 100%;"></div>
                            <?php endforeach?>
                        </div>
                    </div>
                    <!--// Product Details Left -->

                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                    <div class="product-details-content ">

                        <h5 class="font-weight--reguler mb-10"><?php echo $product['name']?></h5>
                        <h3 class="price">PHP <?php amountHTML($product['price'])?></h3>
                        <form method="post" action="<?php echo isset($item) ? base_url('cart/updateItem/'.$item['id']) : base_url('cart/addItem') ?>">
                            <?php if(!empty($product['attr_extracted'])) :?>
                              <div class="form-group">
                                <?php foreach($product['attr_extracted'] as $attributes) :?>
                                  <?php $attr_name = $attributes['attribute']['name']?>
                                  <div class="form-group">
                                    <label style="font-weight: bold;"><?php echo $attributes['attribute']['name']?></label>
                                    <div style="padding: 5px;">
                                      <?php foreach($attributes['values'] as $row) :?>
                                        <?php
                                          $is_checked = false;

                                          if( isset($item['attr_key_pair']->$attr_name) ){
                                            $is_checked = $item['attr_key_pair']->$attr_name == $row['value'] ? true : false;
                                          }
                                        ?>
                                        <label style="border:1px solid #eee; padding: 4px;">
                                          <input type="radio" name="attr[<?php echo $attr_name?>]" 
                                          value="<?php echo $row['value']?>" <?php echo $is_checked ? 'checked' : ''?>>
                                          <span class="badge text-primary"><?php echo $row['value']?></span>
                                        </label>
                                      <?php endforeach?>
                                    </div>
                                  </div>
                                <?php endforeach?>
                              </div>
                            <?php endif?>
                            <div class="quickview-action-wrap mt-30">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']?>">
                                  <input type="hidden" name="product_type" value="single">
                                  <input type="hidden" name="cart_type" value="cart">
                                  <?php if($this->session->userdata('logged_in')) :?>
                                    <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('id')?>">
                                  <?php endif?>

                                <?php if($product['stock_quantity'] >= $product['min_stock']) :?>
                                    <h5>Stocks (<?php echo $product['stock_quantity']?>) </h5>
                                    <div class="quickview-cart-box">
                                        <div class="quickview-quality">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" type="text" name="quantity" 
                                                value="<?php echo isset($item) ? $item['quantity'] : 1?>">
                                            </div>
                                        </div>
                                        <div class="quickview-button">
                                            <div class="quickview-cart button">
                                                <button type="submit" role="button" class="btn--lg btn--black font-weight--reguler text-white">
                                                    <i class="p-icon icon-bag2"></i>  <?php echo isset($item) ? 'Update Cart Item' : 'Add to Cart'?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php else:?>
                                <h4 class="ribbon out-of-stock text-danger"> Out Of Stock </h4>
                                <?php endif?>

                                <div class="product_meta mt-30">
                                    <div class="sku_wrapper item_meta">
                                        <span class="label"> SKU: </span>
                                        <span class="sku"> <?php echo $product['sku']?> </span>
                                    </div>
                                    <?php if( isset($product['category_extracted']) && !empty($product['category_extracted'])) :?>
                                        <div class="tagged_as item_meta">
                                            <span class="label">Categories: </span>
                                            <?php foreach($product['category_extracted'] as $key => $row) :?>
                                                <?php $category = urlencode($row['id'])?>
                                                <a href="#"><?php echo $row['name']?></a>
                                            <?php endforeach?>
                                        </div>
                                    <?php endif?>
                                </div>
                           </div>
                       </form>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="product_details_tab_content tab-content mt-30">
                        <!-- Start Single Content -->
                        <div class="product_tab_content tab-pane active" id="description" role="tabpanel">
                            <div class="product_description_wrap">
                                <div class="product-details-wrap">
                                    <div class="row align-items-center">
                                        <div class="col-lg-7 order-md-1 order-2">
                                            <div class="details mt-30">
                                                <h5 class="mb-10"><i class="fa fa-info-circle"></i> Detail</h5>
                                                <?php echo $product['description']?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product_tab_content tab-pane" id="reviews" role="tabpanel">

                            <!-- Start RAting Area -->
                            <div class="rating_wrap mb-30">
                                <h4 class="rating-title-2">Be the first to review “Wooden chair”</h4>
                                <p>Your rating</p>
                                <div class="rating_list">
                                    <div class="product-rating d-flex">
                                        <i class="yellow icon_star"></i>
                                        <i class="yellow icon_star"></i>
                                        <i class="yellow icon_star"></i>
                                        <i class="yellow icon_star"></i>
                                        <i class="yellow icon_star"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- End RAting Area -->
                            <div class="comments-area comments-reply-area">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form action="#" class="comment-form-area">
                                            <p class="comment-form-comment">
                                                <label>Your review *</label>
                                                <textarea class="comment-notes" required="required"></textarea>
                                            </p>
                                            <div class="comment-input">
                                                <p class="comment-form-author">
                                                    <label>Name <span class="required">*</span></label>
                                                    <input type="text" required="required" name="Name">
                                                </p>
                                                <p class="comment-form-email">
                                                    <label>Email <span class="required">*</span></label>
                                                    <input type="text" required="required" name="email">
                                                </p>
                                            </div>

                                            <div class="comment-form-submit">
                                                <input type="submit" value="Submit" class="comment-submit">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Content -->
                    </div>
                </div>
            </div>

            <div class="related-products section-space--ptb_90">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center mb-30">
                            <h4>Related products</h4>
                        </div>
                    </div>
                </div>

                <div class="product-slider-active">
                    <?php if($related_products) :?>
                        <?php foreach( $related_products as $row) : ?>
                            <div class="col-lg-12">
                                <!-- Single Product Item Start -->
                                <div class="single-product-item text-center">
                                    <div class="products-images">
                                        <a href="<?php echo base_url('productPublic/show/'.$row['id'])?>" class="product-thumbnail">
                                            <img src="<?php echo base_url($row['image'])?>" class="img-fluid" alt="Product Images" width="300" height="300">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h6 class="prodect-title"><a href="product-details.html"><?php echo $row['name']?></a></h6>
                                    </div>
                                </div><!-- Single Product Item End -->
                            </div>
                        <?php endforeach?>
                    <?php endif?>
                </div>
            </div>

        </div>
    </div>

</div>