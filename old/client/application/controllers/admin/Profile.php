<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!isset($_SESSION['auth_login'])) {
			redirect('admin/Auth');
		}
		$this->load->model('admin/Profile_model');
		$this->load->model('admin/All_model');
	}

	public function index($content = 'definisi', $page = 1)
	{
		$data	= $this->__getContentData('list', $content);
		$data['usulan'] = $this->All_model->getUsulan();
		$data['artikel'] = $this->All_model->getArtikel();
		$data['jurnal'] = $this->All_model->getJurnal();
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/pages/profile/'.$content.'-list');
		$this->load->view('admin/templates/footer');
	}

	protected function __getContentData($type, $content, $id = NULL) {
		if($type == 'list') {
			if($content == 'definisi') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head']		= 'Definisi Netlitbang';
				$data['content']	= '';
				$data['title']		= 'Definisi';
				
				$data['script']		= 'admin/profile/'.$content.'-list.js'; 
	
				return $data;
			}else if($content == 'struktur-organisasi') {
				$data				= $this->__getPagination($content, 'articles');
				$data['head'] 		= 'Struktur Organisasi Litbang Kabupaten Bombana';
				$data['content']	= '';
				$data['title']		= 'Struktur Organisasi';
				$data['script']		= 'admin/profile/'.$content.'-list.js'; 
	
				return $data;
			}else if($content == 'regulasi') {
				$data					= $this->__getPagination($content, 'articles');
				$data['head'] 			= 'Regulasi Litbang Kabupaten Bombana';
				$data['content']		= 'Informasi regulasi Litbang kabupaten Bombana.';
				$data['title']			= 'Regulasi';
				$data['node_modules']	= 'sweetalert2/dist/sweetalert2.all.min.js';
				$data['script']			= 'admin/profile/'.$content.'-list.js'; 
	
				return $data;
			}else if($content == 'kontak-kami') {
				$data					= $this->__getPagination($content, 'articles');
				$data['head'] 			= 'Kontak Netlitbang';
				$data['content']		= 'Informasi kontak resmi netlitbang kabupaten Bombana.';
				$data['title']			= 'Kontak Kami';
				$data['node_modules']	= 'sweetalert2/dist/sweetalert2.all.min.js';
				$data['script']			= 'admin/profile/'.$content.'-list.js'; 
	
				return $data;
			}
		}else if($type == 'create') {
			if($content == 'regulasi') {
				$data['head'] 		= 'Regulasi Litbang Kabupaten Bombana';
				$data['content']	= 'Informasi regulasi Litbang kabupaten Bombana.';
				$data['title']		= 'Regulasi';
				$data['slug']		= 'regulasi';
				$data['script']		= 'admin/profile/'.$content.'-create.js'; 
	
				return $data;
			}
		}else if($type == 'update') {
			if($content == 'definisi') {
				$data['data'] 		= $this->Profile_model->getDetail('articles', $id);
				$data['head']		= 'Definisi Netlitbang';
				$data['content']	= '';
				$data['title']		= 'Definisi';
				$data['slug']		= 'definisi';
				$data['script']		= 'admin/profile/'.$content.'-update.js'; 
	
				return $data;
			}else if($content == 'struktur-organisasi') {
				$data['data'] 		= $this->Profile_model->getDetail('articles', $id);
				$data['head'] 		= 'Struktur Organisasi Litbang Kabupaten Bombana';
				$data['content']	= '';
				$data['title']		= 'Struktur Organisasi';
				$data['slug']		= 'struktur-organisasi';
				$data['script']		= 'admin/profile/'.$content.'-update.js'; 
	
				return $data;
			}else if($content == 'regulasi') {
				$data['data'] 		= $this->Profile_model->getDetail('articles', $id);
				$data['head'] 		= 'Regulasi Litbang Kabupaten Bombana';
				$data['content']	= 'Informasi regulasi Litbang kabupaten Bombana.';
				$data['title']		= 'Regulasi';
				$data['slug']		= 'regulasi';
				$data['script']		= 'admin/profile/'.$content.'-update.js'; 
	
				return $data;
			}else if($content == 'kontak-kami') {
				$data['data'] 		= $this->Profile_model->getDetail('articles', $id);
				$data['head'] 		= 'Kontak Netlitbang';
				$data['content']	= 'Informasi kontak resmi netlitbang kabupaten Bombana.';
				$data['title']		= 'Kontak Kami';
				$data['slug']		= 'kontak-kami';
				$data['script']		= 'admin/profile/'.$content.'-update.js'; 
	
				return $data;
			}
		}else if($type == 'post') {
			if($content == 'regulasi') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Regulasi berhasil di tambahkan.'
				];

				$this->form_validation->set_rules('title', 'Judul', 'trim|required');
				$this->form_validation->set_rules('content', 'Isi', 'trim|required');
				// $this->form_validation->set_rules('file', 'PDF', 'required');
				if($this->form_validation->run()) {
					$file	= $this->Profile_model->uploadPDF();
					if($file['status']) {
						$slug = url_title($this->input->post('title'), 'dash', true).'-'.time();
						$data	= [
							'title'			=> $this->input->post('title'),
							'content'		=> $this->input->post('content'),
							'file'			=> $file['file_name'],
							'type'			=> 'regulasi',
							'slug'			=> $slug,
							'created_by'	=> 1
						];
						$result	= $this->Profile_model->postData('articles', $data);
						if(!$result) {
							$results	= [
								'status'	=> FALSE,
								'message'	=> 'Regulasi gagal di tambahkan.'
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
			if($content == 'definisi') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Definisi berhasil di update.'
				];

				$data	= [
					'title'			=> $this->input->post('title'),
					'content'		=> $this->input->post('content'),
					'updated_at'	=> date('Y-m-d'),
					'updated_by'	=> 1
				];
				$result	= $this->Profile_model->putData('articles', $id, $data);
				if(!$result) {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'Definisi Gagal di update.'
					];
				}
				return $results;
			}else if($content == 'struktur-organisasi') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Struktur organisasi berhasil di update.'
				];

				if(empty($_FILES['file']['name'])) {
					$slug = url_title($this->input->post('title'), 'dash', true).'-'.time();
					$data	= [
						'title'			=> $this->input->post('title'),
						'content'		=> $this->input->post('content'),
						'start_date'	=> $this->input->post('start_date'),
						'end_date'		=> $this->input->post('end_date'),
						'slug'			=> $slug,
						'updated_at'	=> date('Y-m-d'),
						'updated_by'	=> 1
					];
					$result	= $this->Profile_model->putData('articles', $id, $data);
					if(!$result) {
						$results	= [
							'status'	=> FALSE,
							'message'	=> 'Struktur organisasi gagal di update.'
						];
					}
				}else {
					$file	= $this->Profile_model->uploadImage();
					if($file['status']) {
						$details_data	= $this->Profile_model->getDetail('articles', $id);
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
							'content'		=> $this->input->post('content'),
							'start_date'	=> $this->input->post('start_date'),
							'end_date'		=> $this->input->post('end_date'),
							'file'			=> $file['file_name'],
							'slug'			=> $slug,
							'updated_at'	=> date('Y-m-d'),
							'updated_by'	=> 1
						];
						$result	= $this->Profile_model->putData('articles', $id, $data);
						if(!$result) {
							$results	= [
								'status'	=> FALSE,
								'message'	=> 'Agenda kegiatan gagal di update.'
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
			}else if($content == 'regulasi') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Regulasi berhasil di update.'
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
					$result	= $this->Profile_model->putData('articles', $id, $data);
					if(!$result) {
						$results	= [
							'status'	=> FALSE,
							'message'	=> 'Regulasi gagal di update.'
						];
					}
				}else {
					$file	= $this->Profile_model->uploadPDF();
					if($file['status']) {
						$details_data	= $this->Profile_model->getDetail('articles', $id);
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
						$result	= $this->Profile_model->putData('articles', $id, $data);
						if(!$result) {
							$results	= [
								'status'	=> FALSE,
								'message'	=> 'Regulasi gagal di update.'
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
			}else if($content == 'kontak-kami') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Kontak netlitbang berhasil di update.'
				];

				$data	= [
					'title'			=> $this->input->post('title'),
					'content'		=> $this->input->post('content'),
					'updated_at'	=> date('Y-m-d'),
					'updated_by'	=> 1
				];
				$result	= $this->Profile_model->putData('articles', $id, $data);
				if(!$result) {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'Kontak netlitbang Gagal di update.'
					];
				}
				return $results;
			}
		}else if($type == 'delete') {
			if($content == 'definisi') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Definisi netlitbang berhasil di hapus.'
				];

				$result	= $this->Profile_model->deleteData('articles', $id);
				if(!$result) {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'Definisi netlitbang gagal di hapus.'
					];
				}
				return $results;
			}else if($content == 'struktur-organisai') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Struktur organisasi berhasil di hapus.'
				];

				$details_data	= $this->Profile_model->getDetail('articles', $id);
				if(file_exists('./uploads/images/'.$details_data[0]['file'])) {
					unlink('./uploads/images/'.$details_data[0]['file']);
				}
				if(file_exists('./uploads/images/smalls/'.$details_data[0]['file'])) {
					unlink('./uploads/images/smalls/'.$details_data[0]['file']);
				}
				if(file_exists('./uploads/images/thumbs/'.$details_data[0]['file'])) {
					unlink('./uploads/images/thumbs/'.$details_data[0]['file']);
				}

				$result	= $this->Profile_model->deleteData('articles', $id);
				if(!$result) {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'Struktur organisasi gagal di hapus.'
					];
				}
				return $results;
			}else if($content == 'regulasi') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Regulasi berhasil di hapus.'
				];

				$details_data	= $this->Profile_model->getDetail('articles', $id);
				if(file_exists('./uploads/files/'.$details_data[0]['file'])) {
					unlink('./uploads/files/'.$details_data[0]['file']);
				}

				$result	= $this->Profile_model->deleteData('articles', $id);
				if(!$result) {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'Regulasi gagal di hapus.'
					];
				}
				return $results;
			}else if($content == 'kontak-kami') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Kontak netlitbang berhasil di hapus.'
				];

				$result	= $this->Profile_model->deleteData('articles', $id);
				if(!$result) {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'Kontak netlitbang gagal di hapus.'
					];
				}
				return $results;
			}
		}
	}

	protected function __getPagination($content, $table, $per_page = 10) {
		// Pagination confoguration
		$config['base_url'] 	= base_url('admin/profile/').$content; //site url
		$config['total_rows'] 	= $this->Profile_model->getTotalData($content, $table); //total row
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
		$data['data'] 				= $this->Profile_model->getContentData($content, $table, $config["per_page"], $data['page']);           
	
		$data['pagination'] 		= $this->pagination->create_links();

		return $data;
	}

	public function detail($content, $id) {
		if($content == 'definisi' || $content == 'struktur-organisasi' || $content == 'regulasi' || $content == 'kontak-kami') {
			$result	= $this->Profile_model->getDetail('articles', $id);
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
		$this->load->view('admin/pages/profile/'.$content.'-create');
		$this->load->view('admin/templates/footer');
	}

	public function update($content, $id) {
		$data		= $this->__getContentData('update', $content, $id);
		$data['id']	= $id;
		$data['usulan'] = $this->All_model->getUsulan();
		$data['artikel'] = $this->All_model->getArtikel();
		$data['jurnal'] = $this->All_model->getJurnal();
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/pages/profile/'.$content.'-update');
		$this->load->view('admin/templates/footer');
	}

	public function post($content) {
		$results	= $this->__getContentData('post', $content);
		if($results['status']) {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'success', 'message' => $results['message']]);
			redirect(base_url('admin/profile/create/'.$content));
		}else {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'danger', 'message' => $results['message']]);
			redirect(base_url('admin/profile/create/'.$content));
		}
	}

	public function put($content, $id) {
		$results	= $this->__getContentData('put', $content, $id);
		
		if($results['status']) {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'success', 'message' => $results['message']]);
			redirect(base_url('admin/profile/'.$content));
		}else {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'danger', 'message' => $results['message']]);
			redirect(base_url('admin/profile/update/'.$content).$id);
		}
	}

	public function delete($content, $id) {
		$results	= $this->__getContentData('delete', $content, $id);
		
		if($results['status']) {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'success', 'message' => $results['message']]);
			redirect(base_url('admin/profile/'.$content));
		}else {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'danger', 'message' => $results['message']]);
			redirect(base_url('admin/profile/update/'.$content).$id);
		}
	}
}
