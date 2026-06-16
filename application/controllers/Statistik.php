<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistik extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth');
        }
        $this->load->model('M_statistik');
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');

        $bulan = $this->input->get('bulan') ? $this->input->get('bulan') : date('n');
        $tahun = $this->input->get('tahun') ? $this->input->get('tahun') : date('Y');

        // Ambil Data Donut Chart
        $aktivitas = $this->M_statistik->get_rasio_aktivitas($id_user, $bulan, $tahun);
        $data['count_selesai'] = isset($aktivitas['selesai']) ? (int)$aktivitas['selesai'] : 0;
        $data['count_belum']   = isset($aktivitas['belum']) ? (int)$aktivitas['belum'] : 0;

        // Ambil Data Bar Chart
        $kas = $this->M_statistik->get_arus_kas($id_user, $bulan, $tahun);
        $data['total_pemasukan']   = isset($kas['total_masuk']) ? (int)$kas['total_masuk'] : 0;
        $data['total_pengeluaran'] = isset($kas['total_keluar']) ? (int)$kas['total_keluar'] : 0;
        $data['saldo_bersih']      = $data['total_pemasukan'] - $data['total_pengeluaran'];

        // Ambil List Histori
        $data['riwayat_keuangan'] = $this->M_statistik->get_riwayat_keuangan($id_user, $bulan, $tahun);

        $data['bulan_pilih'] = $bulan;
        $data['tahun_pilih'] = $tahun;

        $this->load->view('dashboard/statistik', $data);
    }
    // Taruh di bagian paling bawah Controller Statistik.php sebelum penutup class
    public function ekspor_pdf() {
        $id_user = $this->session->userdata('id_user');
        $bulan = $this->input->get('bulan') ? $this->input->get('bulan') : date('n');
        $tahun = $this->input->get('tahun') ? $this->input->get('tahun') : date('Y');

        // Ambil data untuk dilempar ke PDF
        $data['bulan_pilih'] = $bulan;
        $data['tahun_pilih'] = $tahun;
        $data['riwayat_keuangan'] = $this->M_statistik->get_riwayat_keuangan($id_user, $bulan, $tahun);
        
        // Gantilah baris di bawah ini dengan library PDF yang kamu pakai (misal Dompdf / Mpdf)
        // Contoh standar cetak view ke html biasa dulu untuk tes:
        $this->load->view('dashboard/cetak_statistik_pdf', $data);
    }
}