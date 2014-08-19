<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//load models
		$this->load->model('service_m');
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
		$this->stencil->title('Layanan');
		//set metadata
		$this->stencil->meta(array(
            'author' => 'Sakukode Team',
            'description' => 'beberapa layanan jasa yang Kami tawarkan untuk Anda antara lain pembuatan web,desain web,manajemen konten web serta seo&promosi',
            'keywords' => 'sakukode,web,services,freelancer'
        ));
		//set the layout to be default
		$this->stencil->layout('default');
		//get data from model
		$data['services']	= $this->service_m->get_all();
		//render about_view to template (/views/pages/service_view.php)
		$this->stencil->paint('service_view',$data);
	}

}

/* End of file service.php */
/* Location: ./application/controllers/service.php */