<style>
.form-input{
	font-size:9pt !important
}
</style>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script>
$(document).ready(function(){
	var cost_table = $('#cost_table').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
    });
	$('#submit').click(function(){
		$.post('<?php echo base_url();?>systems/cost_center/save',$('#formData').serialize(),function(){
				cost_table.fnClearTable();
				$.getJSON('<?php echo base_url();?>systems/cost_center/getData',function(data){
					cost_table.fnAddData(data);
					$('.form-input').val('');
				});
		});
	});
	
});
function del(id){
	var con = confirm('Are You Sure?');
	var cost_tables = $('#cost_table').dataTable();
	if(con==true){
		$.post('<?php echo base_url();?>systems/cost_center/delete/'+id,function(){
				cost_tables.fnClearTable();
				$.getJSON('<?php echo base_url();?>systems/cost_center/getData',function(data){
					cost_tables.fnAddData(data);
					$('.form-input').val('');
				});
		});
	}
	}
function edit(id){
	$.getJSON('<?php echo base_url();?>systems/cost_center/getDetail/'+id,function(data){
		$('#id').val(data.id);
		$('#company').val(data.company_code);
		$('#cost_center').val(data.cost_center);
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
				<a data-toggle="modal" href="#myModal" class="btn btn-success">Add Cost Center</a><br><br>
                  <table id="cost_table" class="table table-bordered table-hover" style="font-size:9pt !important">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Company</th>
                        <th>Cost Center</th>
                        <th>Description</th>
                        <th>Valid From</th>
                        <th>Valid To</th>
                        <th>Manager</th>
                        <th>Email</th>
                        <th>#</th>
                      </tr>
                    </thead>
						<?php $no=1; foreach($data as $row){?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $row->company_name;?></td>
								<td><?php echo $row->cost_center;?></td>
								<td><?php echo $row->description;?></td>
								<td><?php echo $row->valid_from;?></td>
								<td><?php echo $row->valid_to;?></td>
								<td><?php echo $row->mng_name;?></td>
								<td><?php echo $row->mng_email;?></td>
								<td>
								<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id;?>')"><i class="fa fa-edit"></i></button>
								<button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id;?>')"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
						<?php $no++; } ?>
                    <tbody id="tRow">
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div><!-- /.box -->
              </div><!-- /.box -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close exit" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Cost Center Form</h4>
            </div>
                <div class="modal-body" style="">   
				<form id="formData" method="post" style="font-size:9pt !important">
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
                      <input type="text" class="form-control form-input" id="cost_center" name="cost_center" placeholder="Cost Center">
                    </div>
					<div class="form-group" style="margin-top:-10px">
                      <label for="exampleInputEmail1">Description</label>
                      <input type="text" class="form-control form-input" id="description" name="description" placeholder="Description">
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
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default exit" data-dismiss="modal">Exit</button>
                    <input type="submit" class="btn btn-primary" value="Save"  data-dismiss="modal" id="submit"/>
                </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->