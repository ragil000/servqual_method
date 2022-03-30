<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AsUser extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// if(!$this->session->userdata('auth_signin')) {
		// 	redirect('Auth');
		// }
		$this->load->model('Questionnaire_model');
		$this->load->model('Question_model');
		$this->load->model('Answer_model');
		// $this->load->model('SummaryServqual_model');
	}

    public function index() {
        $this->session->set_userdata(['old_url' => str_replace('/servqual_method/', '',$_SERVER['REQUEST_URI']), 'old_query' => $_SERVER['QUERY_STRING']]);
        $lab_id = $this->input->get('lab_id');
        if($lab_id) {
            try {
                $lab_id = _decrypt($lab_id, 'penyihir-cinta', true);
            }catch(Exception $e) {
                $lab_id = null;
            }
        }

        $get_questionnaire      = $this->Questionnaire_model->get_default_questionnaire(true, $lab_id);
        $questionnaire_id       = $get_questionnaire->status ? $get_questionnaire->data->_id : NULL;
        
        $data['data']           = $this->Question_model->get_data(1, NULL, $questionnaire_id, 100);;
		$data['head'] 			= 'Kuesioner Penilaian Kualitas Layanan';
		$data['content']		= 'Kuesioner Penilaian Kualitas Layanan';
		$data['title']			= 'Kuesioner Penilaian Kualitas Layanan';
		$data['js_vendors'] 	= ['sweetalert2/sweetalert2.all.min.js'];
		$data['script']			= 'as_user/list.js';

		$this->load->view('templates/as_user/header', $data);
		$this->load->view('pages/as_user/list');
		$this->load->view('templates/as_user/footer');
	}

    public function set_user() {
        $post = $this->input->post();

        
        $check_user = $this->Answer_model->check_user(strtolower(trim($post['nim'])), $post['questionnaire_id']);
        
        if(!$check_user->status) {
            $data = [
                'session_user' => [
                    'user_name' => $post['name'],
                    'user_nim' => strtolower(trim($post['nim']))
                ]
            ];
            $this->session->set_userdata($data);
            echo json_encode(true);
        }else {
            echo json_encode(false);
        }
	}

    public function reset_user() {
        $this->session->unset_userdata('session_user');
        echo json_encode(true);
	}

    public function post() {
        if(!$this->session->userdata('session_user')) {
            redirect($this->session->userdata('old_url'));
            return false;
        }

        $this->session->unset_userdata('session_user');

		$post = $this->input->post();

        $this->Answer_model->post_data($post);

        $data['head'] 			= 'Kuesioner Penilaian Kualitas Layanan';
		$data['content']		= 'Kuesioner Penilaian Kualitas Layanan';
		$data['title']			= 'Kuesioner Penilaian Kualitas Layanan';
        $data['js_vendors'] 	= ['sweetalert2/sweetalert2.all.min.js'];
		$data['script']			= 'as_user/success.js';

		$this->load->view('templates/as_user/header', $data);
		$this->load->view('pages/as_user/success');
		$this->load->view('templates/as_user/footer');
	}

}
