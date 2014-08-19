<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @property Example $example
 * @author rizqi <rizqimaulana88@gmail.com>
 */
class Example extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
	}

	public function index()
	{
		//Sets the variable $head to use the slice head (/views/slices/head.php)
		$this->stencil->slice('head');
		//Sets the variable $head to use the slice header (/views/slices/header.php)
		$this->stencil->slice('header');
		//Sets the variable $head to use the slice bottom (/views/slices/bottom.php)
		$this->stencil->slice('bottom');
		//set the variable $title into view
		$this->stencil->title('About Us');
		//set metadata
		$this->stencil->meta(array(
            'author' => 'Sakukode Team',
            'description' => 'Sakukode adalah freelancer yang bergerak di bidang jasa pembuatan dan
            pengelolaan web',
            'keywords' => 'sakukode,web,freelance'
        ));
		//set the layout to be default
		$this->stencil->layout('default');
		//render about_view to template (/views/pages/about_view.php)
		$this->stencil->paint('about_view');
	}

	function company()
	{
		$this->load->helper('company');

		echo company('address');
	}

	function category()
	{
		$tes = category(3);
		
		print_r($tes);	
	}

	function post()
	{
		$tes = post(3);

		print_r($tes);
	}

	function decode()
	{
		$this->load->library('salabim');

		$tes = $this->salabim->encode(1);

		echo $tes;
		echo '<br>';

		//echo $this->salabim->decode('DcA1S92vlnfIei2byYmC4Kmxrltj_gMsXqHnGP6ntyw');
	}

	
}

/* End of file example.php */
/* Location: ./application/controllers/example.php */