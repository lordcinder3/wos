

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Products</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Products</li>
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
            <h3 class="box-title">Add Product</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <!--
					 <div class="form-group">
                  <label for="product_image">Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="product_image" name="product_image" type="file">
                      </div>
                  </div>
                </div>
					 -->
					<div class="col-md-4">
					</div>
					<div class="col-md-8 col-xs-5">
						 <div class="form-group">
							<label for="product_brand">Product Brand</label>
							<input type="text" class="form-control" id="product_brand" name="product_brand" placeholder="Enter product brand" autocomplete="off" value="<?php echo $this->input->post('product_brand') ?>" />
						 </div>

						 <div class="form-group">
							<label for="product_name">Product Name</label>
							<input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" autocomplete="off" value="<?php echo $this->input->post('product_name') ?>" />
						 </div>

						 <div class="form-group">
							<label for="product_sku">SKU Number</label>
							<input type="text" class="form-control" id="product_sku" name="product_sku" placeholder="Enter SKU Number" autocomplete="off" value="<?php echo $this->input->post('product_sku') ?>" />
						 </div>
					</div>
					 <div class="col-md-6">
						 <div class="form-group">
							<label for="product_weight" class="">Weight</label>
							<input type="text" class="form-control" id="product_weight" name="product_weight" placeholder="Enter Product Weight" autocomplete="off" value="<?php echo $this->input->post('product_weight') ?>" />
							<label for="product_height" class="">Height</label>
							<input type="text" class="form-control" id="product_height" name="product_height" placeholder="Enter Product Height" autocomplete="off" value="<?php echo $this->input->post('product_height') ?>" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="product_length" class=" ">Length</label>
							<input type="text" class="form-control"  id="product_length" name="product_length" placeholder="Enter Product Length" autocomplete="off" value="<?php echo $this->input->post('product_length') ?>" />
							<label for="product_width" class="">Width</label>
							<input type="text" class="form-control" id="product_width" name="product_width" placeholder="Enter Product Width" autocomplete="off" value="<?php echo $this->input->post('product_width') ?>" />
						 </div>
					 </div>

					<div class="col-md-5">
						 <div class="form-group">
							<label for="category" >Category</label>
							<select class="form-control select_group col-xs-5" id="category" name="category[]" multiple="multiple">
							  <?php foreach ($category as $k => $v): ?>
								 <option value="<?php echo $v['category_id'] ?>"><?php echo $v['category_name'] ?></option>
							  <?php endforeach ?>
							</select>
						 </div>
					</div>
					<div class="col-md-1">
					</div>
					<div class="col-md-5">
						 <div class="form-group">
							<label for="product_compatibilities">Compatible with</label>
							<select class="form-control select_group" id="product_compatibilities" name="product_compatibilities[]" multiple="multiple">
							  <?php foreach ($product_compatibilities as $k => $v): ?>
								 <option value="<?php echo $v['unit_id'] ?>"><?php echo $v['unit_brand']. " - " .$v['unit_name'] ?></option>
							  <?php endforeach ?>
							</select>
						 </div>
					 </div>
					 <div class="col-md-12">

						 <div class="form-group">
							<label for="is_active" class="col-md-1" >Active</label>							
							<input class="icheckbox_flat-blue col-md-1" id="is_active" name="is_active" type="checkbox" value="<?php echo $this->input->post('is_active') ?>" checked/> 
							
							<!--
							<select class="form-control" id="active" name="active">
							  <option value="1">Yes</option>
							  <option value="2">No</option>
							</select> -->
						 </div>
					</div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('products/') ?>" class="btn btn-warning">Back</a>
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