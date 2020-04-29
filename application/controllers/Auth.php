<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index() // ini login
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
            $data['title'] = 'PO User Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->loginProcess();
        }
    }

    private function loginProcess()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) { // usernya ada
            if ($user['is_active'] == 1) { // email aktif
                if (password_verify($password, $user['password'])) { // password bener, BOLEH MASUKK
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    flashDataMessage('Wrong Password', 'danger', 'auth');
                }
            } else { // email belum di aktivasi
                flashDataMessage('Emal has not active. Please active your email', 'danger', 'auth');
            }
        } else { // gak ada di database
            flashDataMessage('Email not registered', 'danger', 'auth');
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
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];

            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->sendEmail($token, 'verify', $email);
            flashDataMessage('Your email has been registered. Please active your email to login', 'success', 'auth');
        }
    }

    private function sendEmail($token, $type, $email)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'printonline.po@gmail.com',
            'smtp_pass' => 'makanbeling',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        ];
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->load->library('email', $config);

        $this->email->from('printonline.po@gmail.com', 'Print Online');
        $this->email->to($email);

        if ($type == 'verify') {
            $this->email->subject('Account Verification to Print Online');
            $this->email->message('Click this link to verify your account : <a href="' . base_url() . 'auth/verify?email=' . $email . '&token=' . urlencode($token) . '">Active</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) { // EMAIL BERHASIL DI AKTIFKAN
                    $this->db->delete('user_token', ['token' => $token]);
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');
                    flashDataMessage("$email has been activated. Please Login", 'success', 'auth');
                } else { // TOKEN LEWAT 24 JAM

                    $this->db->delete('user_token', ['token' => $token]);
                    $this->db->delete('user', ['email' => $email]);
                    flashDataMessage('Token Invalid', 'danger', 'auth');
                }
            } else { // TOKEN SALAH
                flashDataMessage('Token Invalid', 'danger', 'auth');
            }
        } else { // EMAIL SALAH, klo ada yang edit url
            flashDataMessage('Account verification failed', 'danger', 'auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        flashDataMessage('You have logged out. Please Login to enter', 'success', 'auth');
    }

    public function blocked()
    {
        $data['title'] = 'Access Blocked';
        $this->load->view('templates/header', $data);
        $this->load->view('auth/blocked');
    }
}
