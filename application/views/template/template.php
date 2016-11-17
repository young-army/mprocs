<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Lippo e-Procurement</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<?php 
	if($this->uri->segment(1)=='book'){
	$this->load->view('template/css_form');	
	}else{
	$this->load->view('template/css');
	}
	?>
  </head>
  <!--body class="skin-blue"-->
  <?php if($this->uri->segment(1)=='' or $this->uri->segment('dashboard')){?>
  <body class="skin-blue sidebar-collapse fixed">
  <?php }else{ ?>
  <body class="skin-blue">
  <?php } ?>
    <div class="wrapper">
      <?php $this->load->view($header);?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php $this->load->view($menu);?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper"  style="background:whitesmoke !important">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 style="font-family:Khand">
            <?php //echo $big_header;?>
            <small style="font-family:Khand"><?php //echo $small_header;?></small>
          </h1>
          <!--ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol-->
        </section>

        <!-- Main content -->
        <section class="content">
          <?php $this->load->view($content);?>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer-->
    </div><!-- ./wrapper -->
	<?php 
	if($this->uri->segment(1)=='book'){
	$this->load->view('template/js_form');	
	}else{
	$this->load->view('template/js');
	}
	?>
  </body>
</html>