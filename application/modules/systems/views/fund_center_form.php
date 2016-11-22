<style>
.form-input{
	font-size:9pt !important
}
</style>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script>
$(document).ready(function(){
		$('#company').change(function(){
			$.post('<?php echo base_url();?>systems/fund_center/getCostCenter/'+$(this).val(),function(data){
				$('#cost_center').html(data);
			});
		});
});
</script>
<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body" style="padding:30px">
				<form id="formData"  method="post" style="font-size:9pt !important">
					<div class="form-group">
                      <label for="exampleInputEmail1">Company</label>
                      <input type="hidden" class="form-control form-input" id="id" name="id">
                      <select class="form-control form-input" name="company" id="company">
						<option></option>
						<?php foreach($company as $row){?>
							<option value="<?php echo $row->company_code;?>"><?php echo $row->company_name;?></option>
						<?php } ?>
					  </select>
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Cost Center</label>
                     <select class="form-control form-input" name="cost_center" id="cost_center">
						<option value=""></option>
					  </select>
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Type</label>
                      <select class="form-control form-input" name="type" id="type">
						<option value="1">Cost Center</option>
						<option value="2">Project</option>
					  </select>
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Fund Center</label>
                      <input type="text" class="form-control form-input" id="fund_center" name="fund_Center" placeholder="Manager">
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Descrition</label>
                      <input type="text" class="form-control form-input" id="description" name="description" placeholder="Manager">
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Fiscal</label>
                      <input type="text" class="form-control form-input" id="fiscal" name="fiscal" placeholder="Manager Email">
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Amount</label>
                      <input type="text" class="form-control form-input" id="amount" name="amount" placeholder="Manager">
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Currency</label>
                      <input type="text" class="form-control form-input" id="currency" name="currency" placeholder="Manager">
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Level</label>
                      <input type="text" class="form-control form-input" id="level" name="level" placeholder="Manager">
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Header</label>
                      <input type="text" class="form-control form-input" id="header" name="header" placeholder="Manager">
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Manager</label>
                      <input type="text" class="form-control form-input" id="manager" name="manager" placeholder="Manager">
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="text" class="form-control form-input" id="email" name="email" placeholder="Manager">
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">&nbsp;</label>
                      <button class="btn btn-primary" style="margin-left:-6px;margin-top:10px">Save Fund Center</button>
                    </div>
				</form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div><!-- /.box -->
              </div><!-- /.box -->