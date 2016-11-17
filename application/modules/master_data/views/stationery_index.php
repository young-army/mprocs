<style>
.form-input{
	font-size:9pt !important
}
</style>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script>
$(document).ready(function(){
	var stationery = $('#stationery').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
    });
	$('#submit').click(function(){
		$.post('<?php echo base_url();?>master_data/stationery/save',$('#formData').serialize(),function(){
				stationery.fnClearTable();
				$.getJSON('<?php echo base_url();?>master_data/stationery/getData',function(data){
					stationery.fnAddData(data);
					$('.form-input').val('');
				});
		});
	});
	
});
function del(id){
	var con = confirm('Are You Sure?');
	if(con==true){
		$.post('<?php echo base_url();?>master_data/stationery/delete/'+id,function(){
			$.getJSON('<?php echo base_url();?>master_data/stationery/getData',function(data){
				var stationery = $('#stationery').dataTable({
					  "bPaginate": true,
					  "bLengthChange": false,
					  "bFilter": false,
					  "bSort": true,
					  "bInfo": true,
					  "bAutoWidth": false,
					  "bDestroy": true
				});
					stationery.fnClearTable();
					stationery.fnAddData(data);
			});
		});
	}
	}
function edit(id){
	$.getJSON('<?php echo base_url();?>master_data/stationery/getDetail/'+id,function(data){
		$('#id').val(data.id);
		$('#item_code').val(data.item_code);
		$('#item_name').val(data.item_name);
		$('#unit').val(data.unit);
		$('#myModal').modal('show');
	});
}
</script>
<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
				<a data-toggle="modal" href="#myModal" class="btn btn-success">Add New Stationery</a><br>
                  <table id="stationery" class="table table-bordered table-hover" style="font-size:9pt !important">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Unit</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody id="tRow">
					<?php $no=1; foreach($data as $row){?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->item_code;?></td>
						<td><?php echo $row->item_code;?></td>
						<td><?php echo $row->unit;?></td>
						<td>
						<button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id;?>')"><i class="fa fa-edit"></i></button>
						<button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id;?>')"><i class="fa fa-trash"></i></button>
						</td>
					</tr>
					<?php $no++; } ?>
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
                <h4 class="modal-title">Stationery</h4>
            </div>
                <div class="modal-body" style="">   
				<form id="formData" method="post" style="font-size:9pt !important">
					<div class="form-group">
                      <label for="exampleInputEmail1">Item Code</label>
                      <input type="hidden" class="form-control form-input" id="id" name="id">
                      <input type="text" class="form-control form-input" id="item_code" name="item_code" placeholder="Item Code">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Item Name</label>
                      <input type="text" class="form-control form-input" id="item_name" name="item_name" placeholder="Item Name">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Unit</label>
                      <input type="text" class="form-control form-input" id="unit" name="unit" placeholder="Unit">
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