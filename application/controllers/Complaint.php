<?php
defined('BASEPATH')OR exit('NO Direct Script Access Allowed');
class Complaint extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ComplaintModel');
    $this->load->model('User');
  }
  public function get_category()
  {
    $id = $this->input->post('id');
    echo json_encode($this->ComplaintModel->get_category_description($id));
  }
  public function get_user_address()
  {
    $json_obj = $this->input->post('obj');
    $obj = json_decode($json_obj);
    if( $obj->location == 'hostel' || $obj->location == 'residance')
    {
      $user = $this->User->get_user($obj->uid);
      echo $user[0]->address;
    }
    else if( $obj->location == 'department')
    {
      $office = $this->User->get_ofice_location($obj->uid);
      echo $office[0]->office_location;
    }
  }
  public function register()
  {

  }
}
 ?>
