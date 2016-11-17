<aside class="main-sidebar" style="">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url();?>assets/images/lippo.png" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <h4 style="font-family:Khand">Lippo Procurement</h4>

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
			 <li class="">
              <a href="<?php echo base_url();?>book/meeting_room">
                <i class="fa fa-building-o"></i> <span>Meeting Room</span> 
              </a></li>
			  <li class="">
              <a href="<?php echo base_url();?>book/operational_car">
                <i class="fa fa-truck"></i> <span>Operational Car</span> 
              </a></li>
			   <li class="">
              <a href="<?php echo base_url();?>book/stationery">
                <i class="fa fa-rocket"></i> <span>Stationery</span> 
              </a></li>
			   <li class="">
              <a href="<?php echo base_url();?>pr">
                <i class="fa fa-file-text-o"></i> <span>Purchase Requisition</span> 
              </a></li>
			 <?php if($this->session->userdata('sess_login')->level==1){?>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-check-square-o"></i>
                <span>Reservation & Approval</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>appres/operational_car"><i class="fa fa-circle-o"></i> Operational Car</a></li>
                <li><a href="<?php echo base_url();?>appres/stationery"><i class="fa fa-circle-o"></i> Stationery</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i>
                <span>Master Data</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>master_data/meeting_room"><i class="fa fa-circle-o"></i> Meeting Room</a></li>
                <li><a href="<?php echo base_url();?>master_data/operational_car"><i class="fa fa-circle-o"></i> Operational Car</a></li>
                <li><a href="<?php echo base_url();?>master_data/stationery"><i class="fa fa-circle-o"></i> Stationery</a></li>
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
			 <?php } ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>