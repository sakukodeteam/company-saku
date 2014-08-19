<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->stencil->title('Blog Category');
		//load helper and library
		$this->load->helper('dateindo');
		//load model
		$this->load->model('blog_category_m');
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
		$data['caption']		= 'Blog Category';
		$data['path_add'] 		= 'admin4739/category/add';
		$data['path_table']		= 'admin4739/category/get_all';
		$data['header_table']	= array('check','Category Name','Url','Description','Action');
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
		$this->datatables->select('category_id,category_name,category_url,description')
						 ->from('blog_categories')
						 ->where('deleted',0)
						 ->edit_column('check','<input type="checkbox" value="$1">','category_id')
						 ->add_column('Action',
				        	'<a href="'.site_url('admin4739/category/view/$1').'" class="btn btn-xs btn-flat btn-info" data-toggle="tooltip" data-placement="top" title="view detail">
				        	<i class="ion ion-information-circled"></i></a>
				        	<a href="'.site_url('admin4739/category/edit/$1').'" class="btn btn-xs btn-flat bg-olive" data-toggle="tooltip" data-placement="top" title="edit">
				        	<i class="ion ion-edit"></i></a>
				        	<button class="btn btn-xs btn-flat btn-danger btn-del" id=$1 data-toggle="tooltip" data-placement="top" title="delete">
				        	<i class="ion ion-trash-a"></i></button>','category_id');

		echo $this->datatables->generate();
	}

		/**
	 * method view to display detail data
	 * @param  int $porto_id data ID
	 * @return void 
	 */
	public function view($category_id)
	{
		$id = $this->security->xss_clean($category_id);
		$result = $this->blog_category_m->get_by('category_id',$id);

		if(!empty($result))
		{
			$arr_result = array(
				'Category Name' 	=> $result->category_name,
				'Category Url'		=> $result->category_url,
				'Description'		=> $result->description
			);
		}else
		{
			$arr_result = NULL;
		}

		$data['data'] 			= $arr_result;
		$data['path_edit']		= 'admin4739/category/edit/'.$id;
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
			'check'			=> 'valid',
			'category_id'	=> NULL,
			'category_name'	=> '',
			'desc'			=> '',
			'btn_submit'	=> 'Save'
		);
		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('adm/category_form');
	}

	/**
	 * method edit get data to store form edit
	 * @param  int $category_id data ID
	 * @return void
	 */
	public function edit($category_id)
	{
		$id = $this->security->xss_clean($category_id);
		$result = $this->blog_category_m->get_by('category_id',$id);

		if(!empty($result))
		{
			//prepare data form
			$data = array(
				'check'			=> 'valid',
				'category_id'	=> $result->category_id,
				'category_name'	=> $result->category_name,
				'desc'			=> $result->description,
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
		$this->stencil->paint('adm/category_form');
	}

	/**
	 * method save process saving data from form to database
	 * @return void
	 */
	function save()
	{
		$this->form_validation->set_rules('category-name', 'Category Name', 'trim|required|min_length[3]|xss_clean|callback_check_name');
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
			$id 		= $this->input->post('category-id');
			$load 		= $this->input->post('submit');
			$catname  	= ucwords($this->input->post('category-name'));
			$caturl 	= strtolower(url_title($this->input->post('category-name')));
			$desc 		= $this->input->post('desc');

			if(empty($id))
			{
				//action add
				$post = array(
					'category_id'	=> NULL,
					'category_name'	=> strip_tags($catname,ENT_QUOTES),
					'category_url'	=> strip_tags($caturl,ENT_QUOTES),
					'description'	=> htmlentities($desc,ENT_QUOTES,"UTF-8")
				);

				$this->blog_category_m->insert($post);
				
					if($load == 1)
					{
						$this->session->set_flashdata('notif-success', 'Data has been successfully inserted. '.anchor('/admin4739/category/add', 'Add Blog Category').'');	
					}
							
						$data = array(
							'load'		=> $load,
							'clearform'	=> TRUE,
							'status'	=> TRUE,
							'msg'		=> 'data has been successfully inserted. '.anchor('/admin4739/category', 'Go back to list').'',
						);

						echo json_encode($data);
			}
			else
			{
				//action edit
				//call method to update table
				$post = array(
					'category_name'	=> strip_tags($catname,ENT_QUOTES),
					'category_url'	=> strip_tags($caturl,ENT_QUOTES),
					'description'	=> htmlentities($desc,ENT_QUOTES,"UTF-8")
				);

				$this->blog_category_m->update($id,$post);

				if($load == 1)
				{
					$this->session->set_flashdata('notif-success', 'Data has been successfully updated. '.anchor('/admin4739/category/edit/'.$id , 'Edit Blog Category').'');
				}

				$data = array(
					'load'		=> $load,
					'clearform'	=> FALSE,
					'status'	=> TRUE,
					'msg'		=> 'data has been successfully updated. '.anchor('/admin4739/category', 'Go back to list').'',
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
			$q = $this->blog_category_m->delete($id);
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

		$q = $this->blog_category_m->delete_many($id);

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
		$id = $this->input->post('category-id');

		if(!empty($id))
		{
			return TRUE;
		}
		else
		{
			$tb = 'blog_categories';
			$cond = array('category_name'=>ucwords($str));

			$check = $this->check_data($tb,$cond);

			if($check == FALSE)
			{
				$this->form_validation->set_message('check_name','Category Name is exist. Try another?');
				return FALSE;
			}else
			{
				return TRUE;
			}
		}
	}

}

/* End of file category.php */
/* Location: ./application/controllers/category.php */