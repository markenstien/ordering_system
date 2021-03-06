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
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-6 col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Delivery</h3>
            </div>

            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tr>
                    <td>Delivery Reference.</td>
                    <td><?php echo $delivery['reference']?></td>
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

              <?php if( isEqual($delivery['status'] , 'pending')) :?>
                <a href="#" class="btn btn-primary">For Delivery</a>
              <?php endif?>

              <?php if( isEqual($delivery['status'] ,'for-delivery') ) :?>
                <a href="#" class="btn btn-primary delivery-action" data-toggle="modal" data-target="#exampleModal" data-type="delivered">Delivered</a>
                <a href="#" class="btn btn-danger delivery-action" data-toggle="modal" data-target="#exampleModal" data-type="cancelled">Cancelled</a>
              <?php endif?>
            </div>
          </div>
        </div>

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
                    <td>Net Amount</td>
                    <td><?php echo $order['payment_status']?></td>
                  </tr>
                </table>
              </div>
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
                  </thead>

                  <tbody>
                    <?php foreach($order_items as $key => $row) :?>
                      <tr>
                        <td><?php echo ++$key?></td>
                        <td><?php echo $row['name']?></td>
                        <td><?php echo $row['qty']?></td>
                      </tr>
                    <?php endforeach?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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

