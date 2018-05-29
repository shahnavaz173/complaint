<?php
defined('BASEPATH') OR exit("NO Direct Script Access Allowed");
class Site extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User');
		$this->load->model('ComplaintModel','cm');
	}
	public function view($page = 'home')
	{
		if(!file_exists(APPPATH.'views/public/'.$page.'.php'))
		{
			show_404();
		}
		if($this->session->userdata('user_id'))
		{
			$data['uid'] = $this->session->userdata('user_id');
			$data['islogin'] = TRUE;
		}
		else
		{
			$data['islogin'] = FALSE;
		}
		if($page == 'register')
		{
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

				if($this->session->userdata('cdetails'))
				{
						$data['cdetails'] = $this->session->userdata('cdetails');
						$this->session->unset_userdata('cdetails');
				}
				else
					$data['cdetails'] = FALSE;
		}
		else if( $page == 'complaintregister')
		{
			$data['ctype'] = $this->uri->segment(2);
			$data['usertype'] = $this->session->userdata('usertype');
			$data['complain_caategory'] = $this->cm->get_complaint_category();
			$data['complaints'] = $this->cm->get_complaints_by_address($this->session->userdata('user_id'));
		}
		else if($page == 'trackcomplaint')
		{
			if($this->session->userdata('cdetails'))
			{
					$data['cdetails'] = $this->session->userdata('cdetails');
					$this->session->unset_userdata('cdetails');
			}
			else
				$data['cdetails'] = FALSE;
		}
		else if($page == 'complaints')
		{
			$data['ucomplaints'] = $this->cm->get_complaints_by_user($this->session->userdata('user_id'));
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
	public function get_user()
	{
		$uid = $this->input->post('uid');
		echo json_encode($this->User->get_user($uid));
	}
}
?>
