
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <?php flash()?>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="userTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Type</th>
                    <th>Verification</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if($users): ?>                  
                      <?php foreach ($users as $key => $row): ?>
                        <tr>
                          <td><?php echo $row['username']?></td>
                          <td><?php echo $row['email']?></td>
                          <td><?php echo $row['firstname'] . ' ' .$row['lastname']?></td>
                          <td><?php echo $row['phone'] . ' ' .$row['lastname']?></td>
                          <td><?php echo $row['user_type']?></td>
                          <td><?php echo $row['verification_status']?></td>
                          <td>
                            <?php echo btnLink('users/edit/'.$row['id'] , 'Edit' , 'edit')?>
                          </td>
                        </tr>
                      <?php endforeach ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
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

  <script type="text/javascript">
    $(document).ready(function() {
      $('#userTable').DataTable();

      $("#mainUserNav").addClass('active');
      $("#manageUserNav").addClass('active');
    });
  </script>
