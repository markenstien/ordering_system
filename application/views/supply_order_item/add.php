  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Add Supply Order Item</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Manage </a></li>
        <li class="active">Supply Item</li>
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
              <h3 class="box-title">Add Supply Item</h3>
            </div>

            <div class="box-body">
              <?php __(f_open(['method' => 'post' , 'action' => base_url('supplyOrderItem/add/'.$supply_order_id)]));?>
                <div class="form-group">
                  <?php
                    __( f_col( f_label('Product') , f_select('product_id' , arr_layout_keypair($products , ['id' , 'name']) ,'' , 
                      ['class' => 'form-control' , 'required' => true]) ) );
                  ?>
                </div>

                <div class="form-group">
                  <?php
                    __( f_col(f_label('Quantity') , f_text('quantity' , '' , ['class' => 'form-control' , 'required' => true])) );
                  ?>
                </div>

                <div class="form-group">
                  <?php
                    __( f_col(f_label('Supplier Price') , f_text('supplier_price' , '' , ['class' => 'form-control' , 'required' => true])) );
                  ?>
                </div>

                <div class="form-group">
                  <?php
                   __( f_submit('' , 'Add Product') )
                  ?>
                </div>
              <?php __(f_close()); ?>
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

