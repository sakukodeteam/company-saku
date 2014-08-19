<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_m extends MY_Model {

	public $primary_key = 'message_id';
	protected $soft_delete = TRUE;

	public function send()
	{
		//get value from post
		$name 		= $this->input->post('name');
		$email		= $this->input->post('email');
		$url		= $this->input->post('url');
		$message 	= $this->input->post('message');
		//prepare quries
		$data = array(
			'message_id' => NULL,
			'name'		=> strip_tags($name,ENT_QUOTES),
			'email'		=> strip_tags($email,ENT_QUOTES),
			'url'		=> strip_tags($url,ENT_QUOTES),
			'message'	=> strip_tags($message,ENT_QUOTES)
		);

		$result = $this->insert($data);
		if(empty($result))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

}

/* End of file message_m.php */
/* Location: ./application/models/message_m.php */