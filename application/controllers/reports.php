<?php
defined('BASEPATH') OR exit('No Direct Script Access Allowed');
class Reports extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ComplaintModel','cm');
  }
  public function get_complaint_report()
  {
    $data = json_decode($this->input->post('data'));
    echo json_encode($this->cm->get_complaint_report($data));
  }

  public function get_worker_report()
  {
    $data = json_decode($this->input->post('data'));
    echo json_encode($this->cm->get_worker_report($data));
  }
}
?>
