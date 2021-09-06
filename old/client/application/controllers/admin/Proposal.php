<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposal extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!isset($_SESSION['auth_login'])) {
			redirect('admin/Auth');
		}
		$this->load->model('admin/Proposal_model');
		$this->load->model('admin/All_model');
	}

	public function index($content = 'usulan-penelitian', $page = 1)
	{
		$data	= $this->__getContentData('list', $content);
		$data['usulan'] = $this->All_model->getUsulan();
		$data['artikel'] = $this->All_model->getArtikel();
		$data['jurnal'] = $this->All_model->getJurnal();
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/pages/proposal/'.$content.'-list');
		$this->load->view('admin/templates/footer');
	}

	protected function __getContentData($type, $content, $id = NULL) {
		if($type == 'list') {
			if($content == 'usulan-penelitian') {
				$data				= $this->__getPagination($content, 'proposals');
				$data['head']		= 'Usulan Penelitian';
				$data['content']	= 'Usulan Penelitian.';
				$data['title']		= 'Usulan Penelitian';
				$data['node_modules']	= 'sweetalert2/dist/sweetalert2.all.min.js';
				$data['script']		= 'admin/proposal/'.$content.'-list.js'; 
	
				return $data;
			}else if($content == 'instansi') {
				$data				= $this->__getPagination($content, 'agencies');
				$data['head'] 		= 'Instansi';
				$data['content']	= 'Instansi yang mengajukan penelitian.';
				$data['title']		= 'Instansi';
				$data['node_modules']	= 'sweetalert2/dist/sweetalert2.all.min.js';
				$data['script']		= 'admin/proposal/'.$content.'-list.js'; 
	
				return $data;
			}
		}else if($type == 'create') {
			if($content == 'usulan-penelitian') {
				$data['head']		= 'Usulan Penelitian';
				$data['content']	= 'Usulan Penelitian.';
				$data['title']		= 'Usulan Penelitian';
				$data['slug']		= 'usulan-penelitian';
				$data['script']		= 'admin/proposal/'.$content.'-create.js'; 
	
				return $data;
			}else if($content == 'instansi') {
				$data['head'] 		= 'Instansi';
				$data['content']	= 'Instansi yang mengajukan penelitian.';
				$data['title']		= 'Instansi';
				$data['slug']		= 'instansi';
				$data['script']		= 'admin/proposal/'.$content.'-create.js'; 
	
				return $data;
			}
		}else if($type == 'update') {
			if($content == 'usulan-penelitian') {
				$data['data'] 		= $this->Proposal_model->getDetail('proposals', $id);
				$data['head']		= 'Usulan Penelitian';
				$data['content']	= 'Usulan Penelitian.';
				$data['title']		= 'Usulan Penelitian';
				$data['slug']		= 'usulan-penelitian';
				$data['script']		= 'admin/proposal/'.$content.'-update.js'; 
	
				return $data;
			}else if($content == 'instansi') {
				$data['data'] 		= $this->Proposal_model->getDetail('agencies', $id);
				$data['head'] 		= 'Instansi';
				$data['content']	= 'Instansi yang mengajukan penelitian.';
				$data['title']		= 'Instansi';
				$data['slug']		= 'instansi';
				$data['script']		= 'admin/proposal/'.$content.'-update.js'; 
	
				return $data;
			}
		}else if($type == 'post') {
			if($content == 'instansi') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Instansi berhasil di tambahkan.'
				];

				$this->form_validation->set_rules('title', 'Judul', 'trim|required');
				if($this->form_validation->run()) {
					$data	= [
						'title'			=> $this->input->post('title'),
						'created_by'	=> 1
					];
					$result	= $this->Proposal_model->postData('agencies', $data);
					if(!$result) {
						$results	= [
							'status'	=> FALSE,
							'message'	=> 'Instansi gagal di tambahkan.'
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
			if($content == 'usulan-penelitian') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Usulan penelitian berhasil diterima.'
				];

				$data	= [
					'status'		=> 'diterima',
					'updated_at'	=> date('Y-m-d'),
					'updated_by'	=> 1
				];
				$result	= $this->Proposal_model->putData('proposals', $id, $data);
				if(!$result) {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'Usulan penelitian gagal diterima.'
					];
				}

				return $results;
			}else if($content == 'instansi') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'instansi berhasil ditambah.'
				];

				$data	= [
					'title'			=> $this->input->post('title'),
					'updated_at'	=> date('Y-m-d'),
					'updated_by'	=> 1
				];
				$result	= $this->Proposal_model->putData('agencies', $id, $data);
				if(!$result) {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'instansi gagal ditambah.'
					];
				}

				return $results;
			}
		}else if($type == 'delete') {
			if($content == 'instansi') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Instansi berhasil di hapus.'
				];

				$result	= $this->Proposal_model->deleteData('agencies', $id);
				if(!$result) {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'Instansi gagal di hapus.'
					];
				}
				return $results;
			}else if($content == 'usulan-penelitian') {
				$results	= [
					'status'	=> TRUE,
					'message'	=> 'Usulan penelitian berhasil ditolak.'
				];

				$data	= [
					'status'		=> 'ditolak',
					'updated_at'	=> date('Y-m-d'),
					'updated_by'	=> 1
				];
				$result	= $this->Proposal_model->putData('proposals', $id, $data);
				if(!$result) {
					$results	= [
						'status'	=> FALSE,
						'message'	=> 'Usualan penelitian gagal ditolak.'
					];
				}
				return $results;
			}
		}
	}

	protected function __getPagination($content, $table, $per_page = 10) {
		// Pagination confoguration
		$config['base_url'] 	= base_url('admin/proposal/').$content; //site url
		$config['total_rows'] 	= $this->Proposal_model->getTotalData($table); //total row
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
		$data['data'] 				= $this->Proposal_model->getContentData($table, $config["per_page"], $data['page']);           
	
		$data['pagination'] 		= $this->pagination->create_links();

		return $data;
	}

	public function detail($content, $id) {
		if($content == 'usulan-penelitian') {
			$result	= $this->Proposal_model->getDetail('proposals', $id);
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
		$this->load->view('admin/pages/proposal/'.$content.'-create');
		$this->load->view('admin/templates/footer');
	}

	public function update($content, $id) {
		$data		= $this->__getContentData('update', $content, $id);
		$data['id']	= $id;
		$data['usulan'] = $this->All_model->getUsulan();
		$data['artikel'] = $this->All_model->getArtikel();
		$data['jurnal'] = $this->All_model->getJurnal();
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/pages/proposal/'.$content.'-update');
		$this->load->view('admin/templates/footer');
	}

	public function post($content) {
		$results	= $this->__getContentData('post', $content);
		if($results['status']) {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'success', 'message' => $results['message']]);
			redirect(base_url('admin/proposal/create/'.$content));
		}else {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'danger', 'message' => $results['message']]);
			redirect(base_url('admin/proposal/create/'.$content));
		}
	}

	public function put($content, $id) {
		$results	= $this->__getContentData('put', $content, $id);
		
		if($results['status']) {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'success', 'message' => $results['message']]);
			redirect(base_url('admin/proposal/'.$content));
		}else {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'danger', 'message' => $results['message']]);
			redirect(base_url('admin/proposal/update/'.$content).$id);
		}
	}

	public function delete($content, $id) {
		$results	= $this->__getContentData('delete', $content, $id);
		
		if($results['status']) {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'success', 'message' => $results['message']]);
			redirect(base_url('admin/proposal/'.$content));
		}else {
			$this->session->set_flashdata(['flash_message' => TRUE, 'status' => 'danger', 'message' => $results['message']]);
			redirect(base_url('admin/proposal/update/'.$content).$id);
		}
	}
}
