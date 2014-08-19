<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aboutus extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//load models
		$this->load->model('team_m');
		//Sets the variable $head to use the slice head (/views/slices/head.php)
		$this->stencil->slice('head');
		//Sets the variable $head to use the slice header (/views/slices/header.php)
		$this->stencil->slice('header');
		//Sets the variable $head to use the slice bottom (/views/slices/bottom.php)
		$this->stencil->slice('bottom');
	}

	public function index()
	{
		//set the variable $title into view
		$this->stencil->title('Tentang Kami');
		//set metadata
		$this->stencil->meta(array(
            'author' => 'Sakukode Team',
            'description' => 'Sakukode adalah freelancer yang bergerak di bidang jasa pembuatan dan
             pengelolaan web',
            'keywords' => 'sakukode,web,freelance'
        ));
		//set the layout to be default
		$this->stencil->layout('default');
		//get data from model
		$data['teams']	= $this->team_m->get_all();
		//render about_view to template (/views/pages/about_view.php)
		$this->stencil->paint('about_view',$data);
	}

}

/* End of file aboutus.php */
/* Location: ./application/controllers/aboutus.php */