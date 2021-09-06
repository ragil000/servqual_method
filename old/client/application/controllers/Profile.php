<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Profile_model');
	}

	public function index($content = 'definisi') {
		$data					= $this->__getContentData($content, 'index');
		$data['new_articles']	= $this->Profile_model->getNewArticle();
		$this->load->view('templates/header');
		$this->load->view('templates/head-content', $data);
		$this->load->view('pages/profile/'.$content);
		$this->load->view('templates/footer');
	}

	public function detail($content, $slug) {
		$data					= $this->__getContentData($content, 'detail', $slug);
		$data['new_articles']	= $this->Profile_model->getNewArticle();
		$this->load->view('templates/header');
		$this->load->view('templates/head-content', $data);
		$this->load->view('pages/profile/'.$content.'-detail');
		$this->load->view('templates/footer');
	}

	protected function __getContentData($content, $function = 'index', $slug = NULL) {
		if($function == 'index') {
			if($content == 'definisi') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head'] 		= 'Definisi';
				$data['content']	= 'Definisi netlitbang kabupaten Bombana.';
				$data['title']		= 'Definisi';
				$data['link_map']	= [
					[
						'title'	=> 'beranda',
						'slug'	=> base_url()
					],
					[
						'title'	=> 'profil',
						'slug'	=> NULL
					],
					[
						'title'	=> 'definisi',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'Struktur Organisasi',
						'slug'	=> base_url('profile/struktur-organisasi'),
						'total'	=> NULL
					],
					[
						'title'	=> 'Regulasi',
						'slug'	=> base_url('profile/regulasi'),
						'total' => NULL
					],
					[
						'title'	=> 'Kotak Kami',
						'slug'	=> base_url('profile/kontak-kami'),
						'total'	=> NULL
					]
				];
				
				return $data;
			}else if($content == 'struktur-organisasi') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head'] 		= 'Struktur Organiasi';
				$data['content']	= 'Struktur organisasi Litbang kabupaten Bombana.';
				$data['title']		= 'Struktur Organiasi';
				$data['link_map']	= [
					[
						'title'	=> 'beranda',
						'slug'	=> base_url()
					],
					[
						'title'	=> 'profil',
						'slug'	=> NULL
					],
					[
						'title'	=> 'struktur organisasi',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'Definisi',
						'slug'	=> base_url('profile/definisi'),
						'total'	=> NULL
					],
					[
						'title'	=> 'Regulasi',
						'slug'	=> base_url('profile/regulasi'),
						'total' => NULL
					],
					[
						'title'	=> 'Kotak Kami',
						'slug'	=> base_url('profile/kontak-kami'),
						'total'	=> NULL
					]
				];
				
				return $data;
			}else if($content == 'regulasi') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head'] 		= 'Regulasi';
				$data['content']	= 'Informasi tentang regulasi Litbang kabupaten Bombana.';
				$data['title']		= 'Regulasi';
				$data['link_map']	= [
					[
						'title'	=> 'beranda',
						'slug'	=> base_url()
					],
					[
						'title'	=> 'profil',
						'slug'	=> NULL
					],
					[
						'title'	=> 'regulasi',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'Definisi',
						'slug'	=> base_url('profile/definisi'),
						'total' => NULL
					],
					[
						'title'	=> 'Struktur Organisasi',
						'slug'	=> base_url('profile/struktur-organisasi'),
						'total'	=> NULL
					],
					[
						'title'	=> 'Kotak Kami',
						'slug'	=> base_url('profile/kontak-kami'),
						'total'	=> NULL
					]
				];
	
				return $data;
			}else if($content == 'kontak-kami') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head'] 		= 'Kontak Kami';
				$data['content']	= 'Informasi kontak netlitbang kabupaten Bombana.';
				$data['title']		= 'Kontak Kami';
				$data['link_map']	= [
					[
						'title'	=> 'beranda',
						'slug'	=> base_url()
					],
					[
						'title'	=> 'profil',
						'slug'	=> NULL
					],
					[
						'title'	=> 'kontak kami',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'Definisi',
						'slug'	=> base_url('profile/definisi'),
						'total'	=> NULL
					],
					[
						'title'	=> 'Struktur Organisasi',
						'slug'	=> base_url('profile/struktur-organisasi'),
						'total'	=> NULL
					],
					[
						'title'	=> 'Regulasi',
						'slug'	=> base_url('profile/regulasi'),
						'total' => NULL
					]
				];
	
				return $data;
			}
		}else if($function == 'detail') {
			if($content == 'definisi') {
				$data['results']	= $this->Profile_model->getDetailData('articles', $slug);
				$data['head'] 		= 'Definisi';
				$data['content']	= 'Definisi netlitbang kabupaten Bombana.';
				$data['title']		= 'Definisi';
				$data['link_map']	= [
					[
						'title'	=> 'beranda',
						'slug'	=> base_url()
					],
					[
						'title'	=> 'profil',
						'slug'	=> NULL
					],
					[
						'title'	=> 'definisi',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'Struktur Organisasi',
						'slug'	=> base_url('profile/struktur-organisasi'),
						'total'	=> NULL
					],
					[
						'title'	=> 'Regulasi',
						'slug'	=> base_url('profile/regulasi'),
						'total' => NULL
					],
					[
						'title'	=> 'Kotak Kami',
						'slug'	=> base_url('profile/kontak-kami'),
						'total'	=> NULL
					]
				];
	
				return $data;
			}else if($content == 'struktur-organisasi') {
				$data['results']	= $this->Profile_model->getDetailData('articles', $slug);
				$data['head'] 		= 'Struktur Organiasi';
				$data['content']	= 'Struktur organisasi Litbang kabupaten Bombana.';
				$data['title']		= 'Struktur Organiasi';
				$data['link_map']	= [
					[
						'title'	=> 'beranda',
						'slug'	=> base_url()
					],
					[
						'title'	=> 'profil',
						'slug'	=> NULL
					],
					[
						'title'	=> 'struktur organisasi',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'Definisi',
						'slug'	=> base_url('profile/definisi'),
						'total'	=> NULL
					],
					[
						'title'	=> 'Regulasi',
						'slug'	=> base_url('profile/regulasi'),
						'total' => NULL
					],
					[
						'title'	=> 'Kotak Kami',
						'slug'	=> base_url('profile/kontak-kami'),
						'total'	=> NULL
					]
				];
	
				return $data;
			}else if($content == 'regulasi') {
				$data['results']	= $this->Profile_model->getDetailData('articles', $slug);
				$data['head'] 		= 'Regulasi';
				$data['content']	= 'Informasi tentang regulasi Litbang kabupaten Bombana.';
				$data['title']		= 'Regulasi';
				$data['link_map']	= [
					[
						'title'	=> 'beranda',
						'slug'	=> base_url()
					],
					[
						'title'	=> 'profil',
						'slug'	=> NULL
					],
					[
						'title'	=> 'regulasi',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'Definisi',
						'slug'	=> base_url('profile/definisi'),
						'total' => NULL
					],
					[
						'title'	=> 'Struktur Organisasi',
						'slug'	=> base_url('profile/struktur-organisasi'),
						'total'	=> NULL
					],
					[
						'title'	=> 'Kotak Kami',
						'slug'	=> base_url('profile/kontak-kami'),
						'total'	=> NULL
					]
				];
	
				return $data;
			}else if($content == 'kontak-kami') {
				$data['results']	= $this->Profile_model->getDetailData('articles', $slug);
				$data['head'] 		= 'Kontak Kami';
				$data['content']	= 'Informasi kontak netlitbang kabupaten Bombana.';
				$data['title']		= 'Kontak Kami';
				$data['link_map']	= [
					[
						'title'	=> 'beranda',
						'slug'	=> base_url()
					],
					[
						'title'	=> 'profil',
						'slug'	=> NULL
					],
					[
						'title'	=> 'kontak kami',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'Definisi',
						'slug'	=> base_url('profile/definisi'),
						'total'	=> NULL
					],
					[
						'title'	=> 'Struktur Organisasi',
						'slug'	=> base_url('profile/struktur-organisasi'),
						'total'	=> NULL
					],
					[
						'title'	=> 'Regulasi',
						'slug'	=> base_url('profile/regulasi'),
						'total' => NULL
					]
				];
	
				return $data;
			}
		}
	}

	protected function __getPagination($content, $table, $per_page = 10) {
		// Pagination confoguration
		$config['base_url'] 	= base_url('profile/').$content; //site url
		$config['total_rows'] 	= $this->Profile_model->getTotalData($content, $table); //total row
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
		$data['results'] 			= $this->Profile_model->getContentData($content, $table, $config["per_page"], $data['page']);           
	
		$data['pagination'] 		= $this->pagination->create_links();

		return $data;
	}

}
