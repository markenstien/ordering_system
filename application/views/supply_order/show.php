  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Supply Order</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Manage </a></li>
        <li class="active">Supply Order</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-8 col-xs-8">
          <?php flash()?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Supply Order</h3>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <td>Reference</td>
                      <th>#<?php echo $supply_order['reference']?></th>
                    </tr>

                    <tr>
                      <td>Title</td>
                      <th><?php echo $supply_order['title']?></th>
                    </tr>
                    <tr>
                      <td>Supplier</td>
                      <th><?php echo $supply_order['supplier']?></th>
                    </tr>
                    <tr>
                      <td>Date</td>
                      <th><?php echo $supply_order['date']?></th>
                    </tr>
                    <tr>
                      <td>Status</td>
                      <th><?php echo $supply_order['status']?></th>
                    </tr>
                    <tr>
                      <td>Budget</td>
                      <th><?php echo $supply_order['budget']?></th>
                    </tr>
                    <tr>
                      <td>Description</td>
                      <th><?php echo $supply_order['description']?></th>
                    </tr>
                  </thead>
                </table>
              </div>
              <?php
                  $buttons = [];

                  if(!isEqual($supply_order['status'] , ['cancelled' , 'delivered']))
                  {
                    array_push($buttons , [
                      btnLink("supplyOrder/delivered/".$supply_order['id'] , 'Delivered' , 'success' , 'fa fa-truck'),
                      btnLink("supplyOrder/cancel/".$supply_order['id'] , 'Cancell' , 'danger' , 'fa fa-times'),
                      btnLink("supplyOrder/edit/".$supply_order['id'] , 'Edit' , 'Edit')
                    ]);
                  }else{
                    array_push($buttons , [
                      btnLink("supplyOrder/reOrder/".$supply_order['id'] , 'Re-Order' , 'warning' , 'fa fa-refresh'),
                    ]);
                  }
              ?>
            </div>
          </div>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Supply Items</h3>
              <?php if( !isEqual($supply_order['status'] , ['cancelled' , 'delivered']) ) :?>
              <div><?php __( btnLink('supplyOrderItem/add/'.$supply_order['id'], " Add Item ", 'create')) ?></div>
              <?php endif?>
            </div>

            <div class="box-body">
              <?php if( !$order_items) :?>
                <p>No items yet</p>
              <?php else:?>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <th>#</th>
                      <th>Product</th>
                      <th>SKU</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Total Amount</th>
                      <?php if( !isEqual($supply_order['status'] , ['cancelled' , 'delivered']) ) :?>
                        <th>Action</th>
                      <?php endif?>
                    </thead>

                    <tbody>
                      <?php $total = 0?>
                      <?php foreach( $order_items as $key => $item) :?>
                        <?php 
                          $market_price = $item['supplier_price'] ?? 0;
                          $total_amount =  $market_price * $item['quantity'];

                          $total += $total_amount;
                        ?>
                        <tr>
                          <td><?php echo ++$key?></td>
                          <td><?php echo $item['name']?></td>
                          <td><?php echo strtoupper($item['sku'])?></td>
                          <td><?php echo $item['quantity']?></td>
                          <td>
                            <div> Supplier : <?php echo $item['supplier_price']?></div>
                            <div> <small>Market : <?php amountHTML( $item['price'])?></small> </div>
                          </td>
                          <td><?php amountHTML($total_amount)?></td>
                          <td>
                            <?php if( !isEqual($supply_order['status'] , ['cancelled' , 'delivered']) ) :?>
                              <?php
                                __([
                                  btnLink('supplyOrderItem/edit/'.$item['id'],'Edit' , 'edit'),
                                  btnLink('supplyOrderItem/delete/'.$item['id'],'Delete' , 'delete')
                                ])
                              ?>
                            <?php endif?>
                          </td>
                        </tr>
                      <?php endforeach?>
                    </tbody>
                  </table>
                </div>
                <h4>Total : <?php amountHTML($total)?></h4>
              <?php endif?>
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
  <!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function() {
    $("#companyNav").addClass('active');
    $("#message").wysihtml5();
  });
</script>

