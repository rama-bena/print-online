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

    public function deleteImage($image)
    {
        if ($image != 'default.png') {
            unlink(FCPATH . 'assets/img/profile/' . $image);
        }
    }
}
