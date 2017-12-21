<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Position extends CI_Controller {
	function __construct(){
					parent::__construct();
					$this->pageHeader='Position';
					$this->cancelString = 'Position';
					$this->load->model('position_m','pm');
			 }
    public function index()
	{
		$this->load->view('template/header');
		$this->load->view('template/left');
		$page="Position";
		$data['pageHeader'] = $this->pageHeader;
		$data["action_url"]=array(0=>"{$page}/add",1=>"{$page}/edit",2=>"{$page}/delete");
		$data["tbl_hdr"]=array("Position Name","Pos. Code","Description","User create","Date create","User update","Date update");
		$id="";
		$row=$this->pm->index($id);
		$i=0;
		foreach($row as $value):
			$data["tbl_body"][$i]=array(
										$value->pos_name,
										$value->pos_code,
										$value->pos_desc,
										$value->user_crea,
										$value->date_crea,
										$value->user_updt,
										$value->date_updt,
										$value->pos_id
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
		$data['action'] = 'Position/add';
		$data['pageHeader'] = $this->pageHeader;
		$data['cancel'] = $this->cancelString;
		if(isset($_POST['btnSubmit']))
		{
		   $this->form_validation->set_rules('txtPosCode','Position Code','required');
		   $this->form_validation->set_rules('txtPosName','Position Name','required');

		   if($this->form_validation->run()==false){
				$this->load->view('template/header');
				$this->load->view('template/left');
				$this->load->view('page_add',$data);
				$this->load->view('template/footer');
			   }else{
			   	if($this->pm->user_create()==TRUE)
			   	{
			   		$this->session->set_flashdata('msg','Save successfully !');
			   		redirect('Position');
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
		 	$row=$this->pm->index($id);
		 }
		$data['ctrl'] = $this->createCtrl($row,$option,$option1);
		$data['action'] = "Position/edit/{$id}";
		$data['pageHeader'] = $this->pageHeader;
		$data['cancel'] = $this->cancelString;
		$this->form_validation->set_rules('txtPosCode','Position Code','required');
	  $this->form_validation->set_rules('txtPosName','Position Name','required');
		if(isset($_POST['btnSubmit']))
		{
			if($this->form_validation->run()==TRUE)
			{
					if($this->pm->user_udate($id)==TRUE)
					{
						$this->session->set_flashdata('msg','Change successfully !');
						redirect('Position');
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
				  $value_1=$value->pos_code;
			    $value_2=$value->pos_name;
			    $value_3=$value->pos_desc;
			    }
          $ctrl = array(
        array(
            'type'=>'text',
            'name'=>'txtPosCode',
            'id'=>'txtPosCode',
            'placeholder'=>'Enter Position Code here...',
            'class'=>'form-control',
            'readonly'=>'readonly',
            'label'=>'Position Code',
            'value'=>set_value("txtPosCode",$value_1),
            'required'=>'',
          ),
        array(
            'type'=>'text',
            'name'=>'txtPosName',
            'id'=>'txtPosName',
            'placeholder'=>'Enter Position Name here...',
            'class'=>'form-control',
            'value'=>set_value("txtPosName",$value_2),
            'label'=>'Position Name',
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
							'name'=>'txtPosCode',
							'id'=>'txtPosCode',
							'placeholder'=>'Enter Position Code here...',
							'class'=>'form-control',
							'label'=>'Position Code',
							'required'=>'',
						),
					array(
							'type'=>'text',
							'name'=>'txtPosName',
							'id'=>'txtPosName',
							'placeholder'=>'Enter Position Name here...',
							'class'=>'form-control',
							'label'=>'Position Name',
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
     	 $this->pm->delete($id);
     	 redirect('Position');
     	}
	}

	public function change_password($id){
		$data['option'] = array('1'=>'Enable','0'=>'Disable');
		$row=$this->um->index($id);
		foreach ($row as  $value) {
		}
		$user_passwd=$value->user_pass;
		$data['ctrl'] = $this->changeCtrl();
		$data['action'] = "User/change_password/{$id}";
		$data['pageHeader'] = $this->pageHeader;
		$data['cancel'] = $this->cancelString;
		if(isset($_POST['btnSubmit']))
		{
			$this->form_validation->set_rules('txtPasswd','Password','required');
			$this->form_validation->set_rules('txtNewPassword','New Password','required');
			$this->form_validation->set_rules('txtConfirm','Comfirm Password','required|matches[txtNewPassword]');
			if($this->form_validation->run()==false)
			{
				$this->load->view('template/header');
				$this->load->view('template/left');
				$this->load->view('change_passwd',$data);
			}
			else
			{
				if($user_passwd==do_hash($this->input->post('txtPasswd')))
				{
			      if($this->um->updatePassword($id)==TRUE)
			      {
			      	$this->session->set_flashdata('msg','Change Password successfully !');
			      	redirect('User');
			      	exit;
			      }
				}
				else
				{
					$data['error']='Your Old password Incorrect !';
					$this->load->view('template/header');
					$this->load->view('template/left');
					$this->load->view('change_passwd',$data);
				}
			}
		}else
		{
			$this->load->view('template/header');
			$this->load->view('template/left');
			$this->load->view('change_passwd',$data);
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
