<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portofolio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//load models
		$this->load->model('portofolio_m');
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
		$this->stencil->title('Portofolio');
		//set metadata
		$this->stencil->meta(array(
            'author' => 'Sakukode Team',
            'description' => 'kumpulan Portofolio yang sudah kami kerjakan,baik aplikasi,web maupun desain web',
            'keywords' => 'sakukode,web,portofolio,freelancer'
        ));
		//set the layout to be default
		$this->stencil->layout('default');
		//get data from model
		$data['portofolios']	= $this->portofolio_m->get_all();
		//render about_view to template (/views/pages/portofolio_view.php)
		$this->stencil->paint('portofolio_view',$data);
	}

}

/* End of file portofolio.php */
/* Location: ./application/controllers/portofolio.php */