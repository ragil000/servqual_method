<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Journal_model');
	}

	public function index($content = 'sop-kelitbangan')
	{
		$data					= $this->__getContentData($content, 'index');
		$data['new_articles']	= $this->Journal_model->getNewArticle();
		$this->load->view('templates/header');
		$this->load->view('templates/head-content', $data);
		$this->load->view('pages/journal/'.$content);
		$this->load->view('templates/footer');
	}

	public function detail($content, $slug) {
		$data					= $this->__getContentData($content, 'detail', $slug);
		$data['new_articles']	= $this->Journal_model->getNewArticle();
		$this->load->view('templates/header');
		$this->load->view('templates/head-content', $data);
		$this->load->view('pages/journal/'.$content.'-detail');
		$this->load->view('templates/footer');
	}

	protected function __getContentData($content, $function = 'index', $slug = NULL) {
		if($function == 'index') {
			if($content == 'sop-kelitbangan') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head'] 		= 'SOP Kelitbangan';
				$data['content']	= 'Informasi SOP Kelitbangan kabupaten Bombana.';
				$data['title']		= 'SOP Kelitbangan';
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
						'title'	=> 'sop kelitbangan',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'RIK Kab. Bombana',
						'slug'	=> base_url('journal/rik-bombana'),
						'total'	=> NULL
					],
					[
						'title'	=> 'Agenda Kegiatan',
						'slug'	=> base_url('journal/agenda-kegiatan'),
						'total' => $this->Journal_model->getTotalData('agenda-kegiatan', 'articles')
					],
					[
						'title'	=> 'Rekomendasi',
						'slug'	=> base_url('journal/rekomendasi'),
						'total'	=> NULL
					],
					[
						'title'	=> 'Artikel dan Berita',
						'slug'	=> base_url('journal/artikel-berita'),
						'total' => $this->Journal_model->getTotalData('artikel-berita', 'articles')
					]
				];
				
				return $data;
			}else if($content == 'rik-bombana') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head'] 		= 'RIK Kabupaten Bombana';
				$data['content']	= 'Informasi RIK kabupaten Bombana.';
				$data['title']		= 'RIK Kabupaten Bombana';
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
						'title'	=> 'rik kab. bombana',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'SOP Kelitbangan',
						'slug'	=> base_url('journal/sop-kelitbangan'),
						'total'	=> NULL
					],
					[
						'title'	=> 'Agenda Kegiatan',
						'slug'	=> base_url('journal/agenda-kegiatan'),
						'total' => $this->Journal_model->getTotalData('agenda-kegiatan', 'articles')
					],
					[
						'title'	=> 'Rekomendasi',
						'slug'	=> base_url('journal/rekomendasi'),
						'total'	=> NULL
					],
					[
						'title'	=> 'Artikel dan Berita',
						'slug'	=> base_url('journal/artikel-berita'),
						'total' => $this->Journal_model->getTotalData('artikel-berita', 'articles')
					]
				];
				
				return $data;
			}else if($content == 'agenda-kegiatan') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head'] 		= 'Agenda Kegiatan';
				$data['content']	= 'Informasi tentang agenda kegiatan Litbang kabupaten Bombana.';
				$data['title']		= 'Agenda Kegiatan';
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
						'title'	=> 'Agenda Kegiatan',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'SOP Kelitbangan',
						'slug'	=> base_url('journal/sop-kelitbangan'),
						'total'	=> NULL
					],
					[
						'title'	=> 'RIK Kab. Bombana',
						'slug'	=> base_url('journal/rik-bombana'),
						'total' => NULL
					],
					[
						'title'	=> 'Rekomendasi',
						'slug'	=> base_url('journal/rekomendasi'),
						'total'	=> NULL
					],
					[
						'title'	=> 'Artikel dan Berita',
						'slug'	=> base_url('journal/artikel-berita'),
						'total' => $this->Journal_model->getTotalData('artikel-berita', 'articles')
					]
				];
	
				return $data;
			}else if($content == 'rekomendasi') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head'] 			= 'Rekomendasi';
				$data['content']		= 'Daftar rekomendasi jurnal Litbang kabupaten Bombana.';
				$data['title']			= 'Rekomendasi Jurnal Litbang Kabupaten Bombana';
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
						'title'	=> 'rekomendasi',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'SOP Kelitbangan',
						'slug'	=> base_url('journal/sop-kelitbangan'),
						'total'	=> NULL
					],
					[
						'title'	=> 'RIK Kab. Bombana',
						'slug'	=> base_url('journal/rik-bombana'),
						'total' => NULL
					],
					[
						'title'	=> 'Agenda Kegiatan',
						'slug'	=> base_url('journal/agenda-kegiatan'),
						'total'	=> $this->Journal_model->getTotalData('agenda-kegiatan', 'articles')
					],
					[
						'title'	=> 'Artikel dan Berita',
						'slug'	=> base_url('journal/artikel-berita'),
						'total' => $this->Journal_model->getTotalData('artikel-berita', 'articles')
					]
				];
	
				return $data;
			}else if($content == 'artikel-berita') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head'] 			= 'Artikel dan Berita';
				$data['content']		= 'Informasi artikel dan berita Litbang kabupaten Bombana.';
				$data['title']			= 'Artikel dan Berita';
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
						'title'	=> 'artikel dan berita',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'SOP Kelitbangan',
						'slug'	=> base_url('journal/sop-kelitbangan'),
						'total'	=> NULL
					],
					[
						'title'	=> 'RIK Kab. Bombana',
						'slug'	=> base_url('journal/rik-bombana'),
						'total' => NULL
					],
					[
						'title'	=> 'Agenda Kegiatan',
						'slug'	=> base_url('journal/agenda-kegiatan'),
						'total'	=> $this->Journal_model->getTotalData('agenda-kegiatan', 'articles')
					],
					[
						'title'	=> 'Rekomendasi',
						'slug'	=> base_url('journal/rekomendasi'),
						'total' => $this->Journal_model->getTotalData('rekomendasi', 'articles')
					]
				];
	
				return $data;
			}
		}else if($function == 'detail') {
			if($content == 'agenda-kegiatan') {
				$data['results']	= $this->Journal_model->getDetailData('articles', $slug);
				$data['head'] 		= 'Agenda Kegiatan';
				$data['content']	= 'Informasi tentang agenda kegiatan Litbang kabupaten Bombana.';
				$data['title']		= 'Agenda Kegiatan';
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
						'title'	=> 'agenda kegiatan',
						'slug'	=> base_url('journal/agenda-kegiatan')
					],
					[
						'title'	=> 'detail agenda kegiatan',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'SOP Kelitbangan',
						'slug'	=> base_url('journal/sop-kelitbangan'),
						'total'	=> NULL
					],
					[
						'title'	=> 'RIK Kab. Bombana',
						'slug'	=> base_url('journal/rik-bombana'),
						'total' => NULL
					],
					[
						'title'	=> 'Rekomendasi',
						'slug'	=> base_url('journal/rekomendasi'),
						'total'	=> NULL
					],
					[
						'title'	=> 'Artikel dan Berita',
						'slug'	=> base_url('journal/artikel-berita'),
						'total' => $this->Journal_model->getTotalData('artikel-berita', 'articles')
					]
				];
	
				return $data;
			}else if($content == 'rekomendasi') {
				$data['results']	= $this->Journal_model->getDetailData('articles', $slug);
				$data['head'] 			= 'Rekomendasi';
				$data['content']		= 'Daftar rekomendasi jurnal Litbang kabupaten Bombana.';
				$data['title']			= 'Rekomendasi Jurnal Litbang Kabupaten Bombana';
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
						'title'	=> 'rekomendasi',
						'slug'	=> base_url('journal/rekomendasi')
					],
					[
						'title'	=> 'detail rekomendasi',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'SOP Kelitbangan',
						'slug'	=> base_url('journal/sop-kelitbangan'),
						'total'	=> NULL
					],
					[
						'title'	=> 'RIK Kab. Bombana',
						'slug'	=> base_url('journal/rik-bombana'),
						'total' => NULL
					],
					[
						'title'	=> 'Agenda Kegiatan',
						'slug'	=> base_url('journal/agenda-kegiatan'),
						'total'	=> $this->Journal_model->getTotalData('agenda-kegiatan', 'articles')
					],
					[
						'title'	=> 'Artikel dan Berita',
						'slug'	=> base_url('journal/artikel-berita'),
						'total' => $this->Journal_model->getTotalData('artikel-berita', 'articles')
					]
				];
	
				return $data;
			}else if($content == 'artikel-berita') {
				$data['results']	= $this->Journal_model->getDetailData('articles', $slug);
				$data['head'] 			= 'Artikel dan Berita';
				$data['content']		= 'Informasi artikel dan berita Litbang kabupaten Bombana.';
				$data['title']			= 'Artikel dan Berita';
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
						'title'	=> 'artikel dan berita',
						'slug'	=> base_url('journal/artikel-berita')
					],
					[
						'title'	=> 'detail artikel dan berita',
						'slug'	=> NULL
					],
				];
				$data['side_submenu']	= [
					[
						'title'	=> 'SOP Kelitbangan',
						'slug'	=> base_url('journal/sop-kelitbangan'),
						'total'	=> NULL
					],
					[
						'title'	=> 'RIK Kab. Bombana',
						'slug'	=> base_url('journal/rik-bombana'),
						'total' => NULL
					],
					[
						'title'	=> 'Agenda Kegiatan',
						'slug'	=> base_url('journal/agenda-kegiatan'),
						'total'	=> $this->Journal_model->getTotalData('agenda-kegiatan', 'articles')
					],
					[
						'title'	=> 'Rekomendasi',
						'slug'	=> base_url('journal/rekomendasi'),
						'total' => $this->Journal_model->getTotalData('rekomendasi', 'articles')
					]
				];
	
				return $data;
			}
		}
	}

	protected function __getPagination($content, $table, $per_page = 10) {
		// Pagination confoguration
		$config['base_url'] 	= base_url('journal/').$content; //site url
		$config['total_rows'] 	= $this->Journal_model->getTotalData($content, $table); //total row
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
		$data['results'] 			= $this->Journal_model->getContentData($content, $table, $config["per_page"], $data['page']);           
	
		$data['pagination'] 		= $this->pagination->create_links();

		return $data;
	}

}
