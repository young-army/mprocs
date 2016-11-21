<style>
.form-input{
	font-size:9pt !important
}
</style>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/excel-xp.css"/>
<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
				  <form method="post">
				   <div class="formGroup">
						<div class="formLabel">Purchase Requisition Number : </div>
						<div class="formInput"><input type="text" class="excelFormDiv"></div>
				   </div>
				   <div style="width:100%;overflow:auto;border-right:1px solid #C0C0C0;border-bottom:1px solid #C0C0C0">
                  <table id="" border="1" class="ExcelTableXP">
				    <thead>
						<tr>
						<th class="heading" style="width:27px">&nbsp;</th>
						<th>Material</th>
						<th>Short Text</th>
						<th>Quantity</th>
						<th>Account</th>
						<th>E</th>
						<th>F</th>
						<th>G</th>
						</tr>
					</thead>
					<tbody style="height:100px !important">
						<tr>
							<th style="padding:0px 8px">1</th>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><select class="excelForm" style="min-width:100px"></select></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
						</tr>
						<tr>
							<th style="padding:0px 8px">2</th>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><select class="excelForm" style="min-width:100px"></select></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
						</tr>
						<tr>
							<th style="padding:0px 8px">3</th>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><select class="excelForm" style="min-width:100px"></select></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
						</tr>
						<tr>
							<th style="padding:0px 8px">4</th>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><select class="excelForm" style="min-width:100px"></select></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
						</tr>
						<tr>
							<th style="padding:0px 8px">5</th>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><select class="excelForm" style="min-width:100px"></select></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
						</tr>
						<tr>
							<th style="padding:0px 8px">6</th>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><select class="excelForm" style="min-width:100px"></select></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
						</tr>
						<tr>
							<th style="padding:0px 8px">7</th>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><select class="excelForm" style="min-width:100px"></select></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
						</tr>
						<tr>
							<th style="padding:0px 8px">8</th>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><select class="excelForm" style="min-width:100px"></select></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
						</tr>
						<tr>
							<th style="padding:0px 8px">9</th>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><select class="excelForm" style="min-width:100px"></select></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
							<td><input type="text" class="excelForm"></td>
						</tr>
					</tbody>
					</table>
					</div>
					</form>
                </div><!-- /.box-body
				-->
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