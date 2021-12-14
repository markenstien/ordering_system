<header class="main-header">
    <!-- Logo -->
    <a href="http://localhost/stock-v2/dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>WLC</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>WELCOME</b></span>
    </a>
   <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          <?php if( $system_notifications ) :?>
            <li class="dropdown notifications-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning"><?php echo count($system_notifications)?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have <?php echo count($system_notifications)?> notifications</li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                    <?php foreach($system_notifications as $key => $notif) :?>
                      <?php if ($key > 5 ) break?>
                      <li>
                        <a href="<?php echo !empty($notif['href']) ? base_url($notif['href']) : '#'?>">
                          <i class="fa fa-users text-aqua"></i> <?php echo $notif['message']?>
                        </a>
                      </li>
                    <?php endforeach?>
                  </ul>
                </li>
                <li class="footer"><a href="#">View all</a></li>
              </ul>
            </li>
          <?php endif?>

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="https://icon-library.com/images/user-profile-icon/user-profile-icon-23.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"> <?php echo $user_data['firstname'] . ' '.$user_data['lastname']?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="https://icon-library.com/images/user-profile-icon/user-profile-icon-23.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $user_data['firstname'] . ' '.$user_data['lastname']?>
                  <small><?php echo $user_data['user_type']?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url('users/profile')?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('auth/logout')?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
</header>
  <!-- Left side column. contains the logo and sidebar -->
  