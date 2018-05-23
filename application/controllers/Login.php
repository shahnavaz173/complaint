<?php
defined('BASEPATH') OR exit('No Direct Script Access Allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ComplaintModel');
			$this->load->model('LoginModel');
	}
	public function validate_login()
	{
    $utype=$this->input->post('usertype');
		$logindata = array('email' => $this->input->post('email'), 'password' => $this->input->post('password'));
    if($utype=='admin')
    {
      $login_id = $this->LoginModel->admin_login($logindata);

      if($login_id)
  		{
  				$this->session->set_userdata('check_login',FALSE);
  				$this->session->set_userdata('admin_id',$login_id);
  				redirect(base_url('admin/adminhome'));
  		}
  		else
  		{
  			$this->session->set_userdata('check_login',TRUE);
  			redirect(base_url('login'));
  		}
    }
    else if($utype == 'employee' || $utype == 'recident' || $utype == 'student')
    {
      $login_id = $this->LoginModel->user_login($logindata);

      if($login_id)
  		{
  				$this->session->set_userdata('check_login',FALSE);
  				$this->session->set_userdata('user_id',$login_id);
  				redirect(base_url('home'));
  		}
  		else
  		{
  			$this->session->set_userdata('check_login',TRUE);
  			redirect(base_url('login'));
  		}
    }
  }
	public function logout()
	{
    if($this->session->userdata('user_id') )
    {
			$this->session->unset_userdata('user_id');
    }
		else
    {
      $this->session->unset_userdata('admin_id');
    }
		redirect(base_url('login'));
	}
	public function get_complaint_list()
	{
		$cate = $this->input->post('id');
		$old = $this->ComplaintModel->get_old_complaint_list_cat(5,$cate);
		$new = $this->ComplaintModel->get_new_complaint_list_cat(5,$cate);
		echo json_encode(array_merge($old,$new));
	}
}
?>
