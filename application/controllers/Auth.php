<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_user', 'model');
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'form_validation']);
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('welcome');
        }
        $this->load->view('auth/login');
    }

    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);
            $user = $this->model->getByUsername($username);

            if ($user && password_verify($password, $user->password)) {
                $this->session->set_userdata([
                    'logged_in' => TRUE,
                    'user_id'   => $user->id,
                    'nama'      => $user->nama,
                    'username'  => $user->username,
                ]);
                redirect('welcome');
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah.');
                redirect('auth');
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata(['logged_in', 'user_id', 'nama', 'username']);
        redirect('auth');
    }
}
