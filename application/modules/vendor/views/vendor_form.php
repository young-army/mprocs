<?php 
$code = '';
$code_vendor = '';
if($this->uri->segment(3) == 'add') {
	$code = kode_registration_vendor(); 
	$code_vendor = kode_vendor();
}
else { $code = $rc->register_num; 
	$code_vendor = $rc->vendor_code; }
?>
<!--
<div class="row">
	<div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Collapsible Accordion</h3>
            </div>
         
            <div class="box-body">
              <div class="box-group" id="accordion">
         
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Collapsible Group Item #1
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="btn btn-primary btn-xs">
                        Next
                      </a>
                    </div>
                  </div>
                </div>
                <div class="panel box box-danger">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        Collapsible Group Danger  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="btn btn-primary btn-xs">
                        Prev
                      </a>
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="box-body">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </div>
                  </div>
                </div>
                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        Collapsible Group Success
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse">
                    <div class="box-body">
                     Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                     tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                     quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                     consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                     cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                     proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </div>
                  </div>
                </div>
              </div>
            </div>
     
          </div>
    
        </div>
</div>
-->

<div class="row">
	
	  <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
    <!--  <form id="formData" method="post" style="font-size:9pt !important" class="form-horizontal"> -->
    		<?php echo form_open($act, array('class' => 'form-horizontal')); ?>
   <!--   <form action="<?php echo $this->page->base_url();?>/insert/" method="post" class="form-horizontal">  -->
              <div class="box-body">
              <!-- <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-2">Company</label>

                  <div class="col-sm-8">
                  <input type="text" class="form-control form-input" id="register_num" name="register_num" value="<?php echo $code; ?>">
                   <input type="hidden" class="form-control form-input" id="id_vendor" name="id_vendor">
                  </div>
                </div> -->
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-2">Register Number</label>

                  <div class="col-sm-8">
                  <input type="hidden" class="form-control form-input" id="id_vendor" name="id_vendor">
                    <input type="hidden" class="form-control form-input" id="vendor_code" name="vendor_code" value="<?php echo $code_vendor; ?>">
                   <input type="text" class="form-control form-input" id="register_num" name="register_num" value="<?php echo $code; ?>" readonly required value="<?php echo $rc->vendor_name;?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-2">Vendor Name</label>

                  <div class="col-sm-8">
                       <input type="text" class="form-control input-sm form-input" id="vendor_name" name="vendor_name" placeholder="Vendor Name" required value="<?php echo $rc->vendor_name;?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-2">Supplier Address</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="supplier_address" name="supplier_address" placeholder="Supplier Address" required value="<?php echo $rc->vendor_name;?>">
                    <br><br>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-2">Phone Number</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="phone_number" name="phone_number" placeholder="Phone Number" required value="<?php echo $rc->vendor_name;?>">
                    <br><br>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-2">Fax Number</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="fax_number" name="fax_number" placeholder="Fax Number" required value="<?php echo $rc->vendor_name;?>">
                    <br><br>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-2">Email Address</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="email_address" name="email_address" placeholder="Email Address" required value="<?php echo $rc->vendor_name;?>">
                    <br><br>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-2">Country</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="country" name="country" placeholder="Country" required value="<?php echo $rc->vendor_name;?>">
                    <br><br>
                  </div>
                </div>
                <br><br><br>
                 <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-2">Contact Person</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="contact_person" name="contact_person" placeholder="Contact Person" required value="<?php echo $rc->vendor_name;?>">
                    <br><br>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-2">Mobile Phone</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="mobile_phone" name="mobile_phone" placeholder="Mobile Phone" required value="<?php echo $rc->vendor_name;?>">
                    <br><br>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-2">Email</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="email_person" name="email_person" placeholder="Email" required value="<?php echo $rc->vendor_name;?>">
                    <br><br>
                  </div>
                </div>
               
              <div class="modal-footer">
                    <button type="submit" class="btn btn-small btn-primary">
						<i class="icon-save"></i>
						<?php echo "Save"; ?>
					</button>
                </div>
              </div>
            <!--    
            </form> --> 
          <?php echo form_close(); ?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div><!-- /.box -->
</div>