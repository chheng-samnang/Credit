<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Staff extends CI_Controller {
	function __construct(){
					parent::__construct();
					$this->pageHeader='Staff';
					$this->cancelString = 'Staff';
					$this->load->model('staff_m','sm');
			 }
    public function index()
	{
		$this->load->view('template/header');
		$this->load->view('template/left');
		$page="Staff";
		$data['pageHeader'] = $this->pageHeader;
		$data["action_url"]=array(0=>"{$page}/add",1=>"{$page}/edit",2=>"{$page}/delete");
		$data["tbl_hdr"]=array("Staff Name","Staff Code","Status","Description","User create","Date create","User update","Date update");
		$id="";
		$row=$this->sm->index($id);
		$i=0;
		foreach($row as $value):
			$data["tbl_body"][$i]=array(
										$value->st_name,
										$value->st_code,
										$value->st_status,
										$value->desc,
										$value->user_crea,
										$value->date_crea,
										$value->user_updt,
                    $value->date_updt,
										$value->st_id
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
  		$data['action'] = 'Staff/add';
  		$data['pageHeader'] = $this->pageHeader;
  		$data['cancel'] = $this->cancelString;
  		if(isset($_POST['btnSubmit']))
  		{
  		   $this->form_validation->set_rules('txtStCode','Staff Code','required');
  		   $this->form_validation->set_rules('txtStName','Staff Name','required');

  		   if($this->form_validation->run()==false){
  				$this->load->view('template/header');
  				$this->load->view('template/left');
  				$this->load->view('page_add',$data);
  				$this->load->view('template/footer');
  			   }else{
  			   	if($this->sm->user_create()==TRUE)
  			   	{
  			   		$this->session->set_flashdata('msg','Save successfully !');
  			   		redirect('Staff');
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
		 	$row=$this->sm->index($id);
		 }
		$data['ctrl'] = $this->createCtrl($row,$option,$option1);
		$data['action'] = "Staff/edit/{$id}";
		$data['pageHeader'] = $this->pageHeader;
		$data['cancel'] = $this->cancelString;
		$this->form_validation->set_rules('txtStCode','Staff Code','required');
	  $this->form_validation->set_rules('txtStName','Staff Name','required');
		if(isset($_POST['btnSubmit']))
		{
			if($this->form_validation->run()==TRUE)
			{
					if($this->sm->user_udate($id)==TRUE)
					{
						$this->session->set_flashdata('msg',' Change successfully !');
						redirect('Staff');
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
				  $st_code=$value->st_code;
			    $st_name=$value->st_name;
			    $desc=$value->desc;
          $st_status = $value->st_status;
					$st_hired_date = $value->st_hired_date;
					$st_validity = $value->st_validity;
					$pos_id = $value->pos_id;
					$dep_id = $value->dep_id;
          $img = isset($value->img)&&$value->img!=""?$value->img:"noimages.png";

			    }
          $status = array("-1"=>"Choose one","1"=>"Enable","0"=>"Disable");
					$getPos = $this->sm->getPosition();
					foreach ($getPos as $key => $value) {
						$pos[0] = 'Choose one';
						$pos[$value->pos_id] = $value->pos_name;
					}
					$getDep = $this->sm->getDepartment();
					foreach ($getDep as $key => $value) {
						$dep[0] = 'Choose one';
						$dep[$value->dep_id] = $value->dep_name;
					}
          $ctrl = array(
        array(
            'type'=>'text',
            'name'=>'txtStCode',
            'id'=>'txtStCode',
            'placeholder'=>'Enter Staff Code here...',
            'class'=>'form-control',
            'label'=>'Staff Code',
            'readonly'=>'readonly',
            'value'=>set_value("txtStCode",$st_code),
            'required'=>'',
          ),
        array(
            'type'=>'text',
            'name'=>'txtStName',
            'id'=>'txtStName',
            'placeholder'=>'Enter Staff Name here...',
            'class'=>'form-control',
            'value'=>set_value("txtStName",$st_name),
            'label'=>'Staff Name',
          ),

					array(
	          'type'=>'dropdown',
	          'name'=>'ddlPosition',
	          'option'=>$pos,
	          'class'=>'class="form-control"',
	          'selected'=>$pos_id,
	          'label'=>'Position'
	        ),
					array(
	          'type'=>'dropdown',
	          'name'=>'ddlDepartment',
	          'option'=>$dep,
	          'class'=>'class="form-control"',
	          'selected'=>$dep_id,
	          'label'=>'Department'
	        ),
        array(
          'type'=>'dropdown',
          'name'=>'ddlStatus',
          'option'=>$status,
          'class'=>'class="form-control"',
          'selected'=>$st_status,
          'label'=>'Status'
        ),
				array(
						'type'=>'text',
						'name'=>'txtHiredDate',
						'id'=>'txtHiredDate',
						'placeholder'=>'Click to pick a date',
						'class'=>'form-control datetimepicker',
						'value'=>set_value("txtHiredDate",$st_hired_date),
						'label'=>'Hired Date'
					),
					array(
							'type'=>'text',
							'name'=>'txtValidity',
							'id'=>'txtValidity',
							'placeholder'=>'Click to pick a date',
							'class'=>'form-control datetimepicker',
							'value'=>set_value("txtValidity",$st_validity),
							'label'=>'Validity'
						),
        array(
          'type'=>'upload',
          'name'=>'txtUpload',
          'id'=>'txtUpload',
          'img'=>'<img style="width:120px;" src="'.base_url('assets/uploads').'/'.$img.'" />',
          'label'=>$this->lang->line('upload')
        ),
        array(
          'type'=>'textarea',
          'name'=>'txtDesc',
          'id'=>'txtDesc',
          'value'=>set_value("txtDesc",$desc),
          'class'=>'form-control',
          'label'=>'Description'
        )
        );
			}else
			{
        $status = array("-1"=>"Choose one","1"=>"Enable","0"=>"Disable");
				$getPos = $this->sm->getPosition();
				foreach ($getPos as $key => $value) {
					$pos[0] = 'Choose one';
					$pos[$value->pos_id] = $value->pos_name;
				}
				$getDep = $this->sm->getDepartment();
				foreach ($getDep as $key => $value) {
					$dep[0] = 'Choose one';
					$dep[$value->dep_id] = $value->dep_name;
				}
        $ctrl = array(
                    array(
                        'type'=>'text',
                        'name'=>'txtStCode',
                        'id'=>'txtStCode',
                        'placeholder'=>'Enter Staff Code here...',
                        'class'=>'form-control',
                        'label'=>'Staff Code',
                        'value'=>set_value("txtStCode"),
                        'required'=>'',
                      ),
                    array(
                        'type'=>'text',
                        'name'=>'txtStName',
                        'id'=>'txtStName',
                        'placeholder'=>'Enter Staff Name here...',
                        'class'=>'form-control',
                        'value'=>set_value("txtStName"),
                        'label'=>'Staff Name',
                      ),
											array(
							          'type'=>'dropdown',
							          'name'=>'ddlPosition',
							          'option'=>$pos,
							          'class'=>'class="form-control"',
							          'label'=>'Position'
							        ),
											array(
							          'type'=>'dropdown',
							          'name'=>'ddlDepartment',
							          'option'=>$dep,
							          'class'=>'class="form-control"',
							          'label'=>'Department'
							        ),
                    array(
                      'type'=>'dropdown',
                      'name'=>'ddlStatus',
                      'option'=>$status,
                      'class'=>'class="form-control"',
                      'label'=>'Status'
                    ),
										array(
						            'type'=>'text',
						            'name'=>'txtHiredDate',
						            'id'=>'txtHiredDate',
						            'placeholder'=>'Click to pick a date',
						            'class'=>'form-control datetimepicker',
						            'value'=>set_value("txtHiredDate"),
						            'label'=>'Hired Date'
						          ),
											array(
													'type'=>'text',
													'name'=>'txtValidity',
													'id'=>'txtValidity',
													'placeholder'=>'Click to pick a date',
													'class'=>'form-control datetimepicker',
													'value'=>set_value("txtValidity"),
													'label'=>'Validity Date'
												),
                    array(
                      'type'=>'upload',
                      'name'=>'txtUpload',
                      'id'=>'txtUpload',
                      'img'=>'',
                      'label'=>$this->lang->line("upload")
                    ),
                    array(
                      'type'=>'textarea',
                      'name'=>'txtDesc',
                      'id'=>'txtDesc',
                      'value'=>set_value("txtDesc"),
                      'class'=>'form-control',
                      'label'=>'Description'
                    )
                    );
			}
			return $ctrl;
		}
	public function delete($id){
     if($id!==""){
     	 $this->sm->delete($id);
     	 redirect('Staff');
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
