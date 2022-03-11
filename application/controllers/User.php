<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('auth_signin')) {
			redirect('Auth');
		}
		$this->load->model('User_model');
		$this->load->model('Laboratorium_model');
	}

	public function index($page=1) {
        $role = $this->input->get('role');
        $this->session->set_userdata(['old_url' => str_replace('/servqual_method/', '',$_SERVER['REQUEST_URI']), 'old_query' => $_SERVER['QUERY_STRING']]);
        
        $search = $this->input->post('search') || $this->session->userdata('search_user');
        if($search) {
            $this->session->set_userdata(['search_user' => $search]);
        }

		$page = floor(($page/10) + 1);
        $get_data				= $this->User_model->get_data($page, $search, $role);

        //konfigurasi pagination
        $config['base_url'] = site_url('user'); //site url
        $config['total_rows'] = $get_data->total_data; //total row
        $config['per_page'] = $get_data->limit;  //show record per halaman
        $config["num_links"] = $get_data->total_page;

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = '<i class="fas fa-angle-right"></i>';
        $config['prev_link']        = '<i class="fas fa-angle-left"></i>';
        $config['full_tag_open']    = '<nav aria-label="..."><ul class="pagination justify-content-end mb-0">';
        $config['full_tag_close']   = '</ul></nav>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span class="sr-only">Next</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '<span class="sr-only">Previous</span></span></li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);
        $data['page'] = $page;
 
        $data['data'] = $get_data->data;           
 
        $data['pagination'] = $this->pagination->create_links();

		$data['head'] 			= 'Akun User';
		$data['content']		= 'Daftar Akun User';
		$data['title']			= 'Akun User';
		$data['css_vendors']	= ['select2/css/select2.min.css'];
		$data['js_vendors']	    = ['sweetalert2/sweetalert2.all.min.js', 'select2/js/select2.min.js'];
		$data['script']			= 'user/list.js';

		$this->load->view('templates/header', $data);
		$this->load->view('pages/user/list');
		$this->load->view('templates/footer');
	}

    public function get_data_lab() {
        $page = $this->input->get('page');
        $search = $this->input->get('search');

        $data = $this->Laboratorium_model->get_data($page, $search);

        echo json_encode($data);
    }

	public function create() {
        $this->session->set_userdata(['old_url' => str_replace('/servqual_method/', '',$_SERVER['REQUEST_URI']), 'old_query' => $_SERVER['QUERY_STRING']]);
        $_id = $this->input->get('_id');

        if($_id) {
            $_id = _decrypt($_id, 'penyihir-cinta', true);
            $get_data = $this->User_model->get_detail_data($_id);
            if($get_data->status) {
                $data['old_data'] = $get_data->data;
            }
        }

		$data['head'] 			= 'Akun User';
		$data['content']		= 'Daftar Akun User';
		$data['title']			= 'Akun User';
		$data['style']			= 'user/create.css';
        $data['css_vendors']	= ['select2/css/select2.min.css'];
		$data['js_vendors']	    = ['select2/js/select2.min.js'];
		$data['script']			= 'user/create.js';
		$this->load->view('templates/header', $data);
		$this->load->view('pages/user/create');
		$this->load->view('templates/footer');
	}

	public function post() {
		$results	= (object) [
			'status'	=> TRUE,
			'message'	=> 'Data berhasil di tambahkan.'
		];

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('role', 'Role', 'trim|required');
		if($this->form_validation->run()) {
			$post = [
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'role' => $this->input->post('role'),
                'lab_id' => $this->input->post('lab_id')
            ];

			$results = $this->User_model->post_data($post);
		}else {
			$results = (object) [
				'status'	=> FALSE,
				'message'	=> 'data yang diinput tidak valid.'
			];
		}
		$this->session->set_flashdata(['flash_message' => TRUE, 'status' => ($results->status ? 'success' : 'warning'), 'message' => $results->message]);
		redirect($this->session->userdata('old_url'));
	}

    public function put() {
		$results	= (object) [
			'status'	=> TRUE,
			'message'	=> 'Data berhasil di diubah.'
		];

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('role', 'Role', 'trim|required');
		if($this->form_validation->run()) {
			$post = [
                '_id' => $this->input->post('_id'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'role' => $this->input->post('role'),
                'lab_id' => $this->input->post('lab_id')
            ];

			$results = $this->User_model->put_data($post);
		}else {
			$results = (object) [
				'status'	=> FALSE,
				'message'	=> 'data yang diinput tidak valid.'
			];
		}
		$this->session->set_flashdata(['flash_message' => TRUE, 'status' => ($results->status ? 'success' : 'warning'), 'message' => $results->message]);
        redirect($this->session->userdata('old_url'));
	}

    public function delete() {
        $_id = $this->input->get('_id');
        $results = (object) [
            'status'	=> FALSE,
            'message'	=> 'parameter _id tidak ditemukan.'
        ];

        if($_id) {
            $_id = _decrypt($_id, 'penyihir-cinta', true);
            $results = $this->User_model->delete_data($_id);
        }

        $this->session->set_flashdata(['flash_message' => TRUE, 'status' => ($results->status ? 'success' : 'warning'), 'message' => $results->message]);
		redirect($this->session->userdata('old_url'));
    }
}
