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
		$.post('<?php echo base_url();?>book/stationery/save',$('#formData').serialize(),function(response){
			if(response=='S'){
				alert('Success');
				$('.box-book').removeClass('selected');
				$('.form-input').val('');
				num = 0;
				$.post('<?php echo base_url();?>book/stationery/getCount/<?php echo $this->session->userdata('trxnum');?>',function(total){
					$('#countCart').html(total);
				});
			}else{
				alert('Failed');
				$('.box-book').removeClass('selected');
				$('.form-input').val('');
				num = 0; 
				$.post('<?php echo base_url();?>book/stationery/getCount/<?php echo $this->session->userdata('trxnum');?>',function(total){
					$('#countCart').html(total);
				});
			}
		});
	});
	$.post('<?php echo base_url();?>book/stationery/getCount/<?php echo $this->session->userdata('trxnum');?>',function(total){
		$('#countCart').html(total);
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

function cart(trxnum){
	document.location.href='<?php echo base_url();?>book/stationery/cart/';
}

function order(code,name){
	$('#item_code').val(code);
	$('#item_name').val(name);
	$('#myModal').modal('show');
}
</script>
<?php 
function status($code){
	if($code==0){
		return 'Draft';
	}elseif($code==1){
		return 'Submitted And Waiting For Approval';
	}elseif($code==2){
		return 'Done';
	}
}
?>
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
                 <table id="operational_car" class="table table-bordered table-hover" style="font-size:9pt !important">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Trx Number</th>
                        <th>Status</th>
                        <th>#</th>
                      </tr>
                    </thead>
					<tbody>
						<?php $no = 1; foreach($data as $row){?>
						<tr>
							<td><?php echo $no;?></td> 
							<td><?php echo $row->trxnum;?></td>
							<td><?php echo status($row->status);?></td>
							<td>
							<a href="cart/<?php echo $row->trxnum;?>" class="btn btn-sm btn-primary"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;Detail</a>
							<?php if($row->status==0){?>
							<a href="submit/<?php echo $row->trxnum;?>" onclick="return confirm('Are You Sure?')" class="btn btn-sm btn-success"><i class="fa fa-check"></i>&nbsp;&nbsp;&nbsp;Submit</a>
							<?php } ?>
							</td>
						</tr>
						<?php $no++; } ?>
					</tbody>
					</table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div><!-- /.box -->
              </div><!-- /.box -->
<div class="modal fade mdl" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close exit" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Stationery Order Form</h4>
            </div>
                <div class="modal-body" style="">   
				<form id="formData" method="post" style="font-size:9pt !important">
					<div class="form-group">
                      <label for="exampleInputEmail1">Item Code</label>
					  <input type="hidden" class="form-control form-input" id="id" name="id">
					  <input type="hidden" class="form-control" id="trx_number" name="trx_number" value="<?php echo $this->session->userdata('trxnum');?>">
					  <input type="text" class="form-control form-input" id="item_code" name="item_code">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Item Name</label>
                      <input type="text" class="form-control form-input" id="item_name" name="item_name">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Total Order</label>
                      <input type="text" class="form-control form-input" id="total" name="total" placeholder="0">
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