<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }

        $this->load->model('M_keuangan');
        $this->load->model('M_aktivitas');
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');

        // ==========================================
        // 1. HITUNG HITUNGAN KEUANGAN & GRAFIK
        // ==========================================
        $data_keuangan = $this->M_keuangan->get_keuangan_by_user($id_user);
        $total_pemasukan = 0;
        $total_pengeluaran = 0;

        foreach ($data_keuangan as $transaksi) {
            if (strtolower($transaksi->jenis_transaksi) == 'pemasukan') {
                $total_pemasukan += $transaksi->nominal;
            } else if (strtolower($transaksi->jenis_transaksi) == 'pengeluaran') {
                $total_pengeluaran += $transaksi->nominal;
            }
        }
        $sisa_saldo = $total_pemasukan - $total_pengeluaran;

        // ==========================================
        // 2. HITUNG PROGRESS & AGENDA TERTUNDA
        // ==========================================
        $data_aktivitas = $this->M_aktivitas->get_aktivitas_by_user($id_user);
        $total_aktivitas = count($data_aktivitas);
        $aktivitas_selesai = 0;
        $agenda_tertunda = 0;

        foreach ($data_aktivitas as $akt) {
            if (strtolower($akt->status_aktivitas) == 'selesai' || strtolower($akt->status_aktivitas) == 'done') {
                $aktivitas_selesai++;
            } else if (strtolower($akt->status_aktivitas) == 'incoming' || strtolower($akt->status_aktivitas) == 'pending') {
                $agenda_tertunda++;
            }
        }
        
        $persentase_progress = ($total_aktivitas > 0) ? round(($aktivitas_selesai / $total_aktivitas) * 100) : 0;

        // ==========================================
        // 3. KIRIM DATA KE VIEW
        // ==========================================
        $data['total_pemasukan']     = $total_pemasukan;
        $data['total_pengeluaran']   = $total_pengeluaran;
        $data['sisa_saldo']          = $sisa_saldo;
        $data['persentase_progress'] = $persentase_progress;
        $data['agenda_tertunda']     = $agenda_tertunda;
        $data['aktivitas_terbaru']   = $data_aktivitas; // Nanti di-looping di widget kanan bawah

        $this->load->view('dashboard/dashboard', $data);
    }
}