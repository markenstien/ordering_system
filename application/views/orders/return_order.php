

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Orders</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Orders</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-5 col-xs-12">
        <?php flash()?>
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Return Order</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('orders/reOrder/'.$order_id) ?>" method="post" class="form-horizontal">
            <input type="hidden" name="order_id" value="<?php echo $order['id']?>">
            <table class="table table-bordered">
              <tr>
                <td>Name</td>
                <td>Rate</td>
                <td>Quantity</td>
              </tr>
              <?php foreach($order['items'] as $key => $row): ?>
                <?php $amount = $row['rate'] * $row['qty'] ?>
                <input type="hidden" name="items[<?php echo $key?>][product_id]" value="<?php echo $row['product_id']?>">
                <input type="hidden" name="items[<?php echo $key?>][rate]" value="<?php echo $row['rate']?>">
                <input type="hidden" name="items[<?php echo $key?>][amount]" value="<?php echo $amount?>">
                <tr>
                  <td><?php echo $row['name']?></td>
                  <td><?php echo amountHTML($row['rate'])?></td>
                  <td>
                    <input type="" name="items[<?php echo $key?>][qty]" class="form-control" value="<?php echo $row['qty']?>">
                  </td>
                </tr>
              <?php endforeach?>
            </table>
            <div class="box-body">
              <div class="text-center">
                <p>Are you sure you want to re-order</p>
                <h4>Order # <?php echo $order['bill_no']?></h4>
                <button type="submit" class="btn btn-lg btn-primary"> Re-Order </button>
              </div>
            </div>      
          </form>
          <!-- /.box-body -->
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