<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portofolio extends MY_Controller {

	
	function __construct()
	{
		parent::__construct();
		$this->stencil->title('Portofolio');
		//load helper and library
		$this->load->helper('dateindo');
		//load model
		$this->load->model('portofolio_m');
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
		$data['caption']		= 'Portofolio';
		$data['path_add'] 		= 'admin4739/portofolio/add';
		$data['path_table']		= 'admin4739/portofolio/get_all';
		$data['header_table']	= array('check','Portofolio Name','Picture','Url','Client','Description','Action');
		$data['sort'] = "{
            				'bSortable' : false,
            				'aTargets' : [ 0,2,4,5 ]
          				}";
        $data['width_tr'] = '{ "sWidth": "30px", "aTargets": [ 0 ] },
        					 { "sWidth": "80px", "aTargets": [ 2 ] },
          					 { "sWidth": "300px", "aTargets": [ 5 ] },
          					 { "sWidth": "120px", "aTargets": [ 6 ] },';
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
		$this->datatables->select('portofolio_id,portofolio_name,picture,url,client,description')
						 ->from('portofolios')
						 ->where('deleted',0)
						 ->edit_column('check','<input type="checkbox" value="$1">','portofolio_id')
						 ->edit_column('picture','<img src="'.base_url().'assets/img/portofolio/thumb/$1" width="70" height="60">','picture')
						 ->add_column('Action',
				        	'<a href="'.site_url('admin4739/portofolio/view/$1').'" class="btn btn-xs btn-flat btn-info" data-toggle="tooltip" data-placement="top" title="view detail">
				        	<i class="ion ion-information-circled"></i></a>
				        	<a href="'.site_url('admin4739/portofolio/edit/$1').'" class="btn btn-xs btn-flat bg-olive" data-toggle="tooltip" data-placement="top" title="edit">
				        	<i class="ion ion-edit"></i></a> 
				        	<a href="'.site_url('admin4739/portofolio/change-picture/$1').'" class="btn btn-xs btn-flat bg-maroon" data-toggle="tooltip" data-placement="top" title="change picture">
				        	<i class="ion ion-image"></i></a> 
				        	<button class="btn btn-xs btn-flat btn-danger btn-del" id=$1 data-toggle="tooltip" data-placement="top" title="delete">
				        	<i class="ion ion-trash-a"></i></button>','portofolio_id');

		echo $this->datatables->generate();
	}

		/**
	 * method view to display detail data
	 * @param  int $porto_id data ID
	 * @return void 
	 */
	public function view($porto_id)
	{
		$id = $this->security->xss_clean($porto_id);
		$result = $this->portofolio_m->get_by('portofolio_id',$id);

		if(!empty($result))
		{
			$arr_result = array(
				'Portofolio Name' 	=> $result->portofolio_name,
				'Url'			  	=> $result->url,
				'Client'			=> $result->client,
				'Description'		=> $result->description,
				'Picture'			=> '<img src="'.base_url().'assets/img/portofolio/thumb/'.$result->picture.'" width="120px" height="100px" />'
			);
		}else
		{
			$arr_result = NULL;
		}

		$data['data'] 			= $arr_result;
		$data['path_edit']		= 'admin4739/portofolio/edit/'.$id;
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
			'porto_id'	=> NULL,
			'porto_name'=> '',
			'client'	=> '',
			'url'		=> '',
			'picture'	=> '',
			'desc'		=> '',
			'btn_submit'=> 'Save'
		);
		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('adm/porto_form');
	}

	/**
	 * method edit get data to store form edit
	 * @param  int $porto_id data ID
	 * @return void
	 */
	public function edit($porto_id)
	{
		$id = $this->security->xss_clean($porto_id);
		$result = $this->portofolio_m->get_by('portofolio_id',$id);

		if(!empty($result))
		{
			//prepare data form
			$data = array(
				'check'		=> 'valid',
				'porto_id'	=> $id,
				'porto_name'=> $result->portofolio_name,
				'client'	=> $result->client,
				'url'		=> $result->url,
				'picture'	=> $result->picture,
				'desc'		=> $result->description,
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
		$this->stencil->paint('adm/porto_form');
	}

	/**
	 * method save process saving data from form to database
	 * @return void
	 */
	function save()
	{
		$this->form_validation->set_rules('porto-name', 'Portofolio Name', 'trim|required|min_length[5]|xss_clean|callback_check_name');
		$this->form_validation->set_rules('client', 'Client', 'trim|min_length[4]|xss_clean');
		$this->form_validation->set_rules('url', 'Url', 'trim|required|min_length[5]|xss_clean|prep_url');
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
			$id 	= $this->input->post('porto-id');
			$load 	= $this->input->post('submit');
			$file   = strtolower(url_title($this->input->post('porto-name')));

			if(empty($id))
			{
				//action add
				//process upload picture
				$this->load->library('upload');
				$config['upload_path']	= "./assets/img/portofolio/full";
		        $config['allowed_types']= 'gif|jpg|png|jpeg';
		        $config['file_name'] = $file;
		        $config['max_size']     = '500';
		        $config['max_width']  	= '1200';
		        $config['max_height']  	= '980';
					
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
						$data	   = $this->upload->data();

						//resize picture
						 /* PATH */
				            $source             = "./assets/img/portofolio/full/".$data['file_name'] ;
				            $destination_thumb	= "./assets/img/portofolio/thumb/" ;
				 
				            // Permission Configuration
				            chmod($source, 0777) ;
				 
				            /* Resizing Processing */
				    	    // Configuration Of Image Manipulation :: Static
				    	    $this->load->library('image_lib') ;
				    	    $img['image_library'] = 'GD2';
				    	    $img['create_thumb']  = TRUE;
				    	    $img['maintain_ratio']= TRUE;
				 
				            /// Limit Width Resize
				            $limit_thumb    = 300 ;
				 
				            // Size Image Limit was using (LIMIT TOP)
				            $limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
				 
				            // Percentase Resize
				            if ($limit_use > $limit_thumb) {
				                $percent_thumb  = $limit_thumb/$limit_use ;
				            }
				 
				            //// Making THUMBNAIL ///////
					    	$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
				            $img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
				 
				            // Configuration Of Image Manipulation :: Dynamic
				            $img['thumb_marker'] = '';
				            $img['quality']      = '100%' ;
				            $img['source_image'] = $source ;
				            $img['new_image']    = $destination_thumb ;
				 
				            // Do Resizing
				            $this->image_lib->initialize($img);
				            $this->image_lib->resize();
				            $this->image_lib->clear() ;



						$filename  = $data['file_name']; 
						//call method to insert table
						$this->portofolio_m->add_portofolio($filename);
						if($load == 1){
							$this->session->set_flashdata('notif-success', 'Data has been successfully inserted. '.anchor('/admin4739/portofolio/add', 'Add Portofolio').'');
						
						}
							
						$data = array(
							'load'		=> $load,
							'clearForm'	=> TRUE,
							'status'	=> TRUE,
							'msg'		=> 'data has been successfully inserted. '.anchor('/admin4739/portofolio', 'Go back to list').'',
						);

						echo json_encode($data);
					}	
			}
			else
			{
				//action edit
				//call method to update table
				$this->portofolio_m->update_portofolio($id);
				if($load == 1){
					$this->session->set_flashdata('notif-success', 'Data has been successfully updated. '.anchor('/admin4739/portofolio/edit/'.$id , 'Edit Portofolio').'');
				}

					$data = array(
						'load'		=> $load,
						'clearForm'	=> FALSE,
						'status'	=> TRUE,
						'msg'		=> 'data has been successfully updated. '.anchor('/admin4739/portofolio', 'Go back to list').'',
					);

					echo json_encode($data);
			}
				
		}
	}

	/**
	 * method change_picture display change picture form 
	 * @param  int $porto_d data ID
	 * @return void
	 */
	public function change_picture($porto_id)
	{
		$id = $this->security->xss_clean($porto_id);

		$result = $this->portofolio_m->get_custom_by('portofolio_id,picture','portofolio_id',$porto_id);

		$data = array(
			'path' 			=> 'assets/img/portofolio/full/'.$result->picture,
			'path_action'	=> 'admin4739/portofolio/update_picture',
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
		$pict       = "picture";
		//process upload picture
		$this->load->library('upload');
		$config['upload_path']	= "./assets/img/portofolio/full";
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
			$data = $this->upload->data();
			$newfile = $data['file_name'];

						//resize picture
						 /* PATH */
				            $source             = "./assets/img/portofolio/full/".$data['file_name'] ;
				            $destination_thumb	= "./assets/img/portofolio/thumb/" ;
				 
				            // Permission Configuration
				            chmod($source, 0777) ;
				 
				            /* Resizing Processing */
				    	    // Configuration Of Image Manipulation :: Static
				    	    $this->load->library('image_lib') ;
				    	    $img['image_library'] = 'GD2';
				    	    $img['create_thumb']  = TRUE;
				    	    $img['maintain_ratio']= TRUE;
				 
				            /// Limit Width Resize
				            $limit_thumb    = 300 ;
				 
				            // Size Image Limit was using (LIMIT TOP)
				            $limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;
				 
				            // Percentase Resize
				            if ($limit_use > $limit_thumb) {
				                $percent_thumb  = $limit_thumb/$limit_use ;
				            }
				 
				            //// Making THUMBNAIL ///////
					    	$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
				            $img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;
				 
				            // Configuration Of Image Manipulation :: Dynamic
				            $img['thumb_marker'] = '';
				            $img['quality']      = '100%' ;
				            $img['source_image'] = $source ;
				            $img['new_image']    = $destination_thumb ;
				 
				            // Do Resizing
				            $this->image_lib->initialize($img);
				            $this->image_lib->resize();
				            $this->image_lib->clear() ;

			$this->portofolio_m->update_picture($id,$newfile,$filename);

			if($load == 1){
			    $this->session->set_flashdata('notif-success', 'Picture has been successfully changed.');
			}

			$data = array(
				'path'		=> base_url().'/assets/img/portofolio/full/'.$newfile,
				'file'		=> $newfile,
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
			$q = $this->portofolio_m->delete($id);
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

		$q = $this->portofolio_m->delete_many($id);

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

/* End of file portofolio.php */
/* Location: ./application/controllers/portofolio.php */