<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Products';

        $this->load->model('model_products');
        $this->load->model('model_category');
        $this->load->model('model_units');
        #$this->load->model('model_stores');
    }

    /* 
    * It only redirects to the manage product page
    */
    public function index()
    {
        if(!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->render_template('products/index', $this->data);  
    }

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
    public function fetchProductData()
    {
        if(!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $result = array('data' => array());

        $data = $this->model_products->getProductData();

        foreach ($data as $key => $value) {
            
                $compatibilities = $this->getCompabilitiesList($value['product_compatibilities']);
                
            // button
            $buttons = '';
            if(in_array('updateProduct', $this->permission)) {
                $buttons .= '<a href="'.base_url('products/update/'.$value['product_id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteProduct', $this->permission)) { 
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['product_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
            
            $availability = ($value['is_active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

            $result['data'][$key] = array(
                
                $value['category_name'],
                $value['product_brand'],
                $value['product_name'],
                $value['product_sku'],
            $compatibilities,
            $availability,
                $buttons
            );
        } // /foreach

        echo json_encode($result);
    }   
    
    /*
    * view the product based on the store 
    * the admin can view all the product information
    */
    public function viewproduct()
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
            $result[$k]['products'] = $this->model_products->getProductDataByCat($v['product_id']);
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
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
    public function create()
    {
        if(!in_array('createProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        #$this->form_validation->set_rules('product_id', 'Product Id', 'trim|required') ;
        $this->form_validation->set_rules('product_brand', 'Product Brand', 'trim|required') ;
        $this->form_validation->set_rules('product_sku', 'Product Sku', 'trim|required') ;
        $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required') ;
        $this->form_validation->set_rules('product_compatibilities', 'Product Compatibilities', 'trim') ;
        $this->form_validation->set_rules('product_weight', 'Product Weight', 'trim') ;
        $this->form_validation->set_rules('product_height', 'Product Height', 'trim') ;
        $this->form_validation->set_rules('product_length', 'Product Length', 'trim') ;
        $this->form_validation->set_rules('product_width', 'Product Width', 'trim') ;

        $this->form_validation->set_rules('product_category_id', 'Product Category_Id', 'trim|required') ;
        $this->form_validation->set_rules('is_active', 'Product Active', 'trim|required') ;

        
    
        if ($this->form_validation->run() == TRUE) {
            // true case
            #$upload_image = $this->upload_image();

            $data = array(
                'product_brand' => $this->input->post('product_brand'),
                'product_sku' => $this->input->post('product_sku'),
                'product_name' => $this->input->post('product_name'),               
                'product_weight' => $this->input->post('product_weight'),
                'product_height' => $this->input->post('product_height'),
                'product_length' => $this->input->post('product_length'),
                'product_width' => $this->input->post('product_width'),
                
                'product_category_id' => json_encode($this->input->post('category')),
                'product_compatibilities' => json_encode($this->input->post('product_compatibilities')),
            
                'active' => $this->input->post('is_active'),
            );

            $create = $this->model_products->create($data);
            if($create == true) {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect('products/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('products/create', 'refresh');
            }
        }
        else {
            // false case

            // attributes 
            // $attribute_data = $this->model_attributes->getActiveAttributeData();


            // $this->data['attributes'] = $attributes_final_data;
            // $this->data['brands'] = $this->model_brands->getActiveBrands();          
            $this->data['product_compatibilities'] = $this->model_units->getActiveUnits();          
            $this->data['category'] = $this->model_category->getActiveCategories(4);            
         $this->render_template('products/create', $this->data);
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
    public function update($product_id)
    {      
        if(!in_array('updateProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$product_id) {
            redirect('dashboard', 'refresh');
        }

            $this->form_validation->set_rules('product_brand', 'Product Brand', 'trim|required') ;
            $this->form_validation->set_rules('product_sku', 'Product Sku', 'trim|required') ;
            $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required') ;
            $this->form_validation->set_rules('product_compatibilities', 'Product Compatibilities', 'trim') ;
            $this->form_validation->set_rules('product_weight', 'Product Weight', 'trim') ;
            $this->form_validation->set_rules('product_height', 'Product Height', 'trim') ;
            $this->form_validation->set_rules('product_length', 'Product Length', 'trim') ;
            $this->form_validation->set_rules('product_width', 'Product Width', 'trim') ;

            $this->form_validation->set_rules('product_category_id', 'Product Category_Id', 'required') ;
            $this->form_validation->set_rules('is_active', 'Product Active', 'required') ;


        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                'product_brand' => $this->input->post('product_brand'),
                'product_sku' => $this->input->post('product_sku'),
                'product_name' => $this->input->post('product_name'),               
                'product_weight' => $this->input->post('product_weight'),
                'product_height' => $this->input->post('product_height'),
                'product_length' => $this->input->post('product_length'),
                'product_width' => $this->input->post('product_width'),
                
                #'product_category_id' => json_encode($this->input->post('product_category_id')),
                'product_category_id' => $this->input->post('product_category_id'),
                'product_compatibilities' => json_encode($this->input->post('product_compatibilities')),
            
                'is_active' => $this->input->post('is_active'),
                
            );

            /*
            if($_FILES['product_image']['size'] > 0) {
                $upload_image = $this->upload_image();
                $upload_image = array('image' => $upload_image);
                
                $this->model_products->update($upload_image, $product_id);
            }
                */

            $update = $this->model_products->update($data, $product_id);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('products/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('products/update/'.$product_id, 'refresh');
            }
        }
        else {
                    
                
                $this->data['product_compatibilities'] = $this->model_units->getActiveUnits();          
                $this->data['category'] = $this->model_category->getActiveCategories(4);            
            #$this->data['category'] = $this->model_category->getActiveCategories();           
            #$this->data['stores'] = $this->model_stores->getActiveStore();          

            $product_data = $this->model_products->getProductData($product_id);
            $this->data['product_data'] = $product_data;
            $this->render_template('products/edit', $this->data); 
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