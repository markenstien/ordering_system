

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Supplier</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Manage </a></li>
        <li class="active">Supplier</li>
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
              <h3 class="box-title">Supplier</h3>
            </div>

            <div class="box-body">
              <form method="post" action="<?php base_url('supplierController/create') ?>">
                <div class="form-group">
                  <?php
                    __(f_col('Supplier Names', f_text('name' , '' , ['class' => 'form-control']) ));
                  ?>
                </div>

                <div class="form-group">
                  <?php
                    __(f_col('Supplier product' , f_text('product' , '' , ['class' => 'form-control'])))
                  ?>
                </div>

                <div class="form-group">
                  <?php
                    __(f_col('Supplier Phone' , f_text('phone' , '' , ['class' => 'form-control'])))
                  ?>
                </div>

                <div class="form-group">
                  <?php
                    __(f_col('Supplier Email' , f_text('email' , '' , ['class' => 'form-control'])))
                  ?>
                </div>

                <div class="form-group">
                  <?php
                    __(f_col('Contact Name' , f_text('contact_name' , '' , ['class' => 'form-control'])))
                  ?>
                </div>

                <div class="form-group">
                  <?php
                    __(f_col('Website' , f_text('website' , '' , ['class' => 'form-control'])))
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

