<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class staff_m extends CI_Model {

  public $variable;

  public function __construct()
  {
    parent::__construct();
  }

  public function index($st_id="")
  {
    if($st_id=="")
    {
      $query = $this->db->get('tbl_staf');
      if($query->num_rows()>0)
      {
        return $query->result();
      }else{
        return array();
      }
    }else{
      $query = $this->db->get_where('tbl_staf', array("st_id"=>$st_id));
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
              'st_code'=>$this->input->post('txtStCode'),
              'st_name'=>$this->input->post('txtStName'),
              'desc'=>$this->input->post('txtDesc'),
              'st_status'=>$this->input->post('ddlStatus'),
              'img'=>$this->input->post('txtUpload'),
              'st_hired_date'=>$this->input->post('txtHiredDate'),
              'st_validity'=>$this->input->post('txtValidity'),
              'pos_id'=>$this->input->post('ddlPosition'),
              'dep_id'=>$this->input->post('ddlDepartment'),
              'user_crea'=>$userLogin,
              'date_crea'=>date('Y-m-d')
            );
              if($data!==""){
                $query=$this->db->insert('tbl_staf',$data);
                if($query==TRUE){return TRUE;}
              }
        }

        public function user_udate($st_id){
                if($st_id!==""){
                  if($this->input->post('txtUpload')!=""){
                    $data = array(
                    'st_name'=>$this->input->post('txtStName'),
                    'st_status'=>$this->input->post('ddlStatus'),
                    'img'=>$this->input->post('txtUpload'),
                    'st_hired_date'=>$this->input->post('txtHiredDate'),
                    'st_validity'=>$this->input->post('txtValidity'),
                    'desc'=>$this->input->post('txtDesc'),
                    'pos_id'=>$this->input->post('ddlPosition'),
                    'dep_id'=>$this->input->post('ddlDepartment'),
                    'user_updt'=>$this->session->userLogin,
                    'date_updt'=>date('Y-m-d')
                  );
                }else{
                  $data = array(
                  'st_name'=>$this->input->post('txtStName'),
                  'st_status'=>$this->input->post('ddlStatus'),
                  'st_hired_date'=>$this->input->post('txtHiredDate'),
                  'st_validity'=>$this->input->post('txtValidity'),
                  'desc'=>$this->input->post('txtDesc'),
                  'pos_id'=>$this->input->post('ddlPosition'),
                  'dep_id'=>$this->input->post('ddlDepartment'),
                  'user_updt'=>$this->session->userLogin,
                  'date_updt'=>date('Y-m-d')
                );
                }

                     $this->db->where('st_id',$st_id);
                   $query=$this->db->update('tbl_staf',$data);
                   if($query==TRUE){return TRUE;}
                }
            }

        public function delete($st_id){
  						$this->db->where('st_id',$st_id);
  						$result = $this->db->delete('tbl_staf');
  	    }

        public function getPosition()
        {
          $query = $this->db->get('tbl_position');
          if($query->num_rows()>0){
            return $query->result();
          }else{
            return array();
          }
        }

        public function getDepartment()
        {
          $query = $this->db->get('tbl_department');
          if($query->num_rows()>0){
            return $query->result();
          }else{
            return array();
          }
        }

}

/* End of file ModelName.php */
/* Location: ./application/models/ModelName.php */
