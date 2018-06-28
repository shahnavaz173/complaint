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
    public function user_login($dataenrol)
    {
       $table='user';
       $this->db->select('u_id');
       $this->db->from($table);
       $this->db->where("emp_no = '".$dataenrol['emp_no']."' AND password = '".$dataenrol['password']."' AND u_type = '".$dataenrol['u_type']."'");
       $this->db->or_where("email = '".$dataenrol['emp_no']."' AND password = '".$dataenrol['password']."' AND u_type = '".$dataenrol['u_type']."'");
       $q=$this->db->get();
       if($q->num_rows() == 1)
       {
         return  $q->row()->u_id;
       }
       else
       {
         return FALSE;
       }
    }
    public function worker_login($logindata)
    {
       $table='worker';
       $this->db->select('w_id');
       $this->db->from($table);
       $this->db->where($logindata);
       $q=$this->db->get();
       if($q->num_rows() == 1)
       {
         return  $q->row()->w_id;
       }
       else
       {
         return FALSE;
       }
    }
    public function generate_password($data)
    {
      switch($data['utype'])
      {
        case 'admin':
          $table = 'admin';
        break;
        case 'worker':
          $table = 'worker';
        break;
        default:
          $table = 'user';
      }
      $this->db->set(array('password' => $data['password']));
      $this->db->where('email',$data['email']);
      if($table == 'user')
        $this->db->or_where('emp_no',$data['email']);
      $this->db->update($table);
    }
    public function send_otp($data)
    {
      switch($data['utype'])
      {
        case 'admin':
          $table = 'admin';
        break;
        case 'worker':
          $table = 'worker';
        break;
        default:
          $table = 'user';
      }
      $this->db->select('email');
      $this->db->from($table);
      $this->db->where('email',$data['email']);
      $this->db->or_where('emp_no',$data['email']);
      $result = $this->db->get()->result();

  		$data['otp'] = rand(1000,9999);
      $maildata['subject'] = "Gujarat Vidyapith Estate Department Complaint, For Reset Password";
      $maildata['message'] = $data['otp']." Is your One Time Password for Reset Your Password.<br />Don't share this with  anyone.";
      $maildata['to'] =  $result[0]->email;
      $data['maildata'] = $maildata;
      return $data;
    }
}
?>
