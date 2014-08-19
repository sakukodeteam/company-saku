<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
 
class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->output->nocache();
        //load library and helper
        $this->load->library('security');
        $this->load->library('salabim');
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        //set slices head,header and sidebar
        $this->stencil->slice('head_admin');
        $this->stencil->slice('header_admin');
        $this->stencil->slice('sidebar_admin');
        //set layout admin
        $this->stencil->layout('admin_layout');
        $this->logged_in();
    }

    public function logged_in()
    {
        if(!$this->tank_auth->is_logged_in())
        {
            redirect('login');
        }
    }

    public function check_data($tb,$cond = array())
    {
    	$q = $this->db->get_where($tb,$cond);
    	
    	if($q->num_rows() > 0)
    	{
    		return FALSE;
    	}
    	else
    	{
    		return TRUE;
    	}
    }
}