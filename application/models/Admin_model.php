<?php

class Admin_model extends CI_Model
{
    public function deleteUser($id)
    {
        $user = $this->db->get_where('user', ['id' => $id])->row_array();

        $this->load->model('General_model', 'model');
        $this->model->deleteImage($user['image']);

        $this->_deleteFileInServer('./file-print/' . $id);
        $this->_deletePrintInDatabase($id);
        $this->db->where('id', $id);
        $this->db->delete('user');
    }

    private function _deleteFileInServer($target)
    {
        if (is_dir($target)) {
            $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned
            foreach ($files as $file) {
                delete_files($file);
            }

            rmdir($target);
        } elseif (is_file($target)) {
            unlink($target);
        }
    }

    private function _deletePrintInDatabase($id)
    {
        $printFiles = $this->db->get_where('print_file', ['id_user' => $id])->result_array();

        foreach ($printFiles as $printFile) {
            $idFile = $printFile['id'];
            $this->db->where('id_file', $idFile);
            $this->db->delete('print_order');
        }

        $this->db->where('id_user', $id);
        $this->db->delete('print_file');
    }


    public function changeRole($id, $role_id)
    {
        $this->db->set('role_id', $role_id);
        $this->db->where('id', $id);
        $this->db->update('user');
    }
}
