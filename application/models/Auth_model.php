<?php

class Auth_model extends CI_Model
{

    public function loginProcess()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if (!$user) {
            return 'user not found';
        }
        if ($user['is_active'] == 0) {
            return 'user not active';
        }
        if (password_verify($password, $user['password']) == false) {
            return 'wrong password';
        }

        $data = [
            'email' => $user['email'],
            'role_id' => $user['role_id']
        ];
        return $data;
    }

    public function registrationProcess()
    {
        $email = $this->input->post('email', true);
        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($email),
            'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
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

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        $this->load->model('General_model', 'model');
        $this->model->makeDirectory($user['id']);
        $this->sendEmail($token, 'verify', $email);
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

    public function verifyProcess()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

        if (!$user) { // USER TIDAK ADA
            return [
                'message' => 'Account verification failed',
                'type'    => 'danger'
            ];
        }
        if (!$user_token) { // TOKEN TIDAK ADA
            return [
                'message' => 'Token Invalid',
                'type'    => 'danger'
            ];
        }
        if (time() - $user_token['date_created'] > (60 * 60 * 24)) { // TOKEN LEWAT 24 JAM
            $this->db->delete('user_token', ['token' => $token]);
            $this->db->delete('user', ['email' => $email]);
            return [
                'message' => 'Token Invalid',
                'type'    => 'danger'
            ];
        }

        //VERIFIKASI BERHASIL

        $this->db->delete('user_token', ['token' => $token]);
        $this->db->set('is_active', 1);
        $this->db->where('email', $email);
        $this->db->update('user');

        return [
            'message' => "$email has been activated. Please Login",
            'type'    => 'success'
        ];
    }
}
