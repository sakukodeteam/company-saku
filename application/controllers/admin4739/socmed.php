<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Socmed extends MY_Controller {

	
	function __construct()
	{
		parent::__construct();
		$this->stencil->title('Social Media');
		//load helper and library
		$this->load->helper('dateindo');
		//load model
		$this->load->model('socmed_m');
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
		$data['caption']		= 'Social Media';
		$data['path_add'] 		= 'admin4739/socmed/add';
		$data['path_table']		= 'admin4739/socmed/get_all';
		$data['header_table']	= array('check','Social Media','Icon','Url','Action');
		$data['sort'] = "{
            				'bSortable' : false,
            				'aTargets' : [ 0,2,4 ]
          				}";
        $data['width_tr'] = '{ "sWidth": "30px", "aTargets": [ 0 ] },
          					 { "sWidth": "120px", "aTargets": [ 4 ] },';
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
		$this->datatables->select('socmed_id,socmed_name,icon,url')
						 ->from('socmeds')
						 ->where('deleted',0)
						 ->edit_column('check','<input type="checkbox" value="$1">','socmed_id')
						 ->edit_column('url','<a href="$1" target="_BLANK">$1</a>','url')
						 ->add_column('Action',
				        	'<a href="'.site_url('admin4739/socmed/view/$1').'" class="btn btn-xs btn-flat btn-info" data-toggle="tooltip" data-placement="top" title="view detail">
				        	<i class="ion ion-information-circled"></i></a>
				        	<a href="'.site_url('admin4739/socmed/edit/$1').'" class="btn btn-xs btn-flat bg-olive" data-toggle="tooltip" data-placement="top" title="edit">
				        	<i class="ion ion-edit"></i></a> 
				        	<button class="btn btn-xs btn-flat btn-danger btn-del" id=$1 data-toggle="tooltip" data-placement="top" title="delete">
				        	<i class="ion ion-trash-a"></i></button>','socmed_id');

		echo $this->datatables->generate();
	}

		/**
	 * method view to display detail data
	 * @param  int $socmed_id data ID
	 * @return void 
	 */
	public function view($socmed_id)
	{
		$id = $this->security->xss_clean($socmed_id);
		$result = $this->socmed_m->get_by('socmed_id',$id);

		if(!empty($result))
		{
			$arr_result = array(
				'Social Media' 	=> $result->socmed_name,
				'Icon'			=> $result->icon,
				'Url'			=> '<a href="'.$result->url.'" target="_BLANK">'.$result->url.'</a>'
			);
		}else
		{
			$arr_result = NULL;
		}

		$data['data'] 			= $arr_result;
		$data['path_edit']		= 'admin4739/socmed/edit/'.$id;
		$data['id']				= $id;
		$this->stencil->data($data);
		$this->stencil->paint('adm/detail_view');
	}

	/**
	 * method add to display form add
	 */
	public function add()
	{
		$icons = $this->get_icon();
			//prepare data form
			$data = array(
				'check'			=> 'valid',
				'socmed_id'		=> '',
				'socmed_name'	=> '',
				'icons'			=> $icons,
				'url'			=> '',
				'btn_submit'	=> 'Save'
			);
		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('adm/socmed_form');
	}

	/**
	 * method edit get data to store form edit
	 * @param  int $socmed_id data ID
	 * @return void
	 */
	public function edit($socmed_id)
	{
		$id = $this->security->xss_clean($socmed_id);
		$result = $this->socmed_m->get_by('socmed_id',$id);
		$icons = $this->get_icon();

		if(!empty($result))
		{
			//prepare data form
			$data = array(
				'check'			=> 'valid',
				'socmed_id'		=> $result->socmed_id,
				'socmed_name'	=> $result->socmed_name,
				'icon'			=> $result->icon,
				'icons'			=> $icons,
				'url'			=> $result->url,
				'btn_submit'	=> 'Update'
			);
		}else
		{
			$data = array(
				'check'		=> 'not valid',
			);
		}

		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('adm/socmed_form');
	}

	/**
	 * method save process saving data from form to database
	 * @return void
	 */
	function save()
	{
		$this->form_validation->set_rules('socmed-name', 'Social Media', 'trim|required|callback_check_name|xss_clean');
		$this->form_validation->set_rules('icon', 'Icon', 'trim|required|xss_clean');
		$this->form_validation->set_rules('url', 'Url', 'trim|required|min_length[5]|xss_clean|prep_url');

		$this->form_validation->set_error_delimiters('<p class="text-danger"><i class="fa fa-ban"></i> ','</p>');


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
			$id 		= $this->input->post('socmed-id');
			$load 		= $this->input->post('submit');
			$socmedname	= ucwords($this->input->post('socmed-name'));
			$icon   	= $this->input->post('icon');
			$url 		= $this->input->post('url');

			if(empty($id))
			{
				//action add
				$post = array(
					'socmed_id'	=> NULL,
					'socmed_name'	=> strip_tags($socmedname,ENT_QUOTES),
					'icon'			=> strip_tags($icon,ENT_QUOTES),
					'url'			=> strip_tags($url,ENT_QUOTES)
				);

				$this->socmed_m->insert($post);
				
					if($load == 1)
					{
						$this->session->set_flashdata('notif-success', 'Data has been successfully inserted. '.anchor('/admin4739/socmed/add', 'Add Social Media').'');	
					}
							
						$data = array(
							'load'		=> $load,
							'clearform'	=> TRUE,
							'status'	=> TRUE,
							'msg'		=> 'data has been successfully inserted. '.anchor('/admin4739/socmed', 'Go back to list').'',
						);

						echo json_encode($data);
			}
			else
			{
				//action edit
				//call method to update table
				$post = array(
					'socmed_name'	=> strip_tags($socmedname,ENT_QUOTES),
					'icon'			=> strip_tags($icon,ENT_QUOTES),
					'url'			=> strip_tags($url,ENT_QUOTES)
				);

				$this->socmed_m->update($id,$post);

				if($load == 1)
				{
					$this->session->set_flashdata('notif-success', 'Data has been successfully updated. '.anchor('/admin4739/socmed/edit/'.$id , 'Edit Social Media').'');
				}

				$data = array(
					'load'		=> $load,
					'clearform'	=> FALSE,
					'status'	=> TRUE,
					'msg'		=> 'data has been successfully updated. '.anchor('/admin4739/socmed', 'Go back to list').'',
					);

					echo json_encode($data);
			}
				
		}
	}

	/**
	 * method check_name check social media name if exist from database
	 * @param  string $str name
	 * @return void
	 */
	public function check_name($str)
	{
		$id = $this->input->post('socmed-id');

		if(!empty($id))
		{
			return TRUE;
		}
		else
		{
			$tb = 'socmeds';
			$cond = array('socmed_name'=>ucwords($str));

			$check = $this->check_data($tb,$cond);

			if($check == FALSE)
			{
				$this->form_validation->set_message('check_name','Social Media Name is exist. Try another?');
				return FALSE;
			}else
			{
				return TRUE;
			}
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
			$q = $this->socmed_m->delete($id);
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

		$q = $this->socmed_m->delete_many($id);

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

	public function get_icon()
	{
		$this->load->helper('file');

		$json = read_file('./assets/files/icon.json');

		$result = json_decode($json);

		return $result;
	}

}

/* End of file socmed.php */
/* Location: ./application/controllers/socmed.php */