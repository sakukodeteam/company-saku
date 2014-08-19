<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Sets the variable $head to use the slice head (/views/slices/head.php)
		$this->stencil->slice('head');
		//Sets the variable $head to use the slice header (/views/slices/header.php)
		$this->stencil->slice('header');
		//Sets the variable $head to use the slice bottom (/views/slices/bottom.php)
		$this->stencil->slice('bottom');
	}

	public function index()
	{
		//set title variable
		$this->stencil->title('404');
		//set the layout to be default
		$this->stencil->layout('default');
		//render error_view to template (/views/pages/error_view.php)
		$this->stencil->paint('error_view');
	}

}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */