<style>
.form-input{
	font-size:9pt !important
}
</style>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script>
$(document).ready(function(){
	var fund_table = $('#fund_table').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
    });
	$('#submit').click(function(){
		$.post('<?php echo base_url();?>systems/fund_center/save',$('#formData').serialize(),function(){
				fund_table.fnClearTable();
				$.getJSON('<?php echo base_url();?>systems/fund_center/getData',function(data){
					fund_table.fnAddData(data);
					$('.form-input').val('');
				});
		});
	});
	
});
function del(id){
	var con = confirm('Are You Sure?');
	var fund_table = $('#fund_table').dataTable();
	if(con==true){
		$.post('<?php echo base_url();?>systems/fund_center/delete/'+id,function(){
				fund_table.fnClearTable();
				$.getJSON('<?php echo base_url();?>systems/fund_center/getData',function(data){
					fund_table.fnAddData(data);
					$('.form-input').val('');
				});
		});
	}
	}
function edit(id){
	$.getJSON('<?php echo base_url();?>systems/fund_center/getDetail/'+id,function(data){
		$('#id').val(data.id);
		$('#company').val(data.company_code);
		$('#fund_center').val(data.fund_center);
		$('#description').val(data.description);
		$('#valid_from').val(data.valid_from);
		$('#valid_until').val(data.valid_to);
		$('#manager').val(data.mng_name);
		$('#mng_email').val(data.mng_email);
		$('#myModal').modal('show');
	});
}
</script>
<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
				<form id="formData" class="form-horizontal" method="post" style="font-size:9pt !important">
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
                     
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Type</label>
                      <select class="form-control form-input" name="type" id="type">
						<option value="1">Cost Center</option>
						<option value="2">Project</option>
					  </select>
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Valid From</label>
                      <div class="input-group">
                      <input type="text" class="form-control pull-right form-input datepicker" id="valid_from" name="valid_from"/><div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                    </div>
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Valid Until</label>
                      <div class="input-group">
                      <input type="text" class="form-control pull-right form-input datepicker" id="valid_until" name="valid_until"/><div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                    </div>
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Manager</label>
                      <input type="text" class="form-control form-input" id="manager" name="manager" placeholder="Manager">
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Manager Email</label>
                      <input type="text" class="form-control form-input" id="mng_email" name="mng_email" placeholder="Manager Email">
                    </div>
				</form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div><!-- /.box -->
              </div><!-- /.box -->