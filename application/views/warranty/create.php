<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Warranty</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Warranty</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>


        <div class="box">
          <div class="box-header">
            <h3 class="box-title">CREATE Warranty</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <!--
					 <div class="form-group">
                  <label for="warranty_qrcode">Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="warranty_qrcode" name="warranty_qrcode" type="file">
                      </div>
                  </div>
                </div>
					 -->
					<div class="col-md-12 bg-warning">
						
							
							<div class="form-group clearfix">
							<div class="col-md-3"></div>
							<button class="btn btn-success  form-control-lg col-md-2 " disabled >Warranty Code : </button>
							<button class="btn bg-red col-md-4   form-control-lg" disabled># NEW DATA #</button>
							</div>
							<hr /> 
							<div class="clearfix"> </div>
							<div class="clearfix"> </div>
							
						
						<div class="description-block col-md-4">
							<img src="<?php echo base_url('assets/images/product_image/ios7-camera.png') ?>" alt="image?" class="img-circle img-fluid float-left" width="200" height="200" />
						</div>
					  
						 <div class="form-group col-md-8">
							<label for="warranty_unit_id" >Units </label>								
							<select class="form-control select_group2"  id="warranty_unit_id" name="warranty_unit_id">
							  <?php foreach ($warranty_units as $k => $v): ?>					
								 <option value="<?php echo $v['unit_id'] ?>"  class="select_group2" ><?php  echo $v['unit_name'] ?></option>
							  <?php endforeach ?>
							</select >
						</div> 
						 <div class="form-group col-md-4 " >
							<label for="warranty_code">Warranty Code</label>
							<input type="text" class="form-control" id="warranty_code" name="warranty_code" placeholder="Enter Warranty Code" autocomplete="off" />
						 </div> 
						 <div class="form-group col-md-4">
							<label for="warranty_unit_sn">Serial Number</label>
							<input type="text" class="form-control" id="warranty_unit_sn" name="warranty_unit_sn" placeholder="Enter Unit Serial Number" autocomplete="off" />
						</div>
						 <div class="form-group col-md-4">
							<label for="warranty_expired_date">Expired Date</label>
							<input type="text" class="form-control" id="warranty_expired_date" name="warranty_expired_date" placeholder="Enter Unit Serial Number" autocomplete="off"  />
						 </div>
						 						 											
					  
					</div>
					
					<div class="col-md-12 col-xs-3 bg-info">
					 <div class="callout callout-info">
						Please provide Unit Source and Customer info bellow. 
					 </div>
						 <div class="form-group col-md-6 ">
							<label for="warranty_branch_id">Unit Source</label>
							<select class="form-control select_group2 select_container"  id="warranty_branch_id" name="warranty_branch_id">
								  <?php foreach ($warranty_branches as $k => $v): ?>					
									 <option value="<?php echo $v['branch_id'] ?>"  class="form-control" ><?php  echo $v['branch_code'] . " - " . $v['branch_name'] ?></option>
								  <?php endforeach ?>
							</select >	
						 </div>
						 <div class="col-md-1"> </div>
						 <div class="form-group col-md-4">
							<label for="warranty_po_no">P/O Number</label>
							<input type="text" class="form-control" id="warranty_po_no" name="warranty_po_no" placeholder="Enter Purchase Number" autocomplete="off"  />
						 </div>
						 
						 <div class="form-group col-md-6">
							<label for="warranty_cust_id">Customer</label>
							<select class="form-control select_group2"  id="warranty_cust_id" name="warranty_cust_id">
								  <?php foreach ($warranty_customers as $k => $v): ?>					
									 <option value="<?php echo $v['customer_id'] ?>" ><?php  echo $v['customer_num'] . " - " . $v['customer_nama'] ?></option>
								  <?php endforeach ?>
							</select >	
						 </div>
						 <div class="col-md-1"> </div>
						 <div class="form-group col-md-4">
							<label for="warranty_so_no">S/O Number</label>
							<input type="text" class="form-control" id="warranty_so_no" name="warranty_so_no" placeholder="Enter Sales Number" autocomplete="off" />
						 </div>
					</div>
					<div class="clearfix"> </div>
					<div class="col-md-12 bg-warning">
						<br/>
						<div class="callout callout-warning">
							Please provide Unit Installment info bellow. 
						</div>
						 <div class="col-md-12">
							 <div class="form-group col-md-3">
								<label for="warranty_delivery_date">Delivery Date</label>
								<input type="text" class="form-control" id="warranty_delivery_date" name="warranty_delivery_date" placeholder="Delivery Date" autocomplete="off"  />
							 </div>
							 <div class="col-md-1"> </div>
							 <div class="form-group col-md-3">
								<label for="warranty_installed_date">Installed Date</label>
								<input type="text" class="form-control" id="warranty_installed_date" name="warranty_installed_date" placeholder="Installed Date" autocomplete="off" />
							 </div>
							 <div class="col-md-1"> </div>
							 <div class="form-group col-md-3">
								<label for="warranty_handsover_date">Handsover Date</label>
								<input type="text" class="form-control" id="warranty_handsover_date" name="warranty_handsover_date" placeholder="Handsover Date" autocomplete="off"  />
							 </div>
						 </div>
					</div>
					 <div class="col-md-12">
						 <div class="form-group col-md-3 ">						 
							<input class="icheckbox_blue " id="is_revoke" name="is_revoke" type="checkbox"  /> 
							<label for="is_revoke"  >Warranty Revoke </label>							
						 </div>
						 <div class="form-group col-md-3">				
							<input class="icheckbox_blue " id="is_active" name="is_active" type="checkbox" />							
							<label for="is_active" >Active Warranty </label>
						 </div>
					</div>
					
              </div>
              <!-- /.box-body -->

              <div class="box-footer text-right">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('warranty/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function() {
    $(".select_group").select2();
    $("#description").wysihtml5();

    $("#productMainNav").addClass('active');
    $("#createProductSubMenu").addClass('active');
	 
    $('#warranty_expired_date').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#warranty_delivery_date').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#warranty_installed_date').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#warranty_handsover_date').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
	 /*
    $('#warranty_expired_date').datepicker("setDate", new Date());    
    $('#warranty_delivery_date').datepicker("setDate", new Date());    
    $('#warranty_installed_date').datepicker("setDate", new Date());    
    $('#warranty_handsover_date').datepicker("setDate", new Date());    
	*/
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#product_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });
</script>