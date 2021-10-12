<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PublicQR extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("model_warranty") ;
	}

	public function index()
	{
		$last = $this->uri->total_segments();
		$sn = $this->uri->segment($last);
		
		$data['warranty_data'] = $this->model_warranty->getWarrantyDataBySN($sn);
		$this->load->view("qr_view", $data);
	}

}