<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog_comment_m extends MY_Model {

	public $primary_key = "comment_id";
	protected $soft_delete = TRUE;

	public function send($post_id)
	{
		//get value from post
		$name 		= $this->input->post('name');
		$email		= $this->input->post('email');
		$url		= $this->input->post('url');
		$comment 	= $this->input->post('comment');
		$avatar		= "visitors.jpg";
		//prepare quries
		$data = array(
			'comment_id' => NULL,
			'article_id' => strip_tags($post_id,ENT_QUOTES),
			'name'		=> strip_tags($name,ENT_QUOTES),
			'email'		=> strip_tags($email,ENT_QUOTES),
			'avatar'	=> $avatar,
			'url'		=> strip_tags($url,ENT_QUOTES),
			'content'	=> strip_tags($comment,ENT_QUOTES),
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

	public function reply($post_id,$parent_id)
	{
		//get value from post
		$name 		= $this->input->post('name2');
		$email		= $this->input->post('email2');
		$url		= $this->input->post('url2');
		$comment 	= $this->input->post('comment2');
		$avatar		= "visitors.jpg";
		//prepare quries
		$data = array(
			'comment_id' => NULL,
			'article_id' => strip_tags($post_id,ENT_QUOTES),
			'name'		=> strip_tags($name,ENT_QUOTES),
			'email'		=> strip_tags($email,ENT_QUOTES),
			'url'		=> strip_tags($url,ENT_QUOTES),
			'avatar'	=> $avatar,
			'content'	=> strip_tags($comment,ENT_QUOTES),
			'parent_id' => strip_tags($parent_id,ENT_QUOTES)
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

/* End of file blog_comment_m.php */
/* Location: ./application/models/blog_comment_m.php */