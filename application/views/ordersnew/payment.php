

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
            <h3 class="box-title">PAYMENT</h3>
			 </div>
				<div class="box-body">
				<!-- /.box-header -->
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

		if(!in_array('createBill', $this->permission)) {
			$createBill = " style ='display : none;' " ;
		}else {
			$createBill = " style ='display : relative;' " ;
		}

?>
				<form role="form" action="<?php echo base_url('ordersnew/createbill') ?>" method="post" class="form-horizontal">
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
                  <div class="form-group">
                    <label for="discount" class="col-sm-5 control-label">Discount (%)</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control text-right" id="discount_charge" name="discount_charge" placeholder="Discount" onkeyup="subAmount()" value="<?php echo $order_data['order']['discount_charge_rate'] ?>" autocomplete="off">
							 <input type="text" class="form-control text-right" id="discount_charge_value" name="discount_charge_value" placeholder="Discount" disabled value="<?php echo $order_data['order']['discount_charge_amount'] ?>" autocomplete="off">
							 <input type="hidden" id="discount_charge_amount" name="discount_charge_amount" value="<?php echo $order_data['order']['discount_charge_amount'] ; ?>" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control text-right" id="net_amount" name="net_amount" disabled value="<?php echo number_format($order_data['order']['net_amount'], 2, ',', '.') ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" value="<?php echo $order_data['order']['net_amount'] ?>" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="paid_status" class="col-sm-5 control-label">Paid Status</label>
                    <div class="col-sm-7">
                      <select type="text" class="form-control" id="paid_status" name="paid_status">
                        <option value="1">Paid</option>
                        <option value="2" selected>Unpaid</option>
                      </select>
                    </div>
                  </div>

                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer" >
                <a target="__blank" href="<?php echo base_url() . 'ordersnew/printDiv/'.$order_data['order']['id'] ?>" class="btn btn-default" >Print</a>
                <button type="submit" class="btn btn-primary" <?php echo $createBill ; ?> >Payment</button>
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


<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";
  var manageTable;
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

		
	  
    $(".select_group").select2();

    $("#OrderMainNav").addClass('active');
    $("#manageOrderSubMenu").addClass('active');
    
    

  }); // /document

  // get the product information from the server

  // calculate the total amount of the order
  function subAmount() {
    var service_charge = <?php echo ($company_data['service_charge_value'] > 0) ? $company_data['service_charge_value']:0; ?>;
    var vat_charge = <?php echo ($company_data['vat_charge_value'] > 0) ? $company_data['vat_charge_value']:0; ?>;

    var totalSubAmount = 0;

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

  } // /sub total amount
  

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