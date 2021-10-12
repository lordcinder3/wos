<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Customer';

		$this->load->model('model_customers');
		$this->load->model('model_category');
		$this->load->model('model_stores');
	}

    /* 
    * It only redirects to the manage Customer page
    */
	public function index()
	{
        #f(!in_array('viewOrder', $this->permission)) {
        #    redirect('dashboard', 'refresh');
       # }

		$this->render_template('customer/index', $this->data);	
	}

    /*
    * It Fetches the customer data from the customer table 
    * this function is called from the datatable ajax function
    */
	public function fetchCustomerData()
	{
        if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		$result = array('data' => array());

		$data = $this->model_customer->getCustomerdata();

		foreach ($data as $key => $value) {
            // button
          $buttons = '';
           if(in_array('updateProduct', $this->permission)) {
    			$buttons .= '<a href="'.base_url('customer/update/'.$value['customer_id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
           }

            if(in_array('deleteProduct', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['customer_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			#$img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';

            $availability = ($value['is_active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';


			$result['data'][$key] = array(
                $value['customer_num'],
                $value['customer_nama'],
                $value['customer_kota'],
                $value['customer_pic'],
                $availability,
                $buttons
				
			);
		} // /foreach

		echo json_encode($result);
	}	
    
    /*
    * view the customer based on the store 
    * the admin can view all the customer information
    */
    public function viewCustomer()
    {
        if(!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        #$company_currency = $this->company_currency();
        // get all the category 
        $category_data = $this->model_category->getCategoryData();

        $result = array();
        
        foreach ($category_data as $k => $v) {
            $result[$k]['category'] = $v;
            $result[$k]['products'] = $this->model_products->getProductDataByCat($v['id']);
        }

        // based on the category get all the products 

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
                    <body>
                    
                    <div class="wrapper">
                      <section class="invoice">

                        <div class="row">
                        ';
                            foreach ($result as $k => $v) {
                                $html .= '<div class="col-md-6">
                                    <div class="product-info">
                                        <div class="category-title">
                                            <h1>'.$v['category']['name'].'</h1>
                                        </div>';

                                        if(count($v['products']) > 0) {
                                            foreach ($v['products'] as $p_key => $p_value) {
                                                $html .= '<div class="product-detail">
                                                            <div class="product-name" style="display:inline-block;">
                                                                <h5>'.$p_value['name'].'</h5>
                                                            </div>
                                                            <div class="product-price" style="display:inline-block;float:right;">
                                                                <h5>'.$company_currency . ' ' . $p_value['price'].'</h5>
                                                            </div>
                                                        </div>';
                                            }
                                        }
                                        else {
                                            $html .= 'N/A';
                                        }        
                                    $html .='</div>
                                        
                                </div>';
                            }
                        

                        $html .='
                        </div>
                      </section>
                      <!-- /.content -->
                    </div>
                </body>
            </html>';

                      echo $html;
    }

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage customer page
    */
	public function create()
	{
		if(!in_array('createProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('customer_num', 'Customer Number', 'trim|required');
		$this->form_validation->set_rules('customer_nama', 'Customer Name', 'trim|required');
		$this->form_validation->set_rules('customer_pic', 'PIC', 'trim|required');
        $this->form_validation->set_rules('customer_kota', 'Kota', 'trim|required');
        $this->form_validation->set_rules('customer_telp', 'Telp', 'trim|numeric');
        $this->form_validation->set_rules('customer_pic_telp', 'PIC Telp', 'trim|numeric');
        #$this->form_validation->set_rules('customer_email', 'Email', 'trim|email');
        $this->form_validation->set_rules('is_active', 'Active', 'trim|required');
        	
        if ($this->form_validation->run() == TRUE) {
            // true case
        	#$upload_image = $this->upload_image();

        	$data = array(
        		'customer_num' => $this->input->post('customer_num'),
        		'customer_nama' => $this->input->post('customer_nama'),
        		#'image' => $upload_image,
        		'customer_alamat' => $this->input->post('customer_alamat'),
                'customer_kota' => $this->input->post('customer_kota'),
                'customer_kodepos' => $this->input->post('customer_kodepos'),
                'customer_geolocation' => $this->input->post('customer_geolocation'),
                'customer_telp' => $this->input->post('customer_telp'),
                'customer_email' => $this->input->post('customer_email'),
                'customer_pic' => $this->input->post('customer_pic'),
                'customer_pic_telp' => $this->input->post('customer_pic_telp'),
        		'is_active' => $this->input->post('is_active'),
        	);

        	$create = $this->model_customers->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('customer/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('customer/create', 'refresh');
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

            $this->render_template('customer/create', $this->data);
        }	
	}

    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */
	public function upload_image()
    {
    	// assets/images/product_image
        $config['upload_path'] = 'assets/images/product_image';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';

        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('product_image'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['product_image']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }

    /*
    * If the validation is not valid, then it redirects to the edit product page 
    * If the validation is successfully then it updates the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function update($customer_id)
	{      
        if(!in_array('updateProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$customer_id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('customer_num', 'Customer Number', 'trim|required');
        $this->form_validation->set_rules('customer_nama', 'Customer Name', 'trim|required');
        $this->form_validation->set_rules('customer_pic', 'PIC', 'trim|required');
        $this->form_validation->set_rules('customer_kota', 'Kota', 'trim|required');
        $this->form_validation->set_rules('customer_telp', 'Telp', 'trim|numeric');
        $this->form_validation->set_rules('customer_pic_telp', 'PIC Telp', 'trim|numeric');
        $this->form_validation->set_rules('is_active', 'Active', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                'customer_num' => $this->input->post('customer_num'),
                'customer_nama' => $this->input->post('customer_nama'),
                #'image' => $upload_image,
                'customer_alamat' => $this->input->post('customer_alamat'),
                'customer_kota' => $this->input->post('customer_kota'),
                'customer_kodepos' => $this->input->post('customer_kodepos'),
                'customer_geolocation' => $this->input->post('customer_geolocation'),
                'customer_telp' => $this->input->post('customer_telp'),
                'customer_email' => $this->input->post('customer_email'),
                'customer_pic' => $this->input->post('customer_pic'),
                'customer_pic_telp' => $this->input->post('customer_pic_telp'),
                'is_active' => $this->input->post('is_active'),
            );

            
            #if($_FILES['product_image']['size'] > 0) {
            #    $upload_image = $this->upload_image();
            #   $upload_image = array('image' => $upload_image);
            #    
            #    $this->model_products->update($upload_image, $product_id);
            #}

            $update = $this->model_customer->update($data, $customer_id);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('customer/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('customer/update/'.$customer_id, 'refresh');
            }
        }
        else {
                    
            #$this->data['category'] = $this->model_category->getActiveCategory();           
            #$this->data['stores'] = $this->model_stores->getActiveStore();          

            $customer_data = $this->model_customer->getCustomerdata($customer_id);
            $this->data['customer_data'] = $customer_data;
            $this->render_template('customer/edit', $this->data); 
        }   
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deleteProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $product_id = $this->input->post('product_id');

        $response = array();
        if($product_id) {
            $delete = $this->model_products->remove($product_id);
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

}