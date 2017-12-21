<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Department extends CI_Controller {
	function __construct(){
					parent::__construct();
					$this->pageHeader='Department';
					$this->cancelString = 'Department';
					$this->load->model('department_m','dm');
			 }
    public function index()
	{
		$this->load->view('template/header');
		$this->load->view('template/left');
		$page="Department";
		$data['pageHeader'] = $this->pageHeader;
		$data["action_url"]=array(0=>"{$page}/add",1=>"{$page}/edit",2=>"{$page}/delete");
		$data["tbl_hdr"]=array("Department Name","Dep. Code","Description","User create","Date create","User update","Date update");
		$id="";
		$row=$this->dm->index($id);
		$i=0;
		foreach($row as $value):
			$data["tbl_body"][$i]=array(
										$value->dep_name,
										$value->dep_code,
										$value->dep_desc,
										$value->user_crea,
										$value->date_crea,
										$value->user_updt,
										$value->date_updt,
										$value->dep_id
									);
		    $i=$i+1;
		endforeach;
		if(!empty($this->session->flashdata('msg'))){$data['msg']=$this->message->success_msg($this->session->flashdata('msg'));}
		$this->load->view('page_view',$data);
		$this->load->view('template/footer');
    }
    public function add()
	{
    $option = "";
    $option1 = "";
		$data['ctrl'] = $this->createCtrl($row="",$option,$option1);
		$data['action'] = 'Department/add';
		$data['pageHeader'] = $this->pageHeader;
		$data['cancel'] = $this->cancelString;
		if(isset($_POST['btnSubmit']))
		{
		   $this->form_validation->set_rules('txtDepCode','Department Code','required');
		   $this->form_validation->set_rules('txtDepName','Department Name','required');

		   if($this->form_validation->run()==false){
				$this->load->view('template/header');
				$this->load->view('template/left');
				$this->load->view('page_add',$data);
				$this->load->view('template/footer');
			   }else{
			   	if($this->dm->user_create()==TRUE)
			   	{
			   		$this->session->set_flashdata('msg','Save successfully !');
			   		redirect('Department');
			   		exit;
			   	}
			   }
		}else
		{

			$this->load->view('template/header');
			$this->load->view('template/left');
			$this->load->view('page_add',$data);
			$this->load->view('template/footer');
		}
	}
	public function edit($id){
		$option = "";
		$option1= "";
		 if($id!==""){
		 	$row=$this->dm->index($id);
		 }
		$data['ctrl'] = $this->createCtrl($row,$option,$option1);
		$data['action'] = "Department/edit/{$id}";
		$data['pageHeader'] = $this->pageHeader;
		$data['cancel'] = $this->cancelString;
		$this->form_validation->set_rules('txtDepCode','Department Code','required');
	  $this->form_validation->set_rules('txtDepName','Department Name','required');
		if(isset($_POST['btnSubmit']))
		{
			if($this->form_validation->run()==TRUE)
			{
					if($this->dm->user_udate($id)==TRUE)
					{
						$this->session->set_flashdata('msg','Change successfully !');
						redirect('Department');
		 				exit;
					}
			}
			else
			{
				$this->load->view('template/header');
				$this->load->view('template/left');
				$this->load->view('page_edit',$data);
				$this->load->view('template/footer');
			}
		}else
		{
			$this->load->view('template/header');
			$this->load->view('template/left');
			$this->load->view('page_edit',$data);
			$this->load->view('template/footer');
		}
	}
	public function createCtrl($row,$option,$option1)
		{
		if($row!==""){
				foreach ($row as  $value) {
				  $value_1=$value->dep_code;
			    $value_2=$value->dep_name;
			    $value_3=$value->dep_desc;
			    }
          $ctrl = array(
        array(
            'type'=>'text',
            'name'=>'txtDepCode',
            'id'=>'txtDepCode',
            'placeholder'=>'Enter Department Code here...',
            'class'=>'form-control',
            'readonly'=>'readonly',
            'label'=>'Department Code',
            'value'=>set_value("txtDepCode",$value_1),
            'required'=>'',
          ),
        array(
            'type'=>'text',
            'name'=>'txtDepName',
            'id'=>'txtDepName',
            'placeholder'=>'Enter Department Name here...',
            'class'=>'form-control',
            'value'=>set_value("txtDepName",$value_2),
            'label'=>'Department Name',
          ),
        array(
          'type'=>'textarea',
          'name'=>'txtDesc',
          'id'=>'txtDesc',
          'value'=>set_value("txtDesc",$value_3),
          'class'=>'form-control',
          'label'=>'Description'
        )
        );
			}else
			{
		        $ctrl = array(
					array(
							'type'=>'text',
							'name'=>'txtDepCode',
							'id'=>'txtDepCode',
							'placeholder'=>'Enter Department Code here...',
							'class'=>'form-control',
							'label'=>'Department Code',
							'required'=>'',
						),
					array(
							'type'=>'text',
							'name'=>'txtDepName',
							'id'=>'txtDepName',
							'placeholder'=>'Enter Department Name here...',
							'class'=>'form-control',
							'label'=>'Department Name',
						),
					array(
						'type'=>'textarea',
						'name'=>'txtDesc',
						'id'=>'txtDesc',
						'class'=>'form-control',
						'label'=>'Description'
					)
					);
				}
			return $ctrl;
		}
	public function delete($id){
     if($id!==""){
     	 $this->dm->delete($id);
     	 redirect('Department');
     	}
	}


	public function changeCtrl()
		{
			    $ctrl = array(
			    			array(
									'type'=>'password',
									'name'=>'txtPasswd',
									'id'=>'txtpasswd',
									'placeholder'=>'Enter Old Password',
									'class'=>'form-control',
									'label'=>'Old Password',
									'required'=>''
								),
							array(
									'type'=>'password',
									'name'=>'txtNewPassword',
									'id'=>'txtNewPassword',
									'placeholder'=>'Enter New Password',
									'class'=>'form-control',
									'label'=>'New Password',
									'required'=>''
								),
							array(
									'type'=>'password',
									'name'=>'txtConfirm',
									'id'=>'txtConfirm',
									'placeholder'=>'Enter Confirm Password',
									'class'=>'form-control',
									'label'=>'Confirm Password',
									'required'=>''
								)
				);
				return $ctrl;
		}
}
