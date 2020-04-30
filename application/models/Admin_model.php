<?php

class Admin_model extends CI_Model
{

    public function getUser()
    {
        return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function getAllDataUser()
    {
        $query = "SELECT * FROM `user` 
                  JOIN `user_role` 
                   ON `role_id` = `user_role`.`id`";
        return $this->db->query($query)->result_array();
    }
}
