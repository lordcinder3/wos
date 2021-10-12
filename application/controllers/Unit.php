<?php 

class Unit extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Unit';
		$this->load->model('model_unit');
	}

	public function index()
	{
	
        
		$this->render_template('unit/index', $this->data);
	}

	public function fetchUnitdata()
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->model_unit->getUnitData();



		foreach ($data as $key => $value) {
			// button
			$buttons = '';

			if(in_array('updateProduct', $this->permission)) {
    			$buttons .= '<a href="'.base_url('unit/update/'.$value['unit_id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('updateProduct', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['unit_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }

			$status = ($value['is_active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['unit_brand'],
				$value['unit_sku'],
				$value['unit_name'],
				$value['unit_warranty'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function create()
	{
		if(!in_array('createStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('unit_brand', 'Brand', 'trim|required');
		$this->form_validation->set_rules('unit_sku', 'Serial Number', 'trim|required');
		$this->form_validation->set_rules('unit_warranty', 'Warranty', 'trim|required|numeric');



		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

       if ($this->form_validation->run() == TRUE) {
            // true case
        	#$upload_image = $this->upload_image();

        	$data = array(
        		'unit_brand' => $this->input->post('unit_brand'),
        		'unit_sku' => $this->input->post('unit_sku'),
        		'unit_name' => $this->input->post('unit_name'),
        		'unit_warranty' => $this->input->post('unit_warranty'),
        		'unit_weight' => $this->input->post('unit_weight'),
        		'unit_height' => $this->input->post('unit_height'),
        		'unit_length' => $this->input->post('unit_length'),
        		'unit_width' => $this->input->post('unit_width'),
        		'is_active' => $this->input->post('is_active')
        	);

        	$create = $this->model_unit->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('unit/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('unit/create', 'refresh');
        	}
        }
        else {
            // false case

        	// attributes 
        	// $attribute_data = $this->model_attributes->getActiveAttributeData();


        	// $this->data['attributes'] = $attributes_final_data;
			// $this->data['brands'] = $this->model_brands->getActiveBrands();        	
			#$this->data['category'] = $this->model_category->getActiveCategory();        	
			#$this->data['stores'] = $this->model_stores->getActiveStore();        	

            $this->render_template('unit/create', $this->data);

        }
	}

	public function fetchUnitDataById($id = null)
	{
		if($id) {
			$data = $this->model_unit->getUnitData($id);
			echo json_encode($data);
		}
		
	}

	public function update($unit_id)
	{
		if(!in_array('updateStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($unit_id) {
		$this->form_validation->set_rules('unit_brand', 'Brand', 'trim|required');
		$this->form_validation->set_rules('unit_sku', 'Serial Number', 'trim|required');
		$this->form_validation->set_rules('unit_warranty', 'Warranty', 'trim|required|numeric');


	        if ($this->form_validation->run() == TRUE) {
            // true case
        	#$upload_image = $this->upload_image();

        	$data = array(
        		'unit_brand' => $this->input->post('unit_brand'),
        		'unit_sku' => $this->input->post('unit_sku'),
        		'unit_name' => $this->input->post('unit_name'),
        		'unit_warranty' => $this->input->post('unit_warranty'),
        		'unit_weight' => $this->input->post('unit_weight'),
        		'unit_height' => $this->input->post('unit_height'),
        		'unit_length' => $this->input->post('unit_length'),
        		'unit_width' => $this->input->post('unit_width'),
        		'is_active' => $this->input->post('is_active'),
        	);


 			
            $update = $this->model_unit->update($data, $unit_id);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('unit/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('unit/update/'.$unit_id, 'refresh');
            }
	        }
	        else {
                    
            #$this->data['category'] = $this->model_category->getActiveCategory();           
            #$this->data['stores'] = $this->model_stores->getActiveStore();          

            $unit_data = $this->model_unit->getUnitdata($unit_id);
            $this->data['unit_data'] = $unit_data;
            $this->render_template('unit/edit', $this->data); 

			}
		
		}
	}

	public function remove()
	{
		if(!in_array('deleteStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$unit_id = $this->input->post('unit_id');

		$response = array();
		if($unit_id) {
			$delete = $this->model_unit->remove($unit_id);
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