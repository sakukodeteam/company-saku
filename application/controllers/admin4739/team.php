<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team extends MY_Controller {


	function __construct()
	{
		parent::__construct();
		$this->stencil->title('Team');
		//load helper and library
		$this->load->helper('dateindo');
		//load model
		$this->load->model('team_m');
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
		$data['caption']		= 'Team';
		$data['path_add'] 		= 'admin4739/team/add';
		$data['path_table']		= 'admin4739/team/get_all';
		$data['header_table']	= array('check','Name','Email','Job','Photo','Action');
		$data['sort'] = "{
            				'bSortable' : false,
            				'aTargets' : [ 0,3,4,5 ]
          				}";
        $data['width_tr'] = '{ "sWidth": "30px", "aTargets": [ 0 ] },
        					 { "sWidth": "300px", "aTargets": [ 3 ] },
          					 { "sWidth": "80px", "aTargets": [ 4 ] },
          					 { "sWidth": "100px", "aTargets": [ 5 ] },';
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
		$path_pic = 'assets/img/team/';
		//load library datatables
		$this->load->library('datatables');
		//get data
		$this->datatables->select('team_id,firstname,email,job,picture')
						 ->from('teams')
						 ->where('deleted',0)
						 ->edit_column('check','<input type="checkbox" value="$1">','team_id')
						 ->edit_column('picture','<img src="'.base_url().'assets/img/team/$1" width="70" height="60">','picture')
						 ->add_column('Action',
				        	'<a href="'.site_url('admin4739/team/view/$1').'" class="btn btn-xs btn-flat btn-info" data-toggle="tooltip" data-placement="top" title="view detail">
				        	<i class="ion ion-information-circled"></i></a>
				        	<a href="'.site_url('admin4739/team/edit/$1').'" class="btn btn-xs btn-flat bg-olive" data-toggle="tooltip" data-placement="top" title="edit">
				        	<i class="ion ion-edit"></i></a> 
				        	<a href="'.site_url('admin4739/team/change-picture/$1').'" class="btn btn-xs btn-flat bg-maroon" data-toggle="tooltip" data-placement="top" title="change picture">
				        	<i class="ion ion-image"></i></a> 
				        	<button class="btn btn-xs btn-flat btn-danger btn-del" id=$1 data-toggle="tooltip" data-placement="top" title="delete">
				        	<i class="ion ion-trash-a"></i></button>','team_id');

		echo $this->datatables->generate();
	}

	/**
	 * method view to display detail data
	 * @param  int $team_id data ID
	 * @return void 
	 */
	public function view($team_id)
	{
		$id = $this->security->xss_clean($team_id);
		$result = $this->team_m->get_by('team_id',$id);

		if(!empty($result))
		{
			$arr_result = array(
				'firstname' => $result->firstname,
				'lastname'	=> $result->lastname,
				'email'		=> $result->email,
				'job'		=> $result->job,
				'facebook'	=> $result->fb_account,
				'twitter'	=> $result->twitter_account,
				'picture'	=> '<img src="'.base_url().'assets/img/team/'.$result->picture.'" width="120px" height="100px" />',
				'testimony'	=> $result->description
			);
		}else
		{
			$arr_result = NULL;
		}

		$data['data'] 			= $arr_result;
		$data['path_edit']		= 'admin4739/team/edit/'.$id;
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
			'teamid'	=> NULL,
			'fname'		=> '',
			'lname'		=> '',
			'email'		=> '',
			'job'		=> '',
			'fb'		=> '',
			'twitter'	=> '',
			'desc'		=> '',
			'btn_submit'=> 'Save'
		);
		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('adm/team_form');
	}

	/**
	 * method edit get data to store form edit
	 * @param  int $team_id data ID
	 * @return void
	 */
	public function edit($team_id)
	{
		$id = $this->security->xss_clean($team_id);
		$result = $this->team_m->get_by('team_id',$id);

		if(!empty($result))
		{
			//prepare data form
			$data = array(
				'check'		=> 'valid',
				'teamid'	=> $result->team_id,
				'fname'		=> $result->firstname,
				'lname'		=> $result->lastname,
				'email'		=> $result->email,
				'job'		=> $result->job,
				'fb'		=> $result->fb_account,
				'twitter'	=> $result->twitter_account,
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
		$this->stencil->paint('adm/team_form');
	}

	/**
	 * method save process saving data from form to database
	 * @return void
	 */
	function save()
	{
		$this->form_validation->set_rules('fname', 'Firstname', 'trim|required|min_length[3]|max_length[25]|xss_clean');
		$this->form_validation->set_rules('lname', 'Lastname', 'trim|required|min_length[3]|max_length[25]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[70]|valid_email|xss_clean|callback_check_email');
		$this->form_validation->set_rules('job', 'Job', 'trim|required|min_length[5]|max_length[50]|xss_clean');
		$this->form_validation->set_rules('fb', 'Facebook', 'trim|required|min_length[5]|max_length[70]|prep_url|xss_clean');
		$this->form_validation->set_rules('twitter', 'Twitter', 'min_length[5]|max_length[70]|prep_url|xss_clean');
		$this->form_validation->set_rules('desc', 'Testimony', 'min_length[5]|xss_clean');

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
			$id 	= $this->input->post('team-id');
			$load 	= $this->input->post('submit');
			$fname  = $this->input->post('fname');
			$lname  = $this->input->post('lname');
			$file   = strtolower($fname.'-'.$lname);

			if(empty($id))
			{
				//action add
				//process upload picture
				$this->load->library('upload');
				$config['upload_path']	= "./assets/img/team";
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
						$this->team_m->add_team($filename);
						if($load == 1){
							$this->session->set_flashdata('notif-success', 'Data has been successfully inserted. '.anchor('/admin4739/team/add', 'Add Team').'');
						
						}
							
						$data = array(
							'load'		=> $load,
							'clearForm'	=> TRUE,
							'status'	=> TRUE,
							'msg'		=> 'data has been successfully inserted. '.anchor('/admin4739/team', 'Go back to list').'',
						);

						echo json_encode($data);
					}	
			}
			else
			{
				//action edit
				//call method to update table
				$this->team_m->update_team($id);
				if($load == 1){
					$this->session->set_flashdata('notif-success', 'Data has been successfully updated. '.anchor('/admin4739/team/edit/'.$id , 'Edit Team').'');
				}

					$data = array(
						'load'		=> $load,
						'clearForm'	=> FALSE,
						'status'	=> TRUE,
						'msg'		=> 'data has been successfully updated. '.anchor('/admin4739/team', 'Go back to list').'',
					);

					echo json_encode($data);
			}
				
		}
	}

	/**
	 * method change_picture display change picture form 
	 * @param  int $teamid data ID
	 * @return void
	 */
	public function change_picture($teamid)
	{
		$id = $this->security->xss_clean($teamid);

		$result = $this->team_m->get_custom_by('team_id,picture','team_id',$teamid);

		$data = array(
			'path' 			=> 'assets/img/team/'.$result->picture,
			'path_action'	=> 'admin4739/team/update_picture',
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
		$config['upload_path']	= "./assets/img/team";
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

			$this->team_m->update_picture($id,$file,$path);

			if($load == 1){
			    $this->session->set_flashdata('notif-success', 'Picture has been successfully changed.');
			}

			$data = array(
				'path'		=> base_url().'/assets/img/team/'.$file,
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
			$q = $this->team_m->delete($id);
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

		$q = $this->team_m->delete_many($id);

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

	/**
	 * method check_email check email if exist from database
	 * @param  string $str email
	 * @return void
	 */
	public function check_email($str)
	{
		$id = $this->input->post('team-id');

		if(!empty($id))
		{
			return TRUE;
		}
		else
		{
			$tb = 'teams';
			$cond = array('email'=>$str);

			$check = $this->check_data($tb,$cond);

			if($check == FALSE)
			{
				$this->form_validation->set_message('check_email','The Email is exist. Try another?');
				return FALSE;
			}else
			{
				return TRUE;
			}
		}
	}

}

/* End of file team.php */
/* Location: ./application/controllers/team.php */