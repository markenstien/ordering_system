

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Toc</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Toc</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php flash()?>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-5">
          <div class="box">
            <div class="box-header">TOC FORM</div>
            <div class="box-body">
              <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Display Name</label>
                  <input type="text" name="display_name" class="form-control">
                </div>

                <div class="form-group">
                  <label>Description</label>
                  <input type="text" name="description" class="form-control">
                </div>

                <div class="form-group">
                  <label>TOC PDF Document</label>
                  <input type="file" name="file" class="form-control">
                </div>

                <input type="submit" name="" class="btn btn-primary" value="Upload Toc">
              </form>
            </div>
          </div>
        </div>

        <div class="col-md-7">
          <div class="box">
            <div class="box-header">TOC</div>
            <div class="box-body">
              <object data="<?php echo base_url().$toc_file['full_path']?>" style="width: 100%; height:100vh"></object>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function() {
    $("#groups").select2();

    $("#mainUserNav").addClass('active');
    $("#createUserNav").addClass('active');
  
  });
</script>
