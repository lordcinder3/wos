<?php 

class Warranty extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Warranty';
		$this->load->model('model_warranty');
		#$this->load->model('model_stores');
	}

	public function index()
	{	
		$warranty_data = $this->model_warranty->getWarrantyDataByCust();
		$this->data['warranty_data'] = $warranty_data;
		$this->render_template('warranty/index', $this->data);
	}

	public function fetchWarrantiesData()
	{
		
		#if(!in_array('viewWarranty', $this->permission)) {
		if(!in_array('viewOrder', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$result = array('data' => array());

		$data = $this->model_warranty->getWarrantyData();

		foreach ($data as $key => $value) {

			#$store_data = $this->model_stores->getStoresData($value['store_id']);

			// button
			$buttons = '';

			if(in_array('updateOrder', $this->permission)) {
			#if(in_array('updateWarranty', $this->permission)) {
				$buttons .= '<a href="'.base_url('publicqr/index/'.$value['warranty_unit_sn']).'"  class="btn btn-default" style="font-size:12px !important; letter-spacing:0.3px !important; padding:2px 5px;" ><i class="fa fa-print"></i></a>&nbsp';

				$buttons .= '<a href="'.base_url('printqr/index/'.$value['warranty_unit_sn']).'"  class="btn btn-default" style="font-size:12px !important; letter-spacing:0.3px !important; padding:2px 5px;" ><i class="fa fa-file"></i></a>&nbsp';

				$buttons .= '<a href="'.base_url('warranty/update/'.$value['warranty_trx']).'"  class="btn btn-warning" style="font-size:12px !important; letter-spacing:0.3px !important; padding:2px 5px;" ><i class="fa fa-pencil"></i></a>';
			}

			#if(in_array('deleteWarranty', $this->permission)) {
			if(in_array('deleteOrder', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger" onclick="removeFunc('.$value['warranty_trx'].')" data-toggle="modal" data-target="#removeModal" style="font-size:12px !important; letter-spacing:0.3px !important; padding:2px 5px;"><i class="fa fa-trash"></i></button>';
			}

			$status = ($value['is_active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(				
				
				$value['warranty_code'],
				$value['customer_num'],
				$value['customer_nama'],
				$value['unit_sku'],
				#$value['unit_brand'],
				$value['unit_name'],
				$value['warranty_handsover_date'],
				$value['warranty_expired_date'],				
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function create()
	{
		#if(!in_array('createWarranty', $this->permission)) {
		if(!in_array('createOrder', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->load->helper('date');
		$response = array();


			$this->form_validation->set_rules('warranty_code', 'Warranty Code', 'trim|required') ;
			$this->form_validation->set_rules('warranty_unit_sn', 'Product Sku', 'trim|required') ;
			$this->form_validation->set_rules('warranty_delivery_date', 'Delivery', 'date') ;
			$this->form_validation->set_rules('warranty_installed_date', 'Installed', 'date') ;
			$this->form_validation->set_rules('warranty_handsover_date', 'Handsover', 'date') ;
			$this->form_validation->set_rules('warranty_expired_date', 'Expired', 'date') ;
			$this->form_validation->set_rules('warranty_po_no', 'P/O No', 'trim') ;
			$this->form_validation->set_rules('warranty_so_no', 'S/O No', 'trim') ;

			$this->form_validation->set_rules('warranty_unit_id', 'Unit', 'required') ;
			$this->form_validation->set_rules('warranty_cust_id', 'Customer', 'required') ;
			$this->form_validation->set_rules('warranty_branch_id', 'Branch', 'required') ;



		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
			  
				$isRevoke = isset($_POST['is_revoke'])?$this->input->post('is_revoke') : 0 ;
				$isActive = isset($_POST['is_active'])?$this->input->post('is_active') : 0 ;
				
        	
			$data = array(
				'warranty_code' => $this->input->post('warranty_code'),
        		'warranty_unit_sn' => $this->input->post('warranty_unit_sn'),
        		'warranty_delivery_date' => nice_date($this->input->post('warranty_delivery_date'), 'Y-m-d'),
        		'warranty_installed_date' => nice_date($this->input->post('warranty_installed_date'), 'Y-m-d'),
        		'warranty_handsover_date' => nice_date($this->input->post('warranty_handsover_date'), 'Y-m-d'),
        		'warranty_expired_date' => nice_date($this->input->post('warranty_expired_date'), 'Y-m-d'),
        		'warranty_po_no' => $this->input->post('warranty_po_no'),
        		'warranty_so_no' => $this->input->post('warranty_so_no'),
        		'warranty_unit_id' => $this->input->post('warranty_unit_id'),
        		
        		#'product_category_id' => json_encode($this->input->post('product_category_id')),
        		'warranty_cust_id' => $this->input->post('warranty_cust_id'),
        		'warranty_branch_id' => $this->input->post('warranty_branch_id'),
        		'created_date' => 'now()', 
        		'modified_date' => 'now()', 
            'created_by' => $this->session->id, 
            'modified_by' => $this->session->id, 
        		'is_revoke' => $isRevoke ,
        		'is_active' => 1,
        	);
			#print_r($data); 
			#die();
        	$create = $this->model_warranty->create($data);
        	if($create == true) {        		
				$this->session->set_flashdata('success', 'Successfully created');
        		redirect('warranty/', 'refresh');
        	}
        	else {        		
				$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('warranty/create', 'refresh');        		
        	}
        }
        else {

				$this->load->model('model_units');
				$this->load->model('model_customers');
				$this->load->model('model_branches');
				$this->data['warranty_units'] = $this->model_units->getActiveUnits();        	
				$this->data['warranty_customers'] = $this->model_customers->getCustomerData();
				$this->data['warranty_branches'] = $this->model_branches->getBranchesData();
				#$this->data['warranty_qr'] = $this->model_warranty->getQR($warranty_trx);
            #$this->data['category'] = $this->model_category->getActiveCategories();           
            #$this->data['stores'] = $this->model_stores->getActiveStore();          

            #$warranty_data = $this->model_warranty->getWarrantyData($warranty_trx);
            #$this->data['warranty_data'] = $warranty_data;
            $this->render_template('warranty/create', $this->data); 

        }

        #echo json_encode($response);
	}
	
	public function createQR($sn) {
		if($sn) {
			$genQ = $this->generateQR($sn) ; 
			
			#print (base_url("publicqr/".$sn));
			#print $genQ ; 
			return $genQ ; 
		}
		
		return false;
	}

	public function fetchTableDataById($id = null)
	{
		if($id) {
			$data = $this->model_tables->getTableData($id);
			echo json_encode($data);
		}
		
	}

	public function update($warranty_trx)
	{
		$this->load->helper('date');
		if(!in_array('updateTable', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

        if(!$warranty_trx) {
            redirect('waranty', 'refresh');
        }

			$this->form_validation->set_rules('warranty_code', 'Warranty Code', 'trim|required') ;
			$this->form_validation->set_rules('warranty_unit_sn', 'Product Sku', 'trim|required') ;
			$this->form_validation->set_rules('warranty_delivery_date', 'Delivery', 'date') ;
			$this->form_validation->set_rules('warranty_installed_date', 'Installed', 'date') ;
			$this->form_validation->set_rules('warranty_handsover_date', 'Handsover', 'date') ;
			$this->form_validation->set_rules('warranty_expired_date', 'Expired', 'date') ;
			$this->form_validation->set_rules('warranty_po_no', 'P/O No', 'trim') ;
			$this->form_validation->set_rules('warranty_so_no', 'S/O No', 'trim') ;

			$this->form_validation->set_rules('warranty_unit_id', 'Unit', 'required') ;
			$this->form_validation->set_rules('warranty_cust_id', 'Customer', 'required') ;
			$this->form_validation->set_rules('warranty_branch_id', 'Branch', 'required') ;
			
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		
        if ($this->form_validation->run() == TRUE) {
            // true case
            $isRevoke = isset($_POST['is_revoke'])?$this->input->post('is_revoke') : 0 ;
				$isActive = isset($_POST['is_active'])?$this->input->post('is_active') : 0 ;
				
            $data = array(
				'warranty_code' => $this->input->post('warranty_code'),
        		'warranty_unit_sn' => $this->input->post('warranty_unit_sn'),
        		'warranty_delivery_date' => nice_date($this->input->post('warranty_delivery_date'), 'Y-m-d'),
        		'warranty_installed_date' => nice_date($this->input->post('warranty_installed_date'), 'Y-m-d'),
        		'warranty_handsover_date' => nice_date($this->input->post('warranty_handsover_date'), 'Y-m-d'),
        		'warranty_expired_date' => nice_date($this->input->post('warranty_expired_date'), 'Y-m-d'),
        		'warranty_po_no' => $this->input->post('warranty_po_no'),
        		'warranty_so_no' => $this->input->post('warranty_so_no'),
        		'warranty_unit_id' => $this->input->post('warranty_unit_id'),
        		
        		#'product_category_id' => json_encode($this->input->post('product_category_id')),
        		'warranty_cust_id' => $this->input->post('warranty_cust_id'),
        		'warranty_branch_id' => $this->input->post('warranty_branch_id'),
        		
            
        		'is_revoke' => $isRevoke ,
        		'is_active' => $isActive,				
            'modified_by' => $this->session->id, 
            );
				$snForQr = $this->input->post('warranty_unit_sn');
				$qrLink = $this->createQR($snForQr);
				$qrdata = array( 
					'warranty_trx' 	=> $warranty_trx, 
					'content'			=> $snForQr, 
					'filepath'			=> 'assets/images/qr_images/'.$snForQr.'pqr.png', 
					'url' 				=> $qrLink, 
					);

            $update = $this->model_warranty->update($data, $warranty_trx);
				$updateQr = $this->model_warranty->updateQr($qrdata, $warranty_trx);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('warranty/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('warranty/update/'.$warranty_trx, 'refresh');
            }
        }
        else {
                    
				$this->load->model('model_units');
				$this->load->model('model_customers');
				$this->load->model('model_branches');
				$this->data['warranty_units'] = $this->model_units->getActiveUnits();        	
				$this->data['warranty_customers'] = $this->model_customers->getCustomerData();
				$this->data['warranty_branches'] = $this->model_branches->getBranchesData();
				$this->data['warranty_qr'] = $this->model_warranty->getQR($warranty_trx);
            #$this->data['category'] = $this->model_category->getActiveCategories();           
            #$this->data['stores'] = $this->model_stores->getActiveStore();          

            $warranty_data = $this->model_warranty->getWarrantyData($warranty_trx);
            $this->data['warranty_data'] = $warranty_data;
            $this->render_template('warranty/edit', $this->data); 
        }   
	

	}

	public function remove()
	{
		if(!in_array('deleteTable', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$table_id = $this->input->post('table_id');

		$response = array();
		if($table_id) {
			$delete = $this->model_tables->remove($table_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}


}