<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class department_m extends CI_Model {

  public $variable;

  public function __construct()
  {
    parent::__construct();
  }

  public function index($dep_id="")
  {
    if($dep_id=="")
    {
      $query = $this->db->get('tbl_department');
      if($query->num_rows()>0)
      {
        return $query->result();
      }else{
        return array();
      }
    }else{
      $query = $this->db->get_where('tbl_department', array("dep_id"=>$dep_id));
      if($query->num_rows()>0)
      {
        return $query->result();
      }else{
        return array();
      }
    }
  }

  public function user_create()
        {
            $userLogin = isset($this->session->userLogin)?$this->session->userLogin:"N/A";
              $data = array(
              'dep_code'=>$this->input->post('txtDepCode'),
              'dep_name'=>$this->input->post('txtDepName'),
              'dep_desc'=>$this->input->post('txtDesc'),
              'user_crea'=>$userLogin,
              'date_crea'=>date('Y-m-d')
            );
              if($data!==""){
                $query=$this->db->insert('tbl_department',$data);
                if($query==TRUE){return TRUE;}
              }
        }

        public function user_udate($dep_id){
                if($dep_id!==""){
                      $data = array(
                    'dep_code'=>$this->input->post('txtDepCode'),
                    'dep_name'=>$this->input->post('txtDepName'),
                    'dep_desc'=>$this->input->post('txtDesc'),
                    'user_updt'=>$this->session->userLogin,
                    'date_updt'=>date('Y-m-d')
                  );
                     $this->db->where('dep_id',$dep_id);
                   $query=$this->db->update('tbl_department',$data);
                   if($query==TRUE){return TRUE;}
                }
            }

        public function delete($dep_id){
  						$this->db->where('dep_id',$dep_id);
  						$result = $this->db->delete('tbl_department');
  	    }

}

/* End of file ModelName.php */
/* Location: ./application/models/ModelName.php */
