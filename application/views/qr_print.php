<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $page_title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->  
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->  
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css') ?>">
  <!--<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/skin-black-light.min.css') ?>">-->
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/morris.js/morris.css') ?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/jvectormap/jquery-jvectormap.css') ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>">
  <!-- Daterange picker -->  
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') ?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/select2/dist/css/select2.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fileinput/fileinput.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/all.css') ?>">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
  <link rel="stylesheet" href="<?php echo base_url('assets/font_header.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap-extended.min.front.css') ?>">
  

  <!-- jQuery 3 -->
  <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url('assets/bower_components/jquery-ui/jquery-ui.min.js') ?>"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
  <!-- Morris.js charts -->
  <script src="<?php echo base_url('assets/bower_components/raphael/raphael.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/bower_components/morris.js/morris.min.js') ?>"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url('assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') ?>"></script>
  <!-- jvectormap -->
  <script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url('assets/bower_components/jquery-knob/dist/jquery.knob.min.js') ?>"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url('assets/bower_components/moment/min/moment.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
  <!-- datepicker -->
  <script src="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
  <!-- Slimscroll -->
  <script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/fileinput/fileinput.min.js') ?>"></script>
  <!-- Select2 -->
  <script src="<?php echo base_url('assets/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
  <!-- ChartJS -->
  <script src="<?php echo base_url('assets/bower_components/Chart.js/Chart.js') ?>"></script>
  <!-- AdminLTE App -->  
  <script src="<?php echo base_url('assets/dist/js/adminlte.min.js') ?>"></script>
  
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url('assets/dist/js/demo.js') ?>"></script>



  <!-- DataTables -->
<script src="<?php echo base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>


