
<?php
  $type = e_user_type($this->data['user_data']);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Payments</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Payments</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>
        <?php flash()?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Payments</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="manageTable" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>Reference</th>
                <th>Customer Name</th>
                <th>External Reference</th>
                <th>Amount</th>
                <th>Method</th>
                <th>Order Reference</th>
              </tr>
              </thead>

              <tbody>
                <?php foreach($payments as $key => $row) :?>
                  <tr>
                    <td><?php echo ++$key?></td>
                    <td><?php echo $row['reference']?></td>
                    <td><?php echo $row['acc_name']?></td>
                    <td><?php echo $row['external_reference']?></td>
                    <td><?php echo $row['amount']?></td>
                    <td><?php echo $row['method']?></td>
                    <td><?php echo $row['bill_no']?></td>
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

<?php if( isEqual($type , 'admin')): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Order</h4>
      </div>

      <form role="form" action="<?php echo base_url('orders/remove') ?>" method="post" id="removeForm">
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