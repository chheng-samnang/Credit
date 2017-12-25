<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class print_m extends CI_Model {

  public $variable;

  public function __construct()
  {
    parent::__construct();

  }

  public function getCard($id=""){
    if($id!="")
    {
      $query = $this->db->query("SELECT st_name,st_code,pos_name,dep_name,st_hired_date,st_validity,img
                                  FROM tbl_staf s
                                  LEFT JOIN tbl_position p ON s.`pos_id`=p.`pos_id`
                                  LEFT JOIN tbl_department d ON s.`dep_id`=d.`dep_id`
                                  WHERE st_id='{$id}'
                                  ");
      if($query->num_rows()>0)
      {
        return $query->row();
      }else{
        return array();
      }
    }else{
      $query = $this->db->query("SELECT st_name,st_code,pos_name,dep_name,st_hired_date,st_validity,img
                                  FROM tbl_staf s
                                  LEFT JOIN tbl_position p ON s.`pos_id`=p.`pos_id`
                                  LEFT JOIN tbl_department d ON s.`dep_id`=d.`dep_id`");
      if($query->num_rows()>0)
      {
        return $query->result();
      }else{
        return array();
      }
    }
  }

}

/* End of file print_m.php */
/* Location: ./application/models/print_m.php */
