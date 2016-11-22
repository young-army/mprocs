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
			$.post('<?php echo base_url();?>systems/fund_center/getFundCenter/'+$(this).val(),function(data){
				$('#header').html(data);
			});
		});
		$('#type').change(function(){
			if($(this).val()==1){
				var cost = $('#cost_center').val().split('-');
				$('#fund_center').val(cost[0]);
				$('#description').val(cost[1]);
			}
		});
		$('#amount').keyup(function(){
			$(this).val(addCommas($(this).val()));
		})
});
function addCommas(str) {
	str = str.replace(/,/g,'');
	str = parseInt(str);
	if(isNaN(str)){
		str = 0;
	}
    var parts = (str + "").split("."),
        main = parts[0],
        len = main.length,
        output = "",
        i = len - 1;

    while(i >= 0) {
        output = main.charAt(i) + output;
        if ((len - i) % 3 === 0 && i > 0) {
            output = "," + output;
        }
        --i;
    }
    // put decimal part back
    if (parts.length > 1) {
        output += "." + parts[1];
    }
    return output;
}
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
						<option value="">-- Select Company --</option>
						<?php foreach($company as $row){?>
							<option value="<?php echo $row->company_code;?>"><?php echo $row->company_name;?></option>
						<?php } ?>
					  </select>
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Cost Center</label>
                     <select class="form-control form-input" name="cost_center" id="cost_center">
						<option value="">-- Select Cost Center --</option>
					  </select>
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Type</label>
                      <select class="form-control form-input" name="type" id="type">
						<option value="">-- Select Type --</option>
						<option value="1">Cost Center</option>
						<option value="2">Project</option>
					  </select>
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Fund Center</label>
                      <input type="text" class="form-control form-input" id="fund_center" name="fund_Center" placeholder="Fund Center">
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Descrition</label>
                      <input type="text" class="form-control form-input" id="description" name="description" placeholder="Description">
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Fiscal</label>
                      <input type="number" class="form-control form-input" id="fiscal" name="fiscal" value="<?php echo date('Y');?>">
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Amount</label><br>
                      <input type="text" class="form-control form-input" id="amount" name="amount" value="0" style="width:69%;margin-right:1%;float:left">
					  <select class="form-control form-input" name="currency" id="currency" style="width:30%">
						<option value="">-- Select Currency --</option>
						<?php foreach($currency as $row){?>
							<option value="<?php echo $row->currency;?>"><?php echo $row->currency." - ".$row->descs;?></option>
						<?php } ?>
					  </select>
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Level</label>
                      <input type="text" class="form-control form-input" id="level" name="level" placeholder="Level" value="0">
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Header</label>
                      <select class="form-control form-input" name="header" id="header">
						<option value="">-- Select Header --</option>
					  </select>
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Manager</label>
                      <input type="text" class="form-control form-input" id="manager" name="manager" placeholder="Manager">
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="text" class="form-control form-input" id="email" name="email" placeholder="Manager Email">
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