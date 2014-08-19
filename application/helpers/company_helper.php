<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('company'))
{
	function company($key)
	{
		$CI =& get_instance();

		$query = $CI->db->select($key)->where('company_id',1)->get('companies');

		if($query->num_rows() != 1){

			return NULL;
		}else{
			$result = $query->row();

			return $result->$key;
		}
		
	}
}

if ( ! function_exists('category'))
{
	function category()
	{
		$CI =& get_instance();

		$query = $CI->db->select('category_id,category_url,category_name')
						->order_by('category_id','ASC')
						->get('blog_categories');

		if($query->num_rows() > 0 ){

			return $query->result();
		}else{
			
			return NULL;
		}
		
	}
}

if ( ! function_exists('post'))
{
	function post($limit=1)
	{
		$CI =& get_instance();

		$query = $CI->db->select('*')
						->limit($limit)
						->order_by('date','ASC')
						->get('blog_articles');

		if($query->num_rows() > 0 ){

			return $query->result();
		}else{
			
			return NULL;
		}
		
	}
}

if ( ! function_exists('total_comment'))
{
	function total_comment($id)
	{
		$CI =& get_instance();

		$query = $CI->db->get_where('blog_comments',array('article_id'=>$id,'deleted'=>0));

		if($query->num_rows > 0)
		{
			$result = $query->num_rows();
			return $result;
		}else
		{
			$result = "Tidak ada";
			return $result;
		}
		
	}
}