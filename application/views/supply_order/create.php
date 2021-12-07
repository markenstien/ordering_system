  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Supply Order</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Manage </a></li>
        <li class="active">Supply Order</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-6 col-xs-6">
          
          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Create Supply Order</h3>
            </div>

            <div class="box-body">
              <form method="post" action="<?php base_url('supplyOrder/create') ?>">
                <?php
                    __(f_hidden('status' , 'pending'));
                  ?>
                <div class="form-group">
                  <?php
                    __(f_col('title' , f_text('title' , '' ,['class' => 'form-control'])));
                  ?>
                </div>

                <div class="form-group">
                  <?php
                    __(f_col('supplier_id' , f_select('supplier_id' , arr_layout_keypair($suppliers, ['id' , 'name']) ,'' ,['class' => 'form-control'])));
                  ?>
                </div>

                <div class="form-group">
                  <?php
                    __(f_col('date' , f_date('date' , '' ,['class' => 'form-control'])));
                  ?>
                </div>
                <div class="form-group">
                  <?php
                    __(f_col('budget' , f_text('budget' , '' ,['class' => 'form-control'])));
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
  <!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function() {
    $("#companyNav").addClass('active');
    $("#message").wysihtml5();
  });
</script>

