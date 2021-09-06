<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galery extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('auth_login')) {
			redirect('admin/Auth');
		}
		$this->load->model('admin/Galery_model');
		$this->load->model('admin/All_model');
	}

	public function index($page = 1)
	{
		$data	= $this->__getContentData('list');
		$data['news'] = $this->All_model->getNews();
		$data['galery'] = $this->All_model->getGalery();
		$data['views'] = $this->All_model->getViews();
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/pages/galery/galery-list');
		$this->load->view('admin/templates/footer');
	}

	protected function __getContentData($type, $id = NULL) {
		if($type == 'list') {
			$data				= $this->__getPagination('articles');
			$data['head']		= 'Galeri Kegiatan';
			$data['content']	= 'List dokumentasi galeri kegiatan Litbang kabupaten Bombana.';
			$data['title']		= 'Galeri Kegiatan';
			$data['node_modules']	= 'sweetalert2/dist/sweetalert2.all.min.js';
			$data['script']		= 'admin/galery/galery-list.js'; 

			return $data;
		}else if($type == 'create') {
			$data['head']		= 'Galeri Kegiatan';
			$data['content']	= 'List dokumentasi galeri kegiatan Litbang kabupaten Bombana.';
			$data['title']		= 'Galeri Kegiatan';
			$data['slug']		= 'galery';
			$data['script']		= 'admin/galery/galery-create.js'; 

			return $data;
		}else if($type == 'update') {
			$data['data'] 		= $this->Galery_model->getDetail('articles', $id);
			$data['head']		= 'Galeri Kegiatan';
			$data['content']	= 'List dokumentasi galeri kegiatan Litbang kabupaten Bombana.';
			$data['title']		= 'Galeri Kegiatan';
			$data['slug']		= 'galery';
			$data['script']		= 'admin/galery/galery-update.js'; 

			return $data;
		}else if($type == 'post') {
			$results	= [
				'status'	=> TRUE,
				'message'	=> 'Galeri kegiatan berhasil di tambahkan.'
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
						'type'			=> 'images',
						'slug'			=> $slug,
						'level'			=> @$this->session->userdata('levelNama'),
						'created_by'	=> @$this->session->userdata('id')
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
		}else if($type == 'put') {
			$results	= [
				'status'	=> TRUE,
				'message'	=> 'Galeri berhasil di update.'
			];

			if(empty($_FILES['file']['name'])) {
				$slug = url_title($this->input->post('title'), 'dash', true).'-'.time();
				$data	= [
					'title'			=> $this->input->post('title'),
					'slug'			=> $slug,
					'updated_at'	=> date('Y-m-d'),
					'updated_by'	=> @$this->session->userdata('id')
				];
				$result	= $this->Galery_model->putData('articles', $id, $data);
				if(!$result) {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'Galeri gagal di update.'
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
						'updated_by'	=> @$this->session->userdata('id')
					];
					$result	= $this->Galery_model->putData('articles', $id, $data);
					if(!$result) {
						$results	= [
							'status'	=> FALSE,
							'message'	=> 'Galeri gagal di update.'
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
		}else if($type == 'delete') {
			$results	= [
				'status'	=> TRUE,
				'message'	=> 'Galeri berhasil di hapus.'
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
					'message'	=> 'Galeri gagal di hapus.'
				];
			}
			return $results;
		}
	}

	protected function __getPagination($table, $per_page = 10) {
		// Pagination confoguration
		$config['base_url'] 	= base_url('admin/galery/'); //site url
		$config['total_rows'] 	= $this->Galery_model->getTotalData($table); //total row
		$config['per_page'] 	= $per_page;  //show record per halaman
		$config["uri_segment"] 	= 3;  // uri parameter
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

		$data['page'] 				= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['data'] 				= $this->Galery_model->getContentData($table, $config["per_page"], $data['page']);           
	
		$data['pagination'] 		= $this->pagination->create_links();

		return $data;
	}

	public function detail($id) {
		$result	= $this->Galery_model->getDetail('articles', $id);
		echo json_encode($result);
	}

	public function create() {
		$data				= $this->__getContentData('create');
		$data['news'] = $this->All_model->getNews();
		$data['galery'] = $this->All_model->getGalery();
		$data['views'] = $this->All_model->getViews();
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/pages/galery/galery-create');
		$this->load->view('admin/templates/footer');
	}

	public function update($id) {
		$data		= $this->__getContentData('update', $id);
		$data['id']	= $id;
		$data['news'] = $this->All_model->getNews();
		$data['galery'] = $this->All_model->getGalery();
		$data['views'] = $this->All_model->getViews();
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/pages/galery/galery-update');
		$this->load->view('admin/templates/footer');
	}

	public function post() {
		$results	= $this->__getContentData('post');
		if($results['status']) {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'success', 'message' => $results['message']]);
			redirect(base_url('admin/galery/create/'));
		}else {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'danger', 'message' => $results['message']]);
			redirect(base_url('admin/galery/create/'));
		}
	}

	public function put($id) {
		$results	= $this->__getContentData('put', $id);
		
		if($results['status']) {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'success', 'message' => $results['message']]);
			redirect(base_url('admin/galery/'));
		}else {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'danger', 'message' => $results['message']]);
			redirect(base_url('admin/galery/update/').$id);
		}
	}

	public function delete($id) {
		$results	= $this->__getContentData('delete', $id);
		
		if($results['status']) {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'success', 'message' => $results['message']]);
			redirect(base_url('admin/galery/'));
		}else {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'danger', 'message' => $results['message']]);
			redirect(base_url('admin/galery/'));
		}
	}
}
