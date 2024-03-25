<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo (!empty($adminphoto)) ? $genrlimgpath.'admin.jpg' : $genrlimgpath.'admin.jpg'; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $admfname; ?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Menu</li>
      <li><a href="<?=$root_path;?>/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li><a href="<?=$root_path;?>/order/"><i class="fa fa-shopping-cart"></i> <span>Orders</span></a></li>
      <li><a href="<?=$root_path;?>/report/"><i class="fa fa-money"></i> <span>Reports</span></a></li>
      <li><a href="<?=$root_path;?>/user/"><i class="fa fa-users"></i> <span>Users</span></a></li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-barcode"></i>
          <span>Products</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=$root_path;?>/products"><i class="fa fa-circle-o"></i> Product List</a></li>
           <li><a href="<?=$root_path;?>/products/products.php"><i class="fa fa-circle-o"></i> Add Product</a></li>
           <li><a href="<?=$root_path;?>/products/outstock.php"><i class="fa fa-circle-o"></i> Out Stock Products</a></li>
        </ul>
      </li>
       <li class="treeview">
        <a href="#">
          <i class="fa fa-barcode"></i>
          <span>Setting</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
           <li><a href="<?=$root_path;?>/setting/category"><i class="fa fa-circle-o"></i> Category</a></li>
           <li><a href="<?=$root_path;?>/setting/subcategory"><i class="fa fa-circle-o"></i> SubCategory</a></li>
            <li><a href="<?=$root_path;?>/setting/model"><i class="fa fa-circle-o"></i> Model</a></li>
            <li><a href="<?=$root_path;?>/setting/orderstatus"><i class="fa fa-circle-o"></i> OrderStatus</a></li>
             <li><a href="<?=$root_path;?>/setting/slider"><i class="fa fa-circle-o"></i> Slider</a></li>
             <li><a href="<?=$root_path;?>/setting/themeoption"><i class="fa fa-circle-o"></i> General Setting</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>