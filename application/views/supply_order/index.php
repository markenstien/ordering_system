  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Supply Orders</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Manage </a></li>
        <li class="active">Supply Orders</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <?php flash()?>
          <a href="<?php echo base_url('supplyOrder/create') ?>" class="btn btn-primary">Add Supply Order</a>
          <br /> <br />
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Supply Orders</h3>
            </div>

            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered dataTable">
                  <thead>
                    <th>Title</th>
                    <th>Supplier</th>
                    <th>Budget</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Action</th>
                  </thead>

                  <tbody>
                    <?php foreach($supply_orders as $row) :?>
                      <tr>
                        <td><?php echo $row['title']?></td>
                        <td><?php echo $row['supplier']?></td>
                        <td><?php echo $row['budget']?></td>
                        <td><?php echo $row['status']?></td>
                        <td><?php echo $row['description']?></td>
                        <td>
                          <?php
                            __(
                              btnLink('supplyOrder/show/'.$row['id'], 'View' , 'view'),
                              btnLink('supplyOrder/edit/'.$row['id'], 'Edit' , 'edit'),
                            );
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

