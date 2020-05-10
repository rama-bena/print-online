<?php

class OrderEmployee_model extends CI_Model
{
    public function getAllOrderStatus($id_status)
    {
        $po = "SELECT `id` `id_po`, `id_file`, `id_employee`,
                      `id_status`, `date_upload`, `date_process`,
                      `date_finish`, `date_taken`, `keterangan_reject` 
                FROM `print_order`";

        $po_pf = "SELECT `id_member`, `title`, `filename`,
                         `num_print`, `keterangan` ,`po`.* 
                  FROM ($po) `po`
                  JOIN `print_file` `pf`
                    ON `id_file` = `pf`.`id`
                  WHERE `id_status` = $id_status";

        $po_pf_user = "SELECT `po_pf`.*, `name`, `email`, `no_telp` FROM ($po_pf) `po_pf`
                    JOIN `user` 
                    ON `id_member` = `user`.`id` ";

        return $this->db->query($po_pf_user)->result_array();
    }

    public function reject($id_po, $id_employee, $keterangan_reject)
    {
        $this->db->set('id_employee', $id_employee);
        $this->db->set('id_status', 5);
        $this->db->set('date_process', time());
        $this->db->set('keterangan_reject', $keterangan_reject);
        $this->db->where('id', $id_po);
        $this->db->update('print_order');
    }

    public function toProcess($id_po, $id_employee)
    {
        $this->db->set('id_employee', $id_employee);
        $this->db->set('id_status', 2);
        $this->db->set('date_process', time());
        $this->db->where('id', $id_po);
        $this->db->update('print_order');
    }

    public function toFinish($id_po, $price)
    {
        $this->db->set('id_status', 3);
        $this->db->set('price', $price);
        $this->db->set('date_finish', time());
        $this->db->where('id', $id_po);
        $this->db->update('print_order');
    }
}
