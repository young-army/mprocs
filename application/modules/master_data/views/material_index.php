<?php 
$code = kode_material();
?>

<style>
.form-input{
  font-size:9pt !important
}
</style>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script>
$(document).ready(function(){
  var material = $('#material').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
    });
  $('#myModal').on('hidden.bs.modal', function () {
    $(this).find('#material_name').val('').end();

});
  $('#submit').click(function(){
    $.post('<?php echo base_url();?>master_data/material/save',$('#formData').serialize(),function(){
        material.fnClearTable();
      /*  $.getJSON('<?php echo base_url();?>master_data/company/getData',function(data){
          company.fnAddData(data);
          $('.form-input').val('');
        });*/
        window.location.href = "<?php echo site_url('/master_data/material'); ?>";   
    }); 
  });
  
});

function del(id_material){
  var con = confirm('Are You Sure?');
  if(con==true){
    $.post('<?php echo base_url();?>master_data/material/delete/'+id_material,function(){
      $.getJSON('<?php echo base_url();?>master_data/material/getData',function(data){
        var material = $('#material').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
            "bDestroy": true
        });
          material.fnClearTable();
          material.fnAddData(data);
      });
    });
  }
  }
function edit(id_material){
  $.getJSON('<?php echo base_url();?>master_data/material/getDetail/'+id_material,function(data){
    $('#id_material').val(data.id_material);
    $('#material_code').val(data.code_material);
    $('#material_name').val(data.material_name);
    $('#jenis').val(data.jenis);
    $('#type').val(data.type);
    //$('#material_name').val(data.material_name);
    $('#myModal').modal('show');
  });
}
</script>
<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
        <a data-toggle="modal" href="#myModal" class="btn btn-success">Add New material</a><br>
                  <table id="material" class="table table-bordered table-hover" style="font-size:9pt !important">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Material Code</th>
                        <th>material Name</th>
                        <th>Material Jenis</th>
                        <th>Material Type</th>
                        <th>Change Date</th>
                        <th>Change By</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody id="tRow">
          <?php $no=1; foreach($data as $row){?>
          <tr>
            <td><?php echo $no;?></td>
            <td><?php echo $row->code_material;?></td>
            <td><?php echo $row->material_name;?></td>
            <td><?php echo $row->jenis;?></td>
            <td><?php echo $row->type;?></td>
            <td><?php echo $row->create_date;?></td>
            <td><?php echo $row->username;?></td>
            <td>
            <button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_material;?>')"><i class="fa fa-edit"></i></button>
            <button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id_material;?>')"><i class="fa fa-trash"></i></button>
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
                <h4 class="modal-title">material</h4>
            </div>
                <div class="modal-body" style="">   
        
        <form id="formData" method="post" style="font-size:9pt !important" class="form-horizontal">
              <div class="box-body">
                <!-- <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Company</label>

                  <div class="col-sm-8">
                   <input type="hidden" class="form-control form-input" id="id_material" name="id_material">
                     <select name="company_code_fk" id="company_code_fk" class="form-control">
                      <option value="">-- Select Company --</option>
                      <?php foreach($company as $crow){?>
                      <option value="<?php echo $crow->company_code;?>"><?php echo $crow->company_name;?></option>
                      <?php } ?>
                      </select>
                  </div>
                </div> -->
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">material Code</label>

                  <div class="col-sm-8">
                       <input type="hidden" class="form-control input-sm form-input" id="id_material" name="id_material" readonly>
                       <input type="text" class="form-control input-sm form-input" id="material_code" name="material_code" placeholder="material Code" value="<?php echo $code;?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Material Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="material_name" name="material_name" placeholder="Material Name">
                    <br><br>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Jenis</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="jenis" name="jenis" placeholder="Jenis">
                    <br><br>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Type</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="type" name="type" placeholder="Type">
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