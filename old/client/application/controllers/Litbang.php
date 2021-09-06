<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Litbang extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Litbang_model');
	}

	public function index($content = 'sosial-pemerintahan')
	{
		$data					= $this->__getContentData($content, 'index');
		$data['new_articles']	= $this->Litbang_model->getNewArticle();
		$this->load->view('templates/header');
		$this->load->view('templates/head-content', $data);
		$this->load->view('pages/litbang/'.$content);
		$this->load->view('templates/footer');
	}

	public function detail($content, $slug) {
		$data					= $this->__getContentData($content, 'detail', $slug);
		$data['new_articles']	= $this->Litbang_model->getNewArticle();
		$this->load->view('templates/header');
		$this->load->view('templates/head-content', $data);
		$this->load->view('pages/litbang/'.$content.'-detail');
		$this->load->view('templates/footer');
	}

	protected function __getContentData($content, $function = 'index', $slug = NULL) {
		if($function == 'index') {
			if($content == 'sosial-pemerintahan') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head']		= 'Sosial Ekonomi dan Pemerintahan';
				$data['content']	= 'Publikasi jurnal tema sosial ekonomi dan pemerintahan.';
				$data['title']		= 'Sosial Ekonomi dan Pemerintahan';
				$data['link_map']	= [
					[
						'title'	=> 'beranda',
						'slug'	=> base_url()
					],
					[
						'title'	=> 'hasil kelitbangan',
						'slug'	=> NULL
					],
					[
						'title'	=> 'sosial ekonomi dan pemerintahan',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'Pembangunan, Inovasi dan Teknologi',
						'slug'	=> base_url('litbang/ekonomi-pembangunan'),
						'total'	=> $this->Litbang_model->getTotalData('ekonomi-pembangunan', 'articles')
					],
					// [
					// 	'title'	=> 'Inovasi dan Pelayanan Publik',
					// 	'slug'	=> base_url('litbang/inovasi-pelayanan-publik'),
					// 	'total' => $this->Litbang_model->getTotalData('inovasi-pelayanan-publik', 'articles')
					// ]
				];
				
				return $data;
			}else if($content == 'ekonomi-pembangunan') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head']		= 'Pembangunan, Inovasi dan Teknologi';
				$data['content']	= 'Publikasi jurnal tema pembangunan, inovasi dan teknologi.';
				$data['title']		= 'Pembangunan, Inovasi dan Teknologi';
				$data['link_map']	= [
					[
						'title'	=> 'beranda',
						'slug'	=> base_url()
					],
					[
						'title'	=> 'hasil kelitbangan',
						'slug'	=> NULL
					],
					[
						'title'	=> 'pembangunan, inovasi dan teknologi',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'Sosial Ekonomi dan Pemerintahan',
						'slug'	=> base_url('litbang/sosial-pemerintahan'),
						'total'	=> $this->Litbang_model->getTotalData('sosial-pemerintahan', 'articles')
					],
					// [
					// 	'title'	=> 'Inovasi dan Pelayanan Publik',
					// 	'slug'	=> base_url('litbang/inovasi-pelayanan-publik'),
					// 	'total' => $this->Litbang_model->getTotalData('inovasi-pelayanan-publik', 'articles')
					// ]
				];
				
				return $data;
			}else if($content == 'inovasi-pelayanan-publik') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head']		= 'Inovasi dan Pelayanan Publik';
				$data['content']	= 'Publikasi jurnal tema inovasi dan pelayanan publik.';
				$data['title']		= 'Inovasi dan Pelayanan Publik';
				$data['link_map']	= [
					[
						'title'	=> 'beranda',
						'slug'	=> base_url()
					],
					[
						'title'	=> 'hasil kelitbangan',
						'slug'	=> NULL
					],
					[
						'title'	=> 'inovasi dan pelayanan publik',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'Sosial dan Pemerintahan',
						'slug'	=> base_url('litbang/sosial-pemerintahan'),
						'total'	=> $this->Litbang_model->getTotalData('sosial-pemerintahan', 'articles')
					],
					[
						'title'	=> 'Ekonomi dan Pembangunan',
						'slug'	=> base_url('litbang/ekonomi-pembangunan'),
						'total' => $this->Litbang_model->getTotalData('ekonomi-pembangunan', 'articles')
					]
				];
				
				return $data;
			}
		}else if($function == 'detail') {
			if($content == 'sosial-pemerintahan') {
				$data['results']	= $this->Litbang_model->getDetailData('articles', $slug);
				$data['head']		= 'Sosial Ekonomi dan Pemerintahan';
				$data['content']	= 'Publikasi jurnal tema sosial ekonomi dan pemerintahan.';
				$data['title']		= 'Sosial Ekonomi dan Pemerintahan';
				$data['link_map']	= [
					[
						'title'	=> 'beranda',
						'slug'	=> base_url()
					],
					[
						'title'	=> 'jurnal',
						'slug'	=> NULL
					],
					[
						'title'	=> 'sosial ekonomi dan pemerintahan',
						'slug'	=> base_url('litbang/sosial-pemerintahan')
					],
					[
						'title'	=> 'detail jurnal',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'Pembangunan, Inovasi dan Teknologi',
						'slug'	=> base_url('litbang/ekonomi-pembangunan'),
						'total'	=> NULL
					],
					// [
					// 	'title'	=> 'Inovasi dan Pelayanan Publik',
					// 	'slug'	=> base_url('litbang/inovasi-pelayanan-publik'),
					// 	'total' => NULL
					// ]
				];
	
				return $data;
			}else if($content == 'ekonomi-pembangunan') {
				$data['results']	= $this->Litbang_model->getDetailData('articles', $slug);
				$data['head']		= 'Pembangunan, Inovasi dan Teknologi';
				$data['content']	= 'Publikasi jurnal tema pembangunan, inovasi dan teknologi.';
				$data['title']		= 'Pembangunan, Inovasi dan Teknologi';
				$data['link_map']	= [
					[
						'title'	=> 'beranda',
						'slug'	=> base_url()
					],
					[
						'title'	=> 'hasil kelitbangan',
						'slug'	=> NULL
					],
					[
						'title'	=> 'pembangunan, inovasi dan teknologi',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'Sosial Ekonomi dan Pemerintahan',
						'slug'	=> base_url('litbang/sosial-pemerintahan'),
						'total'	=> $this->Litbang_model->getTotalData('sosial-pemerintahan', 'articles')
					],
					// [
					// 	'title'	=> 'Inovasi dan Pelayanan Publik',
					// 	'slug'	=> base_url('litbang/inovasi-pelayanan-publik'),
					// 	'total' => $this->Litbang_model->getTotalData('inovasi-pelayanan-publik', 'articles')
					// ]
				];
	
				return $data;
			}else if($content == 'inovasi-pelayanan-publik') {
				$data['results']	= $this->Litbang_model->getDetailData('articles', $slug);
				$data['head']		= 'Inovasi dan Pelayanan Publik';
				$data['content']	= 'Publikasi jurnal tema inovasi dan pelayanan publik.';
				$data['title']		= 'Inovasi dan Pelayanan Publik';
				$data['link_map']	= [
					[
						'title'	=> 'beranda',
						'slug'	=> base_url()
					],
					[
						'title'	=> 'hasil kelitbangan',
						'slug'	=> NULL
					],
					[
						'title'	=> 'inovasi dan pelayanan publik',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'Sosial dan Pemerintahan',
						'slug'	=> base_url('litbang/sosial-pemerintahan'),
						'total'	=> $this->Litbang_model->getTotalData('sosial-pemerintahan', 'articles')
					],
					[
						'title'	=> 'Ekonomi dan Pembangunan',
						'slug'	=> base_url('litbang/ekonomi-pembangunan'),
						'total' => $this->Litbang_model->getTotalData('ekonomi-pembangunan', 'articles')
					]
				];
	
				return $data;
			}
		}
	}

	protected function __getPagination($content, $table, $per_page = 10) {
		// Pagination confoguration
		$config['base_url'] 	= base_url('litbang/').$content; //site url
		$config['total_rows'] 	= $this->Litbang_model->getTotalData($content, $table); //total row
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
		$data['results'] 			= $this->Litbang_model->getContentData($content, $table, $config["per_page"], $data['page']);           
	
		$data['pagination'] 		= $this->pagination->create_links();

		return $data;
	}

}
