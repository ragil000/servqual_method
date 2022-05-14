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
		$this->load->model('Group_model');
	}

    public function index() {
        $this->session->set_userdata(['old_url' => str_replace('/servqual_method/', '',$_SERVER['REQUEST_URI']), 'old_query' => $_SERVER['QUERY_STRING']]);
        $questionnaire_id = $this->input->get('questionnaire_id');
        if($questionnaire_id) {
            try {
                $questionnaire_id = _decrypt($questionnaire_id, 'penyihir-cinta', true);
            }catch(Exception $e) {
                $questionnaire_id = null;
            }
        }

        $get_questionnaire      = $this->Questionnaire_model->get_default_questionnaire(true, NULL, $questionnaire_id);
        $data['is_group']   = FALSE;
        if($get_questionnaire->status) {
            $current_questionnaire = $get_questionnaire->data;
            if($current_questionnaire->group_id) {
                $data['is_group'] = TRUE;
                $get_group   = $this->Group_model->get_data($current_questionnaire->group_id);
                if($get_group->status) {
                    $data['labs'] = $get_group->data;
                }
            }else {
                $data['lab_id'] = $current_questionnaire->lab_id;
            }
            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";
            // die;
        }
        $data['current_questionnaire']  = $get_questionnaire->status ? $get_questionnaire->data : NULL;
        $data['data']           = $this->Question_model->get_data(1, NULL, $questionnaire_id, 100);
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
