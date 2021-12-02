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
        <div class="col-md-6 col-xs-12">
          <?php flash()?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Stock Management</h3>
            </div>

            <div class="box-body">
              <form method="post" action="<?php base_url('Stocks/create') ?>">
                <div class="form-group">
                  <?php
                  __(
                        f_col(f_label('Product'), f_select('product_id' , arr_layout_keypair($products , ['id' , 'name']) , $_GET['product_id'] ?? null , ['class' => 'form-control' , 'required' => true]))
                    );
                  ?>
                </div>

                <div class="form-group">
                  <?php
                  __(
                        f_col(f_label('Quantity'), f_number('quantity' , '' , ['class' => 'form-control' , 'required' => true]))
                    );
                  ?>
                </div>

                <div class="form-group">
                  <?php
                  __(
                        f_col(f_label('Type'), f_select('type' , ['add' , 'deduct'],'' , ['class' => 'form-control' , 'required' => true]))
                    );
                  ?>
                </div>

                <div class="form-group">
                  <?php
                  __(
                        f_col(f_label('Date'), f_date('date' , '' , ['class' => 'form-control' , 'required' => true]))
                    );
                  ?>
                </div>

                <div class="form-group">
                  <?php
                  __(
                        f_col(f_label('Description'), f_textarea('description' , '' ,['class' => 'form-control','required' => true]))
                    );
                  ?>
                </div>
                <input type="submit" name="submit" class="btn btn-primary" value="Save Changes">
              </form>
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

