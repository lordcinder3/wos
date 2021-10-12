<?php
class Model_warranty extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		#$this->load->model('model_users');
		$tableName = 'tr_warranties' ;
		$viewName = 'vw_tr_warranties' ; 
		$tableID = 'warranty_trx' ;
	}

	public function getWarrantyData($trx = null) 
	{
		if($trx) {
				$sql = "SELECT * FROM vw_tr_warranties where warranty_trx = ?";
				$query = $this->db->query($sql, array($trx));
				return $query->row_array();		
			} else {
				$sql = "SELECT * FROM vw_tr_warranties" ;
				$query = $this->db->query($sql);
				return $query->result_array();		
			}
			
	}
	public function getWarrantyDataBySN($sn = null) 
	{
		if($sn) {
				$sql = "SELECT * FROM vw_tr_warranties where warranty_unit_sn = ?";
				$query = $this->db->query($sql, array($sn));
				return $query->row_array();		
			} 			
	}
	
	public function getQR($trx) {
		$sql= "SELECT * FROM qr_dump WHERE  warranty_trx = ? ";
		$query = $this->db->query($sql, array($trx)) ;
		return $query->row_array(); 
	}
	
	public function saveQR($data) {
			$save = $this->db->insert('qr_dump', $data) or die(mysql_error());
			return ($save == true) ? true : false ; 
	}
		
	public function updateQR($data,$trx) {
			$checkQr = $this->getQR($trx) ;
			if(!empty($checkQr)) {					
				$this->db->where('warranty_trx', $trx); 
				$update = $this->db->update('qr_dump', $data) or die(mysql_error()) ;
				return ($update == true) ? true : false ; 
			}else {
				$saveNew = $this->saveQR($data); 
				return ($saveNew == true) ? true : false ; 
			}
	}
	
	public function create($data = '')
	{
		$create = $this->db->insert('tr_warranties', $data);
		return ($create == true) ? true : false;
	}

	public function update($data, $trx)
	{
		$this->db->where('warranty_trx', $trx);
		$update = $this->db->update('tr_warranties', $data);
		return ($update == true) ? true : false;	
	}

	public function delete($trx)
	{
		$data= array("is_active"=> "0") ;
		$this->db->where('warranty_trx', $trx);
		$delete = $this->db->update('tr_warranties', $data);
		return ($delete == true) ? true : false;
	}

	public function revoke($trx)
	{
		$data= array("is_revoke"=> "0") ;
		$this->db->where('warranty_trx', $trx);
		$delete = $this->db->update('tr_warranties', $data);
		return ($delete == true) ? true : false;
	}

	public function getWarrantyDataByCust($cust_id = null)
	{
		if($cust_id) {
			$sql = "SELECT * FROM vw_tr_warranties where warranty_cust_id= ? ORDER BY warranty_cust_id ASC";
			$query = $this->db->query($sql, array($cust_id));
			// $result = array();
			// foreach($query->result_array() as $key => $value) {
				// $cust_ids = json_decode($value['warranty_cust_id']);
				// if(in_array($cust_id, $cust_ids)) {
					// $result[] = $value;
				// }
			// } 
			return $query->row_array();		
		} else {
			$sql = "SELECT * FROM vw_tr_warranties ORDER BY warranty_cust_id ASC";
			$query = $this->db->query($sql);
			
			return $query->result_array();
		}
	
	}
	

}