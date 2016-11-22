<?php 
$code = kode_company();
?>

<style>
.form-input{
  font-size:9pt !important
}
</style>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script>
$(document).ready(function(){
  var company = $('#company').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
    });
  $('#submit').click(function(){
    $.post('<?php echo base_url();?>systems/company/save',$('#formData').serialize(),function(){
        company.fnClearTable();
      /*  $.getJSON('<?php echo base_url();?>master_data/company/getData',function(data){
          company.fnAddData(data);
          $('.form-input').val('');
        });*/
        window.location.href = "<?php echo site_url('/systems/company'); ?>";   
    }); 
  });
  
});
function del(id_company){
  var con = confirm('Are You Sure?');
  if(con==true){
    $.post('<?php echo base_url();?>systems/company/delete/'+id_company,function(){
      $.getJSON('<?php echo base_url();?>systems/company/getData',function(data){
        var company = $('#company').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
            "bDestroy": true
        });
          company.fnClearTable();
          company.fnAddData(data);
      });
    });
  }
  }
function edit(id_company){
  $.getJSON('<?php echo base_url();?>systems/company/getDetail/'+id_company,function(data){
    $('#id_company').val(data.id_company);
    $('#company_code').val(data.company_code);
    $('#company_name').val(data.company_name);
    $('#street').val(data.street);
    $('#city').val(data.city);
    $('#postal_code').val(data.postal_code);
    $('#province').val(data.province);
    $('#telephone').val(data.telephone);
    $('#fax').val(data.fax);
    $('#myModal').modal('show');
  });
}
</script>
<div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
        <a data-toggle="modal" href="#myModal" class="btn btn-success">Add New Company</a><br>
                  <table id="company" class="table table-bordered table-hover" style="font-size:9pt !important">
                    <thead>
                      <tr>
                        <th>No</th>
                         <th>Code</th>
                        <th>Company Name</th>
                        <th>Change Date</th>
                        <th>Change By</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody id="tRow">
          <?php $no=1; foreach($data as $row){?>
          <tr>
            <td><?php echo $no;?></td>
             <td><?php echo $row->company_code;?></td>
            <td><?php echo $row->company_name;?></td>
            <td><?php echo $row->create_date;?></td>
            <td><?php echo $row->username;?></td>
            <td>
            <button class="btn btn-primary btn-xs" onclick="edit('<?php echo $row->id_company;?>')"><i class="fa fa-edit"></i></button>
            <button class="btn btn-danger btn-xs" onclick="del('<?php echo $row->id_company;?>')"><i class="fa fa-trash"></i></button>
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
                <h4 class="modal-title">Company</h4>
            </div>
                <div class="modal-body" style="">   
        
        <form id="formData" method="post" style="font-size:9pt !important" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Company Code</label>

                  <div class="col-sm-8">
                  <input type="hidden" class="form-control form-input" id="id_company" name="id_company">
                    <input type="text" class="form-control input-sm form-input" id="company_code" name="company_code" placeholder="Company Code" value="<?php echo $code;?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Company Name</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm form-input" id="company_name" name="company_name" placeholder="Company Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Address</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm form-input" id="address" name="street" placeholder="Address">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">City/Postal Code</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm col-md-2 form-input" id="city" name="city" placeholder="City">
                    <br><br>
                     <input type="text" class="form-control input-sm col-md-2 form-input" id="postal_code" name="postal_code" placeholder="Postal Code">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Province</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm form-input" id="province" province="province" placeholder="Province">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Phone</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm form-input" id="telephone" name="phone" placeholder="Phone">
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="col-sm-4">Fax</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control input-sm form-input" id="fax" name="fax" placeholder="Fax">
                  </div>
                </div>
               <!--  <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-4">
                    <input type="password" class="form-control input-sm" id="inputPassword3" placeholder="Password">
                  </div>
                </div> -->
               <!--  <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> Remember me
                      </label>
                    </div>
                  </div>
                </div> -->
              </div>
              <!-- /.box-body -->
              <!-- <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Submit</button>
              </div> -->
              <!-- /.box-footer -->
            </form>
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default exit" data-dismiss="modal">Exit</button>
                    <input type="submit" class="btn btn-primary" value="Save"  data-dismiss="modal" id="submit"/>
                </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->