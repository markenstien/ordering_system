  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small><?php echo $bundle['name']?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Manage </a></li>
        <li class="active">Product Bundle</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php flash()?>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-6 col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Product Bundles</h3>
            </div>

            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tr>
                    <td>Name</td>
                    <td><?php echo $bundle['name']?></td>
                  </tr>

                  <tr>
                    <td>Market Price</td>
                    <td>
                      <?php echo $bundle['price_public']?>

                      <?php if( intval($bundle['price_custom']) ) :?>
                        <a href="<?php __(base_url('productBundle/removePublicPrice/'.$bundle['id'])) ?>">Remove Market Price</a>
                      <?php endif?>    
                    </td>
                  </tr>

                  <tr>
                    <td>Price</td>
                    <td><?php echo $bundle['price']?></td>
                  </tr>

                  <tr>
                    <td>Discount</td>
                    <td><?php echo $bundle['discount']?></td>
                  </tr>

                  <tr>
                    <td>Status</td>
                    <td><?php echo $bundle['stats']?></td>
                  </tr>

                  <tr>
                    <td>Availability</td>
                    <td><?php echo $bundle['is_visible']?></td>
                  </tr>

                  <tr>
                    <td>Description</td>
                    <td><?php echo $bundle['description']?></td>
                  </tr>
                </table>
              </div>
              <?php __(btnLink('productBundle/edit/'.$bundle['id'] , 'Edit' , 'edit')) ?>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>

      <div class="row">
        <div class="col-md-6 col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Bundle Items</h3>
              <div><?php echo btnLink('ProductBundleItem/add/'.$bundle['id'], ' Add Item ' , 'create')?></div>
            </div>

            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <th>#</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>On-Stocks</th>
                    <th>Action</th>
                  </thead>

                  <tbody>
                    <?php $total = 0?>
                    <?php foreach( $bundle_items as $key => $row) : ?>
                      <?php $total += $row['price']?>
                      <tr>
                        <td><?php echo ++$key?></td>
                        <td><?php echo $row['product_name']?></td>
                        <td><?php echo $row['quantity']?></td>
                        <td><?php echo $row['price']?></td>
                        <td><?php echo $row['stocks']?></td>
                        <td>
                          <?php
                            __([
                              btnLink('ProductBundleItem/edit/'.$row['id'] , 'Edit' , 'edit'),
                              btnLink('ProductBundleItem/delete/'.$row['id'] , 'Delete' , 'delete'),
                            ])
                          ?>
                        </td>
                      </tr>
                    <?php endforeach?>
                  </tbody>
                </table>
              </div>
              <h4>Total : <?php echo $total?> </h4>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>