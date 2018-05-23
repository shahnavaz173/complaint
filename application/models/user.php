<?php
defined('BASEPATH')OR exit("No Direct Script Access Allowed");
class User extends CI_Model
{
    public function __construct()
    {
      parent::__construct();
    }
    public function get_department()
    {
      $this->db->select(array('Dept_Name','deptid'));
      $this->db->from('deptmst');
      $r=$this->db->get();
      return $r->result();
    }

}
 ?>
