<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog_category_m extends MY_Model {

	public $primary_key = 'category_id';
	protected $soft_delete = TRUE;


	public function get_id($slug)
	{
		$query = $this->db->select('category_id')->where('category_url',$slug)->get('blog_categories');

		if($query->num_rows == 1)
		{
			$id = $query->row()->category_id;
			return $id;
		}else
		{
			return NULL;
		}
	}

}

/* End of file blog_category_m.php */
/* Location: ./application/models/blog_category_m.php */