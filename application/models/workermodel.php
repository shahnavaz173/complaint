<?php
defined('BASEPATH')OR exit("No Direct Script Access Allowed");
class WorkerModel extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
  public function change_status($w_id)
  {
    $this->db->select('w_status');
    $this->db->from('worker');
    $this->db->where('w_id',$w_id);
    $worker = $this->db->get();
    $wresult = $worker->result();
    if($wresult[0]->w_status == 'Active')
    {
      $this->db->set('w_status','Not Active');
      $this->db->where('w_id',$w_id);
      $this->db->update('worker');
      return "Not Active";
    }
    else
    {
        $this->db->set('w_status','Active');
        $this->db->where('w_id',$w_id);
        $this->db->update('worker');
        return "Active";
    }
  }
  public function update_worker($data)
  {
    $this->db->set($data);
    $this->db->where('w_id',$data['w_id']);
    $this->db->update('worker');
    return 'success';
  }
  public function delete_worker($wid)
  {
    $this->db->where('w_id',$wid);
    $this->db->delete('worker');
    return 'success';
  }
  public function add_worker($data)
  {
    $table = 'worker';
    $this->db->insert($table,$data);
    return TRUE;
  }
}
?>
