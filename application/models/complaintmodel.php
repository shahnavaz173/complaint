<?php
defined('BASEPATH')OR exit("No Direct Script Access Allowed");
class ComplaintModel extends CI_Model
{
  public function complaint_list()
  {
    $this->db->select(array('complaint_register.c_id','complaint_location.location','complaint_register.c_date','complaint_register.c_status','complaint_register.c_description','category.category','category.cate_id','complaint_register.u_id','complaint_register.w_id','user.full_name','worker.w_name'));
    $this->db->from('complaint_register');
    $this->db->join('user','complaint_register.u_id = user.u_id','INNER');
    $this->db->join('complaint','complaint.co_id = complaint_register.co_id');
    $this->db->join('category','category.cate_id = complaint.cate_id');
    $this->db->join('complaint_location','complaint_location.c_id = complaint_register.c_id');
    $this->db->join('worker','complaint_register.w_id = worker.w_id','LEFT');
  }
  public function get_old_complaint_list_cat($interval,$category)
  {
        $this->complaint_list();
        if($category == 'all')
          $this->db->where('complaint_register.c_date <= DATE_ADD(CURDATE(),INTERVAL - '.$interval.' DAY)');
        else
          $this->db->where('complaint_register.c_date <= DATE_ADD(CURDATE(),INTERVAL - '.$interval.' DAY)AND complaint.cate_id = '.$category);
        $this->db->order_by('complaint_register.c_date');
        $q = $this->db->get();
        $olds = $q->result();
        foreach ($olds as $old)
        {
          $old->flag = '0';
        }
        return $olds;
  }
  public function get_new_complaint_list_cat($interval,$category)
  {
      $this->complaint_list();
      if($category == 'all')
        $this->db->where('complaint_register.c_date > DATE_ADD(CURDATE(),INTERVAL - '.$interval.' DAY)');
      else
        $this->db->where('complaint_register.c_date > DATE_ADD(CURDATE(),INTERVAL - '.$interval.' DAY)AND complaint.cate_id = '.$category);
      $this->db->order_by('complaint_register.c_date');
      $q = $this->db->get();

      $news = $q->result();
      foreach ($news as $new)
      {
        $new->flag = '1';
      }
      return $news;
    }
  public function get_complaint_category()
  {
      $this->db->select(array('cate_id','category'));
      $this->db->from('category');
      $q = $this->db->get();
      return $q->result();
  }
  public function get_worker_list($cate_id)
  {
    //$this->db->select(array('w_id','w_name'));
    //$this->db->from('worker');
    //$this->db-where('skill',$cate_id);
    //$q = $this->db->get();
    if($cate_id == 'all')
      $q = $this->db->query("SELECT * FROM worker INNER JOIN category ON worker.skill=category.cate_id");
    else
      $q = $this->db->query("SELECT * FROM worker INNER JOIN category ON worker.skill=category.cate_id WHERE worker.skill=".$cate_id);
    return $q->result();
  }
  public function get_workers($cate_id)
  {
    if($cate_id == 'all')
      $q = $this->db->query("SELECT * FROM worker INNER JOIN category ON worker.skill=category.cate_id AND w_status='Active'");
    else
      $q = $this->db->query("SELECT * FROM worker INNER JOIN category ON worker.skill=category.cate_id WHERE worker.skill=".$cate_id." AND w_status='Active' ");
    return $q->result();
  }
  public function assign_worker($wid,$cid)
  {
    $this->db->set('w_id',$wid);
    $this->db->where('c_id',$cid);
    $this->db->update('complaint_register');
    redirect(base_url('admin'));
  }
}
?>
