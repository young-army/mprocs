<style>
.box-book:hover{
	background:#F39C12;
	color:white;border:none !important;cursor:pointer
}
.selected{
	background:#DD4B39 !important;
	color:white !important;border:none !important
}
</style>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script>
$(document).ready(function(){
	$('#submit').click(function(){
		$.post('<?php echo base_url();?>book/meeting_room/save',$('#formData').serialize(),function(response){
			if(response=='S'){
				alert('Sucess');
				$('.box-book').removeClass('selected');
				$('.form-input').val('');
				num = 0;
			}else{
				alert('Failed');
				$('.box-book').removeClass('selected');
				$('.form-input').val('');
				num = 0; 
			}
		});
	});
});
var num = 0;
var codes = null;
function check(id,code,name){
	num = 1;
	$('#radio'+id).prop('checked',true);
	if($('#radio'+id).is(':checked')==true){
		$('.box-book').removeClass('selected');
		$('#box-book'+id).addClass('selected')
		$('#room_descs').val(code+'-'+name);
		codes = code;
	}
}

function validate(act,id){
	if(num==0){
		alert('Choose Room First!');
	}else{
		$('#myModal').modal('show');
	}
}

function detail(code){
	if(num==0){
		alert('Choose Room First!');
	}else{
		document.location.href="<?php echo base_url();?>detail/meeting_room/"+code;
	}
}
</script>
<div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">CPU Traffic</span>
                  <span class="info-box-number">90<small>%</small></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Likes</span>
                  <span class="info-box-number">41,410</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Sales</span>
                  <span class="info-box-number">760</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">New Members</span>
                  <span class="info-box-number">2,000</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body"><br>
                  <table id="meetroom_tbl" class="table" style="font-size:9pt !important">
                    <tr>
					<?php $no=1; foreach($data as $row){?>
						<?PHP IF($no%6==0){?>
						</tr><tr>
						<?php } ?>
						<td  style="text-align:center;padding:0px;width:20%">
							<div style="margin:2px;padding:20px 0px;height:100%;border:1px solid gray;border-radius:5px" class="box-book"  onclick="check('<?php echo $no;?>','<?php echo $row->room_code;?>','<?php echo $row->room_name;?>')" id="box-book<?php echo $no;?>">
							<i class="fa fa-building-o" style="font-size:30pt"></i><br>
							<input type="radio" name="room" class="room" style="display:none" value="<?php echo $row->room_code;?>" id="radio<?php echo $no;?>">
							<h5 style="font-family:Khand"><?php echo $row->room_name;?> / <?php echo $row->floor;?> Floor</h5>
							<h6 style="font-family:Khand">Capacity : <?php echo $row->capacity;?> Persons</h6>
							
							</div>
						</td>
					 
					<?php $no++; } ?>
					</tr>
                  </table><br>
				  <button class="btn btn-success" onclick="detail(codes)">View Book Schedule</button>
				  <button class="btn btn-primary" onclick="validate()">Book</button>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div><!-- /.box -->
              </div><!-- /.box -->
<div class="modal fade mdl" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close exit" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Meeting Room Booking Form</h4>
            </div>
                <div class="modal-body" style="">   
				<form id="formData" method="post" style="font-size:9pt !important">
					<div class="form-group">
                      <label for="exampleInputEmail1">Room Code/Name</label>
					  <input type="hidden" class="form-control form-input" id="id" name="id">
					  <input type="text" class="form-control form-input" id="room_descs" name="room_descs">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Book Date</label>
                      <div class="input-group">
                      <input type="text" class="form-control pull-right form-input" id="datepicker" name="book_date"/><div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                    </div>
                    </div>
                    <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>Start Time</label>
                      <div class="input-group">
                        <input type="text" class="form-control timepicker form-input" name="start_time" id="start_time"/>
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i> 
                        </div>
                      </div><!-- /.input group -->
                    </div><!-- /.form group -->
                    </div><!-- /.form group -->
					<div class="bootstrap-timepicker">
					<div class="form-group">
                      <label>End Time:</label>
                      <div class="input-group">
                        <input type="text" class="form-control timepicker form-input" name="end_time" id="end_time"/>
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i> 
                        </div>
                      </div><!-- /.input group -->
                    </div><!-- /.form group -->
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Total Person</label>
                      <input type="number" class="form-control form-input" id="total_prs" name="total_prs" placeholder="0">
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