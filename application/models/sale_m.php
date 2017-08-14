<?php
class Sale_m extends CI_Model
{			
	var $userCrea;		
	public function __construct()
	{
		parent::__construct();
		$this->userCrea = isset($this->session->userLogin)?$this->session->userLogin:"N/A";				
	}
	public function index($id="")
	{
		if($id=="")
		{			
			$query=$this->db->query("
				SELECT * FROM tbl_sale as sal
				INNER JOIN tbl_concreter as con ON sal.con_id=con.con_id				
				");
			if($query->num_rows()>0){return $query->result();}			
		}
		else
		{		
			$query=$this->db->query("
				SELECT * FROM tbl_sale as sal
				INNER JOIN tbl_concreter as con ON sal.con_id=con.con_id
				WHERE sal.sal_id=$id
				");
			if($query->num_rows()>0){return $query->row();}
		}
	}
	public function get_concreter()
	{
		$query = $this->db->query("SELECT con_id,CONCAT('code: ',con_code,' ',con_name) AS con_name FROM tbl_concreter WHERE con_status=1");
		if($query->num_rows()>0){return $query->result();}
	}
	public function add()
	{
		$data= array(												
						"con_id" => $this->input->post("ddlConcreter"),
						"customer_name" => $this->input->post("txtCustomerName"),
						"customer_phone" => $this->input->post("txtCustomerPhone"),
						"customer_address" => $this->input->post("txtCustomerAddress"),
						"power" => $this->input->post("txtPower"),
						"cost" => $this->input->post("txtCost"),
						"slump" => $this->input->post("txtSlump"),
						"power" => $this->input->post("txtPower"),						
						"payment_duration" => $this->input->post("txtPaymentDuration"),
						"pump_cost" => $this->input->post("txtPumpCost"),
						"distance" => $this->input->post("txtDistance"),
						"set" => $this->input->post("txtSet"),
						"amount_sale" => $this->input->post("txtAmountSale"),
						"amount_sale1" => $this->input->post("txtAmountSale1"),
						"total_bal_sale" => ($this->input->post("txtAmountSale") * $this->input->post("txtCost")) + $this->input->post("txtPumpCost"),
						"total_bal_sale1" => ($this->input->post("txtAmountSale1") * $this->input->post("txtCost")) + $this->input->post("txtPumpCost"),
						"p" => $this->input->post("txtP"),						
						"sale_date" => $this->input->post("txtSaleDate"),
						"sale_desc" => $this->input->post("txtDesc"),						
						"user_crea" => $this->userCrea,
						"date_crea" => date('Y-m-d')
						 );
		$query=$this->db->insert("tbl_sale",$data);		
		if($query==TURE){return TRUE;}
	}
	public function edit($id)
	{
		if($id==TRUE)
		{			
			
			$data= array(					
					"con_id" => $this->input->post("ddlConcreter"),
					"customer_name" => $this->input->post("txtCustomerName"),
					"customer_phone" => $this->input->post("txtCustomerPhone"),
					"customer_address" => $this->input->post("txtCustomerAddress"),
					"power" => $this->input->post("txtPower"),					
					"cost" => $this->input->post("txtCost"),
					"slump" => $this->input->post("txtSlump"),
					"power" => $this->input->post("txtPower"),						
					"payment_duration" => $this->input->post("txtPaymentDuration"),
					"pump_cost" => $this->input->post("txtPumpCost"),
					"distance" => $this->input->post("txtDistance"),
					"set" => $this->input->post("txtSet"),
					"amount_sale" => $this->input->post("txtAmountSale"),
					"amount_sale1" => $this->input->post("txtAmountSale1"),
					"total_bal_sale" => ($this->input->post("txtAmountSale") * $this->input->post("txtCost")) + $this->input->post("txtPumpCost"),
					"total_bal_sale1" => ($this->input->post("txtAmountSale1") * $this->input->post("txtCost")) + $this->input->post("txtPumpCost"),
					"p" => $this->input->post("txtP"),						
					"sale_date" => $this->input->post("txtSaleDate"),
					"sale_desc" => $this->input->post("txtDesc"),						
					"user_updt" => $this->userCrea,
					"date_updt" => date('Y-m-d')
					 );				
			$this->db->where("sal_id",$id);
			$query=$this->db->update("tbl_sale",$data);
			if($query==TRUE){return TURE;}
		}				
	}
	public function delete($id)
	{
		if($id==TRUE)
		{						
			$this->db->where("sal_id",$id);
			$query=$this->db->delete("tbl_sale");
			if($query==TRUE){return $query;}
		}
	}
	
}
?>