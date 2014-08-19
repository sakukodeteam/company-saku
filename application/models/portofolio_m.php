<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portofolio_m extends MY_Model {

	public $primary_key = 'portofolio_id';
	public $soft_delete = TRUE;

	public function add_portofolio($filename)
	{
		$porto_name	= $this->input->post('porto-name');
		$url 		= $this->input->post('url');
		$client 	= $this->input->post('client');
		$desc		= $this->input->post('desc');

		$data = array(
			'portofolio_id'		=> NULL,
			'portofolio_name'	=> strip_tags($porto_name,ENT_QUOTES),
			'url'				=> strip_tags($url,ENT_QUOTES),
			'client'			=> strip_tags($client,ENT_QUOTES),
			'picture'			=> $filename,
			'description'		=> htmlentities($desc,ENT_QUOTES,"UTF-8")
		);

		$this->insert($data);
	}
	
	public function update_portofolio($id)
	{
		$porto_name	= $this->input->post('porto-name');
		$url 		= $this->input->post('url');
		$client 	= $this->input->post('client');
		$desc		= $this->input->post('desc');

		$data = array(
			'portofolio_name'	=> strip_tags($porto_name,ENT_QUOTES),
			'url'				=> strip_tags($url,ENT_QUOTES),
			'client'			=> strip_tags($client,ENT_QUOTES),
			'description'		=> htmlentities($desc,ENT_QUOTES,"UTF-8")
		);

		$this->update($id,$data);
	}

	public function update_picture($id,$newfile,$filename)
	{
		$path_full = 'assets/img/portofolio/full/'.$filename;
		$path_thumb = 'assets/img/portofolio/thumb/'.$filename;
		$data = array(
			'picture' => $newfile
		);

		$this->update($id,$data);
		@unlink($path_full);
		@unlink($path_thumb);
	}
}

/* End of file portofolio_m.php */
/* Location: ./application/models/portofolio_m.php */