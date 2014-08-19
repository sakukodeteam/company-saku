<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider_m extends MY_Model {

	public $primary_key = 'slide_id';
	protected $soft_delete = TRUE;

	public function add_slider($filename)
	{
		$title 		= $this->input->post('title');
		$background	= $this->input->post('background');
		$desc		= $this->input->post('desc');

		$data = array(
			'slide_id'			=> NULL,
			'title'				=> strip_tags($title,ENT_QUOTES),
			'background'		=> strip_tags($background,ENT_QUOTES),
			'image'			=> $filename,
			'description'		=> htmlentities($desc,ENT_QUOTES,"UTF-8")
		);

		$this->insert($data);
	}
	
	public function update_slider($id)
	{
		$title 		= $this->input->post('title');
		$background	= $this->input->post('background');
		$desc		= $this->input->post('desc');

		$data = array(
			'title'				=> strip_tags($title,ENT_QUOTES),
			'background'		=> strip_tags($background,ENT_QUOTES),
			'description'		=> htmlentities($desc,ENT_QUOTES,"UTF-8")
		);

		$this->update($id,$data);
	}

	public function update_picture($id,$file,$path)
	{
		$data = array(
			'image' => $file
		);

		$this->update($id,$data);
		@unlink($path);
	}

}

/* End of file slider_m.php */
/* Location: ./application/models/slider_m.php */