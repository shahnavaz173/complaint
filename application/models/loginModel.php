<?php
defined('BASEPATH')OR exit("No Direct Script Access Allowed");
class LoginModel extends CI_Model
{
  public function admin_login($data)
  {
    		$table = 'admin';
    		$q = $this->db->get_where($table,$data);
    		if($q->num_rows())
    		{
    		  return  $q->row()->a_id;
    		}
    		else
    		{
    		  return FALSE;
    		}
  	}
    public function user_login($data)
    {
       $table='user';
       $q=$this->db->get_where($table,$data);
       if($q->num_rows())
       {
         return  $q->row()->u_id;
       }
       else
       {
         return FALSE;
       }
    }
}
?>
