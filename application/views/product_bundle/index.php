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
        <div class="col-md-12 col-xs-12">
        	<?php flash()?>
          <a href="<?php echo base_url('productBundle/create') ?>" class="btn btn-primary">Add Bundle</a>
          <br><br>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Product Bundles</h3>
            </div>

            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped dataTable">
                  <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Description</th>
                    <th>Action</th>
                  </thead>

                  <tbody>
                    <?php foreach( $product_bundles as $key => $row) :?>
                      <tr>
                        <td><?php echo ++$key?></td>
                        <td><?php echo $row['name']?></td>
                        <td><?php echo $row['price']?></td>
                        <td><?php echo $row['discount']?></td>
                        <td><?php echo $row['description']?></td>
                        <td>
                          <?php
                            __([
                              btnLink('productBundle/show/'.$row['id'] ,'View' , 'view'),
                              btnLink('productBundle/edit/'.$row['id'] ,'Edit' , 'edit'),
                            ]);
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