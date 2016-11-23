<style>
.form-input{
  font-size:9pt !important
}
</style>
 <!-- bootstrap datepicker -->
<!--   <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datepicker/datepicker3.css">

<script src="<?php echo base_url();?>/assets/plugins/datepicker/bootstrap-datepicker.js"></script> -->

<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script>
$(document).ready(function(){
  var vendor_redlist = $('#vendor_redlist').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
    });
  $('#myModal').on('hidden.bs.modal', function () {
    $(this).find('#vendor_redlist_name').val('').end();
  });
  $('#submit').click(function(){
    $.post('<?php echo base_url();?>vendor_management/vendor_redlist/save',$('#formData').serialize(),function(){
        //vendor_redlist.fnClearTable();
      /*  $.getJSON('<?php echo base_url();?>master_data/company/getData',function(data){
          company.fnAddData(data);
          $('.form-input').val('');
        });*/
        window.location.href = "<?php echo site_url('/vendor_management/vendor_redlist'); ?>";   
    }); 
  });
  
});

function del(id_vendor_redlist){
  var con = confirm('Are You Sure?');
  if(con==true){
    $.post('<?php echo base_url();?>vendor_management/vendor_redlist/delete/'+id_vendor_redlist,function(){
     /* $.getJSON('<?php echo base_url();?>vendor/vendor_redlist/getData',function(data){
        var vendor_redlist = $('#vendor_redlist').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
            "bDestroy": true
        });
          vendor_redlist.fnClearTable();
          vendor_redlist.fnAddData(data);
      });*/
      window.location.href = "<?php echo site_url('/vendor_management/vendor_redlist'); ?>";  
    });
  }
  }
function edit(id_vendor_redlist){
  $.getJSON('<?php echo base_url();?>vendor_management/vendor_redlist/getDetail/'+id_vendor_redlist,function(data){
    $('#id_vendor_redlist').val(data.id_vendor_redlist);
    $('#vendor_fk').val(data.vendor_fk);
     $('#reason').val(data.remark);
    $('#myModal').modal('show');
  });
}
//Date picker
/*    $('#datepicker').datepicker({
      autoclose: true
    });
*/
</script>
<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
        <a data-toggle="modal" href="#myModal" class="btn btn-success">Add New Vendor Redlist</a><br>
                <table id="vendor_redlist" class="table table-bordered table-hover" style="font-size:9pt !important">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Registration Num</th>
                        <th>Vendor Num</th>
                        <th>Vendor Name</th>
                        <th>Start Date</th>
                        <th>Reason</th>
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
            <td><?php echo $row->vendor_fk;?></td>
            <td><?php echo $row->vendor_fk;?></td>
            <td><?php echo $row->vendor_name;?></td>
            <td><?php echo $row->create_date;?></td>
            <td><?php echo $row->remark;?></td>
            <td><?php echo $row->status_redlist;?></td>
             <td><?php echo $row->create_date;?></td>
            <td><?php echo $row->username;?></td>
            <td>
            <button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_vendor_redlist;?>')"><i class="fa fa-edit"></i></button>
              <?php 
             $status_vendor = $row->status_redlist;
             if($status_vendor == 'Waiting'){?>
            <a href="<?php echo base_url();?>vendor_management/vendor_redlist/approve/<?php echo $row->id_vendor_redlist;?>" onclick="return confirm('Are You Sure ?')" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Approve</a>
            <?php }else{
              echo ' ';
            } ?>
            <button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id_vendor_redlist;?>')"><i class="fa fa-trash"></i></button>
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
                <h4 class="modal-title">Vendor Redlist</h4>
            </div>
                <div class="modal-body" style="">   
        
        <form id="formData" method="post" style="font-size:9pt !important" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Vendor</label>

                  <div class="col-sm-8">
                   <input type="hidden" class="form-control form-input" id="id_vendor_redlist" name="id_vendor_redlist">
                     <select name="vendor_fk" id="vendor_fk" class="form-control">
                      <option value="">-- Select Vendor --</option>
                      <?php foreach($vendor as $crow){?>
                      <option value="<?php echo $crow->vendor_code;?>"><?php echo $crow->vendor_name;?></option>
                      <?php } ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Start Date</label>

                  <div class="col-sm-8">
                       <div class="input-group">
                      <input type="text" class="form-control pull-right form-input" id="datepicker" name="book_date"/><div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Reason</label>

                  <div class="col-sm-8">
                   <textarea class="form-control" rows="3" placeholder="Reason ..." name="reason" id="reason"></textarea>
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