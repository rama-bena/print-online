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

        $this->form_validation->set_rules('file', 'File', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('order/index', $data);
            $this->load->view('templates/footer');
        } else {
            echo '<pre>';
            var_dump($_FILES);
            echo '</pre>';
            die;
        }
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
