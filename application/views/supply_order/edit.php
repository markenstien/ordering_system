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
          <?php flash()?>
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Create Supply Order</h3>
            </div>

            <div class="box-body">
              <form method="post" action="<?php echo base_url('supplyOrder/edit/'.$supply_order['id']) ?>">
                
                <div class="form-group">
                  <?php
                    __(f_col('title' , f_text('title' , $supply_order['title'] ,['class' => 'form-control'])));
                  ?>
                </div>

                <div class="form-group">
                  <?php
                    __(f_col('supplier_id' , f_select('supplier_id' , arr_layout_keypair($suppliers, ['id' , 'name']) , $supply_order['supplier_id'] ,['class' => 'form-control'])));
                  ?>
                </div>

                <div class="form-group">
                  <?php
                    __(f_col('date' , f_date('date' , $supply_order['date'] ,['class' => 'form-control'])));
                  ?>
                </div>

                <div class="form-group">
                  <?php
                    __(f_col('status' , f_select('status' ,['pending' , 'delivered','cancelled'], $supply_order['status'] ,['class' => 'form-control'])));
                  ?>
                </div>

                <div class="form-group">
                  <?php
                    __(f_col('budget' , f_text('budget' , $supply_order['budget'] ,['class' => 'form-control'])));
                  ?>
                </div>

                 <div class="form-group">
                  <?php
                    __(f_col('description' , f_textarea('description' , $supply_order['description'] ,['class' => 'form-control'])));
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

