<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrderEmployee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('OrderEmployee_model');
        $this->load->model('General_model', 'model');
    }

    public function index() // INI UPLOAD
    {
        $data['user'] = $this->model->getUser();
        $data['title'] = 'Upload';

        $data['uploads'] = $this->OrderEmployee_model->getAllOrderStatus(1);
        viewDefault('orderEmployee/index', $data);
    }

    public function reject($id_po)
    {
        $keterangan_reject = $this->input->post('keterangan_reject');
        $id_employee = $this->model->getUser()['id'];
        $this->OrderEmployee_model->reject($id_po, $id_employee, $keterangan_reject);
        $this->index();
    }

    public function toProcess($id_po)
    {
        $id_employee = $this->model->getUser()['id'];
        OrderEmployee_model->toProcess($id_po, $id_employee);
        $this->index();
    }

    public function process()
    {
        $data['user'] = $this->model->getUser();
        $data['title'] = 'Process';
        viewDefault('orderEmployee/process', $data);
    }

    public function finish()
    {
        $data['user'] = $this->model->getUser();
        $data['title'] = 'Finish';
        viewDefault('orderEmployee/finish', $data);
    }

    public function taken()
    {
        $data['user'] = $this->model->getUser();
        $data['title'] = 'Taken';
        viewDefault('orderEmployee/taken', $data);
    }
}
