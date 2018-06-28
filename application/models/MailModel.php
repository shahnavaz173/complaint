<?php
class Mailmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function mail_config()
	{
		$config['protocol']     = 'smtp';
		$config['smtp_host']    = 'ssl://smtp.googlemail.com';
		$config['smtp_user'] 	= 'shahnavz73@gmail.com';
		$config['smtp_pass'] 	= 'Vf2fh2nt9';
		$config['smtp_port']    = 465;
		$config['wordwrap']     = TRUE;
		$config['mailtype']     = 'html';
		$config['validate']     = FALSE;
		return $config;
	}
	public function send($data)
	{
		$config = $this->mail_config();
		$this->load->library('email',$config);
		$this->email->set_newline("\r\n");
		$this->email->from($config['smtp_user']);
		$this->email->to($data['to']);
		$this->email->subject($data['subject']);
		$this->email->message($data['message']);
		return $this->email->send();

	}
}
?>
