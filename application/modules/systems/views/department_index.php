<?php 
$code = kode_department();
?>

<style>
.form-input{
  font-size:9pt !important
}
</style>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script>
$(document).ready(function(){
  var department = $('#department').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
    });
  $('#myModal').on('hidden.bs.modal', function () {
    $(this).find('#department_name').val('').end();

});
  $('#submit').click(function(){
    $.post('<?php echo base_url();?>systems/department/save',$('#formData').serialize(),function(){
        department.fnClearTable();
      /*  $.getJSON('<?php echo base_url();?>master_data/company/getData',function(data){
          company.fnAddData(data);
          $('.form-input').val('');
        });*/
        window.location.href = "<?php echo site_url('/systems/department'); ?>";   
    }); 
  });
  
});

function del(id_department){
  var con = confirm('Are You Sure?');
  if(con==true){
    $.post('<?php echo base_url();?>systems/department/delete/'+id_department,function(){
      $.getJSON('<?php echo base_url();?>systems/department/getData',function(data){
        var department = $('#department').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
            "bDestroy": true
        });
          department.fnClearTable();
          department.fnAddData(data);
      });
    });
  }
  }
function edit(id_department){
  $.getJSON('<?php echo base_url();?>systems/department/getDetail/'+id_department,function(data){
    $('#id_department').val(data.id_department);
    $('#company_code_fk').val(data.company_code_fk);
     $('#department_code').val(data.department_code);
    $('#department_name').val(data.department_name);
    $('#myModal').modal('show');
  });
}
</script>
<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
        <a data-toggle="modal" href="#myModal" class="btn btn-success">Add New Department</a><br>
                  <table id="department" class="table table-bordered table-hover" style="font-size:9pt !important">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Company</th>
                        <th>Department Code</th>
                        <th>Department Name</th>
                        <th>Change Date</th>
                        <th>Change By</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody id="tRow">
          <?php $no=1; foreach($data as $row){?>
          <tr>
            <td><?php echo $no;?></td>
             <td><?php echo $row->company_name;?></td>
            <td><?php echo $row->company_name;?></td>
            <td><?php echo $row->department_name;?></td>
             <td><?php echo $row->create_date;?></td>
            <td><?php echo $row->username;?></td>
            <td>
            <button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_department;?>')"><i class="fa fa-edit"></i></button>
            <button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id_department;?>')"><i class="fa fa-trash"></i></button>
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
                <h4 class="modal-title">Department</h4>
            </div>
                <div class="modal-body" style="">   
        
        <form id="formData" method="post" style="font-size:9pt !important" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Company</label>

                  <div class="col-sm-8">
                   <input type="hidden" class="form-control form-input" id="id_department" name="id_department">
                     <select name="company_code_fk" id="company_code_fk" class="form-control">
                      <option value="">-- Select Company --</option>
                      <?php foreach($company as $crow){?>
                      <option value="<?php echo $crow->company_code;?>"><?php echo $crow->company_name;?></option>
                      <?php } ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Department Code</label>

                  <div class="col-sm-8">
                       <input type="text" class="form-control input-sm form-input" id="department_code" name="department_code" placeholder="Department Code" value="<?php echo $code;?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Department Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="department_name" name="department_name" placeholder="Department Code">
                    <br><br>
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