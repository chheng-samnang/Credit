<?php
	class Main_m extends CI_Model
	{
		
		public function __construct()
		{
			parent::__construct();			
		}
		public function index()
		{
			$query=$this->db->query("
			SELECT * FROM tbl_sale as sal
			INNER JOIN tbl_concreter as con ON sal.con_id=con.con_id
			WHERE payment_status='Pending'				
			");
			if($query->num_rows()>0){return $query->result();}
		}	
	}
?>