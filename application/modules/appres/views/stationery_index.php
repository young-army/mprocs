<style>
.form-input{
	font-size:9pt !important
}
</style>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script>
$(document).ready(function(){
	var operational_car = $('#operational_car').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
    });
	$('#submit').click(function(){
		$.post('<?php echo base_url();?>master_data/operational_car/save',$('#formData').serialize(),function(){
				operational_car.fnClearTable();
				$.getJSON('<?php echo base_url();?>master_data/operational_car/getData',function(data){
					operational_car.fnAddData(data);
					$('.form-input').val('');
				});
		});
	});
	
});
function del(id){
	var con = confirm('Are You Sure?');
	if(con==true){
		$.post('<?php echo base_url();?>master_data/operational_car/delete/'+id,function(){
			$.getJSON('<?php echo base_url();?>master_data/operational_car/getData',function(data){
				var operational_car = $('#operational_car').dataTable({
					  "bPaginate": true,
					  "bLengthChange": false,
					  "bFilter": false,
					  "bSort": true,
					  "bInfo": true,
					  "bAutoWidth": false,
					  "bDestroy": true
				});
					operational_car.fnClearTable();
					operational_car.fnAddData(data);
			});
		});
	}
	}
function edit(id){
	$.getJSON('<?php echo base_url();?>master_data/operational_car/getDetail/'+id,function(data){
		$('#id').val(data.id);
		$('#v_num').val(data.v_num);
		$('#brand').val(data.brand);
		$('#type').val(data.type);
		$('#color').val(data.color);
		$('#capacity').val(data.capacity);
		$('#myModal').modal('show');
	});
}
</script>
<?php 
function status($code){
	if($code==0){
		return 'Draft';
	}elseif($code==1){
		return 'Waiting For Approval';
	}elseif($code==2){
		return 'Approved';
	}
}
?>
<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body"><br>
                  <table id="operational_car" class="table table-bordered table-hover" style="font-size:9pt !important">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>TRX Number</th>
                        <th>Status</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody id="tRow">
					<?php $no=1; foreach($data as $row){?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->trx_number;?></td>
						<td><?php echo status($row->status);?></td>
						<td>
						<a href="<?php echo base_url();?>appres/stationery/detail/<?php echo $row->trx_number;?>" class="btn btn-primary btn-xs"><i class="fa fa-check-square-o"></i> Detail</a>
						<?php if($row->status==1){?>
						<a href="<?php echo base_url();?>appres/stationery/approve/<?php echo $row->trx_number;?>" onclick="return confirm('Are You Sure ?')" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Approve</a>
						<?php }else{
							echo ' ';
						} ?>
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
                <h4 class="modal-title">Operational Car</h4>
            </div>
                <div class="modal-body" style="">   
				<form id="formData" method="post" style="font-size:9pt !important">
					<div class="form-group">
                      <label for="exampleInputEmail1">Vehicle Number</label>
                      <input type="hidden" class="form-control form-input" id="id" name="id">
                      <input type="text" class="form-control form-input" id="v_num" name="v_num" placeholder="Vehicle Number">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Brand</label>
                      <input type="text" class="form-control form-input" id="brand" name="brand" placeholder="Brand">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Variant/Type</label>
                      <input type="text" class="form-control form-input" id="type" name="type" placeholder="Variant/Type">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Color</label>
                      <input type="text" class="form-control form-input" id="color" name="color" placeholder="Color">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Capacity</label>
                      <input type="number" class="form-control form-input" id="capacity" name="capacity" placeholder="0">
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