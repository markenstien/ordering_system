<link rel="stylesheet" type="text/css" href="<?php echo base_url('bundles/product_search.css')?>">
<div class="body">
  <?php require_once APPPATH.'/views/templates/partial/public_navigation.php'?>
  <div style="margin-bottom:30px"></div>
  <div class="container">
    <?php flash()?>
      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <?php if( $cart_items ):?>
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Cart Items</h4>
              </div>
              
              <div class="card-body">
                <ul class="list-group mb-3">
                  <?php $total = 0?>
                  <?php foreach($cart_items as $row) :?>
                    <?php $total += $row['price'] * $row['quantity']?>

                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div>
                        <h6 class="my-0"><?php echo $row['name']?></h6>
                        <small class="text-muted">PHP<?php echo $row['price']?>(<?php echo $row['quantity']?>)</small>
                        <div>
                          <a href="<?php echo base_url('productPublic/show/'.$row['id'].'?is_cart_item=true')?>"><i class="fa fa-edit"></i>Edit </a>
                          <a href="<?php echo base_url('cart/delete/'.$row['id'])?>" class="text-danger"><i class="fa fa-trash"></i> Delete </a> &nbsp;
                        </div>
                      </div>
                      <span class="text-muted">PHP <?php echo $row['quantity'] * $row['price']?></span>
                    </li>
                  <?php endforeach?>
                </ul>
              </div>

              <div class="card-footer">
                <h4>Total : <?php echo amountHTML($total)?></h4>
                <hr>
                <form>
                  <input type="submit" name="" value="Check out" class="btn btn-primary">
                </form>
              </div>
            </div>
          <?php endif?>
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Billing address</h4>

          
          <form method="post" action="<?php echo base_url('cart/checkout')?>" class="needs-validation">
            <div class="mb-3">
              <?php
                __(
                  f_col( f_label('Full Name') , f_text('customer_name' , '' , ['class' => 'form-control' , 'placeholder' => 'eg. Jhon Doe']) )
                );
              ?>
            </div>

            <div class="mb-3">
              <?php
                __(
                  f_col( f_label('Phone') , f_text('customer_phone' , '' , ['class' => 'form-control' , 'placeholder' => 'eg. 09xxxxxxxxxxx']) )
                );
              ?>
            </div>

            <div class="mb-3">
              <?php
                __(
                  f_col( f_label('Email') , f_text('customer_email' , '' , ['class' => 'form-control' , 'placeholder' => 'eg. custoemr@email.com']) )
                );
              ?>
            </div>

            <div class="mb-3">
              <?php
                __(
                  f_col( f_label('Address') , f_textarea('customer_address' , '' , 
                    ['class' => 'form-control' , 'placeholder' => 'Complete Address' , 'rows' => 3]) )
                );
              ?>
            </div>

            <?php if( isset($user) ) :?>
              <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('id')?>">
            <?php endif?>
            <input type="submit" name="" class="btn btn-primary" value="Send">

            <!-- <hr class="mb-4">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="same-address">
              <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="save-info">
              <label class="custom-control-label" for="save-info">Save this information for next time</label>
            </div> -->

            <!-- <hr class="mb-4">

            <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                <label class="custom-control-label" for="credit">Credit card</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="debit">Debit card</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="paypal">PayPal</label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">Name on card</label>
                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                <small class="text-muted">Full name as displayed on card</small>
                <div class="invalid-feedback">
                  Name on card is required
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="cc-number">Credit card number</label>
                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                <div class="invalid-feedback">
                  Credit card number is required
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">Expiration</label>
                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                <div class="invalid-feedback">
                  Expiration date required
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-cvv">CVV</label>
                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                <div class="invalid-feedback">
                  Security code required
                </div>
              </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button> -->

          </form>
        </div>
      </div>
  </div>
</div>