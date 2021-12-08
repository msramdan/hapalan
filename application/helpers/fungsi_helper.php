<?php
function check_already_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('userid');
    if ($user_session) {
        redirect('home');
    }
}

function is_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('userid');
    if (!$user_session) {
        redirect('auth');
    }
}

function check_access($guru_id, $kelompok_id)
{
    $ci = get_instance();
    $ci->db->where('guru_id', $guru_id);
    $ci->db->where('kelompok_id', $kelompok_id);
    $result = $ci->db->get('access_guru_to_kelompok');
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function check_aktif_semester($tahun_ajaran_detail_id)
{
    $ci = get_instance();
    $ci->db->where('tahun_ajaran_detail_id', $tahun_ajaran_detail_id);
    $data = $ci->db->get('tahun_ajaran_detail')->row();
    if ($data->status =='Aktif') {
        return "checked='checked'";
    }
}


function check_admin()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level != 'ADMIN') {
        redirect('home');
    }
}





