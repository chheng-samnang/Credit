<?php
class Payment extends CI_Controller
{
	var $pageHeader,$page_redirect;	
	public function __construct()
	{
		parent::__construct();
		$this->pageHeader='Payment';
		$this->page_redirect="Payment";								
		$this->load->model("payment_m","pm");
	}
	public function index($id="")
	{	
		$this->session->sal_id=$id;	
		$this->load->view('template/header');
		$this->load->view('template/left');		
		$data['pageHeader'] = $this->pageHeader;
		$data["action_url"]=array(0=>"{$this->page_redirect}/add/$id",2=>"{$this->page_redirect}/delete",);							
		$data["tbl_hdr"]=array("Code","Concreter","Location","Cost","Pump cost","Amount","Total","Paid","Remaining","Date","User create","Date create");		
		$row=$this->pm->index($id);		
		$i=0;
		if($row==TRUE)
		{
			foreach($row as $value):
			$data["tbl_body"][$i]=array(				
										$value->con_code,	
										$value->con_name,										
										$value->customer_address,																																																																																								
										'$'.number_format($value->cost,2),																																																																																								
										'$'.number_format($value->pump_cost,2),																																																																																								
										number_format($value->amount_sale1,2),																																																																																								
										'$'.number_format($value->total_bal_sale1,2),																																																																																								
										'$'.number_format($value->payment,2),																																																																																								
										'$'.number_format($value->remaining,2),																																																																																								
										date("d-M-Y h:i:sa",strtotime($value->date_payment)),
										$value->user_crea,
										$value->date_crea,
										$value->pay_id
									);
			$i=$i+1;
		endforeach;
		}	
		if(!empty($this->session->flashdata('msg'))){$data['msg']=$this->message->success_msg($this->session->flashdata('msg'));}																		
		$this->load->view('page_view',$data);
		$this->load->view('template/footer');
	}	
	public function validation()
	{		
		$this->form_validation->set_rules('txtPaid','Paid','trim|required|numeric');			
		if($this->form_validation->run()==TRUE){return TRUE;}
		else{return FALSE;}
	}	
	public function add($id="")
	{	
		$data['value']=$this->pm->get_add($id);
		$data['remaining']=$this->pm->get_remaining($id);
		$data['action'] = "{$this->page_redirect}/add_value";
		$data['pageHeader'] = $this->pageHeader;		
		$data['cancel'] = $this->page_redirect."/index/$id";
		$this->load->view('template/header');
		$this->load->view('template/left');
		$this->load->view('payment_add',$data);
		$this->load->view('template/footer');		
	}
	public function add_value()
	{
		if(isset($_POST["btnSubmit"]))
		{			
			if($this->validation()==TRUE)
				{																													             
	                if($this->pm->add()==TRUE)
	                {	      
	                	$id=$this->input->post('txtSaleId'); 
	                	$this->session->set_flashdata('msg','Save successfully !');       	
						redirect("{$this->page_redirect}/index/$id");
						exit;	
	                }	                                																			
				}
			else{$this->add($this->input->post('txtSaleId'));}		
		}
	}
	public function delete($id="")
	{
		if($id!="")
		{
			$sale_id=$this->session->sal_id;
			$row=$this->pm->delete($id);
			if($row==TRUE){redirect("{$this->page_redirect}/index/$sale_id");exit;}
		}
		else{return FALSE;}
	}	
}
?>