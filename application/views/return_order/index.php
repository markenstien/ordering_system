<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <?php flash()?>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Return Order</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Return Order</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?php flash()?>

    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Order Details</h3>
      </div>

      <div class="box-body">
        <div class="table table-bordered">
          <table class="table table-bordered dataTable">
            <thead>
              <th>#</th>
              <th>Reference</th>
              <th>Status</th>
              <th>Remarks</th>
              <th>Customer</th>
              <th>Action</th>
            </thead>

            <tbody>
              <?php foreach($order_returns as $key => $or) :?>
                <tr>
                  <td><?php echo ++$key?></td>
                  <td><?php echo $or['reference']?></td>
                  <td><?php echo $or['status']?></td>
                  <td style="width:30%"><?php echo $or['rermarks']?></td>
                  <td><?php echo $or['firstname'] . ' ' .$or['lastname']?></td>
                  <td>
                    <?php echo btnLink('returnOrder/show/'.$or['id'] , 'Show')?>
                  </td>
                </tr>
              <?php endforeach?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->