<?php
class Payment_m extends CI_Model
{			
	var $userCrea;		
	public function __construct()
	{
		parent::__construct();
		$this->userCrea = isset($this->session->userLogin)?$this->session->userLogin:"N/A";				
	}
	public function index($id="")
	{
		$query = $this->db->query("
			SELECT con_code,con_name,customer_address,pay.* FROM tbl_payment AS pay
			INNER JOIN tbl_sale AS sal ON pay.sal_id=sal.sal_id
			INNER JOIN tbl_concreter AS con ON sal.con_id=con.con_id	
			WHERE pay.sal_id=$id		
			");
		if($query->num_rows()>0){return $query->result();}		
	}
	public function get_add($id="")
	{
		$query=$this->db->query("SELECT * FROM tbl_sale WHERE sal_id=$id");
		if($query->num_rows()>0){return $query->row();}
	}
	public function get_remaining($id="")
	{
		$query=$this->db->query("SELECT remaining FROM tbl_payment WHERE sal_id=$id ORDER BY pay_id DESC");
		if($query->num_rows()>0){return $query->row();}
	}
	public function add()
	{
		$sale_id=$this->input->post('txtSaleId');
		$row=$this->get_add($sale_id);	
		$data= array(						
						"sal_id" => $sale_id,
						"cost" => $row->cost,
						"amount_sale1" => $row->amount_sale1,
						"pump_cost" => $row->pump_cost,
						"total_bal_sale1" => $row->total_bal_sale1,
						"payment" => $this->input->post("txtPaid"),
						"remaining" => $this->input->post("txtRemaining")-$this->input->post("txtPaid"),
						"user_crea" => $this->userCrea,
						"date_crea" => date('Y-m-d')
						 );
		$query=$this->db->insert("tbl_payment",$data);		
		if($query==TURE)
		{
			$row=$this->get_remaining($sale_id);
			if($row->remaining==0)
			{
				$data = array('payment_status' => 'Paid');
				$this->db->where('sal_id',$sale_id);
				$this->db->update('tbl_sale',$data);
			}
			return TRUE;
		}
	}	
	public function delete($id)
	{
		if($id==TRUE)
		{						
			$this->db->where("pay_id",$id);
			$query=$this->db->delete("tbl_payment");
			if($query==TRUE){return $query;}
		}
	}
	
}
?>