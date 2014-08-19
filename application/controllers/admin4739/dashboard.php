<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->stencil->title('Dashboard');
		//load helper and library
		$this->load->helper('dateindo');
	}

	public function index()
	{
		//load model
		$this->load->model(array('blog_article_m','team_m','portofolio_m','message_m'));
		//get data from model
		$data['total_article']	 	= $this->blog_article_m->count_all();
		$data['total_portofolio']	= $this->portofolio_m->count_all();
		$data['total_team']			= $this->team_m->count_all();
		$data['total_message']		= $this->message_m->count_all();
		$this->stencil->data($data);
		$this->stencil->paint('adm/dashboard_view');
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */