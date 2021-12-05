  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Report</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Manage </a></li>
        <li class="active">Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-6 col-xs-12">
          <?php flash()?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Set Report</h3>
            </div>

            <div class="box-body">
              <?php __( f_open(['method' => 'post'])) ?>
              <div class="form-group row">
                <div class="col-md-6">
                  <?php
                    __( f_col(f_label('Start Date') , f_date('start_date' , '' , ['class' => 'form-control', 'requried' => true])) );
                  ?>
                </div>

                <div class="col-md-6">
                  <?php
                    __( f_col(f_label('End Date') , f_date('end_date' , '' , ['class' => 'form-control', 'requried' => true])) );
                  ?>
                </div>
              </div>

              <div class="form-group row">
               <div class="col-md-6">
                 <?php __( f_col(f_label('Report Type') , f_select('type' , ['Inventory' , 'Sales'] , '' , ['class' => 'form-control'])) ) ?>
               </div>
               <div class="col-md-6">
                 <?php __( f_col(f_label('Report Group') , f_select('order_group' , ['Daily' , 'Monthly' ,'Yearly'] , '' , ['class' => 'form-control'])) ) ?>
               </div>
              </div>

              <div class="form-group">
                <?php __( f_submit('' , 'Create Report') )?>
              </div>
              <?php __( f_close() )?>
              <form method="post"></form>
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