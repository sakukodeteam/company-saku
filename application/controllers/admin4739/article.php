<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->stencil->title('Article');
		//load helper and library
		$this->load->helper(array('dateindo','text','company'));
		//load model
		$this->load->model(array('blog_article_m','blog_category_m','blog_comment_m'));
		$this->stencil->css('admin/bootstrap-tokenfield/bootstrap-tokenfield.min');
		$this->stencil->js('admin/plugins/bootstrap-tokenfield/bootstrap-tokenfield.min');
		$this->stencil->js('admin/plugins/ckeditor/ckeditor');

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
		$data['caption']		= 'Article';
		$data['path_add'] 		= 'admin4739/article/add';
		$data['path_table']		= 'admin4739/article/get_all';
		$data['header_table']	= array('check','Title','Keyword','Author','Category','Status','Action');
		$data['sort'] = "{
            				'bSortable' : false,
            				'aTargets' : [ 0,2,6 ]
          				}";
        $data['width_tr'] = '{ "sWidth": "30px", "aTargets": [ 0 ] },
          					 { "sWidth": "240px", "aTargets": [ 1 ] },
          					 { "sWidth": "80px", "aTargets": [ 5 ] },
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
		$author_id = $this->tank_auth->get_user_id();
		//$path_pic = 'assets/img/portofolio/';
		//load library datatables
		$this->load->library('datatables');
		//get data
		$this->datatables->select('article_id,article_title,Keyword,username,category_name,status')
						 ->from('blog_articles')
						 ->join('blog_categories','blog_categories.category_id=blog_articles.category_id')
						 ->join('users','users.id=blog_articles.author_id')
						 ->where('blog_articles.deleted',0)
						 ->where('blog_articles.author_id',$author_id)
						 ->edit_column('check','<input type="checkbox" value="$1">','article_id')
						 ->edit_column('status','<span class="badge bg-green">$1</span>','status')
						 ->add_column('Action',
				        	'<a href="'.site_url('admin4739/article/view/$1').'" class="btn btn-xs btn-flat btn-info" data-toggle="tooltip" title="view detail">
				        	<i class="ion ion-information-circled"></i></a>
				        	<a href="'.site_url('admin4739/article/edit/$1').'" class="btn btn-xs btn-flat bg-olive" data-toggle="tooltip" title="edit">
				        	<i class="ion ion-edit"></i></a>
				        	<a href="'.site_url('admin4739/article/change-picture/$1').'" class="btn btn-xs btn-flat bg-maroon" data-toggle="tooltip" title="edit">
				        	<i class="ion ion-image"></i></a>
				        	<button class="btn btn-xs btn-flat btn-danger btn-del" id=$1 data-toggle="tooltip" data-placement="top" title="delete">
				        	<i class="ion ion-trash-a"></i></button>','article_id');

		echo $this->datatables->generate();
	}

	
	/**
	 * method view to display detail data
	 * @param  int $article_id data ID
	 * @return void 
	 */
	public function view($article_id)
	{
		$id = $this->security->xss_clean($article_id);
		$post = $this->blog_article_m->with('blog_categories')
									 ->with('users')
									 ->with('blog_comments')
                         			 ->get_by('article_id',$id);
        if(!empty($post)){
	        //set the variable $title into view
			$this->stencil->title($post->article_title);
			//set metadata
			$cont = word_limiter($post->content,50);
	        $cont2 = html_entity_decode($cont);
			$this->stencil->meta(array(
	            'author' => $post->users->username,
	            'description' =>$cont2,
	            'keywords' => $post->keyword
	        ));
			
			//get data 
			$data['post'] = $post;
		}else{
			$data['post'] = null;
		}
		$this->stencil->paint('adm/detail_article',$data);
	}

	/**
	 * method add to display form add
	 */
	public function add()
	{
		//prepare data form
		$data = array(
			'check'			=> 'valid',
			'article_id'	=> NULL,
			'category_id'	=> '',
			'category_name' => '',
			'list_category' => category(),
			'article_title'	=> '',
			'keyword'		=> '',
			'status'		=> 'publish',
			'content'		=> '',
			'btn_submit'	=> 'Save'
		);
		//push data to view
		$this->stencil->data($data);
		$this->stencil->paint('adm/article_form',$data);
	}

	/**
	 * method edit get data to store form edit
	 * @param  int $article_id data ID
	 * @return void
	 */
	public function edit($article_id)
	{
		$id = $this->security->xss_clean($article_id);
		$result = $this->blog_article_m->with('blog_categories')->get_by('article_id',$id);

		if(!empty($result))
		{
			//prepare data form
			$data = array(
				'check'			=> 'valid',
				'article_id'	=> $result->article_id,
				'category_id'	=> $result->blog_categories->category_id,
				'category_name'	=> $result->blog_categories->category_name,
				'list_category' => category(),
				'article_title'	=> $result->article_title,
				'keyword'		=> $result->keyword,
				'status'		=> $result->status,
				'picture'		=> $result->picture,
				'content'		=> $result->content,
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
		$this->stencil->paint('adm/article_form');
	}

	/**
	 * method save process saving data from form to database
	 * @return void
	 */
	function save()
	{
		$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[5]|xss_clean|callback_check_title');
		$this->form_validation->set_rules('keyword', 'Keyword', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('category', 'Category', 'trim|required|xss_clean');
		$this->form_validation->set_rules('content', 'Content', 'trim|required|min_length[5]|xss_clean');

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
			$id 	= $this->input->post('article-id');
			$load 	= $this->input->post('submit');
			$title  = $this->input->post('title');
			$file   = strtolower(url_title($title));

			if(empty($id))
			{
				//action add
				//process upload picture
				$this->load->library('upload');
				$config['upload_path']	= "./assets/img/article";
		        $config['allowed_types']= 'gif|jpg|png|jpeg';
		        $config['file_name'] = $file;
				$config['overwrite'] = FALSE;
		        $config['max_size']     = '300';
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
						$upload	   = $this->upload->data();
						$filename  = $upload['file_name']; 
						//call method to insert table
						$this->blog_article_m->add_article($filename);
						if($load == 1){
							$this->session->set_flashdata('notif-success', 'Data has been successfully inserted. '.anchor('/admin4739/article/add', 'Add Article').'');
						
						}
							
						$data = array(
							'load'		=> $load,
							'clearForm'	=> TRUE,
							'status'	=> TRUE,
							'msg'		=> 'data has been successfully inserted. '.anchor('/admin4739/article', 'Go back to list').'',
						);

						echo json_encode($data);
					}	
			}
			else
			{
				//action edit
				//call method to update table
				$this->blog_article_m->update_article($id);
				if($load == 1){
					$this->session->set_flashdata('notif-success', 'Data has been successfully updated. '.anchor('/admin4739/article/edit/'.$id , 'Edit Article').'');
				}

					$data = array(
						'load'		=> $load,
						'clearForm'	=> FALSE,
						'status'	=> TRUE,
						'msg'		=> 'data has been successfully updated. '.anchor('/admin4739/article', 'Go back to list').'',
					);

					echo json_encode($data);
			}
				
		}
	}

	/**
	 * method change_picture display change picture form 
	 * @param  int $article_id data ID
	 * @return void
	 */
	public function change_picture($article_id)
	{
		$id = $this->security->xss_clean($article_id);

		$result = $this->blog_article_m->get_custom_by('article_id,picture','article_id',$article_id);

		$data = array(
			'path' 			=> 'assets/img/article/'.$result->picture,
			'path_action'	=> 'admin4739/article/update_picture',
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
		$config['upload_path']	= "./assets/img/article";
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

			$this->blog_article_m->update_picture($id,$file,$path);

			if($load == 1){
			    $this->session->set_flashdata('notif-success', 'Picture has been successfully changed.');
			}

			$data = array(
				'path'		=> base_url().'/assets/img/article/'.$file,
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
			$q = $this->blog_article_m->delete($id);
			if($q)
			{
				$this->blog_comment_m->delete_by('article_id',$id);
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

		$q = $this->blog_article_m->delete_many($id);

		if($q)
		{
			$this->blog_comment_m->delete_by('article_id',$id);
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

	public function change_status()
	{
		$id_post = $this->input->post('id');
		$status  = $this->input->post('status');

		$id 	 = $this->security->xss_clean($id_post);

		if(!empty($id))
		{
			$data = array('status'=>$status);
			$q = $this->blog_article_m->update($id,$data);
			if($q)
			{
				$this->session->set_flashdata('notif-success','Article has been successfully change status.');
				
				redirect('admin4739/article/view/'.$id);
			}
			else
			{
				$this->session->set_flashdata('notif-error','Failed change status.');
				
				redirect('admin4739/article/view/'.$id);
			}
		}
		else if(empty($id))
		{
			$this->session->set_flashdata('notif-error','ID Null. System Error');
			
			redirect('admin4739/article/view/'.$id);
		}

	}

	/**
	 * method check_name check article title if exist from database
	 * @param  string $str title
	 * @return void
	 */
	public function check_title($str)
	{
		$id = $this->input->post('article-id');

		if(!empty($id))
		{
			return TRUE;
		}
		else
		{
			$tb = 'blog_articles';
			$cond = array('article_title'=>ucwords($str));

			$check = $this->check_data($tb,$cond);

			if($check == FALSE)
			{
				$this->form_validation->set_message('check_title','Title is exist. Try another?');
				return FALSE;
			}else
			{
				return TRUE;
			}
		}
	}

	public function send_comment($id_article)
	{
		$id = $this->security->xss_clean($id_article);

		$this->form_validation->set_rules('comment', 'Comment', 'trim|required|min_length[5]|xss_clean');

		$this->form_validation->set_error_delimiters('<p class="text-danger"><i class="fa fa-ban"></i> ','</p>');

		if($this->form_validation->run() == FALSE)
		{
			$data = array(
				'status' => FALSE,
				'msg'	 => validation_errors()
			);

			echo json_encode($data);
		}
		else
		{
			$email 		= company('email');
			$url   		= company('url');
			$name  		= $this->tank_auth->get_username();
			$content 	= $this->input->post('comment');
			$avatar		= 'admin.jpg';
			$parent_id	= 0;

			$data = array(
				'comment_id'	=> NULL,
				'article_id'	=> $id,
				'name'			=> strip_tags($name,ENT_QUOTES),
				'email'			=> $email,
				'url'			=> $url,
				'content'		=> strip_tags($content,ENT_QUOTES),
				'avatar'		=> $avatar,
				'parent_id'		=> $parent_id
			);

			$check = $this->blog_comment_m->insert($data);

			if(!empty($check))
			{
				$this->session->set_flashdata('notif-success', ' successfully add comment');
				$data = array(
					'status'	=> TRUE
				);

				echo json_encode($data);
			}
			else
			{
				$data = array(
					'status' => FALSE,
					'msg'	 => 'Failed add comment'
				);

				echo json_encode($data);
			}
		}
	}

	public function reply_comment($id_article,$parent_id)
	{
		$id = $this->security->xss_clean($id_article);

		$this->form_validation->set_rules('comment-reply', 'Comment', 'trim|required|min_length[5]|xss_clean');

		$this->form_validation->set_error_delimiters('<p class="text-danger"><i class="fa fa-ban"></i> ','</p>');

		if($this->form_validation->run() == FALSE)
		{
			$data = array(
				'status' => FALSE,
				'msg'	 => validation_errors()
			);

			echo json_encode($data);
		}
		else
		{
			$email 		= company('email');
			$url   		= company('url');
			$name  		= $this->tank_auth->get_username();
			$content 	= $this->input->post('comment-reply');
			$avatar		= 'admin.jpg';

			$data = array(
				'comment_id'	=> NULL,
				'article_id'	=> $id,
				'name'			=> strip_tags($name,ENT_QUOTES),
				'email'			=> $email,
				'url'			=> $url,
				'content'		=> strip_tags($content,ENT_QUOTES),
				'avatar'		=> $avatar,
				'parent_id'		=> $parent_id
			);

			$check = $this->blog_comment_m->insert($data);

			if(!empty($check))
			{
				$this->session->set_flashdata('notif-success', ' successfully add comment');
				$data = array(
					'status'	=> TRUE
				);

				echo json_encode($data);
			}
			else
			{
				$data = array(
					'status' => FALSE,
					'msg'	 => 'Failed add comment'
				);

				echo json_encode($data);
			}
		}
	}

	public function delete_comment($id_post,$article_id)
	{
		$id = $this->security->xss_clean($id_post);

		if(!empty($id))
		{
			$check = $this->blog_comment_m->delete($id);

			if($check)
			{
				$this->session->set_flashdata('notif-success', 'Successfully deleted comment');

				redirect('admin4739/article/view/'.$article_id);
			}
			else
			{
				$this->session->set_flashdata('notif-error', 'Failed deleted comment');

				redirect('admin4739/article/view/'.$article_id);
			}
		}
		else
		{
			$this->session->set_flashdata('notif-error', 'No ID selected');
			
			redirect('admin4739/article');
		}
	}

	public function delete_all_comment($article_id)
	{
		$id = $this->security->xss_clean($article_id);

		if(!empty($id))
		{
			$check = $this->blog_comment_m->delete_by('article_id',$id);

			if($check)
			{
				$this->session->set_flashdata('notif-success', 'Successfully deleted comment');

				redirect('admin4739/article/view/'.$id);
			}
			else
			{
				$this->session->set_flashdata('notif-error', 'Failed deleted comment');

				redirect('admin4739/article/view/'.$id);
			}
		}
		else
		{
			$this->session->set_flashdata('notif-error', 'No ID selected');
			
			redirect('admin4739/article');
		}
	}

}

/* End of file article.php */
/* Location: ./application/controllers/article.php */