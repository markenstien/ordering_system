  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Product Bundle</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Manage </a></li>
        <li class="active">Product Bundle</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-6 col-xs-6">
        	<?php flash()?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Product Bundle</h3>
            </div>

            <div class="box-body">
              <form method="post" action="<?php base_url('productBundle/create') ?>">
                
                <div class="form-group">
                  <?php
                    __(f_col('name' , f_text('name' , '' ,['class' => 'form-control'])));
                  ?>
                </div>
                
                <div class="form-group">
                  <?php
                    __(f_col('price_custom' , f_text('price_custom' , '' ,['class' => 'form-control'])));
                  ?>
                </div>

                <div class="form-group">
                  <?php
                    __(f_col('discount' , f_text('discount' , '' ,['class' => 'form-control'])));
                  ?>
                </div>

                <div class="form-group">
                  <?php
                    __(f_col('description' , f_textarea('description' , '' ,['class' => 'form-control'])));
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