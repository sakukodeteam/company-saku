<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_m extends MY_Model {

	public $primary_key = 'client_id';
	protected $soft_delete = TRUE;

	public function add_client($filename)
	{
		$company 	= $this->input->post('company');
		$contact	= $this->input->post('contact');
		$email 		= $this->input->post('email');
		$phone 		= $this->input->post('phone');
		$hp    		= $this->input->post('hp');
		$url	 	= $this->input->post('url');
		$addr1		= $this->input->post('address-1');
		$addr2		= $this->input->post('address-2');

		$data = array(
			'client_id'			=> NULL,
			'company'			=> strip_tags($company,ENT_QUOTES),
			'contact_person'	=> strip_tags($contact,ENT_QUOTES),
			'email'				=> strip_tags($email,ENT_QUOTES),
			'phone'				=> strip_tags($phone,ENT_QUOTES),
			'hp'				=> strip_tags($hp,ENT_QUOTES),
			'url'				=> strip_tags($url,ENT_QUOTES),
			'picture'			=> $filename,
			'address_1'			=> htmlentities($addr1,ENT_QUOTES,"UTF-8"),
			'address_2'			=> htmlentities($addr2,ENT_QUOTES,"UTF-8")
		);

		$this->insert($data);
	}
	
	public function update_client($id)
	{
		$company 	= $this->input->post('company');
		$contact	= $this->input->post('contact');
		$email 		= $this->input->post('email');
		$phone 		= $this->input->post('phone');
		$hp    		= $this->input->post('hp');
		$url	 	= $this->input->post('url');
		$addr1		= $this->input->post('address-1');
		$addr2		= $this->input->post('address-2');

		$data = array(
			'company'			=> strip_tags($company,ENT_QUOTES),
			'contact_person'	=> strip_tags($contact,ENT_QUOTES),
			'email'				=> strip_tags($email,ENT_QUOTES),
			'phone'				=> strip_tags($phone,ENT_QUOTES),
			'hp'				=> strip_tags($hp,ENT_QUOTES),
			'url'				=> strip_tags($url,ENT_QUOTES),
			'address_1'			=> htmlentities($addr1,ENT_QUOTES,"UTF-8"),
			'address_2'			=> htmlentities($addr2,ENT_QUOTES,"UTF-8")
		);

		$this->update($id,$data);
	}

	public function update_picture($id,$file,$path)
	{
		$data = array(
			'picture' => $file
		);

		$this->update($id,$data);
		@unlink($path);
	}

}

/* End of file client_m.php */
/* Location: ./application/models/client_m.php */