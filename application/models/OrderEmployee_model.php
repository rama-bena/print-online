<?php

class OrderEmployee_model extends CI_Model
{
    public function getAllOrderStatus($id_status)
    {
        return $this->db->get_where('print_order', ['id_status' => $id_status])->result_array();
    }
}
