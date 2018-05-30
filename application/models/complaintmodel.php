<?php
defined('BASEPATH')OR exit("No Direct Script Access Allowed");
class ComplaintModel extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
  public function complaint_list()
  {
    $this->db->select(array('complaint_register.c_id','complaint_location.location','complaint_register.c_date','complaint_register.s_date','complaint_register.c_status','complaint_register.c_description','category.category','category.cate_id','complaint_register.u_id','complaint_register.w_id','user.full_name','worker.w_name','worker.ph_no'));
    $this->db->from('complaint_register');
    $this->db->join('user','complaint_register.u_id = user.u_id','INNER');
    $this->db->join('category','complaint_register.cate_id = category.cate_id','LEFT');
    $this->db->join('complaint_location','complaint_location.c_id = complaint_register.c_id');
    $this->db->join('worker','complaint_register.w_id = worker.w_id','LEFT');
  }
  public function get_old_complaint_list_cat($interval,$category)
  {
        $this->complaint_list();
        if($category == 'all')
          $this->db->where('complaint_register.c_date <= DATE_ADD(CURDATE(),INTERVAL - '.$interval.' DAY)');
        else
          $this->db->where('complaint_register.c_date <= DATE_ADD(CURDATE(),INTERVAL - '.$interval.' DAY)AND category.cate_id = '.$category);
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
        $this->db->where('complaint_register.c_date > DATE_ADD(CURDATE(),INTERVAL - '.$interval.' DAY)AND category.cate_id = '.$category);
      $this->db->order_by('complaint_register.c_date');
      $q = $this->db->get();

      $news = $q->result();
      foreach ($news as $new)
      {
        $new->flag = '1';
      }
      return $news;
    }
    public function get_complaints_by_user($uid)
    {
      $this->complaint_list();
      $this->db->where('user.u_id',$uid);
      $q = $this->db->get();
      return $q->result();
    }
    public function get_complaints_by_address($uid)
    {
      $this->db->select(array('user.address','user_dept.office_location'));
      $this->db->from('user');
      $this->db->join('user_dept','user.u_id = user_dept.u_id','LEFT');
      $this->db->where('user.u_id',$uid);
      $add = $this->db->get();
      $add_result = $add->result();
      $address = $add_result[0]->address;
      $office = $add_result[0]->office_location;
      $this->complaint_list();
      $this->db->like('complaint_location.location',$address);
      $this->db->or_like('complaint_location.location',$office);
      $res = $this->db->get();
      return $res->result();
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
  public function get_category_description($cid,$level)
  {
    $this->db->select('description');
    $this->db->from('complaint');
    $this->db->where('cate_id',$cid);
    if($level == 2)
      $this->db->where('c_level!=',$level);
    $q = $this->db->get();
    return $q->result();
  }
  public function register_complaint($cinfo,$location)
  {
    $cid = $this->generate_complaint_id($cinfo['u_id']);
    $cinfo = array_merge(array('c_id' => $cid),$cinfo);
    echo "<pre>";
    print_r($cinfo);
    echo "</pre>";
    $this->db->insert('complaint_register',$cinfo);
    $this->db->insert('complaint_location',array('c_id' => $cid, 'location' => $location));
    $this->session->set_userdata('registered_complaint',$cid);
  }
  public function generate_complaint_id($uid)
  {
    $this->db->select('complaint_register.c_id');
    $this->db->from('complaint_register');
    $this->db->join('complaint_location','complaint_location.c_id = complaint_register.c_id','INNER');
    $this->db->order_by('complaint_location.loc_id','DESC');
    $this->db->limit(1);
    $q = $this->db->get();
    $last = $q->result();
    $today = date('Ymd-');
    $user = substr($uid,-3);
    if(sizeof($last) == 0)
    {
      return $today."".$user."-0001";
    }
    else
    {
      $last_cid = substr($last[0]->c_id,14);
      $last_cid = intval($last_cid)+1;
      if($last_cid <= 9)
        $last_cid = "000".$last_cid;
      else if($last_cid <= 99)
        $last_cid = "00".$last_cid;
      else if($last_cid <= 999)
        $last_cid = "0".$last_cid;

      return $today."".$user."-".$last_cid;
    }
  }
  public function track_complaint($cid)
  {
    $this->complaint_list();
    $this->db->where('complaint_register.c_id',$cid);
    $q = $this->db->get();
    return $q->result();
  }
  public function get_common_complaints($id)
  {
    $this->db->select(array('category.category','complaint.c_level','complaint.description'));
    $this->db->from('complaint');
    $this->db->join('category','category.cate_id = complaint.cate_id');
    if($id != 'all')
      $this->db->where('category.cate_id',$id);
    $q = $this->db->get();
    return $q->result();
  }
  public function update_complaint_status($status,$cid)
  {
    $this->db->select(array('c_date','f_status'));
    $this->db->from('complaint_register');
    $this->db->where('c_id',$cid);
    $q = $this->db->get();
    $q = $q->result();
    $today = date('Y-m-d');
    if($status == 'Complete')
    {
      if($q[0]->f_status == FALSE)
        $this->db->set(array('c_status' => $status, 's_date' => $today, 'f_available' => TRUE));
      else
        $this->db->set(array('c_status' => $status, 's_date' => $today));
    }

    else
      $this->db->set(array('c_status' => $status,  's_date' => NULL, 'solution_duration' => NULL));
    $this->db->where('c_id',$cid);
    $this->db->update('complaint_register');
    return TRUE;
  }
  public function get_pending_feedback($uid)
  {
    $where = array('u_id' => $uid, 'f_available' => TRUE, 'f_status' => FALSE);
    $this->db->select('c_id');
    $this->db->from('complaint_register');
    $this->db->where($where);
    $q = $this->db->get();
    return $q->result();
  }
  public function get_complaint_by_cid($cid)
  {
    $this->db->select(array('c_id','c_description'));
    $this->db->from('complaint_register');
    $this->db->where('c_id',$cid);
    $q = $this->db->get();
    return $q->result();
  }
  public function submit_feedback($rating,$cid)
  {
    $today = date('Y-m-d');
    $this->db->set(array('f_date' => $today,'satisfaction_level' => $rating, 'f_status' => TRUE, 'f_available' => FALSE));
    $this->db->where('c_id',$cid);
    $this->db->update('complaint_register');
    redirect(base_url('home'));
  }
}
?>
