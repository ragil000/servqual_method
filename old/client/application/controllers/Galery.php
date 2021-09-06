<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galery extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Galery_model');
	}

	public function index($content = 'foto-kegiatan') {
		$data					= $this->__getContentData($content, 'index');
		$data['new_articles']	= $this->Galery_model->getNewArticle();
		$this->load->view('templates/header');
		$this->load->view('templates/head-content', $data);
		$this->load->view('pages/galery/'.$content);
		$this->load->view('templates/footer');
	}

	public function detail($content, $slug) {
		$data					= $this->__getContentData($content, 'detail', $slug);
		$data['new_articles']	= $this->Galery_model->getNewArticle();
		$this->load->view('templates/header');
		$this->load->view('templates/head-content', $data);
		$this->load->view('pages/galery/'.$content.'-detail');
		$this->load->view('templates/footer');
	}

	protected function __getContentData($content, $function = 'index', $slug = NULL) {
		if($function == 'index') {
			if($content == 'foto-kegiatan') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head'] 		= 'Foto - Foto Dokumentasi';
				$data['content']	= 'Dokumentasi netlitbang kabupaten Bombana.';
				$data['title']		= 'Foto - Foto Dokumentasi';
				$data['link_map']	= [
					[
						'title'	=> 'beranda',
						'slug'	=> base_url()
					],
					[
						'title'	=> 'galeri',
						'slug'	=> NULL
					],
					[
						'title'	=> 'foto - foto dokumentasi',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'Video Dokumentasi',
						'slug'	=> base_url('galery/video'),
						'total'	=> $this->Galery_model->getTotalData('video', 'articles')
					]
				];
				
				return $data;
			}else if($content == 'video') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head'] 		= 'Video Dokumentasai';
				$data['content']	= 'Dokumentasi Litbang kabupaten Bombana.';
				$data['title']		= 'Video Dokumentasai';
				$data['link_map']	= [
					[
						'title'	=> 'beranda',
						'slug'	=> base_url()
					],
					[
						'title'	=> 'galeri',
						'slug'	=> NULL
					],
					[
						'title'	=> 'video dokumentasi',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'Foto - Foto Dokumentasi',
						'slug'	=> base_url('galery/foto-kegiatan'),
						'total'	=> $this->Galery_model->getTotalData('foto-kegiatan', 'articles')
					]
				];
				
				return $data;
			}
		}
	}

	protected function __getPagination($content, $table, $per_page = 10) {
		// Pagination confoguration
		$config['base_url'] 	= base_url('galery/').$content; //site url
		$config['total_rows'] 	= $this->Galery_model->getTotalData($content, $table); //total row
		$config['per_page'] 	= $per_page;  //show record per halaman
		$config["uri_segment"] 	= 3;  // uri parameter
		$choice 				= $config["total_rows"] / $config["per_page"];
		$config["num_links"] 	= floor($choice);

		// Create pagination style for BootStrap v4
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = '<i class="icofont-rounded-right"></i>';
		$config['prev_link']        = '<i class="icofont-rounded-left"></i>';
		$config['full_tag_open']    = '<ul class="justify-content-center">';
		$config['full_tag_close']   = '</ul>';
		$config['num_tag_open']     = '<li>';
		$config['num_tag_close']    = '</li>';
		$config['cur_tag_open']     = '<li class="active"><a href="#">';
		$config['cur_tag_close']    = '</a></li>';
		$config['next_tag_open']    = '<li>';
		$config['next_tagl_close']  = '</li>';
		$config['prev_tag_open']    = '<li>';
		$config['prev_tagl_close']  = '</li>';
		$config['first_tag_open']   = '<li>';
		$config['first_tagl_close'] = '</li>';
		$config['last_tag_open']    = '<li>';
		$config['last_tagl_close']  = '</li>';
		$this->pagination->initialize($config);

		$data['page'] 				= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['results'] 			= $this->Galery_model->getContentData($content, $table, $config["per_page"], $data['page']);           
	
		$data['pagination'] 		= $this->pagination->create_links();

		return $data;
	}

}
