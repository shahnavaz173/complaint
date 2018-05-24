<?php
defined('BASEPATH') OR exit("NO Direct Script Access Allowed");
class Site extends CI_Controller
{
	public function view($page = 'home')
	{
		if(!file_exists(APPPATH.'views/public/'.$page.'.php'))
		{
			show_404();
		}
		if($this->session->userdata('user_id'))
		{
			$data['islogin'] = TRUE;
		}
		else
		{
			$data['islogin'] = FALSE;
		}
		if($page == 'register')
		{
			$this->load->model('User');
			$data['departments']=$this->User->get_department();
		}
		else if($page == 'login')
		{
			if($this->session->userdata('user_id'))
				$page = 'home';
			else if($this->session->userdata('admin_id'))
				redirect(base_url('admin'));

			$data['logincheck'] = FALSE;
			if($this->session->userdata('check_login') == TRUE )
				$data['logincheck'] = TRUE;
		}
		else if( $page == 'complaintregister')
		{
			$this->load->model('ComplaintModel');
			$data['complain_caategory'] = $this->ComplaintModel->get_complaint_category();
		}

		$data['title']=ucfirst($page);
		$data['viewuser'] = 'public';
		//$data['islogin'] = false;
		$this->load->view('public/header',$data);
		$this->load->view('public/'.$page,$data);
		$this->load->view('public/footer',$data);
		if($this->session->userdata('check_login'))
			$this->session->unset_userdata('check_login');
	}

}
?>
