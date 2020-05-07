<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrderPrint extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('OrderPrint_model');
        $this->load->model('General_model', 'model');
    }

    public function index()
    {
        $data['user'] = $this->model->getUser();
        $data['title'] = 'Print Now';
        viewDefault('orderPrint/index', $data);
    }

    public function printNow()
    {

        if (!$this->input->post('uploadFile')) {
            $this->index();
        }

        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('file', 'File', 'callback_file_check');
        $this->form_validation->set_rules('num_print', 'Number of prints', 'required|trim|greater_than[0]');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'max_length[256]');
        $this->form_validation->set_message('max_length', '%s: the minimum of characters is %s');

        if ($this->form_validation->run() == false) { // gagal validasi awal
            $this->index();
        }

        $result = $this->OrderPrint_model->printNowProcess();

        if ($result['status'] == 'success') {
            flashDataMessage('File berhasil di upload', 'success', 'orderPrint');
        } else {
            $data['error_msg'] = $result['error_msg'];
            flashDataMessage($result['error_msg'] . " " . $_FILES['file']['name'], 'danger', 'orderPrint');
        }
    }

    public function file_check($str)
    {
        $this->form_validation->set_message('file_check', 'Please select file.');
        return ($_FILES['file']['name'] && $_FILES['file']['name'] != '');
    }

    public function historyOrder()
    {
        $data['user'] = $this->model->getUser();
        $data['title'] = 'History Order';
        viewDefault('orderPrint/historyOrder', $data);
    }
}
