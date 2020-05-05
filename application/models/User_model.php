<?php

class User_model extends CI_Model
{

    public function changePassword($new_password, $email)
    {
        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $this->db->set('password', $password_hash);
        $this->db->where('email', $email);
        $this->db->update('user');
    }
}
