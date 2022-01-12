<style type="text/css">
    label{
        margin-bottom: 0px !important;
    }
    .form-group{
        margin-bottom: 15px;
    }
</style>
<div class="checkout-main-area section-space--ptb_90">
    <div class="container">
        <div class="checkout-wrap">
            <form method="post" action="<?php echo base_url('cart/checkout_bundle?bundle_id='.$bundle['id'])?>" class="needs-validation">
                <?php if( isset($user) ) :?>
                  <input type="hidden" name="user_id" value="<?php echo $user['id']?>">
                <?php endif?>
                <div class="row">
                    <div class="col-lg-7">
                        <div class="billing-info-wrap mr-100">
                            <h6 class="mb-20">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <?php
                                            __(
                                              f_col( f_label('Full Name') , f_text('customer_name' , $user['firstname'] ?? '' , ['class' => 'form-control' , 'placeholder' => 'eg. Jhon Doe' , 'required' => true]) )
                                            );
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <?php
                                            __(
                                              f_col( f_label('Phone') , f_text('customer_phone' , $user['phone'] ?? '' , ['class' => 'form-control' , 'placeholder' => 'eg. 09xxxxxxxxxxx' , 'required' => true]) )
                                            );
                                       ?>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <?php
                                            __(
                                              f_col( f_label('Email') , f_text('customer_email' , $user['email'] ?? '' , ['class' => 'form-control' , 'placeholder' => 'eg. custoemr@email.com' , 'required' => true]) )
                                            );
                                        ?>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <?php
                                            __(
                                              f_col( f_label('Address') , f_textarea('customer_address' , $user['address'] ?? '' , 
                                                ['class' => 'form-control' , 'placeholder' => 'Complete Address' , 'rows' => 3 , 'required' => true]) )
                                            );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="additional-info-wrap">
                                <h6 class="mb-10">Additional information</h6>
                                <label>Order notes (optional)</label>
                                <textarea placeholder="Notes about your order, e.g. special notes for delivery. " name="message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="your-order-wrappwer tablet-mt__60 small-mt__60">
                            <h6 class="mb-20">Your order</h6>
                            <div class="your-order-area">
                                <div class="your-order-wrap gray-bg-4">
                                    <div class="your-order-info-wrap">
                                        <div class="your-order-info">
                                            <ul>
                                                <li>Product <span>Total</span></li>
                                            </ul>
                                        </div>
                                        <div class="your-order-middle">
                                            <?php $total = $bundle['price_public'] - $bundle['discount']?>
                                            <ul>
                                                <li> 
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <?php echo $bundle['name']?> <small> <?php echo $bundle['price_public']?> (<?php echo $bundle['discount']?>)->discount </small> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span> PHP <?php echo amountHTML($total) ?> </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="your-order-info order-total">
                                            <ul>
                                                <li><strong>Total</strong> <span>PHP <?php echo amountHTML($total)?> </span></li>
                                            </ul>
                                        </div>

                                        <div class="payment-area mt-30">
                                            <div class="single-payment">
                                                <h6 class="mb-10">Check payments</h6>
                                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                            </div>
                                            <div class="single-payment mt-20">
                                                <h6 class="mb-10">What is PayPal?</h6>
                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="place-order mt-30">
                                <button type="submit" class="btn--full btn--black btn--lg text-center">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>