<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_statistik extends CI_Model {

    // 1. RASIO AKTIVITAS (Selesai vs Belum)
    public function get_rasio_aktivitas($id_user, $bulan, $tahun) {
        $this->db->select("
            SUM(CASE WHEN status_aktivitas = 'Selesai' OR status_aktivitas = 'Done' THEN 1 ELSE 0 END) as selesai,
            SUM(CASE WHEN status_aktivitas != 'Selesai' AND status_aktivitas != 'Done' THEN 1 ELSE 0 END) as belum
        ");
        $this->db->where('id_user', $id_user);
        $this->db->where('MONTH(tanggal_aktivitas)', $bulan);
        $this->db->where('YEAR(tanggal_aktivitas)', $tahun);
        return $this->db->get('aktivitas')->row_array();
    }

    // 2. AMBIL TOTAL ARUS KAS (Sesuai Kolom: jenis_transaksi & nominal)
    public function get_arus_kas($id_user, $bulan, $tahun) {
        $this->db->select("
            SUM(CASE WHEN LOWER(jenis_transaksi) = 'pemasukan' THEN nominal ELSE 0 END) as total_masuk,
            SUM(CASE WHEN LOWER(jenis_transaksi) = 'pengeluaran' THEN nominal ELSE 0 END) as total_keluar
        ");
        $this->db->where('id_user', $id_user);
        $this->db->where('MONTH(tanggal_transaksi)', $bulan);
        $this->db->where('YEAR(tanggal_transaksi)', $tahun);
        return $this->db->get('keuangan')->row_array();
    }

    // 3. DAFTAR RIWAYAT TRANSAKSI BULANAN UNTUK TABEL (Sesuai Kolom: tanggal_transaksi)
    public function get_riwayat_keuangan($id_user, $bulan, $tahun) {
        $this->db->where('id_user', $id_user);
        $this->db->where('MONTH(tanggal_transaksi)', $bulan);
        $this->db->where('YEAR(tanggal_transaksi)', $tahun);
        $this->db->order_by('tanggal_transaksi', 'DESC');
        return $this->db->get('keuangan')->result_array();
    }
}