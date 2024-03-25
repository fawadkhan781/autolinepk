<header class="main-header">
  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>C</b>P</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Autoline</b>.pk</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="user-menu viewsite">
          <a href="<?=$homeurl;?>" target="_blank">
           <i class="fa fa-home" aria-hidden="true"></i>
            Visit Site
          </a>
        </li>
        <li class="dropdown user user-menu topMenuHover">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo (!empty($adminphoto)) ? $genrlimgpath.'admin.jpg' : $genrlimgpath.'admin.jpg'; ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $admfname; ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?php echo (!empty($adminphoto)) ? $genrlimgpath.'admin.jpg' : $genrlimgpath.'admin.jpg'; ?>" class="img-circle" alt="User Image">

              <p>
                <?php echo $admfname; ?>
                <small>Member since <?php echo date('M. Y', strtotime($_SESSION['created_on'])); ?></small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="#profile" data-toggle="modal" class="btn btn-primary btn-flat" id="admin_profile">Update</a>
              </div>
              <div class="pull-right">
                <a href="../logout.php" class="btn btn-danger btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>