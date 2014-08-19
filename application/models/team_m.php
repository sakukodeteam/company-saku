<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team_m extends MY_Model {

	public $primary_key = 'team_id';
	protected $soft_delete = TRUE;

	public function add_team($filename)
	{
		$fname 		= $this->input->post('fname');
		$lname 		= $this->input->post('lname');
		$email 		= $this->input->post('email');
		$job   		= $this->input->post('job');
		$fb    		= $this->input->post('fb');
		$twitter 	= $this->input->post('twitter');
		$desc		= $this->input->post('desc');

		$data = array(
			'team_id'			=> NULL,
			'firstname'			=> strip_tags($fname,ENT_QUOTES),
			'lastname'			=> strip_tags($lname,ENT_QUOTES),
			'email'				=> strip_tags($email,ENT_QUOTES),
			'job'				=> strip_tags($job,ENT_QUOTES),
			'fb_account'		=> strip_tags($fb,ENT_QUOTES),
			'twitter_account'	=> strip_tags($twitter,ENT_QUOTES),
			'picture'			=> $filename,
			'description'		=> htmlentities($desc,ENT_QUOTES,"UTF-8")
		);

		$this->insert($data);
	}
	
	public function update_team($id)
	{
		$fname 		= $this->input->post('fname');
		$lname 		= $this->input->post('lname');
		$email 		= $this->input->post('email');
		$job   		= $this->input->post('job');
		$fb    		= $this->input->post('fb');
		$twitter 	= $this->input->post('twitter');
		$desc		= $this->input->post('desc');

		$data = array(
			'firstname'			=> strip_tags($fname,ENT_QUOTES),
			'lastname'			=> strip_tags($lname,ENT_QUOTES),
			'email'				=> strip_tags($email,ENT_QUOTES),
			'job'				=> strip_tags($job,ENT_QUOTES),
			'fb_account'		=> strip_tags($fb,ENT_QUOTES),
			'twitter_account'	=> strip_tags($twitter,ENT_QUOTES),
			'description'		=> htmlentities($desc,ENT_QUOTES,"UTF-8")
		);

		$this->update($id,$data);
	}

	public function update_picture($id,$file,$path)
	{
		$data = array(
			'picture' => $file
		);

		$this->update($id,$data);
		@unlink($path);
	}
}

/* End of file team_m.php */
/* Location: ./application/models/team_m.php */