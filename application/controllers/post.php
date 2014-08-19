<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//load library and helper
		$this->load->library('pagination');
		$this->load->helper(array('dateindo','text'));
		//load models
		$this->load->model(array('blog_article_m','blog_comment_m','blog_category_m'));
		//Sets the variable $head to use the slice head (/views/slices/head.php)
		$this->stencil->slice('head');
		//Sets the variable $head to use the slice header (/views/slices/header.php)
		$this->stencil->slice('header');
		//Sets the variable $sidebar to use the slice sidebar (/views/slices/sidebar.php)
		$this->stencil->slice('sidebar');
		//Sets the variable $head to use the slice bottom (/views/slices/bottom.php)
		$this->stencil->slice('bottom');
	}

	public function index($offset=0)
	{
		//set the variable $title into view
		$this->stencil->title('Blog');
		//set metadata
		$this->stencil->meta(array(
            'author' => 'Sakukode Team',
            'description' => 'Kumpulan artikel dunia komputer dan pengetahuan umum yang menarik',
            'keywords' => 'sakukode,blog,artikel'
        ));
		//set the layout to be default
		$this->stencil->layout('blog_layout');
		//create paging
		$limit = 3;
		$total = $this->blog_article_m->count_all();
		//config paging
		$config['base_url'] 	= base_url().'blog/post';
		$config['total_rows']	= $total;
		$config['per_page']		= $limit;
		$config['uri_segment']  = 3;
		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$config['first_link'] = '&laquo; Awal';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Akhir &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config); 											
		$data['pagination'] = $this->pagination->create_links();

		//get data from model
		$data['posts']	= $this->blog_article_m->limit($limit,$offset)
									   ->order_by('date','ASC')
									   ->with('blog_categories')
									   ->with('users')
									   ->get_all();
		//render blog_view to template (/views/pages/blog_view.php)
		$this->stencil->paint('blog_view',$data);
	}

	/**
	 * method to view post item
	 * @param  [string] $slug [article url variale]
	 * @return json
	 */
	function view($slug)
	{
		$url = str_replace("'", "", $slug);
		$post = $this->blog_article_m->with('blog_categories')
									 ->with('users')
									 ->with('blog_comments')
									 ->order_by('date','DESC')
                         			 ->get_by('article_url',$url);
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
		//set the layout to be default
		$this->stencil->layout('blog_layout');
		//render blog_detail_view to template (/views/pages/blog_detail_view.php)
		$this->stencil->paint('blog_detail_view',$data);
	}

	/**
	 * method to submit/send comment
	 * @param int $post_id article id variable
	 * @return json
	 */
	public function send_comment($post_id)
	{
		$this->form_validation->set_rules('name', 'Nama', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'min_length[5]|valid_email|xss_clean');
		$this->form_validation->set_rules('url', 'Url', 'min_length[5]|xss_clean|prep_url');
		$this->form_validation->set_rules('comment', 'Komentar', 'trim|required|min_length[5]|xss_clean');

		$this->form_validation->set_error_delimiters('<p class="text-danger"><i class="icon-ban-circle"></i>&nbsp;','</p>');
		$this->form_validation->set_message('required','%s harus diisi');
		$this->form_validation->set_message('valid_email','%s tidak valid');
		$this->form_validation->set_message('min_length','%s minimal terdiri dari %s karakter');

		//if validation false, return FALSE and set message errors
		if($this->form_validation->run() == FALSE)
		{
			$data = array(
				'status' 	=> FALSE,
				'msg'		=> validation_errors()
			);

			echo json_encode($data);
		}//if validation true, insert comment to database 
		else
		{
			$check = $this->blog_comment_m->send($post_id);

			if($check == true)
			{
				$visitor = $this->input->post('name');
				$this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissable" id="notice-comment">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p>Terima kasih '.$visitor.' telah berkomentar.</p>
                </div>');

				$data = array(
					'status'	=> TRUE,
				);				

				echo json_encode($data);
			}
			else
			{
				$data = array('status' => 'errors','msg' =>'Gagal Berkomentar');

				echo json_encode($data);
			}
		}
	}


	/**
	 * method to reply comment
	 * @param  int $post_id   article id variable
	 * @param  int $parent_id comment parent id variable
	 * @return json
	 */
	public function reply_comment($post_id,$parent_id)
	{
		$this->form_validation->set_rules('name2', 'Nama', 'trim|required|min_length[3]|xss_clean');
		$this->form_validation->set_rules('email2', 'Email', 'min_length[5]|valid_email|xss_clean');
		$this->form_validation->set_rules('url2', 'Url', 'min_length[5]|xss_clean|prep_url');
		$this->form_validation->set_rules('comment2', 'Komentar', 'trim|required|min_length[5]|xss_clean');

		$this->form_validation->set_error_delimiters('<p class="text-danger"><i class="icon-ban-circle"></i>&nbsp;','</p>');
		$this->form_validation->set_message('required','%s harus diisi');
		$this->form_validation->set_message('valid_email','%s tidak valid');
		$this->form_validation->set_message('min_length','%s minimal terdiri dari %s karakter');

		//if validation false, return FALSE and set message errors
		if($this->form_validation->run() == FALSE)
		{
			$data = array(
				'status' 	=> FALSE,
				'msg'		=> validation_errors()
			);

			echo json_encode($data);
		}//if validation true, insert comment to database 
		else
		{
			$check = $this->blog_comment_m->reply($post_id,$parent_id);

			if($check == true)
			{
				$visitor = $this->input->post('name2');
				$this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissable" id="notice-comment">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p>Terima kasih '.$visitor.' telah berkomentar.</p>
                </div>');

				$data = array(
					'status'	=> TRUE,
				);				

				echo json_encode($data);
			}
			else
			{
				$data = array('status' => 'errors','msg' =>'Gagal Berkomentar');

				echo json_encode($data);
			}
		}
	}

	/**
	 * method to get post/article per category
	 * @param  string  $slug   variable url categories
	 * @param  int $offset offset pagination
	 * @return data
	 */
	public function categories($slug,$offset=0)
	{
		//set the variable $title into view
		$title = str_replace("-", " ", $slug);
		$this->stencil->title(ucfirst($title));
		//set metadata
		$this->stencil->meta(array(
            'author' => 'Sakukode Team',
            'description' => 'Kumpulan artikel dunia komputer dan pengetahuan umum yang menarik',
            'keywords' => 'sakukode,blog,article','category','post'
        ));
		//set the layout to be default
		$this->stencil->layout('blog_layout');
		//create paging
		$limit = 1;
		$cat_id = $this->blog_category_m->get_id($slug);
		$total = $this->blog_article_m->total_percategory($cat_id);
		//config paging
		$config['base_url'] 	= base_url().'blog/categories/'.$slug;
		$config['total_rows']	= $total;
		$config['per_page']		= $limit;
		$config['uri_segment']  = 4;
		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$config['first_link'] = '&laquo; Awal';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Akhir &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config); 											
		$data['pagination'] = $this->pagination->create_links();

		//get data from model
		$data['posts']	= $this->blog_article_m->limit($limit,$offset)
									   ->order_by('date','ASC')
									   ->with('blog_categories')
									   ->with('users')
									   ->get_many_by('category_id',$cat_id);
		//render blog_view to template (/views/pages/blog_view.php)
		$this->stencil->paint('blog_view',$data);
	}

	public function search()
	{
		
	}	

}

/* End of file post.php */
/* Location: ./application/controllers/post.php */