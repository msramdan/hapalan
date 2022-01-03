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


function check_siswa()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level != 'SISWA') {
        redirect('home');
    }
}



function nama_surat($surat_id){
        $ci = &get_instance();
        $result = $ci->db->get_where('surat', array('surat_id' => $surat_id))->row();
        return $result->nama_surat;
    }

    function nama_kelas($kelas_id){
        $ci = &get_instance();
        $result = $ci->db->get_where('kelas', array('kelas_id' => $kelas_id))->row();
        return $result->nama_kelas;
    }





