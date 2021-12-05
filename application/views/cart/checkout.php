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
              </div>
            </div>
          <?php endif?>
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Billing address</h4>

          
          <form method="post" action="<?php echo base_url('cart/checkout')?>" class="needs-validation">
            <?php if( isset($user) ) :?>
              <input type="hidden" name="user_id" value="<?php echo $user['id']?>">
            <?php endif?>
            <div class="mb-3">
              <?php
                __(
                  f_col( f_label('Full Name') , f_text('customer_name' , $user['firstname'] ?? '' , ['class' => 'form-control' , 'placeholder' => 'eg. Jhon Doe']) )
                );
              ?>
            </div>

            <div class="mb-3">
              <?php
                __(
                  f_col( f_label('Phone') , f_text('customer_phone' , $user['phone'] ?? '' , ['class' => 'form-control' , 'placeholder' => 'eg. 09xxxxxxxxxxx']) )
                );
              ?>
            </div>

            <div class="mb-3">
              <?php
                __(
                  f_col( f_label('Email') , f_text('customer_email' , $user['email'] ?? '' , ['class' => 'form-control' , 'placeholder' => 'eg. custoemr@email.com']) )
                );
              ?>
            </div>

            <div class="mb-3">
              <?php
                __(
                  f_col( f_label('Address') , f_textarea('customer_address' , $user['address'] ?? '' , 
                    ['class' => 'form-control' , 'placeholder' => 'Complete Address' , 'rows' => 3]) )
                );
              ?>
            </div>

            <?php if( isset($user) ) :?>
              <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('id')?>">
            <?php endif?>
            <input type="submit" name="" class="btn btn-primary" value="Checkout">
          </form>
        </div>
      </div>
  </div>
</div>