<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends MY_Controller {

	
	function __construct()
	{
		parent::__construct();
		$this->stencil->title('Client');
		//load helper and library
		$this->load->helper('dateindo');
		//load model
		$this->load->model('client_m');
	}

	
	/**
	 * method index
	 * @return void display index page
	 */
	public function index()
	{
		//set css and js
		$this->stencil->css('admin/datatables/dataTables.bootstrap');
		$this->stencil->js('admin/plugins/datatables/jquery.dataTables');
		$this->stencil->js('admin/plugins/datatables/dataTables.bootstrap');
		//prepare data
		$data['caption']		= 'Client';
		$data['path_add'] 		= 'admin4739/client/add';
		$data['path_table']		= 'admin4739/client/get_all';
		$data['header_table']	= array('check','Company','Contact Person','EMail','Phone','Hp','Picture','Action');
		$data['sort'] = "{
            				'bSortable' : false,
            				'aTargets' : [ 0,3,4,5,6,7 ]
          				}";
        $data['width_tr'] = '{ "sWidth": "30px", "aTargets": [ 0 ] },
          					 { "sWidth": "80px", "aTargets": [ 6 ] },
          					 { "sWidth": "120px", "aTargets": [ 7 ] },';
		$this->stencil->data($data);
		//set page view
		$this->stencil->paint('adm/table_view');
	}

	/**
	 * method get_all
	 * @return void get all from database to store datatable
	 */
	public function get_all()
	{
		//$path_pic = 'assets/img/portofolio/';
		//load library datatables
		$this->load->library('datatables');
		//get data
		$this->datatables->select('client_id,company,contact_person,email,phone,hp,picture,')
						 ->from('clients')
						 ->where('deleted',0)
						 ->edit_column('check','<input type="checkbox" value="$1">','client_id')
						 ->edit_column('picture','<img src="'.base_url().'assets/img/client/$1" width="60" height="60">','picture')
						 ->add_column('Action',
				        	'<a href="'.site_url('admin4739/client/view/$1').'" class="btn btn-xs btn-flat btn-info" data-toggle="tooltip" data-placement="top" title="view detail">
				        	<i class="ion ion-information-circled"></i></a>
				        	<a href="'.site_url('admin4739/client/edit/$1').'" class="btn btn-xs btn-flat bg-olive" data-toggle="tooltip" data-placement="top" title="edit">
				        	<i class="ion ion-edit"></i></a> 
				        	<a href="'.site_url('admin4739/client/change-picture/$1').'" class="btn btn-xs btn-flat bg-maroon" data-toggle="tooltip" data-placement="top" title="change picture">
				        	<i class="ion ion-image"></i></a> 
				        	<button class="btn btn-xs btn-flat btn-danger btn-del" id=$1 data-toggle="tooltip" data-placement="top" title="delete">
				        	<i class="ion ion-trash-a"></i></button>','client_id');

		echo $this->datatables->generate();
	}

		/**
	 * method view to display detail data
	 * @param  int $client_id data ID
	 * @return void 
	 */
	public function view($client_id)
	{
		$id = $this->security->xss_clean($client_id);
		$result = $this->client_m->get_by('client_id',$id);

		if(!empty($result))
		{
			$arr_result = array(
				'Company' 			=> $result->company,
				'Contact Person'	=> $result->contact_person,
				'Email'				=> $result->email,
				'Phone'				=> $result->phone,
				'Hp'				=> $result->hp,
				'Url'			  	=> $result->url,
				'Adress 1'			=> $result->address_1,
				'Address 2'			=> $result->address_2,
				'Picture'			=> '<img src="'.base_url().'assets/img/client/'.$result->picture.'" width="120px" height="100px" />'
			);
		}else
		{
			$arr_result = NULL;
		}

		$data['data'] 			= $arr_result;
		$data['path_edit']		= 'admin4739/client/edit/'.$id;
		$data['id']				= $id;
		$this->stencil->data($data);
		$this->stencil->paint('adm/detail_view');
	}

	/**
	 * method add to display form add
	 */
	public function add()
	{
		//prepare data form
		$data = array(
			'check'		=> 'valid',
			'client_id'	=> NULL,
			'company'	=> '',
			'contact'	=> '',
			'email'		=> '',
			'phone'		=> '',
			'hp'		=> '',
			'url'		=> '',
			'address_1'	=> '',
			'address_2'	=> '',
			'picture'	=> '',
			'btn_submit'=> 'Save'
		);
		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('adm/client_form');
	}

	/**
	 * method edit get data to store form edit
	 * @param  int $client_id data ID
	 * @return void
	 */
	public function edit($client_id)
	{
		$id = $this->security->xss_clean($client_id);
		$result = $this->client_m->get_by('client_id',$id);

		if(!empty($result))
		{
			//prepare data form
			$data = array(
				'check'		=> 'valid',
				'client_id'	=> $result->client_id,
				'company'	=> $result->company,
				'contact'	=> $result->contact_person,
				'email'		=> $result->email,
				'phone'		=> $result->phone,
				'hp'		=> $result->hp,
				'url'		=> $result->url,
				'address_1'	=> $result->address_1,
				'address_2'	=> $result->address_2,
				'picture'	=> $result->picture,
				'btn_submit'=> 'Update'
			);
		}else
		{
			$data = array(
				'check'		=> 'not valid',
			);
		}

		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('adm/client_form');
	}

	/**
	 * method save process saving data from form to database
	 * @return void
	 */
	function save()
	{
		$this->form_validation->set_rules('company', 'Company', 'trim|required|min_length[5]|xss_clean|callback_check_company');
		$this->form_validation->set_rules('contact', 'Contact Person', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|xss_clean|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|xss_clean');
		$this->form_validation->set_rules('hp', 'Hp', 'trim|required|min_length[11]|xss_clean|numeric');
		$this->form_validation->set_rules('address-1', 'Address 1', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('url', 'Url', 'trim|xss_clean|prep_url');
		$this->form_validation->set_rules('address-2', 'Address 2', 'min_length[5]|xss_clean');

		$this->form_validation->set_error_delimiters('<p class="text-danger"><i class="fa fa-ban"></i> ','</p>');

		$pic = 'picture';

		//validation form false
		if($this->form_validation->run() == FALSE)
		{
			//return error message
			$data = array(
				'status'	=> FALSE,
				'msg'		=> validation_errors()
			);

			echo json_encode($data);
		}
		else //validation form true
		{
			$id 	 = $this->input->post('client-id');
			$load 	 = $this->input->post('submit');
			$company = $this->input->post('company');
			$file    = strtolower(url_title($company));

			if(empty($id))
			{
				//action add
				//process upload picture
				$this->load->library('upload');
				$config['upload_path']	= "./assets/img/client";
		        $config['allowed_types']= 'gif|jpg|png|jpeg';
		        $config['file_name'] = $file;
				$config['overwrite'] = FALSE;
		        $config['max_size']     = '300';
		        $config['max_width']  	= '700';
		        $config['max_height']  	= '700';
					
				$this->upload->initialize($config);
					//validation upload false
					if(!$this->upload->do_upload($pic))
					{
						$data = array(
							'status'	=> 'error-upload',
							'msg'		=> $this->upload->display_errors()
						);

						echo json_encode($data);
					}
					else//validation upload true/success
					{
						$upload	   = $this->upload->data();
						$filename  = $upload['file_name']; 
						//call method to insert table
						$this->client_m->add_client($filename);
						if($load == 1){
							$this->session->set_flashdata('notif-success', 'Data has been successfully inserted. '.anchor('/admin4739/client/add', 'Add Client').'');
						
						}
							
						$data = array(
							'load'		=> $load,
							'clearForm'	=> TRUE,
							'status'	=> TRUE,
							'msg'		=> 'data has been successfully inserted. '.anchor('/admin4739/client', 'Go back to list').'',
						);

						echo json_encode($data);
					}	
			}
			else
			{
				//action edit
				//call method to update table
				$this->client_m->update_client($id);
				if($load == 1){
					$this->session->set_flashdata('notif-success', 'Data has been successfully updated. '.anchor('/admin4739/client/edit/'.$id , 'Edit Client').'');
				}

					$data = array(
						'load'		=> $load,
						'clearForm'	=> FALSE,
						'status'	=> TRUE,
						'msg'		=> 'data has been successfully updated. '.anchor('/admin4739/client', 'Go back to list').'',
					);

					echo json_encode($data);
			}
				
		}
	}

	/**
	 * method change_picture display change picture form 
	 * @param  int $clientid data ID
	 * @return void
	 */
	public function change_picture($client_id)
	{
		$id = $this->security->xss_clean($client_id);

		$result = $this->client_m->get_custom_by('client_id,picture','client_id',$id);

		$data = array(
			'path' 			=> 'assets/img/client/'.$result->picture,
			'path_action'	=> 'admin4739/client/update_picture',
			'id'			=> $id,
			'picture'		=> $result->picture
		);
		$this->stencil->data($data);
		$this->stencil->paint('adm/picture_form');
	}

	/**
	 * method update_picture process update field filename to database and replace picture to folder
	 * @return void
	 */
	public function update_picture()
	{
		$newname    = strtolower(url_title($this->input->post('newname')));
		$filename 	= $this->input->post('filename');
		$path 		= $this->input->post('path');
		$load 		= $this->input->post('submit');
		$id         = $this->input->post('id');
		$pict = "picture";
		//process upload picture
		$this->load->library('upload');
		$config['upload_path']	= "./assets/img/client";
		$config['allowed_types']= 'gif|jpg|png|jpeg';		
		$config['max_size']     = '300';
		$config['max_width']  	= '700';
		$config['max_height']  	= '700';
		if(!empty($newname)){
			$config['file_name']    = $newname;
		}
			
		$this->upload->initialize($config);

		if(!$this->upload->do_upload($pict))
		{
			$data = array(
				'status' => FALSE,
				'msg'	 => $this->upload->display_errors()
			);

			echo json_encode($data);
		}
		else
		{
			$upload = $this->upload->data();
			$file = $upload['file_name'];

			$this->client_m->update_picture($id,$file,$path);

			if($load == 1){
			    $this->session->set_flashdata('notif-success', 'Picture has been successfully changed.');
			}

			$data = array(
				'path'		=> base_url().'/assets/img/client/'.$file,
				'file'		=> $file,
				'load'		=> $load,
				'status'	=> TRUE,
				'msg'		=> 'Picture has been successfully changed. '.anchor('/admin4739/'.$this->router->fetch_class().'', 'Go back to list').'',
			);

			echo json_encode($data);
		}

	}

	/**
	 * method delete
	 * @return void
	 */
	public function delete()
	{
		$id_post = $_GET['id'];
		$id 	 = $this->security->xss_clean($id_post);

		if(!empty($id))
		{
			$q = $this->client_m->delete($id);
			if($q)
			{
				$this->session->set_flashdata('notif-success','Data has been successfully deleted.');
				
				$data = array(
					'status' => TRUE
				);

				echo json_encode($data);
			}
			else
			{
				$this->session->set_flashdata('notif-error','Failed Delete.');
				$data = array(
					'status' => TRUE
				);

				echo json_encode($data);
			}
		}
		else if(empty($id))
		{
			$this->session->set_flashdata('notif-error','ID Null. System Error');
			$data = array(
					'status' => TRUE
				);

			echo json_encode($data);
		}
	}

	/**
	 * method delete_many
	 * @return [type] [description]
	 */
	public function delete_many()
	{
		$id = $this->input->post('data',TRUE);

		$q = $this->client_m->delete_many($id);

		if($q)
		{
			$this->session->set_flashdata('notif-success', 'Data has been successfully deleted.');
			$data = array(
				'status' => TRUE,
			);
			echo json_encode($data);
		}else
		{
			$this->session->set_flashdata('notif-error', 'Failed Delete');
			$data = array(
				'status' => TRUE,
			);

			echo json_encode($data);
		}
	}

}

/* End of file client.php */
/* Location: ./application/controllers/client.php */