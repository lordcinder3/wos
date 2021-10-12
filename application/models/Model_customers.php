<?php 

class Model_customers extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_users');
	}

	/* get the customer data */
	public function getCustomerdata($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM ms_customers WHERE customer_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM ms_customers ORDER BY customer_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	/* get the Customer data */
	public function getProductDataByCat($cat_id = null)
	{
		if($cat_id) {

			$user_id = $this->session->userdata('id');
			if($user_id == 1) {
				$sql = "SELECT * FROM products ORDER BY id DESC";
				$query = $this->db->query($sql);
				$result = array();
				foreach($query->result_array() as $key => $value) {
					$category_ids = json_decode($value['category_id']);
					if(in_array($cat_id, $category_ids)) {
						$result[] = $value;
					}
				} 

				return $result;
			}
			else {

				// for store users 
				$user_data = $this->model_users->getUserData($user_id);

				$sql = "SELECT * FROM products ORDER BY id DESC";
				$query = $this->db->query($sql);

				$data = array();
				foreach ($query->result_array() as $k => $v) {
					$store_ids = json_decode($v['store_id']);
					$category_ids = json_decode($v['category_id']);
					if(in_array($cat_id, $category_ids) && in_array($user_data['store_id'], $store_ids)) {
						$data[] = $v;
					}
				}

				return $data;		


			}
		}	
	}

	public function getActiveCustomerData()
	{
		$sql = "SELECT * FROM ms_customer WHERE is_active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();		
		

		
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('ms_customers', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('customer_id', $id);
			$update = $this->db->update('ms_customers', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('customer_id', $id);
			$delete = $this->db->delete('ms_customers');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalCustomer()
	{
		$sql = "SELECT * FROM ms_customers";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}