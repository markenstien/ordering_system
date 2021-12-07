<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <?php $type = e_user_type($this->data['user_data']);?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        
          <li id="dashboardMainMenu">
            <a href="<?php echo base_url('dashboard') ?>">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>

          <?php if(isEqual($type,'admin')) :?>
            <li class="treeview" id="mainUserNav">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Users</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li id="createUserNav"><a href="<?php echo base_url('users/create') ?>"><i class="fa fa-circle-o"></i> Add User</a></li>
                <li id="manageUserNav"><a href="<?php echo base_url('users') ?>"><i class="fa fa-circle-o"></i> Manage Users</a></li>
              </ul>
            </li>
          <?php endif?>

          <?php if(isEqual($type,'admin')) :?>
          <li class="treeview" id="supplyNav">
            <a href="#">
              <i class="fa fa-cube"></i>
              <span>Supplies</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
               <li id="supplierNav"><a href="<?php echo base_url('supplier/index') ?>"><i class="fa fa-circle-o"></i> Supplier </a></li>
               <li id="supplierNav"><a href="<?php echo base_url('supplyOrder/index') ?>"><i class="fa fa-circle-o"></i> Supply Order </a></li>
            </ul>
          </li>
          <?php endif?>

          <?php if(isEqual($type,'admin')) :?>
          <li id="categoryNav">
            <a href="<?php echo base_url('category/') ?>">
              <i class="fa fa-files-o"></i> <span>Category</span>
            </a>
          </li>

          <li id="attributeNav">
            <a href="<?php echo base_url('attributes/') ?>">
              <i class="fa fa-files-o"></i> <span>Attributes</span>
            </a>
          </li>
          <?php endif?>

          <?php if(!isEqual($type,'customer')) :?>
          <li class="treeview" id="mainProductNav">
            <a href="#">
              <i class="fa fa-cube"></i>
              <span>Products</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="addProductNav"><a href="<?php echo base_url('products/index') ?>"><i class="fa fa-circle-o"></i>Products</a></li>
              <li id="addProductNav"><a href="<?php echo base_url('ProductBundle/index') ?>"><i class="fa fa-circle-o"></i> Bundles</a></li>
            </ul>
          </li>
          <?php endif?>

          <?php if(isEqual($type,'admin')) :?>
          <li id="idStockNav">
            <a href="<?php echo base_url('stocks/index') ?>">
              <i class="fa fa-files-o"></i> <span>Stocks</span>
            </a>
          </li>
          <?php endif?>
          <?php if(isEqual($type,['admin' , 'employee'])) :?>
            <li class="treeview" id="mainOrdersNav">
              <a href="#">
                <i class="fa fa-dollar"></i>
                <span>Orders</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
               <li id="addOrderNav"><a href="<?php echo base_url('orders/create') ?>"><i class="fa fa-circle-o"></i> Add Order</a></li>
               <li id="manageOrdersNav"><a href="<?php echo base_url('orders') ?>"><i class="fa fa-circle-o"></i> Manage Orders</a></li>
              </ul>
            </li>
          <?php endif?>

          <?php if(isEqual($type,['admin'])) :?>
            <li id="idDeliveryNav">
            <a href="<?php echo base_url('delivery/index') ?>">
              <i class="fa fa-files-o"></i> <span>Deliveries</span>
            </a>
          </li>
          <?php endif?>

          <?php if(isEqual($type,['admin' , 'customer'])) :?>
          <li id="idOrdersNav">
            <a href="<?php echo base_url('landing/index') ?>">
              <i class="fa fa-files-o"></i> <span>Catalog</span>
            </a>
          </li>

          <li id="idOrdersNav">
            <a href="<?php echo base_url('orders/index') ?>">
              <i class="fa fa-files-o"></i> <span>Orders</span>
            </a>
          </li>

          <li id="idPaymentsNav">
            <a href="<?php echo base_url('payment/index') ?>">
              <i class="fa fa-files-o"></i> <span>Payments</span>
            </a>
          </li>
          <?php endif?>
          <?php if(isEqual($type,'admin')) :?>
            <li class="treeview" id="mainOrdersNav">
              <a href="#">
                <i class="fa fa-dollar"></i>
                <span>Reports</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
               <li id="addOrderNav"><a href="<?php echo base_url('reports/') ?>"><i class="fa fa-circle-o"></i> Simple </a></li>
               <li id="manageOrdersNav"><a href="<?php echo base_url('reports/advance') ?>"><i class="fa fa-circle-o"></i> Advance</a></li>
              </ul>
            </li>
          <?php endif?>

          <?php if(isEqual($type,'admin')) :?>
          <li id="companyNav"><a href="<?php echo base_url('company/') ?>"><i class="fa fa-files-o"></i> <span>Company</span></a></li>
          <li id="companyNav"><a href="<?php echo base_url('toc/') ?>"><i class="fa fa-files-o"></i> <span>Terms And Condition</span></a></li>
          <!-- <li><a href="<?php echo base_url('users/setting/') ?>"><i class="fa fa-wrench"></i> <span>Setting</span></a></li> -->
          <?php endif?>
          <li><a href="<?php echo base_url('users/profile/') ?>"><i class="fa fa-user-o"></i> <span>Profile</span></a></li>
        <!-- user permission info -->
        <li><a href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <span>Logout</span></a></li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>