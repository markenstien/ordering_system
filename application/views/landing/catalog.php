<div class="site-wrapper-reveal border-bottom">

    <!-- Product Area Start -->
    <div class="product-wrapper section-space--ptb_120">
        <div class="container">

            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="shop-toolbar__items shop-toolbar__item--left">
                        <div class="shop-toolbar__item shop-toolbar__item--result">
                            <p class="result-count"> Showing <?php echo count( $products ) ?> results</p>
                        </div>

                        <div class="shop-toolbar__item shop-short-by">
                            <ul>
                                <li>
                                    <a href="#">Sort by <i class="fa fa-angle-down angle-down"></i></a>
                                    <ul>
                                        <li class="active"><a href="#">Default sorting</a></li>
                                        <li><a href="#">Sort by popularity</a></li>
                                        <li><a href="#">Sort by average rating</a></li>
                                        <li><a href="#">Sort by latest</a></li>
                                        <li><a href="#">Sort by price: low to high</a></li>
                                        <li><a href="#">Sort by price: high to low</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="shop-toolbar__items shop-toolbar__item--right">
                        <div class="shop-toolbar__items-wrapper">


                            <div class="shop-toolbar__item">
                                <ul class="nav toolber-tab-menu justify-content-start" role="tablist">
                                    <li class="tab__item nav-item active">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#tab_columns_01" role="tab">
                                            <img src="<?php echo base_url('tmp/assets/images/svg/column-03.svg')?>" class="img-fluid" alt="Columns 03">
                                        </a>
                                    </li>
                                    <li class="tab__item nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#tab_columns_02" role="tab"><img src="<?php echo base_url('tmp/assets/images/svg/column-04.svg')?>" class="img-fluid" alt="Columns 03"> </a>
                                    </li>
                                    <li class="tab__item nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#tab_columns_03" role="tab"><img src="<?php echo base_url('tmp/assets/images/svg/column-05.svg')?>" class="img-fluid" alt="Columns 03"> </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="shop-toolbar__item shop-toolbar__item--filter ">
                                <a class="shop-filter-active" href="#">Filter<i class="icon-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="product-filter-wrapper">
                <form method="get">
                    <?php $selectedCategories = $_GET['categories']  ?? [];?>
                    <?php foreach($categories as $key => $category) :  ?>
                        <?php $isSelected = isEqual($category['id'] , $selectedCategories) ?>
                        <label>
                            <input type="checkbox" name="categories[]" value="<?php echo $category['id']?>"
                                <?php echo $isSelected == true ? 'checked':'' ?>>
                            <?php echo $category['name']?>
                        </label>
                    <?php endforeach?>
                    <div class="form-group">
                        <input type="submit" name="" value="Apply Filter">
                    </div>
                </form>
            </div>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab_columns_01">
                    <?php if( isset($_GET['categories']) || isset($_GET['key_word']) ) :?>
                        <a href="?">Remove Filter</a>
                    <?php endif?>
                    <div class="row">
                        <?php foreach( $products as $key => $row) :?>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <!-- Single Product Item Start -->
                                <div class="single-product-item text-center">
                                    <div class="products-images">
                                       <a href="<?php echo base_url('productPublic/show/'.$row['id'])?>" class="product-thumbnail">
                                            <img src="<?php echo base_url($row['image'])?>" class="img-fluid" alt="Product Images" width="300" height="300">
                                            <?php if($row['stock_quantity'] >= $row['min_stock']) :?>
                                              <span class="ribbon onsale ">
                                                Available: <?php echo $row['stock_quantity']?>
                                               </span>
                                              <div class="available_bar"><span style="width:17%"></span></div>
                                            <?php else:?>
                                             <span class="ribbon out-of-stock ">
                                                Out Of Stock
                                             </span>
                                            <?php endif?>
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h6 class="prodect-title"><a href="<?php echo base_url('productPublic/show/'.$row['id'])?>"><?php echo $row['name']?></a></h6>
                                        <div class="prodect-price">
                                            <span class="new-price">PHP <?php echo $row['price']?></span>
                                        </div>
                                    </div>
                                </div><!-- Single Product Item End -->
                            </div>
                        <?php endforeach?>
                    </div>
                </div>
            </div>

            <!-- <div class="paginatoin-area">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="pagination-box">
                            <li>
                                <a href="#" class="Previous"><i class="icon-chevron-left"></i></a>
                            </li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li>
                                <a href="#" class="Next"><i class="icon-chevron-right"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> -->

        </div>
    </div>
    <!-- Product Area End -->

</div>