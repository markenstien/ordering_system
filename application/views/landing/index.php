<link rel="stylesheet" type="text/css" href="<?php echo base_url('bundles/product_search.css')?>">

<style type="text/css">
  .category-item{
    text-transform: capitalize !important;
    border: 1px solid #eee;
    padding: 2px 5px;
  }
</style>
<div class="body">
  <?php require_once APPPATH.'/views/templates/partial/public_navigation.php'?>
  <div style="margin-bottom: 25px;"></div>
  <?php flash()?>
  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <div class="card">
          <div class="card-body">
            <h5>Categories</h5>

            <form method="get">
              <?php $category_picked = $_GET['categories'] ?? [];?>
              <?php foreach($categories as $cat) :?>
                <div class="category-item">
                  <input type="checkbox" name="categories[]" value="<?php echo $cat['id']?>"
                    id="cbox-category-item-<?php echo $cat['id']?>" 
                    <?php echo isEqual($cat['id'] , $category_picked) ? 'checked' : ''?>>
                  <label for="cbox-category-item-<?php echo $cat['id']?>"><?php echo $cat['name']?></label>
                </div>
              <?php endforeach?>
              <br>
              <input type="submit" name="filter_category" value="Apply Filter" class="btn btn-primary btn-sm">
            </form>
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
                            <a href="<?php echo base_url('productPublic/show/'.$row['id'])?>" style="text-decoration: none;">
                              <div class="bbb_deals_image">
                                  <img src="<?php echo base_url($row['image'])?>" alt="">
                              </div>
                              <div class="bbb_deals_content" style="text-decoration: none !important;">
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
                                         <!--  <div class="sold_stars ml-auto"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div> -->
                                      </div>
                                      <div class="available_bar"><span style="width:17%"></span></div>
                                    <?php else:?>
                                      <p>No Stock Available</p>
                                    <?php endif?>
                                  </div>
                              </div>
                          </div>
                          </a>
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