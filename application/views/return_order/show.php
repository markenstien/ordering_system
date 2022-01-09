<!-- Content Wrapper. Contains page content -->
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
      <div class="col-md-7 col-xs-12">
        <?php flash()?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Return Details</h3>
          </div>

          <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <td>Reference#:</td>
                  <td><?php echo $return_order['reference']?></td>
                </tr>
                <tr>
                  <td>Requested On</td>
                  <td><?php echo $return_order['created_at']?></td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td><?php echo $return_order['status']?></td>
                </tr>

                <tr>
                  <td colspan="2"> <strong>Customer</strong> </td>
                </tr>
                <tr>
                  <td>Name</td>
                  <td><?php echo $return_order['firstname'] . ' ' . $return_order['lastname']?></td>
                </tr>
                <tr>
                  <td>Contact</td>
                  <td><?php echo $return_order['phone']?></td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td><?php echo $return_order['email']?></td>
                </tr>
                <tr>
                  <td>View Actual Order</td>
                  <td><a href="<?php echo base_url('orders/show/'.$return_order['order_id'])?>">view</a></td>
                </tr>
              </table>

              <div class="mt-2"></div>
              <h4>Items</h4>
              <div class="table table-bordered">
                  <table class="table table-bordered">
                    <thead>
                      <th>Name</th>
                      <th>Action</th>
                      <th>Qty</th>
                      <th>Return Qty</th>
                    </thead>
                    <tbody>
                      <?php foreach( $return_order_items as $key => $item) :?>
                        <tr>
                          <td><?php echo $item['name']?></td>
                          <td><a href="<?php echo base_url('productPublic/show/'.$item['product_id'])?>">View</a></td>
                          <td><?php echo $item['order_qty']?></td>
                          <td><?php echo $item['return_qty']?></td>
                        </tr>
                      <?php endforeach?>
                    </tbody>
                  </table>
              </div>
              <hr>
              <h3>Reason</h3>
              <p><?php echo $return_order['reason']?></p>
              <?php if( !empty($return_order['rermarks']) ):?>
                <h3>Remarks</h3>
                <p><?php echo $return_order['rermarks']?></p>
              <?php endif?>
          </div>
          </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->


      <?php if( e_user_type($user_data) != 'customer' ) :?>
        <div class="col-md-5 col-xs-12">
         <div class="box">
            <div class="box-header">
              <h3 class="box-title">Action</h3>
            </div>

            <div class="box-body">
              <?php if( isEqual($return_order['status'] , 'pending')) : ?>
                <a href="<?php echo base_url('ReturnOrder/updateForChecking/'.$return_order['id'])?>" class="btn btn-primary btn-sm">For Checking</a>
              <?php endif?>

              <?php if( isEqual($return_order['status'] , 'for-checking') ) :?>
                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalOrderApprove" data-type="cancelled">Approve Return</a>
                <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalOrderInvalid" data-type="cancelled">Invalid Return</a>
              <?php else:?>
                <p>Return Order Ticket is completed , Current Status : <?php echo $return_order['status']?></p>
              <?php endif?>
            </div>
          </div>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Return Process</h3>
            </div>

            <div class="box-body">
              <form method="post" action="<?php echo base_url('ReturnProcess/update')?>">
                <input type="hidden" name="id" value="1">
                <input type="hidden" name="return_id" value="<?php echo $return_order['id']?>">
                <div class="form-group">
                  <textarea class="textarea form-control" row="5" name="text_content"><?php echo $return_order_process['text_content'];?></textarea>
                </div>

                <div class="form-group">
                  <input type="submit" name="" value="Submit Changes" class="btn btn-primary">
                </div>
              </form>
            </div>
          </div>
        </div>
      <?php endif?>

      
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<div class="modal fade" id="modalOrderApprove" tabindex="-1" role="dialog" 
  aria-labelledby="modalCustomerCancelOrderLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Approve Return Request</h3>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url('returnOrder/approve')?>">
          <input type="hidden" name="id" value="<?php echo $return_order['id']?>">
          <input type="hidden" name="status" value="returned">
          <div class="form-group">
            <label>Notes</label>
            <textarea class="form-control" rows="3" name="rermarks" required 
            placeholder></textarea>
          </div>
          <input type="submit" name="" class="btn btn-primary" value="Submit">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalOrderInvalid" tabindex="-1" role="dialog" 
  aria-labelledby="modalCustomerCancelOrderLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Invalid Return Request</h3>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url('returnOrder/invalid')?>">
          <input type="hidden" name="id" value="<?php echo $return_order['id']?>">
          <input type="hidden" name="status" value="invalid">
          <div class="form-group">
            <label>Return</label>
            <textarea class="form-control" rows="3" name="rermarks" required 
            placeholder="Describe your reason for cancelation"></textarea>
          </div>
          <input type="submit" name="" class="btn btn-primary" value="Submit">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>