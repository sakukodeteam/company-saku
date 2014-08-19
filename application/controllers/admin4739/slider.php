<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends MY_Controller {

	
	function __construct()
	{
		parent::__construct();
		$this->stencil->title('Slider');
		//load helper and library
		$this->load->helper('dateindo');
		//load model
		$this->load->model('slider_m');
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
		$data['caption']		= 'Slider';
		$data['path_add'] 		= 'admin4739/slider/add';
		$data['path_table']		= 'admin4739/slider/get_all';
		$data['header_table']	= array('check','Title','Picture','Description','Background','Action');
		$data['sort'] = "{
            				'bSortable' : false,
            				'aTargets' : [ 0,2,3,4,5 ]
          				}";
        $data['width_tr'] = '{ "sWidth": "30px", "aTargets": [ 0 ] },
          					 { "sWidth": "300px", "aTargets": [ 3 ] },
          					 { "sWidth": "120px", "aTargets": [ 5 ] },';
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
		$this->datatables->select('slide_id,title,image,description,background')
						 ->from('sliders')
						 ->where('deleted',0)
						 ->edit_column('check','<input type="checkbox" value="$1">','slide_id')
						 ->edit_column('image','<img src="'.base_url().'assets/img/slider/$1" width="70" height="60">','image')
						 ->add_column('Action',
				        	'<a href="'.site_url('admin4739/slider/view/$1').'" class="btn btn-xs btn-flat btn-info" data-toggle="tooltip" data-placement="top" title="view detail">
				        	<i class="ion ion-information-circled"></i></a>
				        	<a href="'.site_url('admin4739/slider/edit/$1').'" class="btn btn-xs btn-flat bg-olive" data-toggle="tooltip" data-placement="top" title="edit">
				        	<i class="ion ion-edit"></i></a> 
				        	<a href="'.site_url('admin4739/slider/change-picture/$1').'" class="btn btn-xs btn-flat bg-maroon" data-toggle="tooltip" data-placement="top" title="change picture">
				        	<i class="ion ion-image"></i></a> 
				        	<button class="btn btn-xs btn-flat btn-danger btn-del" id=$1 data-toggle="tooltip" data-placement="top" title="delete">
				        	<i class="ion ion-trash-a"></i></button>','slide_id');

		echo $this->datatables->generate();
	}

		/**
	 * method view to display detail data
	 * @param  int $slider_id data ID
	 * @return void 
	 */
	public function view($slide_id)
	{
		$id = $this->security->xss_clean($slide_id);
		$result = $this->slider_m->get_by('slide_id',$id);

		if(!empty($result))
		{
			$arr_result = array(
				'Title' 		=> $result->title,
				'Background'	=> $result->background,
				'Description'	=> $result->description,
				'Picture'		=> '<img src="'.base_url().'assets/img/slider/'.$result->image.'" width="120px" height="100px" />'
			);
		}else
		{
			$arr_result = NULL;
		}

		$data['data'] 			= $arr_result;
		$data['path_edit']		= 'admin4739/slider/edit/'.$id;
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
			'check'		 => 'valid',
			'slide_id'	 => NULL,
			'slide_title'=> '',
			'background' => '',
			'picture'	 => '',
			'desc'		 => '',
			'btn_submit' => 'Save'
		);
		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('adm/slide_form');
	}

	/**
	 * method edit get data to store form edit
	 * @param  int $slide_id data ID
	 * @return void
	 */
	public function edit($slide_id)
	{
		$id = $this->security->xss_clean($slide_id);
		$result = $this->slider_m->get_by('slide_id',$id);

		if(!empty($result))
		{
			//prepare data form
			$data = array(
				'check'		 => 'valid',
				'slide_id'	 => $id,
				'slide_title'=> $result->title,
				'background' => $result->background,
				'picture'	 => $result->image,
				'desc'		 => $result->description,
				'btn_submit' => 'Update'
			);
		}else
		{
			$data = array(
				'check'		=> 'not valid',
			);
		}

		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('adm/slide_form');
	}

	/**
	 * method save process saving data from form to database
	 * @return void
	 */
	function save()
	{
		$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('background', 'Background', 'trim|required|xss_clean');
		$this->form_validation->set_rules('desc', 'Description', 'trim|required|min_length[5]|xss_clean');

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
			$id 	= $this->input->post('slide-id');
			$load 	= $this->input->post('submit');
			$title  = $this->input->post('title');
			$file   = strtolower(url_title($title));

			if(empty($id))
			{
				//action add
				//process upload picture
				$this->load->library('upload');
				$config['upload_path']	= "./assets/img/slider";
		        $config['allowed_types']= 'jpg|png|jpeg';
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
						$this->slider_m->add_slider($filename);
						if($load == 1){
							$this->session->set_flashdata('notif-success', 'Data has been successfully inserted. '.anchor('/admin4739/slider/add', 'Add Slider').'');
						
						}
							
						$data = array(
							'load'		=> $load,
							'clearForm'	=> TRUE,
							'status'	=> TRUE,
							'msg'		=> 'data has been successfully inserted. '.anchor('/admin4739/slider', 'Go back to list').'',
						);

						echo json_encode($data);
					}	
			}
			else
			{
				//action edit
				//call method to update table
				$this->slider_m->update_slider($id);
				if($load == 1){
					$this->session->set_flashdata('notif-success', 'Data has been successfully updated. '.anchor('/admin4739/slider/edit/'.$id , 'Edit Slider').'');
				}

					$data = array(
						'load'		=> $load,
						'clearForm'	=> FALSE,
						'status'	=> TRUE,
						'msg'		=> 'data has been successfully updated. '.anchor('/admin4739/slider', 'Go back to list').'',
					);

					echo json_encode($data);
			}
				
		}
	}

	/**
	 * method change_picture display change picture form 
	 * @param  int $slide_id data ID
	 * @return void
	 */
	public function change_picture($slide_id)
	{
		$id = $this->security->xss_clean($slide_id);

		$result = $this->slider_m->get_custom_by('slide_id,image','slide_id',$slide_id);

		$data = array(
			'path' 			=> 'assets/img/slider/'.$result->image,
			'path_action'	=> 'admin4739/slider/update_picture',
			'id'			=> $id,
			'picture'		=> $result->image
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
		$config['upload_path']	= "./assets/img/slider";
		$config['allowed_types']= 'jpg|png|jpeg';		
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

			$this->slider_m->update_picture($id,$file,$path);

			if($load == 1){
			    $this->session->set_flashdata('notif-success', 'Picture has been successfully changed.');
			}

			$data = array(
				'path'		=> base_url().'/assets/img/slider/'.$file,
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
			$q = $this->slider_m->delete($id);
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

		$q = $this->slider_m->delete_many($id);

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

/* End of file slider.php */
/* Location: ./application/controllers/slider.php */