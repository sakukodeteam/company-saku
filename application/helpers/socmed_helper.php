<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('personal'))
{
function socmed($key='*')
{
	$CI =& get_instance();

	$query = $CI->db->select($key)->from('socmeds')->get();

	if($query->num_rows() < 0){
		return NULL;
	}else{
		return $result = $query->result();
	}
	
}
}