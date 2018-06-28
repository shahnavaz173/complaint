<?php
defined('BASEPATH') OR exit('No Direct Script Access Allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ComplaintModel');
		$this->load->model('LoginModel');
	}
	public function view($page = 'adminhome')
	{
		if(!file_exists(APPPATH.'views/admin/'.$page.'.php'))
		{
			show_404();
		}

		//check login or not
		if($this->session->userdata('admin_id'))
			$data['islogin'] = TRUE;
		else
			$data['islogin'] = FALSE;

		if($page == 'login')
		{

			if($this->session->userdata('check_login') )
				$data['logincheck'] = TRUE;
			else
				$data['logincheck'] = FALSE;
		}
		else if($page == 'adminhome' || $page == 'worker' || $page == 'category')
		{
			$data['complain_caategory'] = $this->ComplaintModel->get_complaint_category();
		}
		else if($page == 'print')
		{
			$data['printc'] = $this->session->userdata('printc');
			$data['printcomplaint'] = $this->ComplaintModel->get_complaint_details_by_cid($data['printc']['c_id']);
		}
		else if($page == 'reports')
		{
			$data['categories'] = $this->ComplaintModel->get_complaint_category();
		}
		$data['title'] = ucfirst($page);
		$data['viewuser'] = 'admin';

		$this->load->view('public/header',$data);
		$this->load->view('admin/'.$page,$data);
	}
	public function get_complaint_for_home()
	{
		$old = $this->ComplaintModel->get_old_complaint_list_cat(4,'all');
		$new = $this->ComplaintModel->get_new_complaint_list_cat(4,'all');
		return array_merge($old,$new);
	}
	public function get_complaint_list()
	{
		$cate = $this->input->post('id');
		$old = $this->ComplaintModel->get_old_complaint_list_cat(4,$cate);
		$new = $this->ComplaintModel->get_new_complaint_list_cat(4,$cate);
		echo json_encode(array_merge($old,$new));
	}
}
?>
