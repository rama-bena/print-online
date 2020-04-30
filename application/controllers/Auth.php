<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index() // INI LOGIN
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        // aturan email
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Email tidak valid'
        ]);
        //aturan password
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $result = $this->Auth_model->loginProcess();

            if ($result == 'user not found') {
                flashDataMessage('Email not registered', 'danger', 'auth');
            } elseif ($result == 'user not active') {
                flashDataMessage('Email has not active. Please check your email', 'danger', 'auth');
            } elseif ($result == 'wrong password') {
                flashDataMessage('Wrong Password', 'danger', 'auth');
            } else { //BERHASIL LOGIN
                $this->session->set_userdata($result);
                ($result['role_id'] == 1) ? redirect('admin') : redirect('user');
            }
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        // rules nama
        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'nama tidak boleh kosong'
        ]);
        // rules email
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'email tidak boleh kosong',
            'valid_email' => 'email tidak valid',
            'is_unique' => 'email sudah terdaftar'
        ]);
        // rules password1
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => 'password tidak boleh kosong',
            'matches' => 'Password tidak sama',
            'min_length' => 'Password terlalu pendek'
        ]);
        // rules password2
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) { // klo ada yg salah
            $data['title'] = 'PO User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else { // berhasil registrasi
            $this->Auth_model->registrationProcess();
            flashDataMessage('Your email has been registered. Please active your email in 24h to login', 'success', 'auth');
        }
    }

    public function verify()
    {
        $result = $this->Auth_model->verifyProcess();
        flashDataMessage($result['message'], $result['type'], 'auth');
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        flashDataMessage('You have logged out. Please Login to enter', 'warning', 'auth');
    }

    public function blocked()
    {
        $data['title'] = 'Access Blocked';
        $this->load->view('templates/header', $data);
        $this->load->view('auth/blocked');
    }
}
