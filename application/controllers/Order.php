<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Order_model');
        $this->load->model('General_model', 'model');
    }

    public function index()
    {
        $data['user'] = $this->model->getUser();
        $data['title'] = 'Print Now';

        if ($this->input->post('uploadFile')) {
            $this->form_validation->set_rules('file', 'File', 'callback_file_check');

            if ($this->form_validation->run() == false) {
                $this->viewPrintNow($data);
            } else {
                $config['upload_path']   = './file-print/';
                $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|zip|rar';
                $config['max_size']      = 50 * 1024;
                $this->load->library('upload', $config);

                //upload file to directory
                if ($this->upload->do_upload('file')) {
                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];

                    flashDataMessage('File berhasil di upload', 'success', 'order');
                } else {
                    $data['error_msg'] = $this->upload->display_errors();
                    flashDataMessage($this->upload->display_errors() . " " . $_FILES['file']['name'], 'danger', 'order');
                }
            }
        } else {
            $this->viewPrintNow($data);
        }
    }

    public function file_check($str)
    {
        $this->form_validation->set_message('file_check', 'Please select file.');
        return ($_FILES['file']['name'] && $_FILES['file']['name'] != '');
    }

    private function viewPrintNow($data)
    {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('order/index', $data);
        $this->load->view('templates/footer');
    }

    public function printNow()
    {
        echo '<pre>';
        var_dump($_FILES);
        echo '</pre>';
        die;
    }

    public function historyOrder()
    {
        $data['user'] = $this->model->getUser();
        $data['title'] = 'History Order';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('order/historyOrder', $data);
        $this->load->view('templates/footer');
    }
}
