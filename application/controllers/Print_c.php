<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Print_c extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data = array();
    $this->load->view('template/header');
    $this->load->view('print_page', $data);
		$this->load->view('template/footer');
  }

}

/* End of file Print.php */
/* Location: ./application/controllers/Print.php */
