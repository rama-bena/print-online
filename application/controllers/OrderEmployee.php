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

        $po = "SELECT `id` `id_po`, `id_file`, `id_employee`,
                         `id_status`, `date_upload`, `date_process`,
                         `date_finish`, `date_taken`, `is_reject`,
                         `keterangan_reject` FROM `print_order`";

        // $result = $this->db->query($query)->result_array();
        // echo '<pre>';
        // print_r($result);
        // echo '</pre>';
        // die;

        $query = "SELECT `id_member`, `title`, `filename`,
                         `num_print`, `keterangan` ,`po`.* 
                  FROM ($po) `po`
                  JOIN `print_file` `pf`
                    ON `id_file` = `pf`.`id`
                  WHERE `id_status` = 1";

        // $po_pf = $this->db->query($query)->result_array();
        // echo '<pre>';
        // print_r($po_pf);
        // echo '</pre>';
        // die;

        $query = "SELECT * FROM ($query) `po_pf`
                    JOIN `user` 
                    ON `id_member` = `user`.`id` ";

        $po_pf_user = $this->db->query($query)->result_array();

        echo '<pre>';
        print_r($po_pf_user);
        echo '</pre>';
        die;

        viewDefault('orderEmployee/index', $data);
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
