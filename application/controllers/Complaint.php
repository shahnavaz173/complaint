<?php
defined('BASEPATH')OR exit('NO Direct Script Access Allowed');
class Complaint extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ComplaintModel');
  }
  public function get_category()
  {
    $id = $this->input->post('id');
    echo json_encode($this->ComplaintModel->get_category_description($id));
  }
}
 ?>
