

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Customers</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Customers</li>
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
            <h3 class="box-title">Add Customer</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">

              <!--    <label for="product_image">Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="product_image" name="product_image" type="file">
                      </div>
                  </div>
                </div>
              -->

                <div class="form-group">
                  <label for="customer_num">Customer Number</label>
                  <input type="text" class="form-control" id="customer_num" name="customer_num" placeholder="Enter Customer name" autocomplete="off" value="<?php echo $this->input->post('customer_num') ?>" />
                </div>

                <div class="form-group">
                  <label for="customer_nama">Name</label>
                  <input type="text" class="form-control" id="customer_nama" name="customer_nama" placeholder="Enter Customner Name" autocomplete="off" value="<?php echo $this->input->post('customer_nama') ?>"/>
                </div>

                <div class="form-group">
                  <label for="customer_alamat">Address</label>
                  <input type="text" class="form-control" id="customer_alamat" name="customer_alamat" placeholder="Enter Address" autocomplete="off" value="<?php echo $this->input->post('customer_alamat') ?>"/>
                </div>

                
                <div class="form-group col-md-6" style="padding:0px">
                  <label for="customer_kota">City</label>
                  <input type="text" class="form-control" id="customer_kota" name="customer_kota" placeholder="Enter City" autocomplete="off" value="<?php echo $this->input->post('customer_kota') ?>"/>
                </div>

                <div class="form-group col-md-2" >
                  <label for="customer_kodepos">Postal Code</label>
                  <input type="text" class="form-control" id="customer_kodepos" name="customer_kodepos" placeholder="Enter Postal Code" autocomplete="off" value="<?php echo $this->input->post('customer_kodepos') ?>"/>
                </div>

                <div class="form-group col-md-4" style="padding:0px">
                  <label for="customer_geolocation">Geo Location</label>
                  <input type="text" class="form-control" id="customer_geolocation" name="customer_geolocation" placeholder="Enter Geo Location" autocomplete="off" value="<?php echo $this->input->post('customer_geolocation') ?>"/>
                </div>
                

                <div class="form-group">
                  <label for="customer_telp">Telp</label>
                  <input type="text" class="form-control" id="customer_telp" name="customer_telp" placeholder="Enter Telp" autocomplete="off" value="<?php echo $this->input->post('customer_telp') ?>"/>
                </div>

                <div class="form-group">
                  <label for="customer_email">Email</label>
                  <input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="Enter Email" autocomplete="off" value="<?php echo $this->input->post('customer_email') ?>"/>
                </div>

                <div class="form-group">
                  <label for="customer_pic">PIC</label>
                  <input type="text" class="form-control" id="customer_pic" name="customer_pic" placeholder="Enter PIC" autocomplete="off" value="<?php echo $this->input->post('customer_pic') ?>"/>
                </div>

                <div class="form-group">
                  <label for="customer_pic_telp">PIC Telp</label>
                  <input type="text" class="form-control" id="customer_pic_telp" name="customer_pic_telp" placeholder="Enter PIC Telp" autocomplete="off" value="<?php echo $this->input->post('customer_pic_telp') ?>"/>
                </div>

                <div class="form-group">
                  <label for="is_active">Active</label>
                  <select class="form-control" id="is_active" name="is_active">
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('customer/') ?>" class="btn btn-warning">Back</a>
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