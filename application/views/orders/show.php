  <?php
    $user_type = e_user_type( $user_data );
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Delivery</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Manage </a></li>
        <li class="active">Deliveries</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php flash()?>

      <?php if( isEqual($order['order_status'] , 'cancelled') ) :?>
        <div class="alert alert-danger">
          <p class="alert-text">This order is cancelled</p>
        </div>
      <?php endif?>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-6 col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Order</h3>
            </div>

            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tr>
                    <td>Bill No</td>
                    <td><a href="<?php echo base_url("orders/show/{$order['id']}")?>"><?php echo $order['bill_no']?></a></td>
                  </tr>
                  <tr>
                    <td>Customer Name</td>
                    <td><?php echo $order['customer_name']?></td>
                  </tr>

                  <tr>
                    <td>Contact & Address</td>
                    <td>
                      <dl>
                        <dd><?php echo $order['customer_phone']?></dd>
                        <dd><?php echo $order['customer_email']?></dd>
                        <dd><?php echo $order['customer_address']?></dd>
                      </dl>
                    </td>
                  </tr>
                  <tr>
                    <td>Date Ordered</td>
                    <td><?php echo date('Y-m-d' , $order['date_time'])?></td>
                  </tr>
                  <tr>
                    <td>Net Amount</td>
                    <td><?php echo $order['net_amount']?></td>
                  </tr>

                  <tr>
                    <td>Order Status</td>
                    <td><?php echo $order['order_status']?></td>
                  </tr>

                  <tr>
                    <td>Payment Status</td>
                    <td><?php echo $order['payment_status']?></td>
                  </tr>

                  <?php if(!empty($order['remarks'])) :?>
                    <tr>
                      <td>Remarks</td>
                      <td><?php echo $order['remarks']?></td>
                    </tr>
                  <?php endif?>
                </table>
              </div>

              <?php if( isEqual($user_type, ['customer']) && $is_editable && !$delivery) :?> 
                 <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modalCustomerCancelOrder" data-type="cancelled">Cancel Order</a>
              <?php endif?>

              <?php if( isEqual($user_type, ['customer']) ) :?> 
                <?php if(isEqual($order['order_status'] , ['cancelled' , 'completed'] )) :?>
                  <a href="<?php echo base_url('orders/reOrder/'.$order['id'])?>" class="btn btn-primary">Re-Order</a>
                <?php endif?>
              <?php endif?>


              <?php if( isEqual($user_type, ['customer']) && $is_editable) :?> 
                <?php if(isEqual($order['payment_status'], 'unpaid')) :?>
                  <a href="<?php echo base_url('/Payment/create/'.$order['id'])?>" class="btn btn-success">Create Payment</a>
                <?php endif?>
              <?php endif?>

              <?php if( isEqual($user_type, ['customer'] )) :?> 
                <?php if( $delivery && isEqual($delivery['status'] , 'delivered') ) :?>
                  <a href="<?php echo base_url('/returnOrder/create/'.$order['id'])?>" class="btn btn-danger">Return Order</a>
                <?php endif?>
              <?php endif?>

            </div>
          </div>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Items</h3>
            </div>

            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <th>#</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                  </thead>

                  <tbody>
                    <?php foreach($items as $key => $row) :?>
                      <tr>
                        <td><?php echo ++$key?></td>
                        <td><?php echo $row['name']?></td>
                        <td>
                          <div><?php echo $row['qty']?> (PHP <?php echo $row['rate']?>)</div>
                        </td>
                        <td><?php echo $row['amount']?></td>
                      </tr>
                    <?php endforeach?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-6 col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Delivery</h3>
            </div>

            <div class="box-body">
              <?php if($delivery) :?>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tr>
                    <td>Delivery Reference.</td>
                    <td><?php echo $delivery['reference'] . ' - ' .$delivery['id']?></td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td><?php echo $delivery['status']?></td>
                  </tr>
                  <tr>
                    <td>Date of delivery</td>
                    <td><?php echo $delivery['date']?></td>
                  </tr>
                  <tr>
                    <td>Customer Name</td>
                    <td><?php echo $delivery['cx_name']?></td>
                  </tr>
                  <tr>
                    <td>Contact & Delivery Address</td>
                    <td>
                      <dl>
                        <dd><?php echo $delivery['cx_phone']?></dd>
                        <dd><?php echo $delivery['cx_email']?></dd>
                        <dd><?php echo $delivery['cx_address']?></dd>
                      </dl>
                    </td>
                  </tr>

                  <?php if( !is_null($delivery['received_by']) ) :?>
                  <tr>
                    <td>Received By</td>
                    <td><?php echo $delivery['received_by']?></td>
                  </tr>
                  <?php endif?>

                  <?php if( !is_null($delivery['remarks']) ) :?>
                  <tr>
                    <td>Remarks</td>
                    <td><?php echo $delivery['remarks']?></td>
                  </tr>
                  <?php endif?>
                </table>
              </div>
                <?php if( isEqual($delivery['status'] , 'pending') && isEqual($user_type , ['admin' , 'employee']) && $is_editable) :?>
                  <a href="#" class="btn btn-primary">For Delivery</a>
                <?php endif?>

                <?php if( isEqual($delivery['status'] ,'for-delivery') && isEqual($user_type , ['admin' , 'employee']) ) :?>
                  <a href="#" class="btn btn-primary delivery-action" data-toggle="modal" data-target="#exampleModal" data-type="delivered">Delivered</a>
                  <a href="#" class="btn btn-danger delivery-action" data-toggle="modal" data-target="#exampleModal" data-type="cancelled">Cancelled</a>
                <?php endif?>
              <?php else:?>
                <p>No delivery information</p>
              <?php endif?>

              <?php if(!$delivery && isEqual($user_type , ['admin' , 'employee']) && $is_editable) :?>
                <a href="<?php echo base_url('delivery/create/'.$order['id']) ?>" class="btn btn-primary">For Delivery</a>
              <?php endif?>
              
            </div>
          </div>

          <?php if( $payment) :?>
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Payment</h3>
              </div>

              <div class="box-body">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <tr>
                      <td>Reference.</td>
                      <td><?php echo $payment['reference']?></td>
                    </tr>
                    <tr>
                      <td>Amount</td>
                      <td><?php echo $payment['amount']?></td>
                    </tr>
                    <tr>
                      <td>Method</td>
                      <td><?php echo $payment['method']?></td>
                    </tr>
                    <tr>
                      <td>Paid On</td>
                      <td><?php echo $payment['created_at']?></td>
                    </tr>

                    <?php if( isEqual($payment['method'] , 'online')) :?>
                      <tr>
                        <td>External Reference</td>
                        <td><?php echo $payment['external_reference']?></td>
                      </tr>
                      <tr>
                        <td>Account Name</td>
                        <td><?php echo $payment['acc_name']?></td>
                      </tr>
                    <?php endif?>
                  </table>
                </div>
              </div>
            </div>
          <?php endif?>
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php if($delivery) :?>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="updateDeliveryModalLabel"></h3>
        </div>
        <div class="modal-body">
          <form method="post" action="<?php echo base_url('delivery/updateStatus/'.$delivery['id'])?>">
            <input type="hidden" name="status" value="" id="id_delivery_status_input">
            <div class="form-group">
              <label>Remarks</label>
              <textarea class="form-control" rows="3" name="remarks" id="id_remarks" ></textarea>
            </div>

            <div class="form-group">
              <label>Received By</label>
              <input type="text" name="received_by" class="form-control"
              value="<?php echo $delivery['cx_name']?>">
              <small>In-case the customer is unresponsive plase put 'unresponsive'</small>
            </div>

            <input type="submit" name="" class="btn btn-primary">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<?php endif?>

