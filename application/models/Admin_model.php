<?php

class Admin_model extends CI_Model
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

    public function deleteUser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }

    public function changeRole($id, $role_id)
    {
        $this->db->set('role_id', $role_id);
        $this->db->where('id', $id);
        $this->db->update('user');
    }
}
