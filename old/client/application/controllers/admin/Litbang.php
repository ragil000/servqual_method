<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Litbang extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!isset($_SESSION['auth_login'])) {
			redirect('admin/Auth');
		}
		$this->load->model('admin/Litbang_model');
		$this->load->model('admin/All_model');
	}

	public function index($content = 'sosial-pemerintahan', $page = 1)
	{
		$data	= $this->__getContentData('list', $content);
		$data['usulan'] = $this->All_model->getUsulan();
		$data['artikel'] = $this->All_model->getArtikel();
		$data['jurnal'] = $this->All_model->getJurnal();
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/pages/litbang/'.$content.'-list');
		$this->load->view('admin/templates/footer');
	}

	protected function __getContentData($type, $content, $id = NULL) {
		if($type == 'list') {
			if($content == 'sosial-pemerintahan') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head']		= 'Sosial dan Pemerintahan';
				$data['content']	= 'Publikasi jurnal tema sosial dan pemerintahan.';
				$data['title']		= 'Sosial dan Pemerintahan';
				$data['node_modules']	= 'sweetalert2/dist/sweetalert2.all.min.js';
				$data['script']		= 'admin/litbang/'.$content.'-list.js'; 
	
				return $data;
			}else if($content == 'ekonomi-pembangunan') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head'] 		= 'Ekonomi dan Pembangunan';
				$data['content']	= 'Publikasi jurnal tema ekonomi dan pembangunan.';
				$data['title']		= 'Ekonomi dan Pembangunan';
				$data['node_modules']	= 'sweetalert2/dist/sweetalert2.all.min.js';
				$data['script']		= 'admin/litbang/'.$content.'-list.js'; 
	
				return $data;
			}else if($content == 'inovasi-pelayanan-publik') {
				$data					= $this->__getPagination($content, 'articles');
				$data['head'] 			= 'Inovasi dan Pelayanan Publik';
				$data['content']		= 'Publikasi jurnal tema Inovasi dan Pelayanan publik.';
				$data['title']			= 'Inovasi dan Pelayanan Publik';
				$data['node_modules']	= 'sweetalert2/dist/sweetalert2.all.min.js';
				$data['script']			= 'admin/litbang/'.$content.'-list.js'; 
	
				return $data;
			}
		}else if($type == 'create') {
			if($content == 'sosial-pemerintahan') {
				$data['head']		= 'Sosial dan Pemerintahan';
				$data['content']	= 'Publikasi jurnal tema sosial dan pemerintahan.';
				$data['title']		= 'Sosial dan Pemerintahan';
				$data['slug']		= 'sosial-pemerintahan';
				$data['script']		= 'admin/litbang/'.$content.'-create.js'; 
	
				return $data;
			}else if($content == 'ekonomi-pembangunan') {
				$data['head'] 		= 'Ekonomi dan Pembangunan';
				$data['content']	= 'Publikasi jurnal tema ekonomi dan pembangunan.';
				$data['title']		= 'Ekonomi dan Pembangunan';
				$data['slug']		= 'ekonomi-pembangunan';
				$data['script']		= 'admin/litbang/'.$content.'-create.js'; 
	
				return $data;
			}else if($content == 'inovasi-pelayanan-publik') {
				$data['head'] 		= 'Inovasi dan Pelayanan Publik';
				$data['content']	= 'Publikasi jurnal tema Inovasi dan Pelayanan publik.';
				$data['title']		= 'Inovasi dan Pelayanan Publik';
				$data['slug']		= 'inovasi-pelayanan-publik';
				$data['script']		= 'admin/litbang/'.$content.'-create.js'; 
	
				return $data;
			}
		}else if($type == 'update') {
			if($content == 'sosial-pemerintahan') {
				$data['data'] 		= $this->Litbang_model->getDetail('articles', $id);
				$data['head']		= 'Sosial dan Pemerintahan';
				$data['content']	= 'Publikasi jurnal tema sosial dan pemerintahan.';
				$data['title']		= 'Sosial dan Pemerintahan';
				$data['slug']		= 'sosial-pemerintahan';
				$data['script']		= 'admin/litbang/'.$content.'-update.js'; 
	
				return $data;
			}else if($content == 'ekonomi-pembangunan') {
				$data['data'] 		= $this->Litbang_model->getDetail('articles', $id);
				$data['head'] 		= 'Ekonomi dan Pembangunan';
				$data['content']	= 'Publikasi jurnal tema ekonomi dan pembangunan.';
				$data['title']		= 'Ekonomi dan Pembangunan';
				$data['slug']		= 'ekonomi-pembangunan';
				$data['script']		= 'admin/litbang/'.$content.'-update.js'; 
	
				return $data;
			}else if($content == 'inovasi-pelayanan-publik') {
				$data['data'] 		= $this->Litbang_model->getDetail('articles', $id);
				$data['head'] 		= 'Inovasi dan Pelayanan Publik';
				$data['content']	= 'Publikasi jurnal tema Inovasi dan Pelayanan publik.';
				$data['title']		= 'Inovasi dan Pelayanan Publik';
				$data['slug']		= 'inovasi-pelayanan-publik';
				$data['script']		= 'admin/litbang/'.$content.'-update.js'; 
	
				return $data;
			}
		}else if($type == 'post') {
			if($content == 'sosial-pemerintahan') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Jurnal berhasil di tambahkan.'
				];

				$this->form_validation->set_rules('title', 'Judul', 'trim|required');
				$this->form_validation->set_rules('content', 'Isi', 'trim|required');
				// $this->form_validation->set_rules('file', 'PDF', 'required');
				if($this->form_validation->run()) {
					$file	= $this->Litbang_model->uploadPDF();
					if($file['status']) {
						$slug = url_title($this->input->post('title'), 'dash', true).'-'.time();
						$data	= [
							'title'			=> $this->input->post('title'),
							'content'		=> $this->input->post('content'),
							'file'			=> $file['file_name'],
							'type'			=> 'sosial-pemerintahan',
							'slug'			=> $slug,
							'created_by'	=> 1
						];
						$result	= $this->Litbang_model->postData('articles', $data);
						if(!$result) {
							$results	= [
								'status'	=> FALSE,
								'message'	=> 'Jurnal gagal di tambahkan.'
							];
						}
					}else {
						$results	= [
							'status'	=> FALSE,
							'message'	=> 'File gagal di unggah.'
						];
					}
				}else {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'Data yang diinput tidak valid.'
					];
				}
				return $results;
			}else if($content == 'ekonomi-pembangunan') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Jurnal berhasil di tambahkan.'
				];

				$this->form_validation->set_rules('title', 'Judul', 'trim|required');
				$this->form_validation->set_rules('content', 'Isi', 'trim|required');
				// $this->form_validation->set_rules('file', 'PDF', 'required');
				if($this->form_validation->run()) {
					$file	= $this->Litbang_model->uploadPDF();
					if($file['status']) {
						$slug = url_title($this->input->post('title'), 'dash', true).'-'.time();
						$data	= [
							'title'			=> $this->input->post('title'),
							'content'		=> $this->input->post('content'),
							'file'			=> $file['file_name'],
							'type'			=> 'ekonomi-pembangunan',
							'slug'			=> $slug,
							'created_by'	=> 1
						];
						$result	= $this->Litbang_model->postData('articles', $data);
						if(!$result) {
							$results	= [
								'status'	=> FALSE,
								'message'	=> 'Jurnal gagal di tambahkan.'
							];
						}
					}else {
						$results	= [
							'status'	=> FALSE,
							'message'	=> 'File gagal di unggah.'
						];
					}
				}else {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'Data yang diinput tidak valid.'
					];
				}
				return $results;
			}else if($content == 'inovasi-pelayanan-publik') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Jurnal berhasil di tambahkan.'
				];

				$this->form_validation->set_rules('title', 'Judul', 'trim|required');
				$this->form_validation->set_rules('content', 'Isi', 'trim|required');
				// $this->form_validation->set_rules('file', 'PDF', 'required');
				if($this->form_validation->run()) {
					$file	= $this->Litbang_model->uploadPDF();
					if($file['status']) {
						$slug = url_title($this->input->post('title'), 'dash', true).'-'.time();
						$data	= [
							'title'			=> $this->input->post('title'),
							'content'		=> $this->input->post('content'),
							'file'			=> $file['file_name'],
							'type'			=> 'inovasi-pelayanan-publik',
							'slug'			=> $slug,
							'created_by'	=> 1
						];
						$result	= $this->Litbang_model->postData('articles', $data);
						if(!$result) {
							$results	= [
								'status'	=> FALSE,
								'message'	=> 'Jurnal gagal di tambahkan.'
							];
						}
					}else {
						$results	= [
							'status'	=> FALSE,
							'message'	=> 'File gagal di unggah.'
						];
					}
				}else {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'Data yang diinput tidak valid.'
					];
				}
				return $results;
			}
		}else if($type == 'put') {
			if($content == 'sosial-pemerintahan' || $content == 'ekonomi-pembangunan' || $content == 'inovasi-pelayanan-publik') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Jurnal berhasil di update.'
				];

				if(empty($_FILES['file']['name'])) {
					$slug = url_title($this->input->post('title'), 'dash', true).'-'.time();
					$data	= [
						'title'			=> $this->input->post('title'),
						'content'		=> $this->input->post('content'),
						'slug'			=> $slug,
						'updated_at'	=> date('Y-m-d'),
						'updated_by'	=> 1
					];
					$result	= $this->Litbang_model->putData('articles', $id, $data);
					if(!$result) {
						$results	= [
							'status'	=> FALSE,
							'message'	=> 'Jurnal gagal di update.'
						];
					}
				}else {
					$file	= $this->Litbang_model->uploadPDF();
					if($file['status']) {
						$details_data	= $this->Litbang_model->getDetail('articles', $id);
						if(file_exists('./uploads/files/'.$details_data[0]['file'])) {
							unlink('./uploads/files/'.$details_data[0]['file']);
						}
						$slug = url_title($this->input->post('title'), 'dash', true).'-'.time();
						$data	= [
							'title'			=> $this->input->post('title'),
							'content'		=> $this->input->post('content'),
							'file'			=> $file['file_name'],
							'slug'			=> $slug,
							'updated_at'	=> date('Y-m-d'),
							'updated_by'	=> 1
						];
						$result	= $this->Litbang_model->putData('articles', $id, $data);
						if(!$result) {
							$results	= [
								'status'	=> FALSE,
								'message'	=> 'Jurnal gagal di update.'
							];
						}
					}else {
						$results	= [
							'status'	=> FALSE,
							'message'	=> 'File gagal di unggah.'
						];
					}
				}

				return $results;
			}
		}else if($type == 'delete') {
			if($content == 'sosial-pemerintahan' || $content == 'ekonomi-pembangunan' || $content == 'inovasi-pelayanan-publik') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Jurnal berhasil di hapus.'
				];

				$details_data	= $this->Litbang_model->getDetail('articles', $id);
				if(file_exists('./uploads/files/'.$details_data[0]['file'])) {
					unlink('./uploads/files/'.$details_data[0]['file']);
				}

				$result	= $this->Litbang_model->deleteData('articles', $id);
				if(!$result) {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'Jurnal gagal di hapus.'
					];
				}
				return $results;
			}
		}
	}

	protected function __getPagination($content, $table, $per_page = 10) {
		// Pagination confoguration
		$config['base_url'] 	= base_url('admin/litbang/').$content; //site url
		$config['total_rows'] 	= $this->Litbang_model->getTotalData($content, $table); //total row
		$config['per_page'] 	= $per_page;  //show record per halaman
		$config["uri_segment"] 	= 4;  // uri parameter
		$choice 				= $config["total_rows"] / $config["per_page"];
		$config["num_links"] 	= floor($choice);

		// Create pagination style for BootStrap v4
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = '<i class="fas fa-angle-right"></i>';
		$config['prev_link']        = '<i class="fas fa-angle-left"></i>';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav aria-label="..."><ul class="pagination justify-content-end mb-0">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';
		$this->pagination->initialize($config);

		$data['page'] 				= ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$data['data'] 				= $this->Litbang_model->getContentData($content, $table, $config["per_page"], $data['page']);           
	
		$data['pagination'] 		= $this->pagination->create_links();

		return $data;
	}

	public function detail($content, $id) {
		if($content == 'sosial-pemerintahan' || $content == 'ekonomi-pembangunan' || $content == 'inovasi-pelayanan-publik') {
			$result	= $this->Litbang_model->getDetail('articles', $id);
			echo json_encode($result);
		}
	}

	public function create($content) {
		$data				= $this->__getContentData('create', $content);
		$data['date_start']	= date('Y-m-d');
		$date_end 			= strtotime("+1 day", strtotime($data['date_start']));
		$data['date_end']	= date("Y-m-d", $date_end);
		$data['usulan'] = $this->All_model->getUsulan();
		$data['artikel'] = $this->All_model->getArtikel();
		$data['jurnal'] = $this->All_model->getJurnal();
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/pages/litbang/'.$content.'-create');
		$this->load->view('admin/templates/footer');
	}

	public function update($content, $id) {
		$data		= $this->__getContentData('update', $content, $id);
		$data['id']	= $id;
		$data['usulan'] = $this->All_model->getUsulan();
		$data['artikel'] = $this->All_model->getArtikel();
		$data['jurnal'] = $this->All_model->getJurnal();
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/pages/litbang/'.$content.'-update');
		$this->load->view('admin/templates/footer');
	}

	public function post($content) {
		$results	= $this->__getContentData('post', $content);
		if($results['status']) {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'success', 'message' => $results['message']]);
			redirect(base_url('admin/litbang/create/'.$content));
		}else {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'danger', 'message' => $results['message']]);
			redirect(base_url('admin/litbang/create/'.$content));
		}
	}

	public function put($content, $id) {
		$results	= $this->__getContentData('put', $content, $id);
		
		if($results['status']) {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'success', 'message' => $results['message']]);
			redirect(base_url('admin/litbang/'.$content));
		}else {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'danger', 'message' => $results['message']]);
			redirect(base_url('admin/litbang/update/'.$content).$id);
		}
	}

	public function delete($content, $id) {
		$results	= $this->__getContentData('delete', $content, $id);
		
		if($results['status']) {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'success', 'message' => $results['message']]);
			redirect(base_url('admin/litbang/'.$content));
		}else {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'danger', 'message' => $results['message']]);
			redirect(base_url('admin/litbang/update/'.$content).$id);
		}
	}
}
