<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Main_m","mm");
	}
	public function index()
	{
		// $data['value']=$this->mm->index();
		$data = array();
		$this->load->view('template/header');
		$this->load->view('template/left');
		$this->load->view('main',$data);
		$this->load->view('template/footer');
	}
}
