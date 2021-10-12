<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class OrdersNew extends Admin_Controller 
{
	var $currency_code = '';

	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Orders';

		$this->load->model('model_orders');
		$this->load->model('model_tables');
		$this->load->model('model_products');
		$this->load->model('model_company');
		$this->load->model('model_stores');

		$this->currency_code = $this->company_currency();
	}

	/* 
	* It only redirects to the manage order page
	*/
	public function index()
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		
		$this->data['table_data'] = $this->model_tables->getActiveTable();
		$this->data['page_title'] = 'Manage Orders';
		$this->render_template('ordersnew/index', $this->data);		
	}

	/*
	* Fetches the orders data from the orders table 
	* this function is called from the datatable ajax function
	*/
	public function fetchMenu() 
	{
       if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		$result = array('data' => array());

		$data = $this->model_products->getProductData();
		
		foreach ($data as $key=> $value) {
			$store_ids = json_decode($value['store_id']);
            
            
            $store_name = array();
            foreach ($store_ids as $k => $v) {
                $store_data = $this->model_stores->getStoresData($v);
                $store_name[] = $store_data['name'];
            }
			$this->data['product_id']=$value['id'];
			$store_name = implode(', ', $store_name);
			$img = '<button type="button" class="btn btn-default"  data-toggle="modal" data-target="#addModal" data-productid="'.$value['id'].'" data-productprice="'.$value['price'].'"  ><img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" /></button> <span class="icon small-box-footer">'.$value['name'].'</span>';

			$availability = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
			$productId = '<input type="hidden" name="id['.$value['id'].']" id="id['.$value['id'].']" class="form-control" autocomplete="off" value="'.$value['id'].'" >';
			$productName = '<input type="hidden" name="name['.$value['id'].']" id="name['.$value['id'].']" class="form-control" autocomplete="off" value="'.$value['name'].'" >';
			$productPrice = '<input type="hidden" name="price['.$value['id'].']" id="price['.$value['id'].']" class="form-control" autocomplete="off" value="'.$value['price'].'" >';
			$imgs = $img.$productId.$productName.$productPrice ;
			$buttons = '';
            if(in_array('updateProduct', $this->permission)) {
    			
				$buttons .= '<button type="button" class="btn btn-default"  data-toggle="modal" data-target="#addModal"><img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" /></button>';
            }
			
			$result['data'][$key] = array(
				$imgs
			);
		}
		#var_dump($result);
		echo json_encode($result);
	}
	public function fetchProductData()
	{
        if(!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		$result = array('data' => array());

		$data = $this->model_products->getProductData();

		foreach ($data as $key => $value) {
            $store_ids = json_decode($value['store_id']);
            
            
            $store_name = array();
            foreach ($store_ids as $k => $v) {
                $store_data = $this->model_stores->getStoresData($v);
                $store_name[] = $store_data['name'];
            }

            $store_name = implode(', ', $store_name);
            

			// button
            $buttons = '';
            if(in_array('updateOrder', $this->permission)) {
    			$buttons .= '<a href="'.base_url('products/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }
			

			$img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';

            $availability = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
			
			
			$result['data'][$key] = array(
				$img,
				$value['name'],
                $value['price'],
				$store_name,
                $availability,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}
	public function fetchToGrid(){
		
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());
		#print_r ($this->uri->segment(3));
		#die();
		$headid = $this->uri->segment(3);
		#print $headid ;

		$data = $this->model_orders->getOrdersItemData($headid);
		
		foreach($data as $key => $detail) {
			
			// button
			$buttons = '';
			
			/*
			if(in_array('viewOrder', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('ordersnew/printDiv/'.$detail['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}
			
			*/
			if(in_array('updateOrder', $this->permission)) {
				$buttons .= ' <a href="'.base_url('ordersnew/update/'.$detail['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteOrder', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" data-toggle="modal" data-target="#removeModal" data-orderheadid="'.$headid.'" data-productid="'.$detail['id'].'"  >';
				
				$buttons .= ' <input type="hidden" id="orderheadid_a" value="'.$headid. '" /> ';
				$buttons .= ' <input type="hidden" id="productid_a" value="'.$detail['id']. '" /> ';
				$buttons .= ' <i class="fa fa-trash"></i></button> ';
			}
			
			
			$result['data'][$key] = array(
				$detail['name'],
				$detail['qty'],
				$detail['rate'],				
				$detail['amount'],				
				$buttons
			);
		}
		echo json_encode($result);
		
	}
	
	public function fetchOrdersData()
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->model_orders->getOrdersData();
		
		

		foreach ($data as $key => $value) {

			$store_data = $this->model_stores->getStoresData($value['store_id']);
			$table_data = $this->model_tables->getTableData($value['table_id']);

			$count_total_item = $this->model_orders->countOrderItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i a', $value['date_time']);

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';

			if(in_array('viewOrder', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('ordersnew/printDiv/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}

			if(in_array('updateOrder', $this->permission)) {
				$buttons .= ' <a href="'.base_url('ordersnew/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteOrder', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal" ><i class="fa fa-trash"></i></button>';
			}

			if($value['paid_status'] == 1) {
				$paid_status = '<span class="label label-success">Paid</span>';	
			}
			else {
				$paid_status = '<span class="label label-warning">Not Paid</span>';
			}

			$result['data'][$key] = array(
				$store_data['name'],
				$table_data['table_name'],
				$value['bill_no'],
				$date_time,
				$count_total_item,
				$value['net_amount'],
				$paid_status,
				$buttons
			);
		} // /foreach
		

		echo json_encode($result);
	}


	public function createHead() {
		if(!in_array('createOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$this->data['page_title'] = 'Add Order';
		$isExists = $this->model_orders->getExists($this->input->post('table_name')) ; 
		$headID = $isExists->id;
		if (!$isExists) {
			$order_id = $this->model_orders->createHead();
			if($order_id) {
        		#$this->session->set_flashdata('success', 'Successfully created');
        		redirect('ordersNew/update/'.$order_id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');        		
        		redirect('ordersnew/', 'refresh');
        	}
		}else {
			redirect('ordersNew/update/'.$headID, 'refresh');
		}

		
	}
	
	public function createDetail() {
		if(!in_array('createOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Order';
		$headID = $this->input->post('orderheadid') ;
		
		if ($headID>0){
			$items = array(
    			'order_id' => $headID,
    			'product_id' => $this->input->post('productid_post'),
    			'qty' => $this->input->post('qty'),
    			'rate' => $this->input->post('productprice_post'),
    			'amount' => $this->input->post('amount_value'),
    		);
			// print_r($items);
			// die();
			$goDetail = $this->model_orders->createDetail($items);
			
			if ($goDetail == true) {
					$goUpdate = $this->model_orders->updateHead($headID);
					$this->session->set_flashdata('success', 'Successfully updated');
					redirect('ordersnew/update/'.$headID, 'refresh');
			}else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('ordersnew/update/'.$headID, 'refresh');
        	}
		}else {
				redirect('ordersnew/', 'refresh');
		}
		
	}
	
	public function createBill() {
		if(!in_array('createBill' , $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$headID = $this->input->post('order_id');
		$dataBill = array (
			'order_id' 				=> $this->input->post('payment_order_id')	,
			'bill_no' 				=>	$this->input->post('payment_bill_no')	,
			'table_id' 				=>	$this->input->post('payment_table_id')	,
			'stores_id' 			=>	$this->input->post('payment_store_id')	,
			'user_created' 		=>	$this->session->userdata('id')	,
			'user_updated' 		=>	$this->session->userdata('id')	,
			'amount' 				=>	$this->input->post('payment_gross_amount_value')	,
			'tax_charge' 			=>	$this->input->post('payment_vat_charge_rate')	,
			'tax_amount' 			=>	$this->input->post('payment_vat_charge_value')	,
			'service_charge' 		=>	$this->input->post('payment_service_charge_rate')	,
			'service_amount' 		=>	$this->input->post('payment_service_charge_value')	,
			'discount_charge' 	=>	($this->input->post('payment_discount_charge_rate') > 0) ? $this->input->post('payment_discount_charge_rate') : 0	,
			'discount_amount' 	=>	($this->input->post('payment_discount_charge_value') > 0 ) ? $this->input->post('payment_discount_charge_value') : 0	,
			'total_amount' 		=>	$this->input->post('net_amount_value')	,
			'status' 				=>	1	,
		);
		$this->data['payment_data'] = $dataBill;
		
		$this->dumpme($dataBill) ;
		#die();
		
		
		if($this->db->insert('payments', $dataBill)) {
			$this->load->model('model_tables');
			$this->model_tables->update($this->input->post('payment_table_id'), array('available' => 1));
			$this->model_orders->update_status($this->input->post('payment_order_id'), array('paid_status' => 1)) ; 
			
			#return true;
			$this->session->set_flashdata('success', 'Successfully updated');
			redirect('orderNew', 'refresh');
		}else {
			#return false ;
			$this->session->set_flashdata('errors', 'Failed and Error, Please recheck');
			redirect('ordersNew/update/'.$headID, 'refresh');
		}
		
	}
	
	/*
	* If the validation is not valid, then it redirects to the create page.
	* If the validation for each input field is valid then it inserts the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function create()
	{
		if(!in_array('createOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Order';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$order_id = $this->model_orders->create();
        	
        	if($order_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('orders/update/'.$order_id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('ordersnew/create/', 'refresh');
        		redirect('ordersnew/order/', 'refresh');
        	}
        }
        else {
            // false case
			$this->data['table_data'] = $this->model_tables->getActiveTable();
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

            #$this->render_template('ordersnew/create', $this->data);
            $this->render_template('ordersnew/order', $this->data);
        }	
	}

	/*
	* It gets the product id passed from the ajax method.
	* It checks retrieves the particular product data from the product id 
	* and return the data into the json format.
	*/
	public function getProductValueById()
	{
		$product_id = $this->input->post('product_id');
		if($product_id) {
			$product_data = $this->model_products->getProductData($product_id);
			echo json_encode($product_data);
		}
	}

	/*
	* It gets the all the active product inforamtion from the product table 
	* This function is used in the order page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getTableProductRow()
	{
		$products = $this->model_products->getActiveProductData();
		echo json_encode($products);
	}

	/*
	* If the validation is not valid, then it redirects to the edit orders page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function update($id)
	{
		if(!in_array('updateOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}



		$this->data['page_title'] = 'Update Order';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	

        	$update = $this->model_orders->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('ordersnew/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('ordersnew/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$this->data['table_data'] = $this->model_tables->getActiveTable();
			
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] >= 0) ? true : false;

        	$result = array();
        	$orders_data = $this->model_orders->getOrdersData($id);

        	if(empty($orders_data)) {
        		$this->session->set_flashdata('errors', 'The request data does not exists');
        		redirect('ordersnew', 'refresh');
        	}

    		$result['order'] = $orders_data;
    		$orders_item = $this->model_orders->getOrdersItemData($orders_data['id']);
			
			if($orders_item) {
				foreach($orders_item as $k => $v) {
					$result['order_item'][] = $v;
				}
			}else {
					$result['order_item'][]="";
			}
			
			
    		$table_id = $result['order']['table_id'];
    		$table_data = $this->model_tables->getTableData($table_id);

    		$result['order_table'] = $table_data;
			$storeid = $table_data['store_id']; 
			
			$storeData = $this->model_tables->getStoreData($storeid);
			
			$result['store_data'] = $storeData;

    		$this->data['order_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

        	

            $this->render_template('ordersnew/edit', $this->data);
        }
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deleteOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$order_id = $this->input->post('order_id');

        $response = array();
        if($order_id) {
            $delete = $this->model_orders->remove($order_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response); 
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function removeitem()
	{
		if(!in_array('deleteOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$order_id = $this->input->post('rproductid');
		$headID = $this->input->post('rorderheadid');
		

        $response = array();
        if($order_id) {
            $delete = $this->model_orders->removeitem($order_id);
            if($delete == true) {
					$goUpdate = $this->model_orders->updateHead($headID);
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
					 redirect('ordersnew/update/'.$headID, 'refresh');
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
					 redirect('ordersnew/update/'.$headID, 'refresh');
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
				redirect('ordersnew/update/'.$headID, 'refresh');
        }

        
	}

	/*
	* It gets the product id and fetch the order data. 
	* The order print logic is done here 
	*/
	public function printDiv($id)
	{
		if(!in_array('viewOrder', $this->permission)) {
          	redirect('dashboard', 'refresh');
  		}
        
		if($id) {
			
			$order_data = $this->model_orders->getOrdersData($id);
			$orders_items = $this->model_orders->getOrdersItemData($id);
			$company_info = $this->model_company->getCompanyData(1);
			$store_data = $this->model_stores->getStoresData($order_data['store_id']);

			
			$order_date = date('d/m/Y', $order_data['date_time']);
			$paid_status = ($order_data['paid_status'] == 1) ? "Paid" : "Unpaid";

			$table_data = $this->model_tables->getTableData($order_data['table_id']);

			if ($order_data['discount_charge_amount'] > 0) {
				$discount = $this->currency_code . ' ' .$order_data['discount_charge_amount'];
			}
			else {
				$discount = '0';
			}


			$html = '<!-- Main content -->
			<!DOCTYPE html>
			<html>
			<head>
			  <meta charset="utf-8">
			  <meta http-equiv="X-UA-Compatible" content="IE=edge">
			  <title>Invoice</title>
			  <!-- Tell the browser to be responsive to screen width -->
			  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			  <!-- Bootstrap 3.3.7 -->
			  <link rel="stylesheet" href="'.base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
			  <!-- Font Awesome -->
			  <link rel="stylesheet" href="'.base_url('assets/bower_components/font-awesome/css/font-awesome.min.css').'">
			  <link rel="stylesheet" href="'.base_url('assets/dist/css/AdminLTE.min.css').'">
			</head>
			<body onload="window.print();">
			
			<div class="wrapper">
			  <section class="invoice">
			    <!-- title row -->
			    <div class="row">
			      <div class="col-xs-12">
			        <h2 class="page-header">
			          '.$company_info['company_name'].'
			          <small class="pull-right">Date: '.$order_date.'</small>
			        </h2>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <div class="col-sm-4 invoice-col">
			        <b>Bill ID: </b> '.$order_data['bill_no'].'<br>
			        <b>Store Name: </b> '.$store_data['name'].'<br>
			        <b>Table name: </b> '.$table_data['table_name'].'<br>
			        <b>Total items: </b> '.count($orders_items).'<br><br>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			    <!-- Table row -->
			    <div class="row">
			      <div class="col-xs-12 table-responsive">
			        <table class="table table-striped">
			          <thead>
			          <tr>
			            <th>Product name</th>
			            <th>Price</th>
			            <th>Qty</th>
			            <th>Amount</th>
			          </tr>
			          </thead>
			          <tbody>'; 

			          foreach ($orders_items as $k => $v) {

			          	$product_data = $this->model_products->getProductData($v['product_id']); 
			          	
			          	$html .= '<tr>
				            <td>'.$product_data['name'].'</td>
				            <td>'.$this->currency_code . ' ' .$v['rate'].'</td>
				            <td>'.$v['qty'].'</td>
				            <td>'.$this->currency_code . ' ' .$v['amount'].'</td>
			          	</tr>';
			          }
			          
			          $html .= '</tbody>
			        </table>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			    <div class="row">
			      
			      <div class="col-xs-6 pull pull-right">

			        <div class="table-responsive">
			          <table class="table">
			            <tr>
			              <th style="width:50%">Gross Amount:</th>
			              <td>'.$this->currency_code . ' ' .$order_data['gross_amount'].'</td>
			            </tr>';

			            if($order_data['service_charge_amount'] > 0) {
			            	$html .= '<tr>
				              <th>Service Charge ('.$order_data['service_charge_rate'].'%)</th>
				              <td>'.$this->currency_code .' '.$order_data['service_charge_amount'].'</td>
				            </tr>';
			            }

			            if($order_data['vat_charge_amount'] > 0) {
			            	$html .= '<tr>
				              <th>Vat Charge ('.$order_data['vat_charge_rate'].'%)</th>
				              <td>'.$this->currency_code .' '.$order_data['vat_charge_amount'].'</td>
				            </tr>';
			            }
			            
			            
			            $html .=' <tr>
			              <th>Discount:</th>
			              <td>'.$discount.'</td>
			            </tr>
			            <tr>
			              <th>Net Amount:</th>
			              <td>'.$this->currency_code . ' ' .$order_data['net_amount'].'</td>
			            </tr>
			            <tr>
			              <th>Paid Status:</th>
			              <td>'.$paid_status.'</td>
			            </tr>
			          </table>
			        </div>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
			  </section>
			  <!-- /.content -->
			</div>
		</body>
	</html>';

			  echo $html;
		}
	}

}