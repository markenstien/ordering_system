

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
              <h3 class="box-title">Supplier</h3>
            </div>

            <div class="box-body">
              <form method="post" action="<?php base_url('supplierController/edit') ?>">
                <input type="hidden" name="id" value="<?php echo $supplier['id']?>">
                <div class="form-group">
                  <?php
                    __( f_col('Supplier Name', f_text('name' , $supplier['name'] , ['class' => 'form-control']) ))
                  ?>
                </div>

                <div class="form-group">
                  <?php
                    __( f_col('Supplier product' , f_text('supplier' , $supplier['product'] , ['class' => 'form-control']) ));
                  ?>
                </div>

                <div class="form-group">
                  <label for="product_name">Supplier Phone</label>
                  <input type="text" class="form-control" id="phone" name="phone" 
                    placeholder="Enter supplier phone" value="<?php echo $supplier['phone']?>" autocomplete="off"/>
                </div>

                <div class="form-group">
                  <label for="product_name">Supplier Email</label>
                  <input type="text" class="form-control" id="email" name="email" 
                    placeholder="Enter supplier email" value="<?php echo $supplier['email']?>" autocomplete="off"/>
                </div>

                <div class="form-group">
                  <label for="product_name">Contact Name</label>
                  <input type="text" class="form-control" id="contact_name" name="contact_name" 
                    placeholder="Enter supplier contact_name" value="<?php echo $supplier['contact_name']?>" autocomplete="off"/>
                </div>

                <div class="form-group">
                  <label for="product_name">Website</label>
                  <input type="text" class="form-control" id="website" name="website" 
                    placeholder="Enter supplier website" value="<?php echo $supplier['website']?>" autocomplete="off"/>
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

