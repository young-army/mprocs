<style>
.form-input{
  font-size:9pt !important
}
</style>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script>
$(document).ready(function(){
  var sub_category = $('#sub_category').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
    });
  $('#submit').click(function(){
    $.post('<?php echo base_url();?>systems/sub_category/save',$('#formData').serialize(),function(){
        sub_category.fnClearTable();
        $.getJSON('<?php echo base_url();?>systems/sub_category/getData',function(data){
          sub_category.fnAddData(data);
          $('.form-input').val('');
        });
        //window.location.href = "<?php echo site_url('/master_data/sub_category'); ?>";   
    }); 
  });
  
});
function del(id_sub_category){
  var con = confirm('Are You Sure?');
  if(con==true){
    $.post('<?php echo base_url();?>systems/sub_category/delete/'+id_sub_category,function(){
      $.getJSON('<?php echo base_url();?>systems/sub_category/getData',function(data){
        var sub_category = $('#sub_category').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
            "bDestroy": true
        });
          sub_category.fnClearTable();
          sub_category.fnAddData(data);
      });
    });
  }
  }
function edit(id_sub_category){
  $.getJSON('<?php echo base_url();?>systems/sub_category/getDetail/'+id_sub_category,function(data){
    $('#category_fk').val(data.category_fk);
    $('#sub_category').val(data.sub_category_name);
    $('#description').val(data.description);
    $('#myModal').modal('show');
  });
}
</script>
<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
        <a data-toggle="modal" href="#myModal" class="btn btn-success">Add New Sub Category</a><br>
                  <table id="sub_category" class="table table-bordered table-hover" style="font-size:9pt !important">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Description</th>
                        <th>Change Date</th>
                        <th>Change By</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody id="tRow">
          <?php $no=1; foreach($data as $row){?>
          <tr>
            <td><?php echo $no;?></td>
            <td><?php echo $row->category_name;?></td>
             <td><?php echo $row->sub_category_name;?></td>
            <td><?php echo $row->description;?></td>
            <td><?php echo $row->create_date;?></td>
             <td><?php echo $row->username;?></td>
            <td>
            <button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_sub_category;?>')"><i class="fa fa-edit"></i></button>
            <button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id_sub_category;?>')"><i class="fa fa-trash"></i></button>
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
                <h4 class="modal-title">sub_category</h4>
            </div>
                <div class="modal-body" style="">   
        
        <form id="formData" method="post" style="font-size:9pt !important" class="form-horizontal">
              <div class="box-body">
    
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Category</label>

                 <div class="col-sm-8">
                     <input type="hidden" class="form-control form-input" id="id_sub_category" name="id_sub_category">
                    <select name="category_fk" id="category_fk" class="form-control">
                      <option value="">-- Select Company --</option>
                      <?php foreach($category as $crow){?>
                      <option value="<?php echo $crow->id_category;?>"><?php echo $crow->category_name;?></option>
                      <?php } ?>
                      </select>
                  </div>
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Sub Category</label>

                 <div class="col-sm-8">
                     <input type="hidden" class="form-control form-input" id="id_sub_category" name="id_sub_category">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="sub_category" name="sub_category" placeholder="Sub Category">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Description</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="description" name="description" placeholder="Description">
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