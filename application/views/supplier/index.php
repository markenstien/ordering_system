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
    <div class="content">
      <?php flash()?>
       <a href="<?php echo base_url('supplier/create') ?>" class="btn btn-primary">Add Supplier</a>
          <br /> <br />
      <div class="box">
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped dataTable">
              <thead>
                <th>#</th>
                <th>Supplier</th>
                <th>Product</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Contact Name</th>
                <th>Action</th>
              </thead>

              <tbody>
                <?php foreach( $suppliers as $key => $row) :?>
                  <tr>
                    <td><?php echo ++$key?></td>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['product']?></td>
                    <td><?php echo $row['phone']?></td>
                    <td><?php echo $row['email']?></td>
                    <td><?php echo $row['contact_name']?></td>
                    <td>
                      <?php btnLink("supplier/show/{$row['id']}" , 'View' , 'view')?>
                      <?php btnLink("supplier/edit/{$row['id']}" , 'Edit' , 'edit')?>
                    </td>
                  </tr>
                <?php endforeach?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
    </div>
</div>
