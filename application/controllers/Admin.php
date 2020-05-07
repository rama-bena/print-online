<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model');
        $this->load->model('General_model', 'model');
    }

    public function index()
    {
        $data['user'] = $this->model->getUser();
        $data['title'] = 'Dashboard';
        viewDefault('admin/index', $data);
    }

    public function userSetting()
    {
        $data['user'] = $this->model->getUser();
        $data['title'] = 'User Setting';
        $data['allUser'] = $this->model->getAllDataUser();
        viewDefault('admin/userSetting', $data);
    }

    public function deleteUser($idNow, $idDelete)
    {
        if ($idNow == $idDelete) {
            flashDataMessage("You can't delete yourself", 'danger', 'admin/userSetting');
        } else {
            $this->Admin_model->deleteUser($idDelete);
            redirect('admin/userSetting');
        }
    }

    public function changeRole($idNow, $idChange)
    {
        $newRoleId = $this->input->post('radio');
        $this->Admin_model->changeRole($idChange, $newRoleId);

        // masih belum lengkap
        if ($idNow == $idChange) {
            $this->session->set_userdata('role_id', $newRoleId);
        }

        if ($idNow == $idChange && $newRoleId == '2') {
            $this->session->set_userdata('role_id', '2');
            redirect('user');
        } else {
            redirect('admin/userSetting');
        }
    }
}
