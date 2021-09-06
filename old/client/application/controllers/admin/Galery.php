<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galery extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!isset($_SESSION['auth_login'])) {
			redirect('admin/Auth');
		}
		$this->load->model('admin/Galery_model');
		$this->load->model('admin/All_model');
	}

	public function index($content = 'foto-kegiatan', $page = 1)
	{
		$data	= $this->__getContentData('list', $content);
		$data['usulan'] = $this->All_model->getUsulan();
		$data['artikel'] = $this->All_model->getArtikel();
		$data['jurnal'] = $this->All_model->getJurnal();
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/pages/galery/'.$content.'-list');
		$this->load->view('admin/templates/footer');
	}

	protected function __getContentData($type, $content, $id = NULL) {
		if($type == 'list') {
			if($content == 'foto-kegiatan') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head']		= 'Foto-Foto Kegiatan';
				$data['content']	= 'List dokumentasi foto-foto kegiatan Litbang kabupaten Bombana.';
				$data['title']		= 'Foto-Foto Kegiatan';
				$data['node_modules']	= 'sweetalert2/dist/sweetalert2.all.min.js';
				$data['script']		= 'admin/galery/'.$content.'-list.js'; 
	
				return $data;
			}else if($content == 'video') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head'] 		= 'Video Litbang Kabupaten Bombana';
				$data['content']	= 'List video Litbang kabupaten Bombana.';
				$data['title']		= 'Video Litbang Kabupaten Bombana';
				$data['node_modules']	= 'sweetalert2/dist/sweetalert2.all.min.js';
				$data['script']		= 'admin/galery/'.$content.'-list.js'; 
	
				return $data;
			}
		}else if($type == 'create') {
			if($content == 'foto-kegiatan') {
				$data['head']		= 'Foto-Foto Kegiatan';
				$data['content']	= 'List dokumentasi foto-foto kegiatan Litbang kabupaten Bombana.';
				$data['title']		= 'Foto-Foto Kegiatan';
				$data['slug']		= 'foto-kegiatan';
				$data['script']		= 'admin/galery/'.$content.'-create.js'; 
	
				return $data;
			}else if($content == 'video') {
				$data['head'] 		= 'Video Litbang Kabupaten Bombana';
				$data['content']	= 'List video Litbang kabupaten Bombana.';
				$data['title']		= 'Video Litbang Kabupaten Bombana';
				$data['slug']		= 'video';
				$data['script']		= 'admin/galery/'.$content.'-create.js'; 
	
				return $data;
			}
		}else if($type == 'update') {
			if($content == 'foto-kegiatan') {
				$data['data'] 		= $this->Galery_model->getDetail('articles', $id);
				$data['head']		= 'Foto-Foto Kegiatan';
				$data['content']	= 'List dokumentasi foto-foto kegiatan Litbang kabupaten Bombana.';
				$data['title']		= 'Foto-Foto Kegiatan';
				$data['slug']		= 'foto-kegiatan';
				$data['script']		= 'admin/galery/'.$content.'-update.js'; 
	
				return $data;
			}else if($content == 'video') {
				$data['data'] 		= $this->Galery_model->getDetail('articles', $id);
				$data['head'] 		= 'Video Litbang Kabupaten Bombana';
				$data['content']	= 'List video Litbang kabupaten Bombana.';
				$data['title']		= 'Video Litbang Kabupaten Bombana';
				$data['slug']		= 'video';
				$data['script']		= 'admin/galery/'.$content.'-update.js'; 
	
				return $data;
			}
		}else if($type == 'post') {
			if($content == 'foto-kegiatan') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Foto kegiatan berhasil di tambahkan.'
				];

				$this->form_validation->set_rules('title', 'Judul', 'trim|required');
				// $this->form_validation->set_rules('file', 'Gambar', 'required');
				if($this->form_validation->run()) {
					$file	= $this->Galery_model->uploadImage();
					if($file['status']) {
						$slug = url_title($this->input->post('title'), 'dash', true).'-'.time();
						$data	= [
							'title'			=> $this->input->post('title'),
							'file'			=> $file['file_name'],
							'type'			=> 'foto-kegiatan',
							'slug'			=> $slug,
							'created_by'	=> 1
						];
						$result	= $this->Galery_model->postData('articles', $data);
						if(!$result) {
							$results	= [
								'status'	=> FALSE,
								'message'	=> 'Foto kegiatan gagal di tambahkan.'
							];
						}
					}else {
						$results	= [
							'status'	=> FALSE,
							'message'	=> 'Gambar gagal di unggah.'
						];
					}
				}else {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'Data yang diinput tidak valid.'
					];
				}
				return $results;
			}else if($content == 'video') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Video berhasil di tambahkan.'
				];

				$this->form_validation->set_rules('title', 'Judul', 'trim|required');
				// $this->form_validation->set_rules('file', 'PDF', 'required');
				if($this->form_validation->run()) {
					$file	= $this->Galery_model->uploadVideo();
					if($file['status']) {
						$slug = url_title($this->input->post('title'), 'dash', true).'-'.time();
						$data	= [
							'title'			=> $this->input->post('title'),
							'file'			=> $file['file_name'],
							'type'			=> 'video',
							'slug'			=> $slug,
							'created_by'	=> 1
						];
						$result	= $this->Galery_model->postData('articles', $data);
						if(!$result) {
							$results	= [
								'status'	=> FALSE,
								'message'	=> 'Video gagal di tambahkan.'
							];
						}
					}else {
						$results	= [
							'status'	=> FALSE,
							'message'	=> 'Video gagal di unggah.'
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
			if($content == 'foto-kegiatan') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Foto kegiatan berhasil di update.'
				];

				if(empty($_FILES['file']['name'])) {
					$slug = url_title($this->input->post('title'), 'dash', true).'-'.time();
					$data	= [
						'title'			=> $this->input->post('title'),
						'slug'			=> $slug,
						'updated_at'	=> date('Y-m-d'),
						'updated_by'	=> 1
					];
					$result	= $this->Galery_model->putData('articles', $id, $data);
					if(!$result) {
						$results	= [
							'status'	=> FALSE,
							'message'	=> 'Foto kegiatan gagal di update.'
						];
					}
				}else {
					$file	= $this->Galery_model->uploadImage();
					if($file['status']) {
						$details_data	= $this->Galery_model->getDetail('articles', $id);
						if(file_exists('./uploads/images/'.$details_data[0]['file'])) {
							unlink('./uploads/images/'.$details_data[0]['file']);
						}
						if(file_exists('./uploads/images/smalls/'.$details_data[0]['file'])) {
							unlink('./uploads/images/smalls/'.$details_data[0]['file']);
						}
						if(file_exists('./uploads/images/thumbs/'.$details_data[0]['file'])) {
							unlink('./uploads/images/thumbs/'.$details_data[0]['file']);
						}
						$slug = url_title($this->input->post('title'), 'dash', true).'-'.time();
						$data	= [
							'title'			=> $this->input->post('title'),
							'file'			=> $file['file_name'],
							'slug'			=> $slug,
							'updated_at'	=> date('Y-m-d'),
							'updated_by'	=> 1
						];
						$result	= $this->Galery_model->putData('articles', $id, $data);
						if(!$result) {
							$results	= [
								'status'	=> FALSE,
								'message'	=> 'Foto kegiatan gagal di update.'
							];
						}
					}else {
						$results	= [
							'status'	=> FALSE,
							'message'	=> 'Gambar gagal di unggah.'
						];
					}
				}

				return $results;
			}else if($content == 'video') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Video berhasil di update.'
				];

				if(empty($_FILES['file']['name'])) {
					$slug = url_title($this->input->post('title'), 'dash', true).'-'.time();
					$data	= [
						'title'			=> $this->input->post('title'),
						'slug'			=> $slug,
						'updated_at'	=> date('Y-m-d'),
						'updated_by'	=> 1
					];
					$result	= $this->Galery_model->putData('articles', $id, $data);
					if(!$result) {
						$results	= [
							'status'	=> FALSE,
							'message'	=> 'Video gagal di update.'
						];
					}
				}else {
					$file	= $this->Galery_model->uploadVideo();
					if($file['status']) {
						$details_data	= $this->Galery_model->getDetail('articles', $id);
						if(file_exists('./uploads/videos/'.$details_data[0]['file'])) {
							unlink('./uploads/videos/'.$details_data[0]['file']);
						}
						$slug = url_title($this->input->post('title'), 'dash', true).'-'.time();
						$data	= [
							'title'			=> $this->input->post('title'),
							'file'			=> $file['file_name'],
							'slug'			=> $slug,
							'updated_at'	=> date('Y-m-d'),
							'updated_by'	=> 1
						];
						$result	= $this->Galery_model->putData('articles', $id, $data);
						if(!$result) {
							$results	= [
								'status'	=> FALSE,
								'message'	=> 'Video gagal di update.'
							];
						}
					}else {
						$results	= [
							'status'	=> FALSE,
							'message'	=> 'Video gagal di unggah.'
						];
					}
				}

				return $results;
			}
		}else if($type == 'delete') {
			if($content == 'foto-kegiatan') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Foto kegiatan berhasil di hapus.'
				];

				$details_data	= $this->Galery_model->getDetail('articles', $id);
				if(file_exists('./uploads/images/'.$details_data[0]['file'])) {
					unlink('./uploads/images/'.$details_data[0]['file']);
				}
				if(file_exists('./uploads/images/smalls/'.$details_data[0]['file'])) {
					unlink('./uploads/images/smalls/'.$details_data[0]['file']);
				}
				if(file_exists('./uploads/images/thumbs/'.$details_data[0]['file'])) {
					unlink('./uploads/images/thumbs/'.$details_data[0]['file']);
				}

				$result	= $this->Galery_model->deleteData('articles', $id);
				if(!$result) {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'Foto kegiatan gagal di hapus.'
					];
				}
				return $results;
			}else if($content == 'video') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Video berhasil di hapus.'
				];

				$details_data	= $this->Galery_model->getDetail('articles', $id);
				if(file_exists('./uploads/videos/'.$details_data[0]['file'])) {
					unlink('./uploads/videos/'.$details_data[0]['file']);
				}

				$result	= $this->Galery_model->deleteData('articles', $id);
				if(!$result) {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'Video gagal di hapus.'
					];
				}
				return $results;
			}
		}
	}

	protected function __getPagination($content, $table, $per_page = 10) {
		// Pagination confoguration
		$config['base_url'] 	= base_url('admin/galery/').$content; //site url
		$config['total_rows'] 	= $this->Galery_model->getTotalData($content, $table); //total row
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
		$data['data'] 				= $this->Galery_model->getContentData($content, $table, $config["per_page"], $data['page']);           
	
		$data['pagination'] 		= $this->pagination->create_links();

		return $data;
	}

	public function detail($content, $id) {
		if($content == 'foto-kegiatan' || $content == 'video') {
			$result	= $this->Galery_model->getDetail('articles', $id);
			echo json_encode($result);
		}
	}

	public function create($content) {
		$data				= $this->__getContentData('create', $content);
		$data['usulan'] = $this->All_model->getUsulan();
		$data['artikel'] = $this->All_model->getArtikel();
		$data['jurnal'] = $this->All_model->getJurnal();
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/pages/galery/'.$content.'-create');
		$this->load->view('admin/templates/footer');
	}

	public function update($content, $id) {
		$data		= $this->__getContentData('update', $content, $id);
		$data['id']	= $id;
		$data['usulan'] = $this->All_model->getUsulan();
		$data['artikel'] = $this->All_model->getArtikel();
		$data['jurnal'] = $this->All_model->getJurnal();
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/pages/galery/'.$content.'-update');
		$this->load->view('admin/templates/footer');
	}

	public function post($content) {
		$results	= $this->__getContentData('post', $content);
		if($results['status']) {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'success', 'message' => $results['message']]);
			redirect(base_url('admin/galery/create/'.$content));
		}else {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'danger', 'message' => $results['message']]);
			redirect(base_url('admin/galery/create/'.$content));
		}
	}

	public function put($content, $id) {
		$results	= $this->__getContentData('put', $content, $id);
		
		if($results['status']) {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'success', 'message' => $results['message']]);
			redirect(base_url('admin/galery/'.$content));
		}else {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'danger', 'message' => $results['message']]);
			redirect(base_url('admin/galery/update/'.$content).$id);
		}
	}

	public function delete($content, $id) {
		$results	= $this->__getContentData('delete', $content, $id);
		
		if($results['status']) {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'success', 'message' => $results['message']]);
			redirect(base_url('admin/galery/'.$content));
		}else {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'danger', 'message' => $results['message']]);
			redirect(base_url('admin/galery/update/'.$content).$id);
		}
	}
}
