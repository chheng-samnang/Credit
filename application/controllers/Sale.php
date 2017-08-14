<?php
class Sale extends CI_Controller
{
	var $pageHeader,$page_redirect;
	public function __construct()
	{
		parent::__construct();
		$this->pageHeader='Credit';
		$this->page_redirect="Sale";
		$this->load->model("sale_m","sm");
	}
	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('template/left');
		$data['pageHeader'] = $this->pageHeader;
		$data["action_url"]=array(0=>"{$this->page_redirect}/add",1=>"{$this->page_redirect}/edit",2=>"{$this->page_redirect}/delete",3=>"Payment/index",4=>"{$this->page_redirect}/saleDetail");
		$data["value"]= $this->sm->index();
		if(!empty($this->session->flashdata('msg'))){$data['msg']=$this->message->success_msg($this->session->flashdata('msg'));}
		$this->load->view('sale_v',$data);
		$this->load->view('template/footer');
	}
	public function saleDetail($id="")
	{
		$data['detail'] = $this->sm->index($id);
		$this->load->view('template/header');
		$this->load->view('template/left');
		$this->load->view('sale_detail',$data);
		$this->load->view('template/footer');
	}
	public function validation()
	{
		$this->form_validation->set_rules('ddlConcreter','Concreter','trim|required');
		$this->form_validation->set_rules('txtCustomerName','Customer name','trim|required');
		$this->form_validation->set_rules('txtCost','Cost','trim|required|numeric');
		$this->form_validation->set_rules('txtPumpCost','Pump cost','trim|required|numeric');
		$this->form_validation->set_rules('txtPaymentDuration','Payment duration','trim|required|numeric');
		$this->form_validation->set_rules('txtDistance','Distance','trim|required|numeric');
		$this->form_validation->set_rules('txtSet','Set','trim|numeric');
		$this->form_validation->set_rules('txtAmountSale','Amount sale','trim|required|numeric');
		$this->form_validation->set_rules('txtAmountSale1','Amount sale1','trim|required|numeric');
		$this->form_validation->set_rules('txtSaleDate','Sale Date','trim|required');
		if($this->form_validation->run()==TRUE){return TRUE;}
		else{return FALSE;}
	}
	public function add()
	{
		$row=$this->sm->get_concreter();
		if($row==TRUE)
		{
			$option[NULL]	=	"Choose One";
			foreach($row as $value):
				$option[$value->con_id]=$value->con_name;
			endforeach;
		}
		else{$option[NULL]=NULL;}
		$data['ctrl'] = $this->createCtrl($row="",$option);
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
	                if($this->sm->add()==TRUE)
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
			$row=$this->sm->get_concreter();
			if($row==TRUE)
			{
				$option[NULL]	=	"Choose One";
				foreach($row as $value):
					$option[$value->con_id]=$value->con_name;
				endforeach;
			}
			else{$option[NULL]=NULL;}

			$row=$this->sm->index($id);
			if($row==TRUE)
			{
				$data['ctrl'] = $this->createCtrl($row,$option);
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
				$row=$this->sm->edit($id);
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
			$row=$this->sm->delete($id);
			if($row==TRUE){redirect("{$this->page_redirect}/");exit;}
		}
		else{return FALSE;}
	}
	public function createCtrl($row="",$option="")
		{
			if($row!="")
			{
				$row2=$row->con_id;
				$row3=$row->customer_name;
				$row4=$row->customer_phone;
				$row5=$row->customer_address;
				$row6=$row->power;
				$row7=$row->cost;
				$row8=$row->slump;
				$row9=$row->payment_duration;
				$row10=$row->pump_cost;
				$row11=$row->distance;
				$row12=$row->set;
				$row13=$row->amount_sale;
				$row14=$row->amount_sale1;
				$row15=$row->p;
				$row16=$row->sale_date;
				$row17=$row->sale_desc;
			}
			$ctrl = array(
							array(
									'type'=>'dropdown',
									'name'=>'ddlConcreter',
									'option'=>$option,
									'selected'=>$row==""? set_value("ddlConcreter") : $row2,
									'class'=>'class="form-control"',
									'label'=>'Concreter'
								),
							array(
									'type'=>'text',
									'name'=>'txtCustomerName',
									'id'=>'txtCustomerName',
									'value'=>$row==""? set_value("txtCustomerName") : $row3,
									'placeholder'=>'Enter customer name',
									'class'=>'form-control',
									'label'=>'Customer name'
								),
							array(
									'type'=>'text',
									'name'=>'txtCustomerPhone',
									'id'=>'txtCustomerPhone',
									'value'=>$row==""? set_value("txtCustomerPhone") : $row4,
									'placeholder'=>'Enter customer phone',
									'class'=>'form-control',
									'label'=>'Customer phone'
								),
							array(
									'type'=>'text',
									'name'=>'txtCustomerAddress',
									'id'=>'txtCustomerAddress',
									'value'=>$row==""? set_value("txtCustomerAddress") : $row5,
									'placeholder'=>'Enter customer address',
									'class'=>'form-control',
									'label'=>'Customer address'
								),
								array(
									'type'=>'text',
									'name'=>'txtPower',
									'id'=>'txtPower',
									'value'=>$row==""? set_value("txtPower") : $row6,
									'placeholder'=>'Enter power',
									'class'=>'form-control',
									'label'=>'Power'
								),
								array(
									'type'=>'text',
									'name'=>'txtCost',
									'id'=>'txtCost',
									'value'=>$row==""? set_value("txtCost") : $row7,
									'placeholder'=>'Enter cost',
									'class'=>'form-control',
									'label'=>'Cost'
								),
							array(
									'type'=>'text',
									'name'=>'txtSlump',
									'id'=>'txtSlump',
									'value'=>$row==""? set_value("txtSlump") : $row8,
									'placeholder'=>'Enter slump',
									'class'=>'form-control',
									'label'=>'Slump'
								),
							array(
									'type'=>'text',
									'name'=>'txtPaymentDuration',
									'id'=>'txtPaymentDuration',
									'value'=>$row==""? set_value("txtPaymentDuration") : $row9,
									'placeholder'=>'Enter payment duration',
									'class'=>'form-control',
									'label'=>'Payment duration'
								),
							array(
									'type'=>'text',
									'name'=>'txtPumpCost',
									'id'=>'txtPumpCost',
									'value'=>$row==""? set_value("txtPumpCost") : $row10,
									'placeholder'=>'Enter pump cost',
									'class'=>'form-control',
									'label'=>'Pump cost'
								),
							array(
									'type'=>'text',
									'name'=>'txtDistance',
									'id'=>'txtDistance',
									'value'=>$row==""? set_value("txtDistance") : $row11,
									'placeholder'=>'Enter distance',
									'class'=>'form-control',
									'label'=>'Distance'
								),
							array(
								'type'=>'text',
								'name'=>'txtSet',
								'id'=>'txtSet',
								'value'=>$row==""? set_value("txtSet") : $row12,
								'placeholder'=>'Enter set',
								'class'=>'form-control',
								'label'=>'Set'
							),
							array(
								'type'=>'text',
								'name'=>'txtAmountSale',
								'id'=>'txtAmountSale',
								'value'=>$row==""? set_value("txtAmountSale") : $row13,
								'placeholder'=>'Enter amount sale',
								'class'=>'form-control',
								'label'=>'Amount sale'
							),
							array(
								'type'=>'text',
								'name'=>'txtAmountSale1',
								'id'=>'txtAmountSale1',
								'value'=>$row==""? set_value("txtAmountSale1") : $row14,
								'placeholder'=>'Enter amount sale1',
								'class'=>'form-control',
								'label'=>'Amount sale1'
							),
							array(
								'type'=>'text',
								'name'=>'txtP',
								'id'=>'txtP',
								'value'=>$row==""? set_value("txtP") : $row15,
								'placeholder'=>'Enter P',
								'class'=>'form-control',
								'label'=>'P'
							),
							array(
									'type'=>'text',
									'name'=>'txtSaleDate',
									'id'=>'txtSaleDate',
									'value'=>$row==""? set_value("txtSaleDate") : $row16,
									'placeholder'=>'Enter sale date',
									'class'=>'form-control datetimepicker',
									'label'=>'Sale date',
								),
							array(
									'type'=>'textarea',
									'name'=>'txtDesc',
									'value'=>$row==""? set_value("txtDesc") : $row17,
									'label'=>'Description'
								),
						);
			return $ctrl;
		}
}
?>
