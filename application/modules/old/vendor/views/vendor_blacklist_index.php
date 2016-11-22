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
/*  var vendor_blacklist = $('#vendor_blacklist').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
    });
  $('#myModal').on('hidden.bs.modal', function () {
    $(this).find('#vendor_blacklist_name').val('').end();
  });*/
  $('#submit').click(function(){
    $.post('<?php echo base_url();?>vendor/vendor_blacklist/save',$('#formData').serialize(),function(){
        //vendor_blacklist.fnClearTable();
      /*  $.getJSON('<?php echo base_url();?>master_data/company/getData',function(data){
          company.fnAddData(data);
          $('.form-input').val('');
        });*/
        window.location.href = "<?php echo site_url('/vendor/vendor_blacklist'); ?>";   
    }); 
  });
  
});

function del(id_vendor_blacklist){
  var con = confirm('Are You Sure?');
  if(con==true){
    $.post('<?php echo base_url();?>vendor/vendor_blacklist/delete/'+id_vendor_blacklist,function(){
       window.location.href = "<?php echo site_url('/vendor/vendor_blacklist'); ?>";  
      /*$.getJSON('<?php echo base_url();?>vendor/vendor_blacklist/getData',function(data){
        var vendor_blacklist = $('#vendor_blacklist').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
            "bDestroy": true
        });
          vendor_blacklist.fnClearTable();
          vendor_blacklist.fnAddData(data);
      });*/
    });
  }
  }
function edit(id_vendor_blacklist){
  $.getJSON('<?php echo base_url();?>vendor/vendor_blacklist/getDetail/'+id_vendor_blacklist,function(data){
    $('#id_vendor_blacklist').val(data.id_vendor_blacklist);
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
        <a data-toggle="modal" href="#myModal" class="btn btn-success">Add New Vendor Blacklist</a><br>
                <table id="vendor_blacklist" class="table table-bordered table-hover" style="font-size:9pt !important">
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
            <td><?php $status_vendor = $row->status_blacklist; ?>
            <?php 
             $status_vendor = $row->status_blacklist;
             if($status_vendor == 'Waiting                       '){?>
            <span style="background-color: red; color: white; padding:5px; border-radius: 3px;"><?php echo $status_vendor; ?></span>
            <?php } else if ($status_vendor == 'Approved                      ') { ?>
            <span style="background-color: green; color: white; padding:5px; border-radius: 3px;"><?php echo $status_vendor; ?></span>
            <?php } else if ($status_vendor == 'Cancel                        ') { ?>
             <span style="background-color: blue; color: white; padding:5px; border-radius: 3px;"><?php echo $status_vendor; ?></span>
            <?php } else if ($status_vendor == 'Rejected                      ') { ?>
             <span style="background-color: black; color: white; padding:5px; border-radius: 3px;"><?php echo $status_vendor; ?></span>
            <?php }else{
              echo ' ';
            } ?>

            </td>
             <td><?php echo $row->create_date;?></td>
            <td><?php echo $row->username;?></td>
            <td>
            <button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_vendor_blacklist;?>')"><i class="fa fa-edit"></i></button>
              <?php 
             $status_vendor = $row->status_blacklist;
             if($status_vendor == 'Waiting                       '){?>
            <a href="<?php echo base_url();?>vendor/vendor_blacklist/approve/<?php echo $row->id_vendor_blacklist;?>" onclick="return confirm('Are You Sure ?')" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Approve</a>
            <?php } else if ($status_vendor == 'Approved                      ') { ?>
            <a href="<?php echo base_url();?>vendor/vendor_blacklist/cancel/<?php echo $row->id_vendor_blacklist;?>" onclick="return confirm('Are You Sure ?')" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Cancel</a>
              <a href="<?php echo base_url();?>vendor/vendor_blacklist/rejected/<?php echo $row->id_vendor_blacklist;?>" onclick="return confirm('Are You Sure ?')" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Rejected</a>
            <?php }else{
              echo ' ';
            } ?>
            <button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id_vendor_blacklist;?>')"><i class="fa fa-trash"></i></button>
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
                <h4 class="modal-title">Vendor Blacklist</h4>
            </div>
                <div class="modal-body" style="">   
        
        <form id="formData" method="post" style="font-size:9pt !important" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Vendor</label>

                  <div class="col-sm-8">
                   <input type="hidden" class="form-control form-input" id="id_vendor_blacklist" name="id_vendor_blacklist">
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