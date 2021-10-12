

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Orders</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Orders</li>
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
            <h3 class="box-title">Edit Order   </h3>
			 </div>
				<div class="box-body">



				<!-- /.box-header -->
					<!--<form role="form" action="<?php base_url('ordersnew/createbill') ?>" method="post" class="form-horizontal">-->
					<div class="col-sm-12">

						<?php echo validation_errors(); ?>
						<div class="row">
							<div class="form-group col-sm-8">
								<label for="storename" class="control-label"> STORE NAME : <?php echo $order_data['store_data'] ;?> </label>
							</div>
						</div>

						<div class=" row">
							<div class="form-group col-sm-4">
								<label for="date" class="control-label">Date: <?php echo date('Y-m-d') . date('h:i a') ?></label>
							</div>
							<div class="form-group col-sm-4">
								<label for="billno" class="control-label">Bill No: <?php echo $order_data['order']['bill_no'] ; ?></label>
								<label for="billno" class="control-label fade"  >Bill No: <?php echo $order_data['order']['id'] ; ?></label>
								<input class="hidden" id="headid" value="<?php echo $order_data['order']['id'] ; ?>" />
							</div>
						</div>

						<div class="row">
							<div class="form-group col-sm-4">
								<label for="gross_amount" class="control-label" style="text-align:left;">Table</label>
							</div>
							<div class="form-group  col-sm-4">
							 <input class="hidden" id="table_name" name="table_name" value="<?php echo $order_data['order_table']['id'] ; ?>" />
							 <input class="text"  value="<?php echo $order_data['order_table']['table_name'] ; ?>"  disabled />
								<!--<select class="form-control" id="table_name" name="table_name">
								<?php if($order_data['order_table']['id']): ?>
									<option value="<?php echo $order_data['order_table']['id']; ?>" <?php if($order_data['order_table']['id'] == $order_data['order']['table_id']) { echo "selected='selected'"; } ?> ><?php echo $order_data['order_table']['table_name']; ?></option>
								<?php endif; ?>								
								</select> -->
							</div>
						
						</div>
					</div>	
				</div>	
					 <div class="card ">
					  <div class="box">
						 <div class="box-header">
							<h3 class="box-title">Pick Table Menu</h3>
						 </div>
						 <!-- /.box-header -->
						 <form role="form" action="<?php echo base_url('ordersnew/createDetail') ?>" method="post" class="form-horizontal">
							
 <style> 
      
       .vertical-scrollable> .row { 
          /* position: absolute;  */
          top: 120px; 
          bottom: 100px; 
          left: 180px; 
          width: 100%; 
          height: 350px; 
          overflow-y: scroll;  
			 margin-bottom: 40px;
			 border: 2px solid gray;
			
        } 
		  .vertical-scrollable> .row2 { 
          /* position: absolute;  */
          top: 120px; 
          bottom: 100px; 
          left: 180px; 
          width: 100%; 
          height: 400px; 
          overflow-y: scroll;  
			 margin-bottom: 40px;
			 /* border: 1px solid gray; */
			 padding: 20px;
        } 
        .col-sm-3 {  
            color: white;  
            /* font-size: 24px;   */
            /* padding-bottom: 20px;   */
            /* padding-top: 18px;   */
        }  
          
        .col-sm-3:nth-child(2n+1) {  
            background: #b8c7ce;  
        }  
          
        .col-sm-3:nth-child(2n+2) {  
            background: #ddd;  
        }  
		  .description-text {
			 white-space: pre-wrap; /* css-3 */
			 white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
			 white-space: -pre-wrap; /* Opera 4-6 */
			 white-space: -o-pre-wrap; /* Opera 7 */
			 word-wrap: break-word; /* Internet Explorer 5.5+ */
			 color : #337ab7;
		  }
  
    </style>
							  <div class="box-body">
								<div class="col-sm-12 container vertical-scrollable ">
									<div class="row text-center">
									 <?php foreach ($products as $key => $value): ?>

										<?php
										#print_r ($products);
										#die();
										
										$btnData = "data-toggle='modal' data-target='#addModal' data-productid='".$value['id']."'" ;
										$btnData .= "	data-orderheadid='".$order_data['order']['id']."'" ;
										$btnData .= "	data-productprice='".$value['price']."'" ;
										$btnData .= "	data-productname='".$value['name']."'" ;
										
										?>									 
									 
										<div class="col-xs-2">
											<div class="card description-block">
												<button type="button" class="btn btn-default card-body" <?php echo $btnData; ?>  >
												<img src="<?php echo base_url("/"). $value['image'] ?>" alt="<?php echo $value['name']?>" class="img-circle img-fluid float-left" width="40" height="40" />
												 <br/>
												<span class="description-text"><?php echo $value['name'] ?></span></button>
											</div>
										</div>
									 <?php endforeach ?>
									</div>							
								</div>
								
								
									<div class="col-sm-12 container vertical-scrollable">
										<div class="row2">
										<table id="manageTable" class="table table-bordered table-striped">
											<thead>
												<th>Name</th>
												<th>Qty</th>
												<th>Price</th>
												<th>SubTotal</th>
												<th>Action</th>
											</thead>
											<tbody>

										</table>
										</div>
									</div>
									 
								 
							 </div>								 
							</form>
						 <!-- /.box-body -->
					  </div>	
					  </div>					  
                <br /> <br/>
                <br /> <br/>
