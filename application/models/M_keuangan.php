<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_keuangan extends CI_Model {

    // INI FUNGSI YANG DICARI OLEH CONTROLLER DASHBOARD!
    public function get_keuangan_by_user($id_user)
    {
        // Menarik data dari tabel 'keuangan' berdasarkan ID user yang sedang login
        return $this->db
            ->where('id_user', $id_user)
            ->order_by('tanggal_transaksi', 'DESC')
            ->get('keuangan')
            ->result();
    }

    public function simpan_transaksi($data)
    {
        return $this->db->insert('keuangan', $data);
    }

    public function hapus_transaksi($id_transaksi)
    {
        return $this->db
            ->where('id_transaksi', $id_transaksi)
            ->delete('keuangan');
    }
}