</head>
<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">
  <section class="content-header">
    <h1>
      Show <small>Warranty</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Public</a></li>
      <li class="active">Warranty</li>
    </ol>
  </section>

  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">View Warranty</h3>
          </div>
			 
			 <div class="box-body">

				<div class="col-md-12 bg-warning">
						
					<div class="form-group clearfix">
					<div class="col-md-3"></div>
					<button class="btn btn-success  form-control-lg col-md-2 " disabled >Warranty Code : </button>
					<button class="btn bg-red col-md-4   form-control-lg" disabled><?php echo "#". $warranty_data['warranty_code'] ;?></button>
					</div>
					<hr /> 
					<div class="clearfix"> </div>
					<div class="clearfix"> </div>
						
					
					<div class="description-block col-md-4">
					
						<?php 
							$fileQR = FCPATH."assets".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."qr_images".DIRECTORY_SEPARATOR ; 
							$fileQR .= $warranty_data['warranty_unit_sn'] ;
							$fileQR .= "pqr.png" ; 
							
							$qrUrl = base_url("assets/images/qr_images/".$warranty_data['warranty_unit_sn']."pqr.png") ;
							
							if(file_exists($fileQR)) { $urlQR = $qrUrl ;	} else { $urlQR = base_url("assets/images/qr_images/ios7-camera.png") ; }
							
							
						?>
							<img src="<?php echo $urlQR ;?>" alt="image?" class="img-square img-fluid float-left" width="200" height="200" />
					</div>
				  
					 <div class="form-group col-md-8">
						<label for="warranty_unit_name" >Units </label>								
						<input type="text" class="form-control" id="warranty_unit_name" name="warranty_unit_name"  autocomplete="off" value="<?php echo $warranty_data['unit_name'] ?>" readonly="readonly"/>
					</div> 

					 <div class="form-group col-md-4">
						<label for="warranty_unit_sn">Serial Number</label>
						<input type="text" class="form-control" id="warranty_unit_sn" name="warranty_unit_sn" autocomplete="off" value="<?php echo $warranty_data['warranty_unit_sn'] ?>" readonly="readonly"/>
					</div>
					 <div class="form-group col-md-4">
						<label for="warranty_expired_date">Expired Date</label>
						<input type="text" class="form-control" id="warranty_expired_date" name="warranty_expired_date" autocomplete="off" value="<?php echo $warranty_data['warranty_expired_date'] ?>" readonly="readonly" />
					 </div>
																						
					 <!--<div class="form-group col-md-4 " >
						<label for="warranty_code">Warranty Code</label> -->
						<input type="hidden" class="form-control" id="warranty_code" name="warranty_code" autocomplete="off" value="<?php echo !empty($this->input->post('warranty_code')) ?:$warranty_data['warranty_code'] ?>"  />
					 <!-- </div> -->

					 <div class="form-group col-md-8">
					 	<h3 style="text-align: center; margin: 0px;">Expired in</h3>
						<p id="countdown" style="text-align: center; font-size: 8vmin;"></p>

					</div> 
				  
				</div>
					<div class="clearfix"> </div>
				<div class="col-md-12 bg-info">
				 <div class="callout callout-info">
						Unit Source and Customer info bellow. 
				 </div>
					 <div class="form-group col-md-6 ">
						<label for="warranty_branch_name">Unit Source</label>						
						<input type="text" class="form-control" id="warranty_branch_name" name="warranty_branch_name" autocomplete="off" value="<?php echo $warranty_data['branch_name'] ?>" readonly="readonly" />
					 </div>
					 <div class="col-md-1"> </div>
					 <div class="form-group col-md-4">
						<label for="warranty_po_no">P/O Number</label>
						<input type="text" class="form-control" id="warranty_po_no" name="warranty_po_no"  autocomplete="off" value="<?php echo $warranty_data['warranty_po_no'] ?>" readonly="readonly" />
					 </div>
					 
					 <div class="form-group col-md-6">
						<label for="warranty_customer_nama">Customer</label>
						<input type="text" class="form-control" id="warranty_customer_nama" name="warranty_customer_nama"  autocomplete="off" value="<?php echo $warranty_data['customer_nama'] ?>" readonly="readonly" />						
					 </div>
					 <div class="col-md-1"> </div>
					 <div class="form-group col-md-4">
						<label for="warranty_so_no">S/O Number</label>
						<input type="text" class="form-control" id="warranty_so_no" name="warranty_so_no" autocomplete="off" value="<?php echo $warranty_data['warranty_so_no'] ?>" readonly="readonly"/>
					 </div>
				</div>
				<div class="clearfix"> </div>
				<div class="col-md-12 bg-warning">
					<br/>
					<div class="callout callout-warning">
						Unit Installment info bellow. 
					</div>
					 <div class="col-md-12">
						 <div class="form-group col-md-3">
							<label for="warranty_delivery_date">Delivery Date</label>
							<input type="text" class="form-control" id="warranty_delivery_date" name="warranty_delivery_date" autocomplete="off" value="<?php echo $warranty_data['warranty_delivery_date'] ?>" readonly="readonly"/>
						 </div>
						 <div class="col-md-1"> </div>
						 <div class="form-group col-md-3">
							<label for="warranty_installed_date">Installed Date</label>
							<input type="text" class="form-control" id="warranty_installed_date" name="warranty_installed_date"  value="<?php echo $warranty_data['warranty_installed_date'] ?>" readonly="readonly"/>
						 </div>
						 <div class="col-md-1"> </div>
						 <div class="form-group col-md-3">
							<label for="warranty_handsover_date">Handsover Date</label>
							<input type="text" class="form-control" id="warranty_handsover_date" name="warranty_handsover_date" value="<?php echo $warranty_data['warranty_handsover_date'] ?>" readonly="readonly"/>
						 </div>
					 </div>
				</div>
			<!-- 	 <div class="col-md-12">
					 <div class="form-group col-md-3 ">						 
					 <?php 
						$isRevoke = '<input class="icheckbox_blue " id="is_revoke" name="is_revoke" readonly="readonly" type="checkbox" '  ;
						if ($warranty_data['is_revoke'] == 1) { $isRevoke .= ' checked="checked"  value="1" /> '; }else { $isRevoke .= ' value ="0" /> ' ; }
						 print $isRevoke ; ?>							
						<label for="is_revoke"  >Warranty Revoke </label>							
					 </div>
					 <div class="form-group col-md-3">				
					 
					 <?php 
						$isActive = '<input class="icheckbox_blue " id="is_active" name="is_active" readonly="readonly" type="checkbox" '  ;
						if ($warranty_data['is_active'] == 1) { $isActive .= ' checked ="checked" value="1"  /> '; }else { $isActive .= ' value ="0" /> ' ; }
						 print $isActive ; ?>
						<label for="is_active">Active Warranty </label>
					 </div>
				</div> -->
							 
			 
			 
			 </div>
		  </div>
		 </div>
		 
	 </div>
	</section>










</div>
<script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js') ?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>


<script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $warranty_data['warranty_expired_date'] ?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var month = Math.floor(distance / (1000 * 60 * 60 * 24 * 30));
  var days = Math.floor(distance / (1000 * 60 * 60 * 24) );
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="countdown"
  document.getElementById("countdown").innerHTML =  days + "D " + hours + "H " + minutes + "m ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("countdown").innerHTML = "EXPIRED";
  }
}, 1000);

</script>
</body>
</html>
  