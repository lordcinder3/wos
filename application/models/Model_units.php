<?php 

class Model_units extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getUnitdata($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM ms_units WHERE unit_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM ms_units ORDER BY unit_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data = array())
	{
		if($data) {
			$create = $this->db->insert('ms_units', $data);
			return ($create == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('unit_id', $id);
			$update = $this->db->update('ms_units', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('unit_id', $id);
			$delete = $this->db->delete('ms_units');
			return ($delete == true) ? true : false;
		}
	}

	public function getActiveUnits()
	{
		$sql = "SELECT * FROM ms_units WHERE is_active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function countTotalUnits()
	{
		$sql = "SELECT * FROM ms_units WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}
}