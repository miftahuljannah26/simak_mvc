<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_aktivitas extends CI_Model {

    // INI FUNGSI YANG DICARI-CARI CONTROLLER DASHBOARD DI BARIS 41!
    public function get_aktivitas_by_user($id_user)
    {
        // Menarik data dari tabel 'aktivitas' berdasarkan user yang login
        // diurutkan dari tanggal aktivitas paling baru
        return $this->db
            ->where('id_user', $id_user)
            ->order_by('tanggal_aktivitas', 'DESC')
            ->get('aktivitas')
            ->result();
    }

    public function simpan_aktivitas($data)
    {
        return $this->db->insert('aktivitas', $data);
    }

    public function ubah_status($id_aktivitas, $status)
    {
        return $this->db
            ->where('id_aktivitas', $id_aktivitas)
            ->update('aktivitas', ['status_aktivitas' => $status]);
    }

    public function hapus_aktivitas($id_aktivitas)
    {
        return $this->db
            ->where('id_aktivitas', $id_aktivitas)
            ->delete('aktivitas');
    }
}