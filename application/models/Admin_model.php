<?php

class Admin_model extends CI_Model
{
    public function deleteUser($id)
    {
        $user = $this->db->get_where('user', ['id' => $id])->row_array();

        $this->load->model('General_model', 'model');
        $this->model->deleteImage($user['image']);

        $this->model->deleteFilePrint($id);


        $this->db->where('id', $id);
        $this->db->delete('user');
    }

    public function changeRole($id, $new_role_id)
    {
        $old_role_id = $this->db->get_where('user', ['id' => $id])->row_array()['role_id'];
        $this->load->model('General_model', 'model');

        if ($old_role_id == 2 && $new_role_id != 2) {
            $this->model->deleteFilePrint($id);
        }

        if ($new_role_id == 2 && $old_role_id != 2) {
            $this->model->makeDirectory($id);
        }

        $this->db->set('role_id', $new_role_id);
        $this->db->where('id', $id);
        $this->db->update('user');
    }
}
