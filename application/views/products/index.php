
<?php $type = e_user_type($this->data['user_data'])?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Products</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Products</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">
         <?php flash()?>
         
        <?php if( isEqual( $type , 'admin') ): ?>
          <a href="<?php echo base_url('products/create') ?>" class="btn btn-primary">Add Product</a>
          <br /> <br />
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Manage Products</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped dataTable">
              <thead>
              <tr>
                <th>Image</th>
                <th>SKU</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Remarks</th>
                <th>Availability</th>
                <?php if( isEqual( $type , 'admin') ): ?>
                  <th>Action</th>
                <?php endif; ?>
              </tr>
              </thead>

              <tbody>
                <?php foreach($products as $row):?>
                  <?php $stock_link = "<a href='".base_url('Stocks/create?product_id='.$row['id'])."'> (0) Add Stock Now </a>"?>
                  <tr>
                    <td><img src="<?php echo base_url($row['image'])?>" alt="<?php echo $row['name']?>" 
                        class="img-circle" width="50" height="50" /></td>

                    <td><?php echo strtoupper($row['sku'])?></td>
                    <td><?php echo strtoupper($row['name'])?></td>
                    <td><?php echo strtoupper($row['price'])?></td>
                    <td><?php echo is_null($row['stock_quantity']) ? '<label class="text-danger">NO STOCK</label>' : strtoupper($row['stock_quantity']) ?></td>
                    <td>
                      <?php
                        if( is_null($row['stock_quantity']) ){
                          echo $stock_link;
                        }else{
                          if( $row['stock_quantity'] <= $row['min_stock'] ){
                            echo '<label class="text-danger">Less than Minimum Stock Level</label>';
                          }elseif($row['stock_quantity'] >= $row['max_stock']){
                            echo '<label class="text-warning">Over Maximum Stock Level</label>';
                          }else{
                           echo '<label class="text-success">Good Stock Condition</label>';
                          }
                        }
                      ?>
                    </td>
                    <td><?php echo strtoupper($row['availability'])?></td>
                    <td>
                      <?php
                          if( isEqual($type , 'admin'))
                            echo btnLink('products/update/'.$row['id'], "Edit", "edit");

                          echo btnLink('products/show/'.$row['id'], "View", "view");
                      ?>
                    </td>
                  </tr>
                <?php endforeach?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php if(in_array('deleteProduct', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Product</h4>
      </div>

      <form role="form" action="<?php echo base_url('products/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>
