<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Print_c extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('print_m', 'pm');
  }

  public function index()
  {
    $data["staff"] = $this->pm->getCard();
    $this->load->view('template/header');
    $this->load->view('print_page', $data);
		$this->load->view('template/footer');
  }

}

/* End of file Print.php */
/* Location: ./application/controllers/Print.php */
