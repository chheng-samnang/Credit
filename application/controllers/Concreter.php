<?php
class Concreter extends CI_Controller
{
	var $pageHeader,$page_redirect;	
	public function __construct()
	{
		parent::__construct();
		$this->pageHeader='Concreter';
		$this->page_redirect="Concreter";								
		$this->load->model("concreter_m","cm");
	}
	public function index()
	{		
		$this->load->view('template/header');
		$this->load->view('template/left');		
		$data['pageHeader'] = $this->pageHeader;
		$data["action_url"]=array(0=>"{$this->page_redirect}/add",1=>"{$this->page_redirect}/edit",2=>"{$this->page_redirect}/delete",4=>"{$this->page_redirect}/concreterDetail");							
		$data["tbl_hdr"]=array("Code","Name","Phone","Status","Address");		
		$row=$this->cm->index();		
		$i=0;
		if($row==TRUE)
		{
			foreach($row as $value):
			$data["tbl_body"][$i]=array(				
										$value->con_code,	
										$value->con_name,										
										$value->con_phone,
										$value->con_status==1?'Enable':'Disable',																																																																															
										$value->con_address,
										$value->con_id
									);
			$i=$i+1;
		endforeach;
		}	
		if(!empty($this->session->flashdata('msg'))){$data['msg']=$this->message->success_msg($this->session->flashdata('msg'));}																		
		$this->load->view('page_view',$data);
		$this->load->view('template/footer');
	}
	public function concreterDetail($id="")
	{
		$data['detail'] = $this->cm->index($id);
		$this->load->view('template/header');
		$this->load->view('template/left');
		$this->load->view('concreter_detail',$data);
		$this->load->view('template/footer');	
	}
	public function validation()
	{		
		$this->form_validation->set_rules('txtCode','Code','trim|required');
		$this->form_validation->set_rules('txtName','Name','trim|required');
		$this->form_validation->set_rules('ddlGender','Gender','trim|required');		
		if($this->form_validation->run()==TRUE){return TRUE;}
		else{return FALSE;}
	}	
	public function add()
	{			
		$option= array('1'=>'Enable','0'=>'Disable');			
		$option1= array(''=>'Choose one','m'=>'Male','f'=>'Female');	
		$data['ctrl'] = $this->createCtrl($row="",$option,$option1);		
		$data['action'] = "{$this->page_redirect}/add_value";
		$data['pageHeader'] = $this->pageHeader;		
		$data['cancel'] = $this->page_redirect;
		$this->load->view('template/header');
		$this->load->view('template/left');
		$this->load->view('page_add',$data);
		$this->load->view('template/footer');		
	}
	public function add_value()
	{
		if(isset($_POST["btnSubmit"]))
		{			
			if($this->validation()==TRUE)
				{																													             
	                if($this->cm->add()==TRUE)
	                {	       
	                	$this->session->set_flashdata('msg','Save successfully !');       	
						redirect("{$this->page_redirect}/");
						exit;	
	                }	                                																			
				}
			else{$this->add();}		
		}
	}
	public function edit($id="")
	{		
		if($id!="")
		{		
			$row=$this->cm->index($id);				
			if($row==TRUE)
			{					
				$option= array('1'=>'Enable','0'=>'Disable');			
				$option1= array(''=>'Choose one','m'=>'Male','f'=>'Female');	
				$data['ctrl'] = $this->createCtrl($row,$option,$option1);			
				$data['action'] = "{$this->page_redirect}/edit_value/{$id}";
				$data['pageHeader'] = $this->pageHeader;		
				$data['cancel'] = $this->page_redirect;
				$this->load->view('template/header');
				$this->load->view('template/left');
				$this->load->view("page_edit",$data);
				$this->load->view('template/footer');
			}
		}
		else{return FALSE;}
	}
	public function edit_value($id="")
	{		
		if(isset($_POST["btnSubmit"]))
		{						
			if($this->validation()==TRUE)
			{	
				$row=$this->cm->edit($id);	
				if($row==TRUE)
	            {	
	            	$this->session->set_flashdata('msg','Change successfully !');                		                	
					redirect("{$this->page_redirect}/");
					exit;	
	            }																												 																				            	                	                                												
			}
			else 
			{	
				$this->edit($id);													
			}			
		}
	}	

	public function delete($id="")
	{
		if($id!="")
		{
			$row=$this->cm->delete($id);
			if($row==TRUE){redirect("{$this->page_redirect}/");exit;}
		}
		else{return FALSE;}
	}
	public function createCtrl($row="",$option="",$option1="")
		{	
			if($row!="")
			{		
				$row1=$row->con_code;
				$row2=$row->con_name;
				$row3=$row->con_gender;
				$row4=$row->con_phone;
				$row5=$row->con_address;
				$row6=$row->con_status;
				$row7=$row->con_age;
				$row8=$row->con_desc;
			}
			$ctrl = array(	
							array(
									'type'=>'text',
									'name'=>'txtCode',
									'id'=>'txtCode',									
									'value'=>$row==""? set_value("txtCode") : $row1,					
									'placeholder'=>'Enter code',									
									'class'=>'form-control',
									'label'=>'Code'																								
								),
								array(
									'type'=>'text',
									'name'=>'txtName',
									'id'=>'txtName',									
									'value'=>$row==""? set_value("txtName") : $row2,					
									'placeholder'=>'Enter name',									
									'class'=>'form-control',
									'label'=>'Name'																								
								),															
							array(
									'type'=>'dropdown',
									'name'=>'ddlGender',
									'option'=>$option1,
									'selected'=>$row==""? set_value("ddlGender") : $row3,
									'class'=>'class="form-control"',
									'label'=>'Gender'
								),
							array(
									'type'=>'text',
									'name'=>'txtPhone',
									'id'=>'txtPhone',									
									'value'=>$row==""? set_value("txtPhone") : $row4,					
									'placeholder'=>'Enter phone',									
									'class'=>'form-control',
									'label'=>'Phone'																								
								),
							array(
									'type'=>'text',
									'name'=>'txtAdress',
									'id'=>'txtAdress',									
									'value'=>$row==""? set_value("txtAdress") : $row5,					
									'placeholder'=>'Enter address',									
									'class'=>'form-control',
									'label'=>'Address'																								
								),
							array(
									'type'=>'dropdown',
									'name'=>'ddlStatus',
									'option'=>$option,
									'selected'=>$row==""? set_value("ddlStatus") : $row6,
									'class'=>'class="form-control"',
									'label'=>'Status'
								),
							array(
									'type'=>'text',
									'name'=>'txtAge',
									'id'=>'txtAge',									
									'value'=>$row==""? set_value("txtAge") : $row7,					
									'placeholder'=>'Enter age',									
									'class'=>'form-control',
									'label'=>'Age'																								
								),
							array(
									'type'=>'textarea',
									'name'=>'txtDesc',
									'value'=>$row==""? set_value("txtDesc") : $row8,
									'label'=>'Description'
								)
							);
			return $ctrl;
		}
}
?>