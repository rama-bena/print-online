<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model');
        $this->load->model('General_model', 'model');
    }

    public function index()   // MY PROFILE
    {
        $data['user'] = $this->model->getUser();
        $data['title'] = 'My Profile';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function editProfile()
    {
        $data['user'] = $this->model->getUser();
        $data['title'] = 'Edit Profile';

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'No. Telp.', 'required|trim');

        if ($this->form_validation->run() == false) { // KLO NAMANYA GAK KOSONG
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/editProfile', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $noTelp = $this->input->post('no_telp');

            // Cek klo upload gambar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '5120';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    $new_image = $this->upload->data('file_name');

                    $this->model->deleteImage($old_image);

                    $this->db->set('image', $new_image);
                } else {  // JIKA GAGAL UPLOAD gambar
                    $error =  $this->upload->display_errors();
                    flashDataMessage($error, 'danger', 'user');
                }
            }

            $this->db->set('name', $name);
            $this->db->set('no_telp', $noTelp);
            $this->db->where('email', $data['user']['email']);
            $this->db->update('user');
            flashDataMessage('Update Success', 'success', 'user');
        }
    }

    public function changePassword()
    {
        $data['user'] = $this->model->getUser();
        $data['title'] = 'Change Password';

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Repeat Password', 'required|trim|matches[new_password1]');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changePassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) { // CURRENT PASSWORD SALAH
                flashDataMessage('Wrong Current Password', 'danger', 'user/changePassword');
            } else if ($current_password == $new_password) { // PASSWORD BARU SAMA DENGAN CURRENT PASSWORD
                flashDataMessage('New Password cannot be same as current password', 'danger', 'user/changePassword');
            } else { // OK UBAH PASSWORD BISA DIUBAH
                $this->User_model->changePassword($new_password, $data['user']['email']);
                flashDataMessage('Password has been updated', 'success', 'user/changePassword');
            }
        }
    }
}
