<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Orders New</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Orders New</li>
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
            <h3 class="box-title">Add Order</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('ordersnew/create') ?>" method="post" class="form-horizontal">
              <div class="box-body">
					<div class="row col-sm-12">
                <?php echo validation_errors(); ?>
					 <div class="col-sm-12 pb-3">
						 <div class="col-sm-3 pull pull-right">
						 <div class="form-group">
							<label for="gross_amount" class="col-sm-12 control-label">Date: <?php echo date('Y-m-d') ?>   <?php echo date('h:i a') ?></label>
							<label for="gross_amount" class="col-sm-12 control-label"></label>
						 </div>
						 </div>
						 <div class="col-md-4 col-xs-12 pull pull-left">

							<div class="form-group " >
							  <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Table</label>
							  <div class="col-sm-7">
								 <select class="form-control" id="table_name" name="table_name">
									<?php foreach ($table_data as $key => $value): ?>
									  <option value="<?php echo $value['id'] ?>"><?php echo $value['table_name'] ?></option>  
									<?php endforeach ?>
									
								 </select>
						  
							  </div>
							</div>
						 </div>
                </div>
					 </div>
					 <div class="row">
						<div class="col-sm-12 text-center">
						 <?php foreach ($products as $key => $value): ?>
							<div class="col-sm-3">
								<!--<div class="card" style="border: solid 1px;"> -->
									<button type="button" class="btn btn-default card" style="border:solid 1px;" data-toggle="modal" data-target="#addModal" data-productid="<?php echo $value['id']?>" data-productprice="<?php echo $value['price']?>" data-productname="<?php echo $value['name'] ?>" >
									<div class="card">
									<img src="<?php echo base_url("/"). $value['image'] ?>" alt="<?php echo $value['name']?>" class="img-circle" width="50" height="50" />
									<span class="icon small-box-footer"><?php echo $value['name'] ?></span></div>
									</button> 
									
									
									<!--
									<img class="card-img-top img-fluid p-2 col-1" src="<?php echo base_url('/').$value['image'] ?>" alt="">
										<div class="card-body" id="<?php echo $value['id'] ?>">
										  <h3 class="card-title mb-2"><?php echo $value['name'] ?></h3>
										  <span class="text-secondary">Rp <span class="harga"><?php echo $value['price'] ?></span></span>
										-->
										<!--
										<div class="">
											<input type="number" class="form-action" placeholder="0" min="0">
											<button class="btn btn-primary tambah form-action" >Add</button>	
											<button type="button" class="btn btn-default"  data-toggle="modal" data-target="#addModal">
										</div>
										-->
										<!-- </div> -->
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
								</thead>
								<tbody>

							</table>
						</div>
						 
					 
					 </div>
					 <div class="clear" > </div>
				<div class="bodybox">
                <div class="col-md-6 col-xs-12 pull pull-right">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Gross Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" autocomplete="off">
                    </div>
                  </div>
                  <?php if($is_service_enabled == true): ?>
                  <div class="form-group">
                    <label for="service_charge" class="col-sm-5 control-label">S-Charge <?php echo $company_data['service_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="service_charge" name="service_charge" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="service_charge_value" name="service_charge_value" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>
                  <?php if($is_vat_enabled == true): ?>
                  <div class="form-group">
                    <label for="vat_charge" class="col-sm-5 control-label">Vat <?php echo $company_data['vat_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="vat_charge" name="vat_charge" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="vat_charge_value" name="vat_charge_value" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>
                  <div class="form-group">
                    <label for="discount" class="col-sm-5 control-label">Discount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" onkeyup="subAmount()" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" autocomplete="off">
                    </div>
                  </div>

                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">
                <button type="submit" class="btn btn-primary">Create Order</button>
                <a href="<?php echo base_url('orders/') ?>" class="btn btn-warning">Back</a>
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
<?php if(in_array('createOrderNew', $user_permission)):
$id = 'keyup="countTotal()"';
 ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Order New</h4>
      </div>

      <form role="form" method="post" id="createForm"><!--action="<?php echo base_url('ordersnew/create') ?>" --> 

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
<?php endif; ?>
