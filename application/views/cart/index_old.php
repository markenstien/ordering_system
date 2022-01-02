<link rel="stylesheet" type="text/css" href="<?php echo base_url('bundles/product_search.css')?>">
<style type="text/css">
  * {
    margin: 0;
    padding: 0;
    -webkit-font-smoothing: antialiased;
    -webkit-text-shadow: rgba(0, 0, 0, .01) 0 0 1px;
    text-shadow: rgba(0, 0, 0, .01) 0 0 1px
}

body {
    font-family: 'Rubik', sans-serif;
    font-size: 14px;
    font-weight: 400;
    background: #E0E0E0;
    color: #000000
}

ul {
    list-style: none;
    margin-bottom: 0px
}

.button {
    display: inline-block;
    background: #0e8ce4;
    border-radius: 5px;
    height: 48px;
    -webkit-transition: all 200ms ease;
    -moz-transition: all 200ms ease;
    -ms-transition: all 200ms ease;
    -o-transition: all 200ms ease;
    transition: all 200ms ease
}

.button a {
    display: block;
    font-size: 18px;
    font-weight: 400;
    line-height: 48px;
    color: #FFFFFF;
    padding-left: 35px;
    padding-right: 35px
}

.button:hover {
    opacity: 0.8
}

.cart_section {
    width: 100%;
    padding-top: 93px;
    padding-bottom: 111px
}

.cart_title {
    font-size: 30px;
    font-weight: 500
}

.cart_items {
    margin-top: 8px
}

.cart_list {
    border: solid 1px #e8e8e8;
    box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
    background-color: #fff
}

.cart_item {
    width: 100%;
    padding: 15px;
    padding-right: 46px
}

.cart_item_image {
    width: 133px;
    height: 133px;
    float: left
}

.cart_item_image img {
    max-width: 100%
}

.cart_item_info {
    width: calc(100% - 133px);
    float: left;
    padding-top: 18px
}

.cart_item_name {
    margin-left: 7.53%
}

.cart_item_title {
    font-size: 14px;
    font-weight: 400;
    color: rgba(0, 0, 0, 0.5)
}

.cart_item_text {
    font-size: 18px;
    margin-top: 35px
}

.cart_item_text span {
    display: inline-block;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    margin-right: 11px;
    -webkit-transform: translateY(4px);
    -moz-transform: translateY(4px);
    -ms-transform: translateY(4px);
    -o-transform: translateY(4px);
    transform: translateY(4px)
}

.cart_item_price {
    text-align: right
}

.cart_item_total {
    text-align: right
}

.order_total {
    width: 100%;
    height: 60px;
    margin-top: 30px;
    border: solid 1px #e8e8e8;
    box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
    padding-right: 46px;
    padding-left: 15px;
    background-color: #fff
}

.order_total_title {
    display: inline-block;
    font-size: 14px;
    color: rgba(0, 0, 0, 0.5);
    line-height: 60px
}

.order_total_amount {
    display: inline-block;
    font-size: 18px;
    font-weight: 500;
    margin-left: 26px;
    line-height: 60px
}

.cart_buttons {
    margin-top: 60px;
    text-align: right
}

.cart_button_clear {
    display: inline-block;
    border: none;
    font-size: 18px;
    font-weight: 400;
    line-height: 48px;
    color: rgba(0, 0, 0, 0.5);
    background: #FFFFFF;
    border: solid 1px #b2b2b2;
    padding-left: 35px;
    padding-right: 35px;
    outline: none;
    cursor: pointer;
    margin-right: 26px
}

.cart_button_clear:hover {
    border-color: #0e8ce4;
    color: #0e8ce4
}

.cart_button_checkout {
    display: inline-block;
    border: none;
    font-size: 18px;
    font-weight: 400;
    line-height: 48px;
    color: #FFFFFF;
    padding-left: 35px;
    padding-right: 35px;
    outline: none;
    cursor: pointer;
    vertical-align: top
}
</style>
<div class="body">
  <?php require_once APPPATH.'/views/templates/partial/public_navigation.php'?>
  <div class="container">
    <div class="cart_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <?php flash()?>
                    <div class="cart_container">
                      <?php if($cart_items) :?>
                        <div class="cart_title">Shopping Cart<small> (<?php echo count($cart_items) ?> item in your cart) </small></div>
                        <div class="cart_items">
                            <ul class="cart_list">
                              <?php $total = 0?>
                              <?php foreach( $cart_items as $row ) : ?>
                                <?php $total += $row['price'] * $row['quantity']?>
                                <li class="cart_item clearfix">
                                    <div class="cart_item_image"><img src="<?php echo base_url($row['image'])?>" alt=""></div>
                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                        <div class="cart_item_name cart_info_col">
                                            <div class="cart_item_title">Name</div>
                                            <div class="cart_item_text">
                                                <?php echo $row['name']?>
                                                <?php if(!is_null($row['attr_key_pair'])) :?>
                                                    <div>
                                                        <?php foreach( (array) $row['attr_key_pair'] as $attr_key => $attr_item) : ?>
                                                            <small><?php echo $attr_key .':'. $attr_item?></small>
                                                        <?php endforeach?>
                                                    </div>
                                                <?php endif?>
                                            </div>
                                        </div>
                                        <!-- <div class="cart_item_color cart_info_col">
                                            <div class="cart_item_title">Color</div>
                                            <div class="cart_item_text"><span style="background-color:#999999;"></span>Silver</div>
                                        </div> -->
                                        <div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_title">Quantity</div>
                                            <div class="cart_item_text"><?php echo $row['quantity']?></div>
                                        </div>
                                        <div class="cart_item_price cart_info_col">
                                            <div class="cart_item_title">Price</div>
                                            <div class="cart_item_text"><?php amountHTML($row['price'])?></div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_title">Total</div>
                                            <div class="cart_item_text"><?php amountHTML($row['price'] * $row['quantity']) ?></div>
                                        </div>
                                    </div>
                                </li>
                                    <a href="<?php echo base_url('productPublic/show/'.$row['id'].'?is_cart_item=true')?>">
                                    <i class="fa fa-edit"></i> Edit</a> | 
                                    
                                    <a href="<?php echo base_url('cart/delete/'.$row['id'])?>" class="text-danger">
                                    <i class="fa fa-trash"></i> Delete</a>
                              <?php endforeach?>
                            </ul>
                        </div>
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Order Total:</div>
                                <div class="order_total_amount"><?php amountHTML($total) ?></div>
                            </div>
                        </div>
                        <div class="cart_buttons">
                            <a href="<?php echo base_url('landing/index')?>" class="btn btn-primary">Continue Shopping</a>
                            
                            <a href="<?php echo base_url('cart/checkout')?>" class="btn btn-success">Check Out</a>
                        </div>

                      <?php else:?>
                        <h2>No Items on your cart</h2>
                        <a href="<?php echo base_url('landing/index')?>">Add Items to your cart</a>
                      <?php endif?>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>