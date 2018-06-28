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
			$data['uinfo'] = $this->User->get_user($data['uid']);
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
			else if($this->session->userdata('w_id'))
				redirect(base_url('worker'));

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
			}
			else
				$data['cdetails'] = FALSE;
		}
		else if($page == 'complaints')
		{
			$data['ucomplaints'] = $this->cm->get_complaints_by_user($this->session->userdata('user_id'));
			$data['chartdata'] = $this->cm->count_by_status($this->session->userdata('user_id'));
		}
		else if($page == 'userprofile')
		{
			$data['udetails'] = $this->User->get_user_detail($this->session->userdata('user_id'));
			$data['departments']=$this->User->get_department();
		}
		else if($page == 'complaintsuccess')
		{
			$data['registered_complaint'] = $this->session->userdata('registered_complaint');
		}
		else if($page == 'feedback')
			$data['fcomplaints'] = $this->cm->get_pending_feedback($this->session->userdata('user_id'));
		$data['title']=ucfirst($page);
		$data['viewuser'] = 'public';
		//$data['islogin'] = false;
		$this->load->view('public/header',$data);
		$this->load->view('public/'.$page,$data);
		$this->load->view('public/footer',$data);
		if($this->session->userdata('check_login'))
			$this->session->unset_userdata('check_login');
	}
	public function update_profile()
	{

		$userid =$this->session->userdata('user_id');
		$user_data=array(
							'u_id'=> $this->input->post('empnumber'),
							'full_name' => $this->input->post('fullname'),
							'emp_no' => $this->input->post('empnumber'),
							'email' => $this->input->post('email'),
							'ph_no' => $this->input->post('contact'),
							'address' => $this->input->post('address'),
							'u_type' => $this->input->post('usertype'),
							'gender'=>$this->input->post('gender'));
					$dept_data = array(
						'u_id' => $this->input->post('empnumber'),
						'deptid' => $this->input->post('department'),
						'office_location' => $this->input->post('oaddress'));
					$this->User->update_user_detail($userid,$user_data,$dept_data);
					  redirect(base_url('userprofile'));
					//$this->session->set_userdata('user_id',$this->input->post('empnumber'));
					//$this->session->set_userdata('usertype',$this->input->post('usertype'));
	}
	public function get_user()
	{
		$uid = $this->input->post('uid');
		echo json_encode($this->User->get_user($uid));
	}
}
?>
