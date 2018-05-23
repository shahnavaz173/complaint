<?php
defined('BASEPATH')OR  exit('No Direct Script Access Allowed');
class Worker extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('ComplaintModel');
    $this->load->model('WorkerModel');
  }

	public function get_worker_list()
	{
    $cate = $this->input->post('cate');
		$list = $this->ComplaintModel->get_worker_list($cate);
		echo json_encode($list);
	}
  public function get_workers()
  {
    $cate = $this->input->post('cate');
		$list = $this->ComplaintModel->get_workers($cate);
		echo json_encode($list);
  }
  public function assign_worker()
  {
    $wid = $this->input->post('selectworker');
    $cid = $this->input->post('cid');
    $this->ComplaintModel->assign_worker($wid,$cid);
  }
  public function change_status()
  {
    $id = $this->input->post('id');
    echo $this->WorkerModel->change_status($id);
  }
  public function update_worker()
  {
    $obj = json_decode($this->input->post('obj'),true);
    echo $this->WorkerModel->update_worker($obj);
  }
  public function delete_worker()
  {
    $wid = $this->input->post('id');
    echo $this->WorkerModel->delete_worker($wid);

  }

  public function add_new()
  {
    $data = array(
      'w_name' => $this->input->post('fullname'),
      'ph_no' => $this->input->post('contact'),
      'email' => $this->input->post('email'),
      'address' => $this->input->post('address'),
      'skill' => $this->input->post('workerskill'),
      'w_status' => $this->input->post('status')
    );
    if($this->WorkerModel->add_worker($data))
      redirect(base_url('admin/worker'));
  }
}
?>
