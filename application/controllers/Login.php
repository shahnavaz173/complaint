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
	  if($utype=='admin')
    {
			$logindata = array('email' => $this->input->post('email'), 'password' => $this->input->post('password'));

      $login_id = $this->LoginModel->admin_login($logindata);

      if($login_id)
  		{
  				$this->session->set_userdata('check_login',FALSE);
  				$this->session->set_userdata('admin_id',$login_id);
					$this->session->set_userdata('usertype',$utype);
  				redirect(base_url('admin/adminhome'));
  		}
  		else
  		{
  			$this->session->set_userdata('check_login',TRUE);
  			redirect(base_url('login'));
  		}
    }
		else if($utype=='worker')
		{
			$logindata = array('email' => $this->input->post('email'), 'password' => $this->input->post('password'));

      $login_id = $this->LoginModel->worker_login($logindata);

      if($login_id)
  		{
  				$this->session->set_userdata('check_login',FALSE);
  				$this->session->set_userdata('w_id',$login_id);
					$this->session->set_userdata('usertype',$utype);
  				redirect(base_url('worker/home'));
  		}
  		else
  		{
  			$this->session->set_userdata('check_login',TRUE);
  			redirect(base_url('login'));
  		}

		}
    else
    {
			$loginenrol = array('emp_no' => $this->input->post('email'), 'password' => $this->input->post('password'),'u_type' => $this->input->post('usertype'));
      $login_id = $this->LoginModel->user_login($loginenrol);
      if($login_id)
  		{
  				$this->session->set_userdata('check_login',FALSE);
  				$this->session->set_userdata('user_id',$login_id);
					$this->session->set_userdata('usertype',$utype);
					$pending_feedback = $this->ComplaintModel->get_pending_feedback($this->session->userdata('user_id'));
					if(sizeof($pending_feedback) > 0)
					{
						$this->session->set_userdata('pending_feedback',$pending_feedback);
						redirect(base_url('feedback'));
					}
					else
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
    elseif($this->session->userdata('w_id') )
    {
			$this->session->unset_userdata('w_id');
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
	public function generate_password()
	{
		$data['password'] = $this->input->post('npassword');
		$data['email'] = $this->input->post('email');
		$data['utype'] = $this->input->post('futype');
		$this->LoginModel->generate_password($data);
		redirect(base_url("login"));
	}
	public function send_otp()
	{
		$jsonobj = $this->input->post('obj');
		$data = json_decode($jsonobj,TRUE);
		$otp = $this->LoginModel->send_otp($data);
		$this->load->model('MailModel','mymail');
		$this->mymail->send($otp['maildata']);
		echo $otp['otp'];
	}
}
?>
