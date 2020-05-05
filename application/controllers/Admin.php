<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $data['user'] = $this->Admin_model->getUser();
        $data['title'] = 'Dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function userSetting()
    {
        $data['user'] = $this->Admin_model->getUser();
        $data['title'] = 'User Setting';
        $data['allUser'] = $this->Admin_model->getAllDataUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/userSetting', $data);
        $this->load->view('templates/footer');
    }

    public function deleteUser($idNow, $idDelete)
    {
        if ($idNow == $idDelete) {
            flashDataMessage("You can't delete yourself", 'danger', 'admin/userSetting');
        } else {
            $this->Admin_model->deleteUser($idDelete);
            $this->userSetting();
        }
    }

    public function changeRole($idNow, $idChange)
    {
        $newRoleId = $this->input->post('radio');
        $this->Admin_model->changeRole($idChange, $newRoleId);

        if ($idNow == $idChange && $newRoleId == '2') {
            $this->session->set_userdata('role_id', '2');
            redirect('user');
        } else {
            redirect('admin/userSetting');
        }
    }
}
