

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
            <h3 class="box-title">Edit Order</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('orders/create') ?>" method="post" class="form-horizontal">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="date" class="col-sm-12 control-label">Date: <?php echo date('Y-m-d') . date('h:i a') ?></label>
                </div>
					 
                <div class="form-group">
                  <label for="billno" class="col-sm-12 control-label">Bill No: <?php echo $order_data['order']['bill_no'] ; ?></label>
                  <label for="billno" class="col-sm-12 control-label fade"  >Bill No: <?php echo $order_data['order']['id'] ; ?></label>
						<input class="hidden" id="headid" value="<?php echo $order_data['order']['id'] ; ?>" />
                </div>
					 
                <div class="col-md-4 col-xs-12 pull pull-left">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Table</label>
                    <div class="col-sm-7">
                      <select class="form-control" id="table_name" name="table_name">
                        <?php if($order_data['order_table']['id']): ?>
                          <option value="<?php echo $order_data['order_table']['id']; ?>" <?php if($order_data['order_table']['id'] == $order_data['order']['table_id']) { echo "selected='selected'"; } ?> ><?php echo $order_data['order_table']['table_name']; ?></option>
                        <?php endif; ?>
								
								<!--
		
                        <?php foreach ($table_data as $key => $value): ?>
                          <option value="<?php echo $value['id'] ?>" <?php if($order_data['order']['table_id'] == $value['id']) { echo 'selected="selected"'; } ?> ><?php echo $value['table_name'] ?></option>  
                        <?php endforeach; ?>
								-->
                        
                      </select>
                    </div>
                  </div>

                  
                </div>
					 </div>
					 <div class="card ">
					  <div class="box">
						 <div class="box-header">
							<h3 class="box-title">Add Order</h3>
						 </div>
						 <!-- /.box-header -->
						 <form role="form" action="<?php base_url('ordersnew/createDetail') ?>" method="post" class="form-horizontal">
							  <div class="box-body">

								 <div class="row">
									<div class="col-sm-12 text-center">
									 <?php foreach ($products as $key => $value): ?>

										<?php
										#print_r ($products);
										#die();
										
										$btnData = "data-toggle='modal' data-target='#addModal' data-productid='".$value['id']."'" ;
										$btnData .= "	data-orderheadid='".$order_data['order']['id']."'" ;
										$btnData .= "	data-productprice='".$value['price']."'" ;
										$btnData .= "	data-productname='".$value['name']."'" ;
										
										?>									 
									 
										<div class="col-sm-3">
											<div class="card description-block" style="border: solid 1px; overflow:hidden !important;">
												<button type="button" class="btn btn-default card-body pull-left" <?php echo $btnData; ?>  >
												<img src="<?php echo base_url("/"). $value['image'] ?>" alt="<?php echo $value['name']?>" class="img-circle img-fluid float-left" width="50" height="50" />
												</button> <br/>
												<span class="description-text"><?php echo $value['name'] ?></span>
											</div>
										</div>
									 <?php endforeach ?>
										</div>							
									</div>
									<div class="col-lg-12">
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
							</form>
						 <!-- /.box-body -->
					  </div>	
					  </div>					  
                <br /> <br/>
                <br /> <br/>
					<div class="box">
                <div class="col-md-6 col-xs-12 pull pull-right">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Gross Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled value="<?php echo $order_data['order']['gross_amount'] ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" value="<?php echo $order_data['order']['gross_amount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <?php if($is_service_enabled == true): ?>
                  <div class="form-group">
                    <label for="service_charge" class="col-sm-5 control-label">S-Charge <?php echo $company_data['service_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="service_charge" name="service_charge" disabled value="<?php echo $order_data['order']['service_charge_amount'] ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="service_charge_value" name="service_charge_value" value="<?php echo $order_data['order']['service_charge_amount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>
                  <?php if($is_vat_enabled == true): ?>
                  <div class="form-group">
                    <label for="vat_charge" class="col-sm-5 control-label">Vat <?php echo $company_data['vat_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="vat_charge" name="vat_charge" disabled value="<?php echo $order_data['order']['vat_charge_amount'] ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="vat_charge_value" name="vat_charge_value" value="<?php echo $order_data['order']['vat_charge_amount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>
                  <div class="form-group">
                    <label for="discount" class="col-sm-5 control-label">Discount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" onkeyup="subAmount()" value="<?php echo $order_data['order']['discount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled value="<?php echo $order_data['order']['net_amount'] ?>" autocomplete="off">
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

              <div class="box-footer">

                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">

                <a target="__blank" href="<?php echo base_url() . 'ordersnew/printDiv/'.$order_data['order']['id'] ?>" class="btn btn-default" >Print</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
    // $("#description").wysihtml5();

    $("#OrderMainNav").addClass('active');
    $("#manageOrderSubMenu").addClass('active');
    
    
    // Add new row in the table 
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            

              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.name+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="rate[]" id="rate_'+row_id+'" class="form-control" disabled><input type="hidden" name="rate_value[]" id="rate_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" disabled><input type="hidden" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control"></td>'+
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  
              }
              else {
                $("#product_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });

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

    totalSubAmount = totalSubAmount.toFixed(2);

    // sub total
    $("#gross_amount").val(totalSubAmount);
    $("#gross_amount_value").val(totalSubAmount);

    // vat
    var vat = (Number($("#gross_amount").val())/100) * vat_charge;
    vat = vat.toFixed(2);
    $("#vat_charge").val(vat);
    $("#vat_charge_value").val(vat);

    // service
    var service = (Number($("#gross_amount").val())/100) * service_charge;
    service = service.toFixed(2);
    $("#service_charge").val(service);
    $("#service_charge_value").val(service);
    
    // total amount
    var totalAmount = (Number(totalSubAmount) + Number(vat) + Number(service));
    totalAmount = totalAmount.toFixed(2);
    // $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);

    var discount = $("#discount").val();
    if(discount) {
      var grandTotal = Number(totalAmount) - Number(discount);
      grandTotal = grandTotal.toFixed(2);
      $("#net_amount").val(grandTotal);
      $("#net_amount_value").val(grandTotal);
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
</script>