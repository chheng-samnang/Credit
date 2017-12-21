<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class position_m extends CI_Model {

  public $variable;

  public function __construct()
  {
    parent::__construct();
  }

  public function index($pos_id="")
  {
    if($pos_id=="")
    {
      $query = $this->db->get('tbl_position');
      if($query->num_rows()>0)
      {
        return $query->result();
      }else{
        return array();
      }
    }else{
      $query = $this->db->get_where('tbl_position', array("pos_id"=>$pos_id));
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
              'pos_code'=>$this->input->post('txtPosCode'),
              'pos_name'=>$this->input->post('txtPosName'),
              'pos_desc'=>$this->input->post('txtDesc'),
              'user_crea'=>$userLogin,
              'date_crea'=>date('Y-m-d')
            );
              if($data!==""){
                $query=$this->db->insert('tbl_position',$data);
                if($query==TRUE){return TRUE;}
              }
        }

        public function user_udate($pos_id){
                if($pos_id!==""){
                      $data = array(
                    'pos_code'=>$this->input->post('txtPosCode'),
                    'pos_name'=>$this->input->post('txtPosName'),
                    'pos_desc'=>$this->input->post('txtDesc'),
                    'user_updt'=>$this->session->userLogin,
                    'date_updt'=>date('Y-m-d')
                  );
                     $this->db->where('pos_id',$pos_id);
                   $query=$this->db->update('tbl_position',$data);
                   if($query==TRUE){return TRUE;}
                }
            }

        public function delete($pos_id){
  						$this->db->where('pos_id',$pos_id);
  						$result = $this->db->delete('tbl_position');
  	    }

}

/* End of file ModelName.php */
/* Location: ./application/models/ModelName.php */
