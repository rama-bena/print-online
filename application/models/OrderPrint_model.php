<?php

class OrderPrint_model extends CI_Model
{
    public function printNowProcess()
    {
        $this->load->model('General_model', 'model');
        $user = $this->model->getUser();
        $result = [];

        $config['upload_path']   = './file-print/' . $user['id'] . '/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx|zip|rar';
        $config['max_size']      = 50 * 1024;
        $this->load->library('upload', $config);

        //upload file to directory
        if ($this->upload->do_upload('file')) {
            $uploadData = $this->upload->data();
            $uploadedFile = $uploadData['file_name'];

            $dataFile = [
                'id_member'  => $user['id'],
                'title'      => $this->input->post('title'),
                'filename'   => $uploadedFile,
                'num_print'  => $this->input->post('num_print'),
                'keterangan' => $this->input->post('keterangan')
            ];
            $this->db->insert('print_file', $dataFile);

            $file = $this->db->get_where('print_file', ['id_member' => $user['id'], 'filename' => $uploadedFile])->row_array();

            $dataOrder = [
                'id_file'      => $file['id'],
                'id_employee'  => 0,
                'id_status'    => 1,
                'price'        => 0,
                'date_upload'  => time(),
                'date_process' => 0,
                'date_finish'  => 0,
                'date_taken'   => 0,
                'keterangan_reject' => ''
            ];

            $this->db->insert('print_order', $dataOrder);

            $result['status'] = 'success';
        } else {
            $result['status'] = 'error';
            $result['error_msg'] = $this->upload->display_errors();
        }
        return $result;
    }
}
