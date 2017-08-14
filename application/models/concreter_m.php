<?php
class Concreter_m extends CI_Model
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
			$this->db->order_by('con_id', 'DESC');
			$query=$this->db->get("tbl_concreter");
			if($query->num_rows()>0){return $query->result();}			
		}
		else
		{
			$this->db->where("con_id",$id);
			$query=$this->db->get("tbl_concreter");
			if($query->num_rows()>0){return $query->row();}
		}
	}
	public function add()
	{
		$data= array(						
						"con_code" => $this->input->post("txtCode"),
						"con_name" => $this->input->post("txtName"),
						"con_gender" => $this->input->post("ddlGender"),
						"con_phone" => $this->input->post("txtPhone"),
						"con_address" => $this->input->post("txtAdress"),
						"con_status" => $this->input->post("ddlStatus"),
						"con_age" => $this->input->post("txtAge"),
						"con_desc" => $this->input->post("txtDesc"),						
						"user_crea" => $this->userCrea,
						"date_crea" => date('Y-m-d')
						 );
		$query=$this->db->insert("tbl_concreter",$data);		
		if($query==TURE){return TRUE;}
	}
	public function edit($id)
	{
		if($id==TRUE)
		{			
			
			$data= array(					
					"con_code" => $this->input->post("txtCode"),
					"con_name" => $this->input->post("txtName"),
					"con_gender" => $this->input->post("ddlGender"),
					"con_phone" => $this->input->post("txtPhone"),
					"con_address" => $this->input->post("txtAdress"),
					"con_status" => $this->input->post("ddlStatus"),
					"con_age" => $this->input->post("txtAge"),
					"con_desc" => $this->input->post("txtDesc"),						
					"user_updt" => $this->userCrea,
					"date_updt" => date('Y-m-d')
					 );				
			$this->db->where("con_id",$id);
			$query=$this->db->update("tbl_concreter",$data);
			if($query==TRUE){return TURE;}
		}				
	}
	public function delete($id)
	{
		if($id==TRUE)
		{						
			$this->db->where("con_id",$id);
			$query=$this->db->delete("tbl_concreter");
			if($query==TRUE){return $query;}
		}
	}
	
}
?>