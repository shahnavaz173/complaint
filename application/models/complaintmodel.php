<?php
defined('BASEPATH')OR exit("No Direct Script Access Allowed");
class ComplaintModel extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/kolkata');
    $this->load->helper('date');

    $this->load->model('MailModel','mymail');
  }
  public function complaint_list()
  {
    $this->db->select(array('complaint_register.c_id','complaint_location.location','complaint_register.c_date','complaint_register.s_date','complaint_register.c_status','complaint_register.c_description','category.category','category.cate_id','complaint_register.u_id','complaint_register.w_id','user.full_name','user.pho_no','user.user_photo','worker.w_name','worker.ph_no','Dept_Name'));
    $this->db->from('complaint_register');
    $this->db->join('user','complaint_register.u_id = user.u_id','INNER');
    $this->db->join('user_dept','user.u_id = user_dept.u_id');
    $this->db->join('deptmst','user_dept.deptid = deptmst.deptid');
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
    if($cate_id == 'all' )
      $q = $this->db->query("SELECT * FROM worker INNER JOIN category ON worker.skill=category.cate_id");
    elseif ($cate_id == 0)
        $q = $this->db->query("SELECT * FROM worker");
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
  public function assign_worker($wid,$cid,$remark)
  {
    $data = array('c_status' => 2,'w_id' => $wid);
    $this->db->set($data);
    $this->db->where('c_id',$cid);
    $this->db->update('complaint_register');
    $data = array('c_id' => $cid,'w_id' => $wid,'comment' => $remark);
    $this->db->insert('remark',$data);
    $this->session->set_userdata('printc',$data);
    $this->send_assign_mail(array('w_id' => $wid, 'c_id' =>$cid,'mailfor' => 'assign'));
    redirect(base_url('admin/print'));
  }
  public function send_assign_mail($data)
  {
    $this->db->select(array('user.full_name','user.email','complaint_register.c_date','complaint_register.c_description','complaint_location.location','worker.w_name','worker.ph_no'));
    $this->db->from('user');
    $this->db->join('complaint_register','user.u_id = complaint_register.u_id');
    $this->db->join('complaint_location','complaint_register.c_id = complaint_location.c_id');
    $this->db->join('worker','complaint_register.w_id = worker.w_id');
    $this->db->where('complaint_register.c_id',$data['c_id']);
    $user = $this->db->get()->result();

    $this->db->select(array('user.pho_no','worker.email','remark.comment'));
    $this->db->from('user');
    $this->db->join('complaint_register','complaint_register.u_id = user.u_id');
    $this->db->join('worker','complaint_register.w_id = worker.w_id');
    $this->db->join('remark','complaint_register.c_id = remark.c_id');
    $this->db->where('remark.c_id',$data['c_id']);
    $this->db->where('remark.w_id',$data['w_id']);
    $worker = $this->db->get()->result();


    $data['to'] = $user[0]->email;
    $data['subject'] = "Your Complaint at Estate Department";
    $dataw['to'] = $worker[0]->email;
    switch($data['mailfor'])
    {
      case 'assign':
      $data['message'] ="<b>Hellow ".$user[0]->full_name.",</b><br /> Your Complaint For ".$user[0]->c_description." at ".$user[0]->location."<br /> Registered on ".$user[0]->c_date." <br /> Assigned to Worker: ".$user[0]->w_name."<br /> His/her Phone Number is: ".$user[0]->ph_no;
      $dataw['message'] ="<b>Hellow ".$user[0]->w_name."</b><br /> New Complaint Assigned to you.<br /> ".$user[0]->c_description." at ".$user[0]->location."<br /> Registered on ".$user[0]->c_date." <br />Complaint Registered By: ".$user[0]->full_name."<br /> His Phone Number is: ".$worker[0]->pho_no."<br /><b>Remarkfor you: ".$worker[0]->comment."</b>";
      $dataw['subject'] = "Estate Department New Complaint Assigned to you";
      break;
      case 'closed':

      break;
    }
    $this->mymail->send($data);
    $this->mymail->send($dataw);

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
  public function generate_complaint_id()
  {
    $today=date('Y-m-d');
    echo $today;
    $this->db->select('*');
    $this->db->from('complaint_register');
    $this->db->join('complaint_location','complaint_location.c_id = complaint_register.c_id','INNER');
    $this->db->where('complaint_register.c_date',$today);
    $this->db->order_by('complaint_location.loc_id','DESC');
    $this->db->limit(1);
    $q=$this->db->get();
    $q=$q->result();
  //  print_r($q->result());
    if(sizeof($q)<=0)
    {
      $cid=$today."-001";
    }
    else
    {
      $last_cid=$q[0]->c_id;
      $last_cid=intval(substr($last_cid,-3))+1;
      if($last_cid <= 9)
        $last_cid = "00".$last_cid;
      else if($last_cid <= 99)
        $last_cid = "0".$last_cid;
      $cid=$today."-".$last_cid;

    }
    return $cid;
    /*$this->db->select('complaint_register.c_id');
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
    }*/

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
    $this->db->select(array('complaint.co_id','category.category','complaint.c_level','complaint.description'));
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
    if($status == 4 || $status == 5)
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

    $this->send_status_mail(array('c_id' => $cid,'c_status' => $status));
    return TRUE;
  }
  public function send_status_mail($data)
  {

    $this->db->select(array('user.full_name','user.email','complaint_register.c_date','complaint_register.c_description','complaint_location.location'));
    $this->db->from('user');
    $this->db->join('complaint_register','user.u_id = complaint_register.u_id');
    $this->db->join('complaint_location','complaint_register.c_id = complaint_location.c_id');
    $this->db->where('complaint_register.c_id',$data['c_id']);
    $user = $this->db->get()->result();
    $maildata['to'] = $user[0]->email;
    $maildata['subject'] = "Your Complaint at Estate Department";
    switch($data['c_status'])
    {
      case 3:
        $maildata['message'] ="<b>Hellow ".$user[0]->full_name.",</b><br /> Your Complaint For ".$user[0]->c_description." at ".$user[0]->location."<br /> Registered on ".$user[0]->c_date." <br /> Is Under Construction. <br> Your Problem Will be Repaired soon.";
      break;
      case 4:
        $maildata['message'] ="<b>Hellow ".$user[0]->full_name.",</b><br /> Your Complaint For ".$user[0]->c_description." at ".$user[0]->location."<br /> Registered on ".$user[0]->c_date." <br /> Is Closed But Not Repaired Because of some reason.";
      break;
      case 5:
        $maildata['message'] ="<b>Hellow ".$user[0]->full_name.",</b><br /> Your Complaint For ".$user[0]->c_description." at ".$user[0]->location."<br /> Registered on ".$user[0]->c_date." <br /> Is Closed And Repaired.";
      break;
      case 0:
        $maildata['message'] ="<b>Hellow ".$user[0]->full_name.",</b><br /> Your Complaint For ".$user[0]->c_description." at ".$user[0]->location."<br /> Registered on ".$user[0]->c_date." <br /> Is Rejected Because of some reason.";
      break;

    }
    $this->mymail->send($maildata);

  }
  public function get_pending_feedback($uid)
  {
    $where = array('u_id' => $uid, 'f_available' => TRUE, 'f_status' => FALSE);
    $this->db->select(array('c_id','c_description'));
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
  public function get_complaint_details_by_cid($cid)
  {
    $this->complaint_list();
    $this->db->where('complaint_register.c_id',$cid);
    return $this->db->get()->result();
  }
  public function submit_feedback($rating,$cid)
  {
    $today = date('Y-m-d');
    for($i=1;$i<=sizeof($cid);$i++)
    {
      $this->db->set(array('f_date' => $today,'satisfaction_level' => $rating[$i], 'f_status' => TRUE, 'f_available' => FALSE));
      $this->db->where('c_id',$cid[$i]);
      $this->db->update('complaint_register');
    }
    $this->session->unset_userdata('pending_feedback');
    redirect(base_url('home'));
  }
  public function add_new_category($category)
  {
      $this->db->insert('category',$category);
  }
  public function add_new_common_complaint($cinfo)
  {
      $this->db->insert('complaint',$cinfo);
  }
  public function delete_common_complaint($co_id)
  {
    $this->db->where('co_id',$co_id);
    $this->db->delete('complaint');
    return TRUE;
  }
  public function get_complaints_for_worker($wid)
  {
    $this->complaint_list();
    $this->db->where('complaint_register.w_id',$wid);
    $q = $this->db->get();
    return $q->result();
  }
  public function count_by_status($uid)
  {
    $this->db->select('c_id');
    $this->db->from('complaint_register');
    $this->db->where('u_id',$uid);
    $this->db->where('c_status',0);
    $q = $this->db->get();
    $count['Rejected'] = $q->num_rows();

    $this->db->select('c_id');
    $this->db->from('complaint_register');
    $this->db->where('u_id',$uid);
    $this->db->where('c_status',1);
    $q = $this->db->get();
    $count['Open'] = $q->num_rows();

    $this->db->select('c_id');
    $this->db->from('complaint_register');
    $this->db->where('u_id',$uid);
    $this->db->where('c_status',2);
    $q = $this->db->get();
    $count['Pending'] = $q->num_rows();

    $this->db->select('c_id');
    $this->db->from('complaint_register');
    $this->db->where('u_id',$uid);
    $this->db->where('c_status',3);
    $q = $this->db->get();
    $count['UnderObservation'] = $q->num_rows();

    $this->db->select('c_id');
    $this->db->from('complaint_register');
    $this->db->where('u_id',$uid);
    $this->db->where('c_status',4);
    $q = $this->db->get();
    $count['ClosedButNotComplete'] = $q->num_rows();

    $this->db->select('c_id');
    $this->db->from('complaint_register');
    $this->db->where('u_id',$uid);
    $this->db->where('c_status',5);
    $q = $this->db->get();
    $count['Closed'] = $q->num_rows();

    return $count;
  }
  public function get_complaint_report($data)
  {
    switch($data->duration)
    {
      case 1:
        $table = 'monthly_report';
      break;
      case 3:
        $table = 'quarterly_report';
      break;
      case 6:
        $table = 'six_monthly_report';
      break;
      case 12:
        $table = 'yearly_report';
      break;
      default:
        $table = 'complaint_register';

    }

          $this->db->select(array('c_description'));
          $this->db->from($table);
          if($data->category != 0)
            $this->db->where('cate_id',$data->category);
          if($data->duration == 2)
          {
            $this->db->where('c_date>=',$data->begin);
            $this->db->where('c_date<=',$data->end);

          }
          $this->db->group_by('c_description');
          $result = $this->db->get()->result();
          foreach($result as $r)
          {
            $r->open = $this->get_count_complaint(1,$r->c_description,$table,$data);
            $r->pending = $this->get_count_complaint(2,$r->c_description,$table,$data);
            $r->uobserv = $this->get_count_complaint(3,$r->c_description,$table,$data);
            $r->closed_not = $this->get_count_complaint(4,$r->c_description,$table,$data);
            $r->closed = $this->get_count_complaint(5,$r->c_description,$table,$data);
            $r->rejected = $this->get_count_complaint(0,$r->c_description,$table,$data);
          }
          return $result;
  }

  public function get_worker_report($data)
  {
    switch($data->duration)
    {
      case 1:
        $table = 'monthly_report';
      break;
      case 3:
        $table = 'quarterly_report';
      break;
      case 6:
        $table = 'six_monthly_report';
      break;
      case 12:
        $table = 'yearly_report';
      break;
      default:
        $table = 'complaint_register';

    }

          $this->db->select(array('c_description'));
          $this->db->from($table);
          if($data->category != 0)
            $this->db->where('cate_id',$data->category);
          $this->db->where('w_id',$data->worker);
          if($data->duration == 2)
          {
            $this->db->where('c_date>=',$data->begin);
            $this->db->where('c_date<=',$data->end);

          }
          $this->db->group_by('c_description');
          $result = $this->db->get()->result();
          foreach($result as $r)
          {
            $r->open = $this->get_count_worker_complaint(1,$r->c_description,$table,$data);
            $r->pending = $this->get_count_worker_complaint(2,$r->c_description,$table,$data);
            $r->uobserv = $this->get_count_worker_complaint(3,$r->c_description,$table,$data);
            $r->closed_not = $this->get_count_worker_complaint(4,$r->c_description,$table,$data);
            $r->closed = $this->get_count_worker_complaint(5,$r->c_description,$table,$data);
            $r->rejected = $this->get_count_worker_complaint(0,$r->c_description,$table,$data);
          }
          return $result;
  }
  public function get_count_complaint($status,$description,$table,$data)
  {
    $this->db->select(array('count(*) stat','c_description'));
    $this->db->from($table);
    if($data->category != 0)
      $this->db->where('cate_id',$data->category);

    $this->db->where('c_status',$status);
    $this->db->like('c_description',$description);
    if($data->duration == 2)
    {
      $this->db->where('c_date>=',$data->begin);
      $this->db->where('c_date<=',$data->end);

    }
    $this->db->group_by('c_description');
    $result = $this->db->get()->result();
    if(sizeof($result) <= 0)
      return 0;
    else
      return $result[0]->stat;
  }
  public function get_count_worker_complaint($status,$description,$table,$data)
  {
    $this->db->select(array('count(*) stat','c_description'));
    $this->db->from($table);
    if($data->category != 0)
      $this->db->where('cate_id',$data->category);
    $this->db->where('c_status',$status);
    $this->db->where('w_id',$data->worker);
    $this->db->like('c_description',$description);
    if($data->duration == 2)
    {
      $this->db->where('c_date>=',$data->begin);
      $this->db->where('c_date<=',$data->end);

    }
    $this->db->group_by('c_description');
    $result = $this->db->get()->result();
    if(sizeof($result) <= 0)
      return 0;
    else
      return $result[0]->stat;
  }
  public function update_common($obj)
  {
    $this->db->set(array(
      'cate_id' => $obj->category,
      'c_level' => $obj->level,
      'description' => $obj->desc
    ));
    $this->db->from('complaint');
    $this->db->where('co_id',$obj->co_id);
    if($this->db->update('complaint'))
      return TRUE;
    else
      return FALSE;
  }
}
?>
