<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_keuangan extends CI_Model {

    // Fungsi untuk mengambil seluruh riwayat transaksi keuangan user
    public function get_by_user($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get('keuangan')->result_array();
    }
}