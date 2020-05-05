<?php

class Admin_model extends CI_Model
{
    public function deleteUser($id)
    {
        $user = $this->db->get_where('user', ['id' => $id])->row_array();

        $this->load->model('General_model', 'model');
        $this->model->deleteImage($user['image']);

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
