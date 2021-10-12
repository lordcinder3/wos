

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Customer</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      <li class="active">Customer</li>
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
            <h3 class="box-title">Edit Customer</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <!-- <div class="form-group">
                  <label>Image Preview: </label>
                  <img src="<?php #echo base_url() . $product_data['image'] ?>" width="150" height="150" class="img-circle">
                </div>
                -->

                <div class="form-group">

                 <!--  <label for="product_image">Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="product_image" name="product_image" type="file">
                      </div>
                  </div>
                </div> -->
                <div class="form-group">
                  <label for="unit_brand">Brand</label>
                  <input type="text" class="form-control" id="unit_brand" name="unit_brand" placeholder="Enter Unit Brand" autocomplete="off" value="<?php echo !empty($this->input->post('unit_brand')) ?:$unit_data['unit_brand'] ?>"  />
                </div>

                <div class="form-group">
                  <label for="unit_sku">Serial Number</label>
                  <input type="text" class="form-control" id="unit_sku" name="unit_sku" placeholder="Enter Unit Serial Number" autocomplete="off" value="<?php echo !empty($this->input->post('unit_sku')) ?:$unit_data['unit_sku'] ?>" />
                </div>

                <div class="form-group">
                  <label for="unit_name">Unit Name</label>
                  <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Enter Unit Name" autocomplete="off" value="<?php echo !empty($this->input->post('unit_name')) ?:$unit_data['unit_name'] ?>" />
                </div>

                <div class="form-group">
                  <label for="unit_warranty">Warranty Duration (Months)</label>
                  <input type="numeric" class="form-control" id="unit_warranty" name="unit_warranty" placeholder="Enter Warranty Duration (Months)" autocomplete="off" value="<?php echo !empty($this->input->post('unit_warranty')) ?:$unit_data['unit_warranty'] ?>" />
                </div>

                <div class="form-group col-md-3" style="padding-left: 0px">
                  <label for="unit_weight">Weight</label>
                  <input type="numeric" class="form-control" id="unit_weight" name="unit_weight" placeholder="Enter Unit Weight (Kg)" autocomplete="off" value="<?php echo !empty($this->input->post('unit_weight')) ?:$unit_data['unit_weight'] ?>"/>
                </div>

                <div class="form-group col-md-3" >
                  <label for="unit_height">Height</label>
                  <input type="numeric" class="form-control" id="unit_height" name="unit_height" placeholder="Enter Unit Height (cm)" autocomplete="off" value="<?php echo !empty($this->input->post('unit_height')) ?:$unit_data['unit_height'] ?>"/>
                </div>

                <div class="form-group col-md-3" >
                  <label for="unit_length">Length</label>
                  <input type="numeric" class="form-control" id="unit_length" name="unit_length" placeholder="Enter Unit Length (cm)" autocomplete="off" value="<?php echo !empty($this->input->post('unit_length')) ?:$unit_data['unit_length'] ?>"/>
                </div>

                <div class="form-group col-md-3" style="padding-right:0px">
                  <label for="unit_width">Width</label>
                  <input type="numeric" class="form-control" id="unit_width" name="unit_width" placeholder="Enter Unit Width (cm)" autocomplete="off" value="<?php echo !empty($this->input->post('unit_width')) ?:$unit_data['unit_width'] ?>" />
                </div>

                 <div class="form-group">
                  <label for="is_active">Active</label>
                  <select class="form-control" id="is_active" name="is_active"> 
                    <option value="1" <?php if($unit_data['is_active'] == 1) { echo 'selected="selected"'; } ?>>Yes</option>
                    <option value="2" <?php if($unit_data['is_active'] == 2) { echo 'selected="selected"'; } ?>>No</option>
                  </select>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('unit/') ?>" class="btn btn-warning">Back</a>
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

