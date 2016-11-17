<style>
.form-input{
	font-size:9pt !important
}
</style>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script>
$(document).ready(function(){
	var meetroom_tbl = $('#meetroom_tbl').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
    });
	$('#submit').click(function(){
		$.post('<?php echo base_url();?>master_data/meeting_room/save',$('#formData').serialize(),function(){
				meetroom_tbl.fnClearTable();
				$.getJSON('<?php echo base_url();?>master_data/meeting_room/getData',function(data){
					meetroom_tbl.fnAddData(data);
					$('.form-input').val('');
				});
		});
	});
	
});
function del(id){
	var con = confirm('Are You Sure?');
	if(con==true){
		$.post('<?php echo base_url();?>master_data/meeting_room/delete/'+id,function(){
			$.getJSON('<?php echo base_url();?>master_data/meeting_room/getData',function(data){
				var meetroom_tbl = $('#meetroom_tbl').dataTable({
					  "bPaginate": true,
					  "bLengthChange": false,
					  "bFilter": false,
					  "bSort": true,
					  "bInfo": true,
					  "bAutoWidth": false,
					  "bDestroy": true
				});
					meetroom_tbl.fnClearTable();
					meetroom_tbl.fnAddData(data);
			});
		});
	}
	}
function edit(id){
	$.getJSON('<?php echo base_url();?>master_data/meeting_room/getDetail/'+id,function(data){
		$('#id').val(data.id);
		$('#room_code').val(data.room_code);
		$('#room_name').val(data.room_name);
		$('#floor').val(data.floor);
		$('#capacity').val(data.capacity);
		$('#myModal').modal('show');
	});
}
</script>
<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
				<a data-toggle="modal" href="#myModal" class="btn btn-success">Add New Meeting Room</a><br>
                  <table id="meetroom_tbl" class="table table-bordered table-hover" style="font-size:9pt !important">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Room Code</th>
                        <th>Room Name</th>
                        <th>Floor</th>
                        <th>Capacity</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody id="tRow">
					<?php $no=1; foreach($data as $row){?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $row->room_code;?></td>
						<td><?php echo $row->room_name;?></td>
						<td><?php echo $row->floor;?></td>
						<td><?php echo $row->capacity;?> Persons</td>
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
                <h4 class="modal-title">Meeting Room</h4>
            </div>
                <div class="modal-body" style="">   
				<form id="formData" method="post" style="font-size:9pt !important">
					<div class="form-group">
                      <label for="exampleInputEmail1">Room Code</label>
                      <input type="hidden" class="form-control form-input" id="id" name="id">
                      <input type="text" class="form-control form-input" id="room_code" name="room_code" placeholder="Room Code">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Room Name</label>
                      <input type="text" class="form-control form-input" id="room_name" name="room_name" placeholder="Room Name">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Floor</label>
                      <input type="text" class="form-control form-input" id="floor" name="floor" placeholder="Floor">
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