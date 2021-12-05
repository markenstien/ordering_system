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
        <div class="col-md-12 col-xs-12">
          <?php flash()?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Deliveries</h3>
            </div>

            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <th>Reference</th>
                    <th>Bill No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                  </thead>

                  <tbody>
                    <?php foreach($deliveries as $row) :?>
                      <tr>
                        <td><?php echo $row['reference']?></td>
                        <td>
                          <a href="<?php echo base_url('order/show/'.$row['order_id'])?>"><?php echo $row['bill_no']?></a>
                        </td>
                        <td><?php echo $row['cx_name']?></td>
                        <td><?php echo $row['cx_address']?></td>
                        <td><?php echo $row['cx_phone']?></td>
                        <td><?php echo $row['status']?></td>
                        <td>
                          <a href="<?php echo base_url('delivery/show/'.$row['id'])?>" class="btn btn-sm btn-primary">Show</a>
                        </td>
                      </tr>
                    <?php endforeach?>
                  </tbody>
                </table>
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