<div class="modal fade" id="modalCustomerCancelOrder" tabindex="-1" role="dialog" aria-labelledby="modalCustomerCancelOrderLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Customer Cancel Order Form</h3>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url('orders/cancel')?>">
          <input type="hidden" name="order_id" value="<?php echo $order['id']?>">
          <div class="form-group">
            <label>Reason</label>
            <textarea class="form-control" rows="3" name="remarks" required placeholder="Describe your reason for cancelation"></textarea>
          </div>
          <div class="form-group">
            <label>
              <input type="checkbox" name="cbox_confirm_cancel" value="1">
              Confirm Order Cancellation
            </label>
          </div>
          <input type="submit" name="" class="btn btn-primary" value="Cancel Order">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $("#companyNav").addClass('active');
    $("#message").wysihtml5();


    $(".delivery-action").click( function(e) 
    {
      let status = $(this).data('type');
      let form_status  = $("#id_delivery_status_input");
      let form_remarks = $("#id_remarks");

      switch(status)
      {
        case 'cancelled':
          $("#updateDeliveryModalLabel").html('Order Cancelled');
          form_status.val('cancelled');
          form_remarks.attr('placeholder' , 'Reason for cancellation , required');
        break;

        case 'delivered':
          $("#updateDeliveryModalLabel").html('Order Delivered');
          form_status.val('delivered');
          form_remarks.attr('placeholder' , 'Notes');
        break;
      }
    });
  });
</script>