<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//load models
		$this->load->model('message_m');
		//Sets the variable $head to use the slice head (/views/slices/head.php)
		$this->stencil->slice('head');
		//Sets the variable $head to use the slice header (/views/slices/header.php)
		$this->stencil->slice('header');
		//Sets the variable $head to use the slice bottom (/views/slices/bottom.php)
		$this->stencil->slice('bottom');
	}

	/**
	 * load page index contact
	 */
	public function index()
	{
		//set the variable $title into view
		$this->stencil->title('Kontak Kami');
		//set metadata
		$this->stencil->meta(array(
            'author' => 'Sakukode Team',
            'description' => 'silahkan hubungi kami http://sakukode.com atau via email kami sakukode@gmail.com',
            'keywords' => 'sakukode,web,contact,freelancer'
        ));
		//set the layout to be default
		$this->stencil->layout('default');
		//render contact_view to template (/views/pages/contact_view.php)
		$this->stencil->paint('contact_view');
	}

	/**
	 * method to validation from contact and send message
	 */
	public function send_message()
	{
		

		$this->form_validation->set_rules('name', 'Nama', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|valid_email|xss_clean');
		$this->form_validation->set_rules('url', 'Url', 'min_length[10]|xss_clean|prep_url');
		$this->form_validation->set_rules('message', 'Pesan', 'trim|required|min_length[5]|xss_clean');

		$this->form_validation->set_error_delimiters('<p class="text-danger"><i class="icon-ban-circle"></i>&nbsp;','</p>');
		$this->form_validation->set_message('required','%s harus diisi');
		$this->form_validation->set_message('valid_email','%s tidak valid');
		$this->form_validation->set_message('min_length','%s minimal terdiri dari %s karakter');
		$this->form_validation->set_message('max_length','%s maksimal terdiri dari %s karakter');

		//if validation false, return FALSE and set message errors
		if($this->form_validation->run() == FALSE)
		{
			$data = array(
				'status'	=> FALSE,
				'msg' 		=> validation_errors()
			);

			echo json_encode($data);
		}
		//if validation true, send message and insert to database 
		else
		{
			$check = $this->message_m->send();

			if($check == true)
			{
				$visitor = $this->input->post('name');
				$this->session->set_flashdata('notice-success', '<div class="noticeform-comment id="notice-contact">
                    <p>pesan terkirim. terima kasih '.$visitor.' telah mengunjungi website kami.</p>
                </div>');

				$data = array(
				'status'	=> TRUE,
				);				

				echo json_encode($data);
			}
			else
			{
				$data = array('status' => 'errors','msg' =>'Gagal Mengirim Pesan');

				echo json_encode($data);
			}
		}


	}

}

/* End of file contact.php */
/* Location: ./application/controllers/contact.php */