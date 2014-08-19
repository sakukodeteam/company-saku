<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->stencil->title('Service');
		//load helper and library
		$this->load->helper('dateindo');
		//load model
		$this->load->model('service_m');
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
		$data['caption']		= 'Service';
		$data['path_add'] 		= 'admin4739/service/add';
		$data['path_table']		= 'admin4739/service/get_all';
		$data['header_table']	= array('check','Service Name','Icon','Description','Action');
		$data['sort'] = "{
            				'bSortable' : false,
            				'aTargets' : [ 0,2,3,4 ]
          				}";
        $data['width_tr'] = '{ "sWidth": "30px", "aTargets": [ 0 ] },
          					 { "sWidth": "300px", "aTargets": [ 3 ] },
          					 { "sWidth": "90px", "aTargets": [ 4 ] },';
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
		$this->datatables->select('service_id,service_name,icon,description')
						 ->from('services')
						 ->where('deleted',0)
						 ->edit_column('check','<input type="checkbox" value="$1">','service_id')
						 ->add_column('Action',
				        	'<a href="'.site_url('admin4739/service/view/$1').'" class="btn btn-xs btn-flat btn-info" data-toggle="tooltip" data-placement="top" title="view detail">
				        	<i class="ion ion-information-circled"></i></a>
				        	<a href="'.site_url('admin4739/service/edit/$1').'" class="btn btn-xs btn-flat bg-olive" data-toggle="tooltip" data-placement="top" title="edit">
				        	<i class="ion ion-edit"></i></a>
				        	<button class="btn btn-xs btn-flat btn-danger btn-del" id=$1 data-toggle="tooltip" data-placement="top" title="delete">
				        	<i class="ion ion-trash-a"></i></button>','service_id');

		echo $this->datatables->generate();
	}

		/**
	 * method view to display detail data
	 * @param  int $porto_id data ID
	 * @return void 
	 */
	public function view($serv_id)
	{
		$id = $this->security->xss_clean($serv_id);
		$result = $this->service_m->get_by('service_id',$id);

		if(!empty($result))
		{
			$arr_result = array(
				'Service Name' 	=> $result->service_name,
				'Icon'			=> $result->icon,
				'Description'		=> $result->description
			);
		}else
		{
			$arr_result = NULL;
		}

		$data['data'] 			= $arr_result;
		$data['path_edit']		= 'admin4739/service/edit/'.$id;
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
			'serv_id'	=> NULL,
			'serv_name'	=> '',
			'icon'		=> '',
			'desc'		=> '',
			'btn_submit'=> 'Save'
		);
		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('adm/service_form');
	}

	/**
	 * method edit get data to store form edit
	 * @param  int $serv_id data ID
	 * @return void
	 */
	public function edit($serv_id)
	{
		$id = $this->security->xss_clean($serv_id);
		$result = $this->service_m->get_by('service_id',$id);

		if(!empty($result))
		{
			//prepare data form
			$data = array(
				'check'		=> 'valid',
				'serv_id'	=> $result->service_id,
				'serv_name'	=> $result->service_name,
				'icon'		=> $result->icon,
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
		$this->stencil->paint('adm/service_form');
	}

	/**
	 * method save process saving data from form to database
	 * @return void
	 */
	function save()
	{
		$this->form_validation->set_rules('serv-name', 'Service Name', 'trim|required|min_length[5]|callback_check_name|xss_clean');
		$this->form_validation->set_rules('icon', 'Icon', 'trim|required|xss_clean');
		$this->form_validation->set_rules('desc', 'Description', 'trim|required|min_length[5]|xss_clean');

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
			$id 		= $this->input->post('serv-id');
			$load 		= $this->input->post('submit');
			$servname  	= ucwords($this->input->post('serv-name'));
			$icon   	= $this->input->post('icon');
			$desc 		= $this->input->post('desc');

			if(empty($id))
			{
				//action add
				$post = array(
					'service_id'	=> NULL,
					'service_name'	=> strip_tags($servname,ENT_QUOTES),
					'icon'			=> strip_tags($icon,ENT_QUOTES),
					'description'	=> htmlentities($desc,ENT_QUOTES,"UTF-8")
				);

				$this->service_m->insert($post);
				
					if($load == 1)
					{
						$this->session->set_flashdata('notif-success', 'Data has been successfully inserted. '.anchor('/admin4739/service/add', 'Add Team').'');	
					}
							
						$data = array(
							'load'		=> $load,
							'clearform'	=> TRUE,
							'status'	=> TRUE,
							'msg'		=> 'data has been successfully inserted. '.anchor('/admin4739/service', 'Go back to list').'',
						);

						echo json_encode($data);
			}
			else
			{
				//action edit
				//call method to update table
				$post = array(
					'service_name'	=> strip_tags($servname,ENT_QUOTES),
					'icon'			=> strip_tags($icon,ENT_QUOTES),
					'description'	=> htmlentities($desc,ENT_QUOTES,"UTF-8")
				);

				$this->service_m->update($id,$post);

				if($load == 1)
				{
					$this->session->set_flashdata('notif-success', 'Data has been successfully updated. '.anchor('/admin4739/service/edit/'.$id , 'Edit Service').'');
				}

				$data = array(
					'load'		=> $load,
					'clearform'	=> FALSE,
					'status'	=> TRUE,
					'msg'		=> 'data has been successfully updated. '.anchor('/admin4739/service', 'Go back to list').'',
					);

					echo json_encode($data);
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
			$q = $this->service_m->delete($id);
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

		$q = $this->service_m->delete_many($id);

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
	 * method check_name check service name if exist from database
	 * @param  string $str name
	 * @return void
	 */
	public function check_name($str)
	{
		$id = $this->input->post('serv-id');

		if(!empty($id))
		{
			return TRUE;
		}
		else
		{
			$tb = 'services';
			$cond = array('service_name'=>ucwords($str));

			$check = $this->check_data($tb,$cond);

			if($check == FALSE)
			{
				$this->form_validation->set_message('check_name','Service Name is exist. Try another?');
				return FALSE;
			}else
			{
				return TRUE;
			}
		}
	}

}

/* End of file service.php */
/* Location: ./application/controllers/service.php */