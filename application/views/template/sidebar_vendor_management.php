<aside class="main-sidebar" style="">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url();?>assets/images/lippo.png" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <h4 style="font-family:Khand">PT Lippo Malls</h4>

              <!--a href="#"><i class="fa fa-circle text-success"></i> Online</a-->
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="">
              <a href="<?php echo base_url();?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a></li>
           <li>
        <a href="<?php echo base_url();?>vendor_management/vendor">
                <i class="fa fa-gears"></i> <span>Registration</span> 
              </a>
      </li>
		<!-- 	<li>
			  <a href="<?php echo base_url();?>vendor_management/">
                <i class="fa fa-gears"></i> <span>Approval</span> 
              </a>
      </li> -->
      <li>
        <a href="<?php echo base_url();?>pr">
                <i class="fa fa-gears"></i> <span>List Vendor</span> 
              </a>
      </li>
     <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i>
                <span>Red / Black List</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>vendor_management/vendor_redlist"><i class="fa fa-circle-o"></i> Redlist Vendor</a></li>
                <li><a href="<?php echo base_url();?>vendor_management/vendor_blacklist"><i class="fa fa-circle-o"></i> Blacklist Vendor</a></li>
               
              </ul>
      </li>
			 <li>
        <a href="<?php echo base_url();?>pr">
                <i class="fa fa-gears"></i> <span>Catalogue</span> 
              </a>
      </li>
			<!--li class="treeview">
              <a href="#">
                <i class="fa fa-money"></i>
                <span>Cost Center</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>acl/user"><i class="fa fa-circle-o"></i> ACL User</a></li>
                <li><a href="<?php echo base_url();?>acl/menu"><i class="fa fa-circle-o"></i> ACL Menu</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-money"></i>
                <span>Fund Center</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>acl/user"><i class="fa fa-circle-o"></i> ACL User</a></li>
                <li><a href="<?php echo base_url();?>acl/menu"><i class="fa fa-circle-o"></i> ACL Menu</a></li>
              </ul>
            </li-->
			<li>
			  <a href="<?php echo base_url();?>vendor_management/#">
                <i class="fa fa-money"></i> <span>Vendor Performance</span> 
              </a></li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>