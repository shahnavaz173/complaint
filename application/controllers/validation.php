
<?php
defined('BASEPATH') OR exit('Direct Script Access not Allowed!');
class validation extends CI_Controller
{
  public function ValidateUniqueEmpnumber()
  {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('value','Employee number','is_unique[user.emp_no]');
      if($this->form_validation->run())
      {
        echo TRUE;
      }
      else
      {
        echo "Employee Number Should be Unique!";
      }
  }
public function ValidateUniqueEmail()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('value','Email','is_unique[user.email]');
    if($this->form_validation->run())
    {
       echo TRUE;
    }
    else
    {
      echo "Employee Number Should be Unique!";
    }
  }
  public function ValidateUniqueContact()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('value','Contact Number','is_unique[user.pho_no]');
    if($this->form_validation->run())
    {
      echo TRUE;
    }
    else
    {
      echo "Employee Number Should be Unique!";
    }
  }
  public function register()
	{
		$this->load->library('form_validation');
	   $this->form_validation->set_rules('fullname','Full Name',"required|regex_match[/^['a-zA-Z\.'\s]{6,60}$/]");
		$this->form_validation->set_rules('empnumber','Employee Number','required|numeric|min_length[3]|max_length[4]|is_unique[user.emp_no]');
		$this->form_validation->set_rules('email','E-mail','required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('contact','Contact','required|numeric|min_length[10]|max_length[10]|is_unique[user.pho_no]');
    $this->form_validation->set_rules('oaddress','Office Address','required');
		$this->form_validation->set_rules('password','Password','required|min_length[6]|max_length[14]');
		$this->form_validation->set_rules('cpassword','Confirm Password','required|min_length[6]|max_length[14]');
		if(strcmp($this->input->post('cpassword'),$this->input->post('password')) != 0)
		{
			$data['cpass']=1;
		}
		else
		{
			$data['cpass']=0;
		}
    if($this->form_validation->run())
    {

      $this->load->model('User');
      $deptname = $this->User->get_single_department($this->input->post('department'));
      $office_loc = $deptname[0]->Dept_Name." ".$this->input->post('oaddress');
      $user_data=array(
                'u_id' => $this->input->post('empnumber'),
								'full_name' => $this->input->post('fullname'),
								'emp_no' => $this->input->post('empnumber'),
								'email' => $this->input->post('email'),
								'pho_no' => $this->input->post('contact'),
								'address' => $this->input->post('address'),
								'u_type' => $this->input->post('usertype'),
                'gender'=>$this->input->post('gender'),
                'user_photo' => $this->input->post('profilephoto'),
								'password' =>$this->input->post('password'));
            $dept_data = array(
              'u_id' => $this->input->post('empnumber'),
              'deptid' => $this->input->post('department'),
              'office_location' => $office_loc);
            $this->User->register($user_data,$dept_data);
            $this->session->set_userdata('user_id',$this->input->post('empnumber'));
            $this->session->set_userdata('usertype',$this->input->post('usertype'));
            redirect(base_url('home'));
    }
 else
    {
      $this->load->model('User');
      $data['departments']=$this->User->get_department();
      $data['title']='Register';
      $data['valid']=1;
      $data['viewuser']='public';
      $data['islogin']=FALSE;
      $this->load->view('public/header',$data);
			$this->load->view('public/register');
			$this->load->view('public/footer',$data);
    }

  }
}
?>
