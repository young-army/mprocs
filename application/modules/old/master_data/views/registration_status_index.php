<style>
.form-input{
  font-size:9pt !important
}
</style>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script>
$(document).ready(function(){
  var registration_status = $('#registration_status').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
    });
  $('#myModal').on('hidden.bs.modal', function () {
    $(this).find('#registration_status_name').val('').end();

});
  $('#submit').click(function(){
    $.post('<?php echo base_url();?>master_data/registration_status/save',$('#formData').serialize(),function(){
        registration_status.fnClearTable();
      /*  $.getJSON('<?php echo base_url();?>master_data/company/getData',function(data){
          company.fnAddData(data);
          $('.form-input').val('');
        });*/
        window.location.href = "<?php echo site_url('/master_data/registration_status'); ?>";   
    }); 
  });
  
});

function del(id_registration_status){
  var con = confirm('Are You Sure?');
  if(con==true){
    $.post('<?php echo base_url();?>master_data/registration_status/delete/'+id_registration_status,function(){
      $.getJSON('<?php echo base_url();?>master_data/registration_status/getData',function(data){
        var registration_status = $('#registration_status').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
            "bDestroy": true
        });
          registration_status.fnClearTable();
          registration_status.fnAddData(data);
      });
    });
  }
  }
function edit(id_registration_status){
  $.getJSON('<?php echo base_url();?>master_data/registration_status/getDetail/'+id_registration_status,function(data){
    $('#id_registration_status').val(data.id_registration_status);
    $('#status').val(data.status);
    $('#myModal').modal('show');
  });
}
</script>
<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
        <a data-toggle="modal" href="#myModal" class="btn btn-success">Add New Registration Status</a><br>
                  <table id="registration_status" class="table table-bordered table-hover" style="font-size:9pt !important">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Status</th>
                        <th>Change Date</th>
                        <th>Change By</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody id="tRow">
          <?php $no=1; foreach($data as $row){?>
          <tr>
            <td><?php echo $no;?></td>
             <td><?php echo $row->status;?></td>
             <td><?php echo $row->create_date;?></td>
            <td><?php echo $row->username;?></td>
            <td>
            <button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_registration_status;?>')"><i class="fa fa-edit"></i></button>
            <button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id_registration_status;?>')"><i class="fa fa-trash"></i></button>
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
                <h4 class="modal-title">Registration Status</h4>
            </div>
                <div class="modal-body" style="">   
        
        <form id="formData" method="post" style="font-size:9pt !important" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Status</label>

                  <div class="col-sm-8">
                    <input type="hidden" class="form-control form-input" id="id_registration_status" name="id_registration_status">
                       <input type="text" class="form-control input-sm form-input" id="status" name="status" placeholder="Registration Status Code">
                  </div>
                </div>
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