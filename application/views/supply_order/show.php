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
              <h3 class="box-title">Supply Order</h3>
            </div>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <td>Title</td>
                      <th><?php echo $supply_order['title']?></th>
                    </tr>
                    <tr>
                      <td>Supplier</td>
                      <th><?php echo $supply_order['supplier']?></th>
                    </tr>
                    <tr>
                      <td>Date</td>
                      <th><?php echo $supply_order['date']?></th>
                    </tr>
                    <tr>
                      <td>Status</td>
                      <th><?php echo $supply_order['status']?></th>
                    </tr>
                    <tr>
                      <td>Budget</td>
                      <th><?php echo $supply_order['budget']?></th>
                    </tr>
                    <tr>
                      <td>Description</td>
                      <th><?php echo $supply_order['description']?></th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Supply Items</h3>
              <div><?php __( btnLink('supplyOrderItem/add/'.$supply_order['id'], " Add Item ", 'create')) ?></div>
            </div>

            <div class="box-body">
              <?php if( !$order_items) :?>
                <p>No items yet</p>
              <?php else:?>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <th>#</th>
                      <th>Product</th>
                      <th>Quantity</th>
                      <th>Action</th>
                    </thead>

                    <tbody>
                      <?php foreach( $order_items as $key => $item) :?>
                        <tr>
                          <td><?php echo ++$key?></td>
                          <td><?php echo $item['name']?></td>
                          <td><?php echo $item['quantity']?></td>
                          <td>
                            #
                          </td>
                        </tr>
                      <?php endforeach?>
                    </tbody>
                  </table>
                </div>
              <?php endif?>
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

