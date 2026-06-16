<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_keuangan extends CI_Model {

    public function get_keuangan_by_user($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->order_by('tanggal_transaksi', 'DESC');
        return $this->db->get('keuangan')->result();
    }

    public function get_summary_keuangan($id_user) {
        $this->db->where('id_user', $id_user);
        $data = $this->db->get('keuangan')->result();

        $pemasukan = 0;
        $pengeluaran = 0;

        foreach ($data as $row) {
            if (strtolower(trim($row->jenis_transaksi)) == 'pemasukan') {
                $pemasukan += $row->nominal;
            } else if (strtolower(trim($row->jenis_transaksi)) == 'pengeluaran') {
                $pengeluaran += $row->nominal;
            }
        }

        return [
            'total_pemasukan'   => $pemasukan,
            'total_pengeluaran' => $pengeluaran,
            'sisa_saldo'        => $pemasukan - $pengeluaran
        ];
    }

    public function get_pengeluaran_per_kategori($id_user) {
        $this->db->select('kategori_utama, SUM(nominal) as total');
        $this->db->where('id_user', $id_user);
        $this->db->where('LOWER(jenis_transaksi)', 'pengeluaran');
        $this->db->group_by('kategori_utama');
        return $this->db->get('keuangan')->result_array();
    }

    // === INI FUNGSI BARU YANG TADI HILANG/BELUM ADA ===
    public function hapus_keuangan($id) {
        // Menggunakan id_transaksi sesuai struktur tabel keuangan kamu
        $this->db->where('id_transaksi', $id);
        return $this->db->delete('keuangan');
    }
}