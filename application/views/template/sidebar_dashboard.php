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
			  <a href="<?php echo base_url();?>pr">
                <i class="fa fa-file-text-o"></i> <span>Purchase Requisition</span> 
              </a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Vendor Management</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>vendor/registration"><i class="fa fa-circle-o"></i> Vendor Registration</a></li>
				<li><a href="<?php echo base_url();?>vendor/verification"><i class="fa fa-circle-o"></i> Vendor Verification</a></li>
                <li><a href="<?php echo base_url();?>vendor/lists"><i class="fa fa-circle-o"></i> Vendor List</a></li>  
              </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Master Data</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>vendor/registration"><i class="fa fa-circle-o"></i> Company</a></li>
				<li><a href="<?php echo base_url();?>vendor/verification"><i class="fa fa-circle-o"></i> Department</a></li>
                <li><a href="<?php echo base_url();?>vendor/lists"><i class="fa fa-circle-o"></i> Material Master</a></li>  
              </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-gears"></i>
                <span>Setting</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>acl/user"><i class="fa fa-circle-o"></i> ACL User</a></li>
                <li><a href="<?php echo base_url();?>acl/menu"><i class="fa fa-circle-o"></i> ACL Menu</a></li>
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>