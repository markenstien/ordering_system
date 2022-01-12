<!-- Content Wrapper. Contains page content -->

<?php
 $order_date = date('Y-m-d' , $order['date_time']);
 $date_now = date('Y-m-d');

 $date1 = date_create( $order_date );
 $date2 = date_create( $date_now );

 $diff = date_diff($date1,$date2);

 $days_count = abs($diff->format("%a days"));
?>
<div class="content-wrapper">
  <?php flash()?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Return Order</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Return Order</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-5 col-xs-12">
        <?php flash()?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Order Details</h3>
          </div>

          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <td>Order#:</td>
                <td><?php echo $order['bill_no']?></td>
              </tr>
              <tr>
                <td>Delivery Status</td>
                <td><?php echo $order['delivery_status']?></td>
              </tr>
              <tr>
                <td>Total Amount</td>
                <td><?php echo $order['net_amount']?></td>
              </tr>
              <tr>
                <td>Purchase Date</td>
                <td><?php echo date('Y-m-d' , $order['date_time'])?></td>
              </tr>
              <tr>
                <td>View Actual Order</td>
                <td><a href="<?php echo base_url('orders/show/'.$order['id'])?>">view</a></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->

      <div class="col-md-7 col-xs-12">
        <?php flash()?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Items To Return</h3>
          </div>

          <div class="box-body">
            <form class="form" method="post" action="<?php echo base_url('returnOrder/create/'.$order['id'])?>">
              <input type="hidden" name="order_id" value="<?php echo $order['id']?>">
              <input type="hidden" name="user_id"  value="<?php echo $user_data['id']?>">

              <table class="table table-bordered">
                <thead>
                  <th>Name</th>
                  <th>Action</th>
                  <th>Qty</th>
                  <th>Return Qty</th>
                </thead>

                <tbody>
                  <?php foreach( $order_items as $key => $order_item) :?>
                    <tr>
                      <td><?php echo $order_item['name']?></td>
                      <td><a href="<?php echo base_url('productPublic/show/'.$order_item['product_id'])?>">View</a></td>
                      <td><?php echo $order_item['qty']?></td>
                      <td>
                        <input type="hidden" name="return_item[<?php echo $key?>][order_qty]" 
                        value="<?php echo $order_item['qty']?>">
                        <input type="hidden" name="return_item[<?php echo $key?>][name]" 
                        value="<?php echo $order_item['name']?>">
                        <input type="hidden" name="return_item[<?php echo $key?>][product_id]" 
                        value="<?php echo $order_item['product_id']?>">
                        <?php echo f_number("return_item[$key][return_qty]" , '' , ['class' => 'form-control'])?>
                      </td>
                    </tr>
                  <?php endforeach?>
                </tbody>
              </table>

              <?php if( intval($days_count) < 5) :?>
                <div>
                  <label>Reason</label>
                  <?php
                    echo f_textarea('reason' , '' , 
                      ['class' => 'form-control' , 'placeholder' => 'Complete Address' , 'rows' => 3 , 'required' => true]);
                  ?>
                </div>

                <label>
                  <input type="checkbox" name="certify" required>
                  I Certify that the return reason given is true and correct
                </label>

                <div class="form-group">
                  <input type="submit" name="" class="btn btn-primary" value="Return Items">
                </div>
              <?php else:?>
                <p class="text-danger"> <strong>Cannot Return Order Over 5 Days.</strong> </p>
              <?php endif?>
            </form>
          </div>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->