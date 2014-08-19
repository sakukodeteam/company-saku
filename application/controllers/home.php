<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * home page controllers
 * @author sakukode <sakukode@gmail.com>
 */
class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//load models
		$this->load->model(array('slider_m','service_m','portofolio_m'));
		//Sets the variable $head to use the slice head (/views/slices/head.php)
		$this->stencil->slice('head');
		//Sets the variable $head to use the slice header (/views/slices/header.php)
		$this->stencil->slice('header');
		//Sets the variable $head to use the slice bottom (/views/slices/bottom.php)
		$this->stencil->slice('bottom');
	}

	public function index()
	{
		//set css and js
		$this->stencil->css('sl-slide');
		$this->stencil->js('jquery.ba-cond.min');
		$this->stencil->js('jquery.slitslider');
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
		$data['sliders'] 		= $this->slider_m->get_all();
		$data['services']		= $this->service_m->get_all();
		$data['portofolios']	= $this->portofolio_m->limit(4)->get_all();
		//render about_view to template (/views/pages/about_view.php)
		$this->stencil->paint('home_view',$data);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */