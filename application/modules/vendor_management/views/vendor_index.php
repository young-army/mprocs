<?php 
$code = kode_registration_vendor();
?>

<style>
.form-input{
  font-size:9pt !important
}
</style>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script>
$(document).ready(function(){
  var vendor = $('#vendor').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
    });

  
  $('#submit').click(function(){
    $.post('<?php echo base_url();?>vendor_management/vendor/save',$('#formData').serialize(),function(){
        vendor.fnClearTable();
      /*  $.getJSON('<?php echo base_url();?>master_data/company/getData',function(data){
          company.fnAddData(data);
          $('.form-input').val('');
        });*/
        window.location.href = "<?php echo site_url('/vendor_management/vendor'); ?>";   
    }); 
  });
  
});
function del(id_vendor){
  var con = confirm('Are You Sure?');
  if(con==true){
    $.post('<?php echo base_url();?>vendor_management/vendor/delete/'+id_vendor,function(){
      $.getJSON('<?php echo base_url();?>vendor_management/vendor/getData',function(data){
        var vendor = $('#vendor').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
            "bDestroy": true
        });
          vendor.fnClearTable();
          vendor.fnAddData(data);
      });
    });
  }
  }
function edit(id_vendor){
  $.getJSON('<?php echo base_url();?>vendor_management/vendor/getDetail/'+id_vendor,function(data){
    $('#id_vendor').val(data.id_vendor);
    $('#vendor_code').val(data.company_code);
    $('#vendor_name').val(data.company_name);
    $('#myModal').modal('show');
  });
}
</script>
<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
    <a href="<?php echo $this->page->base_url('/add');?>" class="btn btn-success">Add New vendor</a><br>
                  <table id="vendor" class="table table-bordered table-hover" style="font-size:9pt !important">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Registration Num</th>
                        <th>Vendor Num</th>
                        <th>vendor Name</th>
                        <th>Category - Sub Category</th>
                        <th>Register Status</th>
                        <th>Register Date</th>
                        <th>Change Date</th>
                        <th>Change By</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody id="tRow">
          <?php $no=1; foreach($index as $row){?>
          <tr>
            <td><?php echo $no;?></td>
            <td><?php echo $row->register_num;?></td>
            <td><?php echo $row->vendor_code;?></td>
            <td><?php echo $row->vendor_name;?></td>
            <td><?php //echo $row->Category;?></td>
            <td><?php echo $row->status_approved;?></td>
            <td><?php echo $row->created_date;?></td>
             <td><?php echo $row->created_date;?></td>
            <td><?php echo $row->username;?></td>
            <td>
            <!-- <button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_vendor;?>')"><i class="fa fa-edit"></i></button> -->
            <a class="green" href="<?php echo site_url('/vendor_management/vendor/edit/'.$row->id_vendor); ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button></a>
              <?php 
             $status_vendor = $row->status_approved;
             if($status_vendor == 'New                           '){?>
            <a href="<?php echo base_url();?>vendor_management/vendor/approve/<?php echo $row->id_vendor;?>" onclick="return confirm('Are You Sure ?')" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Approve</a>


            <?php }else{
              echo ' ';
            } ?>
            <button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id_vendor;?>')"><i class="fa fa-trash"></i></button>
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
                <h4 class="modal-title">vendor</h4>
            </div>
                <div class="modal-body" style="">   
        
        <form id="formData" method="post" style="font-size:9pt !important" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Company</label>

                  <div class="col-sm-8">
                   <input type="hidden" class="form-control form-input" id="id_vendor" name="id_vendor">
                     <select name="company_code_fk" id="company_code_fk" class="form-control">
                      <option value="">-- Select Company --</option>
                      <?php foreach($company as $crow){?>
                      <option value="<?php echo $crow->company_code;?>"><?php echo $crow->company_name;?></option>
                      <?php } ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">vendor Code</label>

                  <div class="col-sm-8">
                       <input type="text" class="form-control input-sm form-input" id="vendor_code" name="vendor_code" placeholder="vendor Code" value="<?php echo $code;?>" readonly>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">vendor Category</label>

                  <div class="col-sm-8">
                       <input type="text" class="form-control input-sm form-input" id="vendor_code" name="vendor_code" placeholder="vendor Code" value="<?php echo $code;?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">vendor Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="vendor_name" name="vendor_name" placeholder="vendor Code">
                    <br><br>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">vendor Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="vendor_name" name="vendor_name" placeholder="vendor Code">
                    <br><br>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">vendor Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="vendor_name" name="vendor_name" placeholder="vendor Code">
                    <br><br>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">vendor Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="vendor_name" name="vendor_name" placeholder="vendor Code">
                    <br><br>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">vendor Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="vendor_name" name="vendor_name" placeholder="vendor Code">
                    <br><br>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">vendor Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="vendor_name" name="vendor_name" placeholder="vendor Code">
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