<?php 

		if(!in_array('viewBill', $this->permission)) {
			$viewBill = " style ='display : none;' " ;
		}
		else {
			$viewBill = " style ='display : relative;' " ;
		}

		if(!in_array('createBill', $this->permission) || ($order_data['order']['paid_status'] == 1) ){
			$createBill = " style ='display : none;' " ;
		}else {
			$createBill = " style ='display : relative;' " ;
		}

?>
				<form role="form" action="<?php echo base_url('ordersnew/createbill/'.$order_data['order']['id']) ?>" method="post" class="form-horizontal">
					<div class="row" <?php echo $viewBill; ?> >
                <div class="col-md-6 col-xs-12 pull pull-right">
						<div class="form-group">
							<input type="hidden" id="bill_no" name="bill_no" value="<?php echo $order_data['order']['bill_no'] ; ?>" />
							<input type="hidden" id="order_id" name="order_id" value="<?php echo $order_data['order']['id'] ; ?>" />
							<input type="hidden" id="table_id" name="table_id" value="<?php echo $order_data['order_table']['id'] ; ?>" />
							<input type="hidden" id="store_id" name="store_id" value="<?php echo $order_data['order_table']['store_id'] ; ?>" />
							<input type="hidden" id="gross" name="gross" value="<?php echo $order_data['order']['gross_amount'] ; ?>" />
							
							
						
						
						
						</div>
                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Gross Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control text-right" id="gross_amount" name="gross_amount" disabled value="<?php echo number_format($order_data['order']['gross_amount'], 2, ',', '.') ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" value="<?php echo $order_data['order']['gross_amount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <?php if($is_service_enabled == true): ?>
                  <div class="form-group">
                    <label for="service_charge" class="col-sm-5 control-label">S-Charge <?php echo $company_data['service_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control  text-right" id="service_charge" name="service_charge" disabled value="<?php echo number_format($order_data['order']['service_charge_amount'], 2, ',', '.') ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="service_charge_value" name="service_charge_value" value="<?php echo $order_data['order']['service_charge_amount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>
                  <?php if($is_vat_enabled == true): ?>
                  <div class="form-group">
                    <label for="vat_charge" class="col-sm-5 control-label">Vat <?php echo $company_data['vat_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control text-right" id="vat_charge" name="vat_charge" disabled value="<?php echo number_format($order_data['order']['vat_charge_amount'], 2, ',', '.') ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="vat_charge_value" name="vat_charge_value" value="<?php echo $order_data['order']['vat_charge_amount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>
                  <!--<div class="form-group">
                    <label for="discount" class="col-sm-5 control-label">Discount (%)</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control text-right" id="discount_charge" name="discount_charge" placeholder="Discount" onkeyup="subAmount()" value="<?php echo $order_data['order']['discount_charge_rate'] ?>" autocomplete="off">
							 <input type="text" class="form-control text-right" id="discount_charge_value" name="discount_charge_value" placeholder="Discount" disabled value="<?php echo $order_data['order']['discount_charge_amount'] ?>" autocomplete="off">
							 <input type="hidden" id="discount_charge_amount" name="discount_charge_amount" value="<?php echo $order_data['order']['discount_charge_amount'] ; ?>" >
                    </div>
                  </div>
						-->
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control text-right" id="net_amount" name="net_amount" disabled value="<?php echo number_format($order_data['order']['net_amount'], 2, ',', '.') ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" value="<?php echo $order_data['order']['net_amount'] ?>" autocomplete="off">
                    </div>
                  </div>
						<!--
                  <div class="form-group">
                    <label for="paid_status" class="col-sm-5 control-label">Paid Status</label>
                    <div class="col-sm-7">
                      <select type="text" class="form-control" id="paid_status" name="paid_status">
                        <option value="1">Paid</option>
                        <option value="2" selected>Unpaid</option>
                      </select>
                    </div>
                  </div>
						-->

                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer" >
						<!--
                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">
						-->
                <a target="__blank" href="<?php echo base_url() . 'ordersnew/printDiv/'.$order_data['order']['id'] ?>" class="btn btn-default" >Print</a>
                <button type="button" class="btn btn-primary" <?php echo $createBill ; ?> data-toggle='modal' data-target='#billModal' >Payment</button>
                <a href="<?php echo base_url('ordersnew/') ?>" class="btn btn-warning">Back</a>
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



<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Order New</h4>
      </div>

      <form role="form" method="post" id="createForm" action="<?php echo base_url('ordersNew/createDetail') ?>" >

        <div class="modal-body">

          <div class="form-group">
            <label for="qty" id='productname'>Quantity</label>            
			<input type="hidden" name="productid" id="productid" class="form-control" disabled placeholder="ProductID" value="">
			<input type="text" name="productprice" id="productprice" class="form-control" disabled placeholder="Price" value="">
			<input type="text" name="qty" id="qty" class="form-control" required placeholder="Enter Qty">
          </div>
		  <div class="form-group">
			<input type="text" name="amount" id="amount" class="form-control" disabled autocomplete="off">
            <input type="hidden" name="amount_value" id="amount_value" class="form-control" autocomplete="off">
            <input type="hidden" name="productprice_post" id="productprice_post" class="form-control" autocomplete="off">
            <input type="hidden" name="productid_post" id="productid_post" class="form-control" autocomplete="off">            
            <input type="hidden" name="productname_post" id="productname_post" class="form-control" autocomplete="off">            
            <input type="hidden" name="orderheadid" id="orderheadid" class="form-control" autocomplete="off">            
		  </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary " id="save">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php if(in_array('deleteOrder', $user_permission)): ?>
<!-- remove item modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Item</h4>
      </div>

      <form role="form" action="<?php echo base_url('ordersnew/removeitem') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Do you really want to remove?</p>
        </div>
        <div class="modal-footer">
			 <input type="hidden" name="rproductid" id="rproductid" class="form-control"  placeholder="ProductID" value="">
			 <input type="hidden" name="rorderheadid" id="rorderheadid" class="form-control" autocomplete="off" value="">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('createBill', $user_permission)): ?>
<!-- remove item modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="billModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Payment</h4>
      </div>

		<form role="form" action="<?php echo base_url('ordersnew/createbill') ?>" method="post" id="removeForm">
        <div class="modal-body">
			<div class="row card">
				<div class="form-group col-sm-12 card-header">	
				 <div class="row form-group">
					<label for="gross_amount" class="col-sm-5 control-label">Subtotal</label>
					<input type="text" class="text-right col-sm-7" id="gross_amount" name="gross_amount" disabled value="<?php echo number_format($order_data['order']['gross_amount'], 2, ',', '.') ?>" autocomplete="off">
					<input type="hidden" id="gross_amount_value" name="gross_amount_value" value="<?php echo $order_data['order']['gross_amount'] ?>" autocomplete="off">
				 </div>
				 <div class="row form-group">
					<label for="service_charge" class="col-sm-5 control-label">Service Charge %</label>
					<input type="text" class=" text-right col-sm-2 " id="sc_value" name="sc_value" disabled value="<?php echo number_format($company_data['service_charge_value'], 2, ',', '.') ?>" autocomplete="off">
					<input type="text" class="text-right col-sm-5" id="sc_amount" name="sc_amount" disabled value="<?php echo $order_data['order']['service_charge_amount'] ?>" autocomplete="off">
				 </div>
				 <div class="row form-group">
					<label for="service_charge" class="col-sm-5 control-label">Vat  <?php echo $company_data['vat_charge_value'] ?> %</label>
					<input type="text" class=" text-right col-sm-7 " id="vat_value" name="vat_value" disabled value="<?php echo number_format($order_data['order']['vat_charge_amount'], 2, ',', '.') ?>" autocomplete="off">					
				 </div>
				 <div class="row form-group">
					<label for="discount" class="col-sm-5 control-label">Discount %</label>
					<input type="text" class=" text-right col-sm-2 " id="payment_discount_charge_rate" name="payment_discount_charge_rate" placeholder="% - Discount in Percent"  autocomplete="off"> 
					<input type="text" class="text-right col-sm-5" id="payment_discount_charge_value" name="payment_discount_charge_value" placeholder="Rp - Discount in Amount" autocomplete="off">
				 </div>
				</div>
			</div>
			<div class="row card">
				 
				 <div class="modal-header">
					<h4 class="modal-title">Paid Now??</h4>
				 </div>
				<div class="col-sm-12 card-body">
				 <div class="row ">
					<label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
				   <div class="col-sm-7">
						<input type="text" class="form-control text-right" id="net_amount" name="net_amount" disabled value="<?php echo number_format($order_data['order']['net_amount'], 2, ',', '.') ?>" autocomplete="off">
						<input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" value="<?php echo $order_data['order']['net_amount'] ?>" autocomplete="off">
				   </div>
				 </div>
				 <div class="row form-group">
					<div class="col-sm-12 card-body">
						<div class="row">
						<label for="Cash" class="col-sm-5 control-label">Cash Tendered </label>            
						<div class="col-sm-7">
						<input type="text" class="form-control text-right " id="casht" name="casht" placeholder="Rp - Amount" autocomplete="off">	
						</div>
						</div>
					</div>
					
				 </div>
				</div>
         </div>
          </div>
		
			
			<input type="hidden" name="billorderheadid" id="rorderheadid" class="form-control" autocomplete="off" value="">
			<input type="hidden" name="totalamount" id="totalamount" class="form-control" disabled placeholder="Total Bill" value="">
			<input type="hidden" name="cashtened" id="cashtend" class="form-control" required placeholder="Enter Payment">
			<input type="hidden" id="payment_vat_charge_rate" name="payment_vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>"/>
			<input type="hidden" id="payment_vat_charge_value" name="payment_vat_charge_value" value="<?php echo $order_data['order']['vat_charge_amount'] ?>" />
		  <div class="form-group">
			<input type="hidden" name="amount_change" id="amount_change" class="form-control" disabled autocomplete="off">
			<input type="hidden" id="payment_bill_no" name="payment_bill_no"   value="<?php echo $order_data['order']['bill_no'] ; ?>" />
			<input type="hidden" id="payment_order_id" name="payment_order_id"  value="<?php echo $order_data['order']['id'] ; ?>"/>
			<input type="hidden" id="payment_table_id" name="payment_table_id"  value="<?php echo $order_data['order_table']['id'] ; ?>" />
			<input type="hidden" id="payment_store_id" name="payment_store_id" value="<?php echo $order_data['order_table']['store_id'] ; ?>"  />
			<input type="hidden" id="payment_gross_amount_value" name="payment_gross_amount_value" value="<?php echo $order_data['order']['gross_amount'] ?>" />
			<input type="hidden" id="payment_service_charge_rate" name="payment_service_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>"/>
			<input type="hidden" id="payment_service_charge_value" name="payment_service_charge_value" value="<?php echo $order_data['order']['vat_charge_amount'] ?>" />
			<input type="hidden" id="payment_net_amount_value" name="payment_net_amount_value" value="<?php echo $order_data['order']['net_amount'] ?>" />				


        <div class="modal-footer">			 
			 
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
		  
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>


<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";
  var manageTable;
  // function printOrder(id)
  // {
  //   if(id) {
  //     $.ajax({
  //       url: base_url + 'orders/printDiv/' + id,
  //       type: 'post',
  //       success:function(response) {
  //         var mywindow = window.open('', 'new div', 'height=400,width=600');
  //         // mywindow.document.write('<html><head><title></title>');
  //         // mywindow.document.write('<link rel="stylesheet" href="<?php //echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>" type="text/css" />');
  //         // mywindow.document.write('</head><body >');
  //         mywindow.document.write(response);
  //         // mywindow.document.write('</body></html>');

  //         mywindow.print();
  //         mywindow.close();

  //         return true;
  //       }
  //     });
  //   }
  // }

  $(document).ready(function() {
	  
	var headid = $('#headid').val() ;
	  
  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    'ajax': base_url + 'ordersnew/fetchToGrid/'+headid,
    'order': []
  });

	$('#addModal').on('show.bs.modal', function (event) { // id of the modal with event
			var button = $(event.relatedTarget) ;
			var productid = button.data('productid') ;
			var productprice = button.data('productprice') ;
			var productname = button.data('productname') ;
			var amount_value = 0;
			var orderheadid = button.data('orderheadid');
			
			
			var test = " Add Order "+ productid ;
			$('#productid').val(productid);
			$("#productid_post").val(productid);
			$("#productname_post").val(productname);
			$("#productprice_post").val(productprice);
			$('#productprice').val(productprice);
			$('#productname').text(productname);
			$('#orderheadid').val(orderheadid);
			
			
			
			$('#qty').prop('keyup', 'countTotal(productid)');
			$('#qty').on('change keyup', function countTotal(id= null) {		
			if(id) {
			  var total = Number($("#qty").val()) * Number($("#productprice").val());
			  total = total.toFixed(2);
			  $("#amount").val(total);
			  $("#amount_value").val(total);		
				amount_value= total;
			} else {
			  alert('no row !! please refresh the page');
			}
			subAmount();
			})
		})
		
		
	$('#removeModal').on('show.bs.modal', function (event) { 
		var button = $(event.relatedTarget) ;
		var rproductid = button.data('productid') ;
		var rorderheadid = button.data('orderheadid');
		
		$('#rorderheadid').val(rorderheadid);
		$('#rproductid').val(rproductid);
		
	})


		
		
	/*	
		$("#addModal").on("submit", "#createForm", function(event){
			event.preventDefault();
			$('#save').attr('disabled', 'disabled');
			var formData = $(this).serialize();
			
			$.ajax({
				url:base_url + "ordersNew/addToGrid",
				method:"POST",
				data:formData,
				success:function(data){				
					$('#createForm')[0].reset();
					$('#addModal').modal('hide');
					$('#save').attr('disabled', false);
				}
			})
			var manageTable = $('#manageTable').DataTable();
			var rowNode = manageTable 
				.row.add([productname, qty, productprice, amount_value])
				.draw()
				.node;
			
			$(rowNod) 
				.css('color', 'red')
				.animate({color:'black'});
				
				
			
		})	  
		*/
		
	  
    $(".select_group").select2();

    $("#OrderMainNav").addClass('active');
    $("#manageOrderSubMenu").addClass('active');
    
    

  }); // /document

  function getTotal(row = null) {
    if(row) {
      var total = Number($("#rate_value_"+row).val()) * Number($("#qty_"+row).val());
      total = total.toFixed(2);
      $("#amount_"+row).val(total);
      $("#amount_value_"+row).val(total);
      
      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }

  // get the product information from the server
  function getProductData(row_id)
  {
    var product_id = $("#product_"+row_id).val();    
    if(product_id == "") {
      $("#rate_"+row_id).val("");
      $("#rate_value_"+row_id).val("");

      $("#qty_"+row_id).val("");           

      $("#amount_"+row_id).val("");
      $("#amount_value_"+row_id).val("");

    } else {
      $.ajax({
        url: base_url + 'orders/getProductValueById',
        type: 'post',
        data: {product_id : product_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
          
          $("#rate_"+row_id).val(response.price);
          $("#rate_value_"+row_id).val(response.price);

          $("#qty_"+row_id).val(1);
          $("#qty_value_"+row_id).val(1);

          var total = Number(response.price) * 1;
          total = total.toFixed(2);
          $("#amount_"+row_id).val(total);
          $("#amount_value_"+row_id).val(total);
          
          subAmount();
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }

  // calculate the total amount of the order
  function subAmount() {
    var service_charge = <?php echo ($company_data['service_charge_value'] > 0) ? $company_data['service_charge_value']:0; ?>;
    var vat_charge = <?php echo ($company_data['vat_charge_value'] > 0) ? $company_data['vat_charge_value']:0; ?>;

    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
    } // /for

    //totalSubAmount = totalSubAmount.toFixed(2);
	 totalSubAmount = $("#gross").val();

    // sub total
    $("#gross_amount_value").val(totalSubAmount);
    //totalSubAmount = totalSubAmount.toFixed(2);
	 $("#gross_amount").val(totalSubAmount);
	 

    // vat
    var vat = (Number($("#gross_amount").val())/100) * vat_charge;
    $("#vat_charge_value").val(vat);
    vat = vat.toFixed(2);
    $("#vat_charge").val(vat);

    // service
    var service = (Number($("#gross_amount").val())/100) * service_charge;
    $("#service_charge_value").val(service);
    service = service.toFixed(2);
    $("#service_charge").val(service);
    
    // total amount
    var totalAmount = (Number(totalSubAmount) + Number(vat) + Number(service));
    totalAmount = totalAmount.toFixed(2);
    // $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);

    var discountCharge = $("#discount_charge").val();
    if(discountCharge) {
		var discountValue  = Number(totalAmount) * (Number(discountCharge)/100) ; 
		$("#discount_charge_amount").val(discountValue);
		discountValue = discountValue.toFixed(2);
		$("#discount_charge_value").val(discountValue);
      var grandTotal = Number(totalAmount) - Number(discountValue);
      $("#net_amount_value").val(grandTotal);
      grandTotal = grandTotal.toFixed(2);
      $("#net_amount").val(grandTotal);
    } else {
      $("#net_amount").val(totalAmount);
      $("#net_amount_value").val(totalAmount);
      
    } // /else discount 

    var paid_amount = Number($("#paid_amount").val());
    if(paid_amount) {
      var net_amount_value = Number($("#net_amount_value").val());
      var remaning = net_amount_value - paid_amount;
      $("#remaining").val(remaning.toFixed(2));
      $("#remaining_value").val(remaning.toFixed(2));
    }

  } // /sub total amount

  function paidAmount() {
    var grandTotal = $("#net_amount_value").val();

    if(grandTotal) {
      var dueAmount = Number($("#net_amount_value").val()) - Number($("#paid_amount").val());
      dueAmount = dueAmount.toFixed(2);
      $("#remaining").val(dueAmount);
      $("#remaining_value").val(dueAmount);
    } // /if
  } // /paid amoutn function

  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }
  

function addDetail(id) 
{
		if(id) {
			$("#addDetail").on('submit', function() {
				var form = $(this);
				var formData = form.serialize();
				$.ajax({
						  url: form.attr('action'),
						  type: form.attr('method'),
						  data: formData, 
						  dataType: 'json',
						  success:function(response) {

							 manageTable.ajax.reload(null, false); 

							 if(response.success === true) {
								$("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
								  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
								'</div>');

								// hide the modal
								$("#addDetail").modal('hide');

							 } else {

								$("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
								  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
								'</div>'); 
							 }
						  }
						}); 

						return false;			
			});
		}
}  


// remove functions 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);
		var formData = form.serialize();
      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: formData, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 
			

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").modal('hide');
				
          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}

</script>