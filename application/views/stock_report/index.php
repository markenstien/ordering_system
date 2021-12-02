  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Stock Report</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Manage </a></li>
        <li class="active">Stock Report</li>
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
              <h3 class="box-title">Stocks Report</h3>
            </div>

            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <th>Product</th>
                    <th>Total Stocks</th>
                    <th>Remarks</th>
                    <th>Action</th>
                  </thead>

                  <tbody>
                    <?php foreach($stocks as $row) :?>
                      <tr>
                        <td><?php echo $row['product_name']?></td>
                        <td><?php echo $row['total_stock']?></td>
                        <td><?php echo $row['remarks']?></td>
                        <td>
                          <?php 
                            __([
                              btnLink('product/show/'.$row['product_id'] , 'Show Product')
                            ])
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

