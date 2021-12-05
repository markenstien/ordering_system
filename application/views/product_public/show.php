<link rel="stylesheet" type="text/css" href="<?php echo base_url('bundles/product_search.css')?>">
<div class="body">
  <?php require_once APPPATH.'/views/templates/partial/public_navigation.php'?>
  <div style="margin-bottom: 25px;"></div>
  <div class="container">
    <?php flash()?>
    <div class="row">
      <div class="col-md-3">
        <h4>Related Products</h4>        
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title"><?php echo $product['name']?></h4>
            <label>Delivery Boxes</label>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <img src="<?php echo base_url($product['image'])?>"
                alt="<?php echo $product['name']?>" class="img-circle" width="100%"/>
              </div>
              <div class="col-md-6">
                <h5>PHP <?php amountHTML($product['price']) ?></h5>
                <div><?php echo $product['description']?></div>
                <br>
                <form method="post" action="<?php echo isset($item) ? base_url('cart/updateItem/'.$item['id']) : base_url('cart/addItem') ?>">
                  <input type="hidden" name="product_id" value="<?php echo $product['id']?>">
                  <input type="hidden" name="product_type" value="single">
                  <input type="hidden" name="cart_type" value="cart">
                  <?php if($this->session->userdata('logged_in')) :?>
                    <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('id')?>">
                  <?php endif?>
                  <div class="row">
                    <?php if( is_null($product['stock_quantity']) || $product['stock_quantity'] <= $product['min_stock']) :?>
                      <p>No Stocks Available</p>
                    <?php else:?>
                    <div class="col-md-5">
                      <input type="number" name="quantity" class="form-control"
                        value="<?php echo isset($item) ? $item['quantity'] : 1?>">
                    </div>
                    <div class="col-md-7">
                      <input type="submit" name="" class="btn btn-primary" 
                        value="<?php echo isset($item) ? 'Update Cart Item' : 'Add to Cart'?>">
                    </div>
                    <?php endif?>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">

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
    </div>
  </div>
</div>