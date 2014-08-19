<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog_article_m extends MY_Model {

	public $primary_key = 'article_id';
	protected $soft_delete = TRUE;

	public $belongs_to = array( 'blog_categories'=>array('model'=>'blog_category_m','primary_key'=>'category_id'),'users'=>array('model'=>'user_m','primary_key'=>'author_id') );

	public $has_many = array( 'blog_comments' => array( 'model' => 'blog_comment_m','primary_key'=>'article_id') );

	public function total_percategory($category_id)
	{
		$query = $this->db->get_where('blog_articles',array('category_id'=>$category_id));

		if($query->num_rows() > 0)
		{
			return $query->num_rows();
		}
		else
		{
			return NULL;
		}
	}

	public function add_article($filename)
	{
		$title 			= ucwords($this->input->post('title'));
		$slug 			= strtolower(url_title($title));
		$category_id 	= $this->input->post('category');
		$keyword		= $this->input->post('keyword');
		$status 		= $this->input->post('status');
		$content		= $this->input->post('content');

		$data = array(
			'article_id'		=> NULL,
			'article_title'		=> strip_tags($title,ENT_QUOTES),
			'article_url'		=> strip_tags($slug,ENT_QUOTES),
			'keyword'			=> strip_tags($keyword,ENT_QUOTES),
			'content'			=> htmlspecialchars($content,ENT_QUOTES,"UTF-8"),
			'author_id'			=> $this->tank_auth->get_user_id(),
			'status'			=> strip_tags($status,ENT_QUOTES),
			'category_id'		=> strip_tags($category_id,ENT_QUOTES),
			'picture'			=> strip_tags($filename,ENT_QUOTES)
		);

		$this->insert($data);
	}
	
	public function update_article($id)
	{
		$title 			= ucwords($this->input->post('title'));
		$slug 			= strtolower(url_title($title));
		$category_id 	= $this->input->post('category');
		$keyword		= $this->input->post('keyword');
		$status 		= $this->input->post('status');
		$content		= $this->input->post('content');

		$data = array(
			'article_title'		=> strip_tags($title,ENT_QUOTES),
			'article_url'		=> strip_tags($slug,ENT_QUOTES),
			'keyword'			=> strip_tags($keyword,ENT_QUOTES),
			'content'			=> htmlspecialchars($content,ENT_QUOTES,"UTF-8"),
			'author_id'			=> $this->tank_auth->get_user_id(),
			'status'			=> strip_tags($status,ENT_QUOTES),
			'category_id'		=> strip_tags($category_id,ENT_QUOTES)
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

/* End of file blog_article_m.php */
/* Location: ./application/models/blog_article_m.php */