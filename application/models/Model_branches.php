<?php 

class Model_branches extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the company data */
	public function getBranchesData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM ms_branches WHERE branch_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM ms_branches ORDER BY branch_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('branch_id', $id);
			$update = $this->db->update('ms_branches', $data);
			return ($update == true) ? true : false;
		}
	}


}