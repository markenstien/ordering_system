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
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-6 col-xs-12">
          <?php flash()?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Set Delivery</h3>
            </div>

            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <tr>
                    <td>Order Reference</td>
                    <td><?php echo $order['bill_no']?></td>
                  </tr>
                  <tr>
                    <td>Placed On</td>
                    <td><?php echo date('Y-m-d' , $order['date_time'])?></td>
                  </tr>
                  <tr>
                    <td>Customer Name</td>
                    <td><?php echo $order['customer_name']?></td>
                  </tr>
                  <tr>
                    <td>Total</td>
                    <td><?php echo $order['net_amount']?></td>
                  </tr>
                  <tr>
                    <td>Payment Status</td>
                    <td><?php echo $order['paid_status'] == 1 ? 'PAID' : 'UNPAID'?></td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="box-body">
              <h4>Delivery Information</h4>
              <div class="table-responsive">
                <form method="post" action="<?php echo base_url('delivery/create/'.$order['id'])?>">
                  <input type="hidden" name="order_id" value="<?php echo $order['id']?>">
                  <div class="form-group">
                    <?php
                      __(
                        f_col( f_label('Date Of Delivery*') , f_date('date' , '' , ['class' => 'form-control' , 'required' => true]) )
                      );
                    ?>
                  </div>
                  <div class="form-group">
                    <?php
                      __(
                        f_col( f_label('Notes For Delivery') , f_textarea('description' , '' , ['class' => 'form-control']) )
                      );
                    ?>
                  </div>

                  <div class="form-group">
                    <?php
                      __(
                        f_col( f_label('Customer Name*') , f_text('cx_name' , $order['customer_name'] , 
                          ['class' => 'form-control' , 'required' => true]) )
                      );
                    ?>
                  </div>


                  <div class="form-group">
                    <?php
                      __(
                        f_col( f_label('Customer Contact Number*') , f_text('cx_phone' , $order['customer_phone'] , 
                          ['class' => 'form-control' , 'required' => true]) )
                      );
                    ?>
                  </div>


                  <div class="form-group">
                    <?php
                      __(
                        f_col( f_label('Delivery Address*') , f_text('cx_address' , $order['customer_address'] , 
                          ['class' => 'form-control' , 'required' => true]) )
                      );
                    ?>
                  </div>

                  <div class="form-group">
                    <?php
                      __(
                        f_col( f_label('Notify Customer' , 'cbox_notify_customer') , f_checkbox('notify_cx' , TRUE , ['id' => 'cbox_notify_customer']) )
                      );
                    ?>
                  </div>

                  <div class="form-group">
                    <?php
                      __(f_submit('', 'Set Delivery'));
                    ?>
                  </div>
                </form>
              </div>
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

