<link rel="stylesheet" type="text/css" href="<?php echo base_url('bundles/product_search.css')?>">
<div class="body">
  <?php require_once APPPATH.'/views/templates/partial/public_navigation.php'?>
  <div style="margin-bottom: 25px;"></div>
  <?php flash()?>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Advance Search</h4>
          </div>

          <div class="card-body">
            <?php __( f_open(['method' => 'get' , 'url' => ''])) ?>
              <div class="form-group">
                <?php
                  __(
                      f_col(f_label('Catalog') , f_text('catalog' , '' , ['class' => 'form-control' , 'placeholder' => 'Catalog Search']))
                  );
                ?>
              </div>
            <?php __( f_close() )?>
          </div>
        </div>
      </div>

      <div class="col-md-8">
        <div class="container">
          <?php if( isset($_GET['key_word']) ):?>
            <div class="alert alert-warning">
              <a href="?">Remove Filter</a>
            </div>
          <?php endif?>
          <div class="row">
            <?php foreach($products as $row) :?>
              <div class="col-md-4">
                  <!-- bbb_deals -->
                  <div class="bbb_deals">
                      <div class="bbb_deals_slider_container">
                          <div class=" bbb_deals_item">
                              <div class="bbb_deals_image">
                                <a href="<?php echo base_url('productPublic/show/'.$row['id'])?>">
                                  <img src="<?php echo base_url($row['image'])?>" alt="">
                                </a>
                              </div>
                              <div class="bbb_deals_content">
                                  <!-- <div class="bbb_deals_info_line d-flex flex-row justify-content-start">
                                      <div class="bbb_deals_item_category"><a href="#">Laptops</a></div>
                                      <div class="bbb_deals_item_price_a ml-auto"><strike>₹30,000</strike></div>
                                  </div> -->
                                  <div class="bbb_deals_info_line d-flex flex-row justify-content-start">
                                      <div class="bbb_deals_item_name"><?php echo $row['name']?></div>
                                      <div class="bbb_deals_item_price ml-auto">PHP <?php  amountHTML($row['price'])?></div>
                                  </div>
                                  <div class="available">
                                    <?php if($row['stock_quantity'] >= $row['min_stock']) :?>
                                      <div class="available_line d-flex flex-row justify-content-start">
                                          <div class="available_title">Available: <span><?php echo $row['stock_quantity']?></span></div>
                                          <div class="sold_stars ml-auto"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                                      </div>
                                      <div class="available_bar"><span style="width:17%"></span></div>
                                    <?php else:?>
                                      <p>No Stock Available</p>
                                    <?php endif?>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            <?php endforeach?>
          </div>
        </div>  
      </div>
    </div>
  </div>
</div>