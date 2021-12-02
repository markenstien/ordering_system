  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Stocks</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Manage </a></li>
        <li class="active">Stocks</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <?php flash()?>
          <a href="<?php echo base_url('stocks/create') ?>" class="btn btn-primary">Add Stocks</a>
          <br /> <br />
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Stock Management</h3>
            </div>

            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered dataTable">
                  <thead>
                    <th>#</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Time Stamp</th>
                    <th>Action</th>
                  </thead>

                  <tbody>
                    <?php foreach( $stocks as $key => $row) :?>
                      <tr>
                        <td><?php echo ++$key?></td>
                        <td><?php echo $row['product_name']?></td>
                        <td><?php echo $row['quantity']?></td>
                        <td><?php echo $row['date']?></td>
                        <td><?php echo $row['description']?></td>
                        <td><?php echo $row['created_at']?></td>
                        <td>
                          <?php
                            __( btnLink('stocks/edit/'.$row['id'] , 'Edit' , 'edit') )
                          ?>
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

