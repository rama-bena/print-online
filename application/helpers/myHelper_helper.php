<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $nowMenu = $ci->uri->segment(1);

        $nowMenuId = $ci->db->get_where('user_menu', ['menu' => $nowMenu])->row_array();
        $menuId = $nowMenuId['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menuId
        ]);
        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function flashDataMessage($message, $type, $redirect)
{
    $ci = get_instance();
    $ci->session->set_flashdata('message', '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert"> ' . $message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    redirect($redirect);
}
