<?php

class General_model extends CI_Model
{
    public function getUser()
    {
        return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function getAllDataUser()
    {
        $query = "SELECT `user`.* , `user_role`.`role` FROM `user` 
                  JOIN `user_role` 
                   ON `role_id` = `user_role`.`id`";
        return $this->db->query($query)->result_array();
    }

    public function makeDirectory($id)
    {
        mkdir('./file-print/' . $id);
    }

    public function deleteImage($image)
    {
        if ($image != 'default.png') {
            unlink(FCPATH . 'assets/img/profile/' . $image);
        }
    }

    public function deleteFilePrint($id)
    {
        $this->_deleteFileInServer('./file-print/' . $id);
        $this->_deletePrintInDatabase($id);
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
}
