<?php
class Model_warranty extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getWarrantydata($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tr_warranties WHERE warranty_trx = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
			
		}

		$sql = "SELECT * FROM tr_warranties ORDER BY warranty_trx DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('tr_warranties', $data);
			return ($create == true) ? true : false;
		}
	}

	public function update($id = null, $data = array())
	{
		if($id && $data) {
			$this->db->where('id', $id);
			$update = $this->db->update('tr_warranties', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id = null)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('tr_warranties');
			return ($delete == true) ? true : false;
		}

		return false;
	}

	public function getActiveWarranty()
	{
		$sql = "SELECT * FROM tr_warranties WHERE is_active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function countTotalWarranty	()
	{
		$sql = "SELECT * FROM tr_warranties WHERE is_active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}
}