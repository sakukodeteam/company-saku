<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @property Example $example
 * @author rizqi <rizqimaulana88@gmail.com>
 */
class Adm extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
	}

	public function index()
	{
		//Sets the variable $head to use the slice head (/views/slices/head.php)
		$this->stencil->slice('head_admin');
		//Sets the variable $head to use the slice header (/views/slices/header.php)
		$this->stencil->slice('header_admin');
		//Sets the variable $head to use the slice bottom (/views/slices/bottom.php)
		$this->stencil->slice('sidebar_admin');

		$this->stencil->title('Empty Page');
		$this->stencil->layout('admin_layout');
		$this->stencil->paint('adm/empty_view');
	}

	public function login()
	{
		//Sets the variable $head to use the slice head (/views/slices/head.php)
		$this->stencil->slice('head_admin');
		//Sets the variable $head to use the slice bottom (/views/slices/bottom.php)
		$this->stencil->slice('sidebar_admin');

		$this->stencil->title('Login Page');
		$this->stencil->layout('login_layout');
		$this->stencil->paint('adm/login_view');
	}


}

