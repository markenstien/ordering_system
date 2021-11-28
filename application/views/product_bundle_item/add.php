  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small><?php echo $bundle['name']?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Manage </a></li>
        <li class="active">Product Bundle</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php flash()?>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-6 col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add Item</h3>
            </div>

            <div class="box-body">
              <div class="table-responsive">
               <?php
                  __([
                    f_open(['method' => 'post' , 'action' => base_url('productBundleItem/add/'.$bundle_id)]),
                    f_hidden('bundle_id' , $bundle_id)
                  ]);
                ?> 

                <div class="form-group">
                  <?php __( f_col(f_label('Product') , f_select('product_id' ,arr_layout_keypair($products, ['id' , 'name']) ,'' , ['class' => 'form-control' , 'requried' => '']) ) )?>
                </div>

                <div class="form-group">
                  <?php __( f_col(f_label('Quantity') , f_number('quantity',  '' , ['class' => 'form-control']) ) )?>
                </div>

                <div>
                  <?php __(f_submit('' , 'Add Bundle Item'));?>

                  <?php __( btnLink('productBundle/show/'.$bundle_id, 'Back to Bundle' , 'warning' , 'return') )?>
                </div>

                <?php __( f_close() )?>
              </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>

    </section>
    <!-- /.content -->
  </div>