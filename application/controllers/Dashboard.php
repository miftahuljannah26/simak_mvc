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
        // 1. HITUNG HITUNGAN KEUANGAN & GRAFIK (BAWAAN UTUH)
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
        // 2. HITUNG PROGRESS & AGENDA TERTUNDA (SINKRON AGAR AKURAT)
        // ==========================================
        $data_aktivitas = $this->M_aktivitas->get_aktivitas_by_user($id_user);
        $total_aktivitas = count($data_aktivitas);
        $aktivitas_selesai = 0;
        $agenda_tertunda = 0;

        foreach ($data_aktivitas as $akt) {
            $status = strtolower($akt->status_aktivitas);
            if ($status == 'selesai' || $status == 'done') {
                $aktivitas_selesai++;
            } else if ($status == 'incoming' || $status == 'in progress' || $status == 'pending') {
                $agenda_tertunda++;
            }
        }
        
        $persentase_progress = ($total_aktivitas > 0) ? round(($aktivitas_selesai / $total_aktivitas) * 100) : 0;

        // ==========================================
// 3. LOGIC BARU: FILTER AKTIVITAS TERDEKAT & BELUM SELESAI
// ==========================================
$hari_ini = date('Y-m-d'); 
$tiga_hari_kedepan = date('Y-m-d', strtotime('+3 days'));
$aktivitas_terbaru_filtered = [];

foreach ($data_aktivitas as $act) {
    $status = strtolower($act->status_aktivitas);
    $tgl_act = date('Y-m-d', strtotime($act->tanggal_aktivitas));

    // Filter: Belum selesai (bukan Done/Selesai) DAN berada di rentang hari ini s.d 3 hari ke depan
    if ($status !== 'done' && $status !== 'selesai') {
        if ($tgl_act >= $hari_ini && $tgl_act <= $tiga_hari_kedepan) {
            $aktivitas_terbaru_filtered[] = $act;
        }
    }
}

// Urutkan array berdasarkan tanggal terdekat (Ascending)
usort($aktivitas_terbaru_filtered, function($a, $b) {
    return strtotime($a->tanggal_aktivitas) - strtotime($b->tanggal_aktivitas);
});

        // ==========================================
        // 4. KIRIM DATA KE VIEW (Mengarah ke dashboard.php bawaanmu)
        // ==========================================
        $data['total_pemasukan']     = $total_pemasukan;
        $data['total_pengeluaran']   = $total_pengeluaran;
        $data['sisa_saldo']          = $sisa_saldo;
        $data['persentase_progress'] = $persentase_progress;
        $data['agenda_tertunda']     = $agenda_tertunda;
        
        // Sekarang variabel ini hanya berisi list tugas aktif 3 hari kedepan
        $data['aktivitas_terbaru']   = $aktivitas_terbaru_filtered; 

        $this->load->view('dashboard/dashboard', $data);
    }

    public function profile() {
        $this->load->view('dashboard/profile_settings'); 
    }

    public function update() {
        $id = $this->session->userdata('id_user');
        
        $data = [
            'nama'  => $this->input->post('nama'),
            'email' => $this->input->post('email')
        ];

        $password_input = $this->input->post('password');
        if (!empty($password_input)) { 
            $data['password'] = md5($password_input);
        }

        if (!empty($_FILES['foto_profil']['name'])) {
            $config['upload_path']   = './assets/uploads/profile/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name']     = 'profile_' . $id . '_' . time();
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_profil')) {
                $upload_data = $this->upload->data();
                $file_name   = $upload_data['file_name'];
                
                $data['foto_profil'] = $file_name;
                $this->session->set_userdata('foto_profil', $file_name);
            } else {
                $this->session->set_flashdata('error_upload', $this->upload->display_errors());
            }
        }

        $this->db->update('user', $data, ['id_user' => $id]);

        $this->session->set_userdata('nama', $data['nama']);
        $this->session->set_userdata('email', $data['email']);

        $this->session->set_flashdata('pesan', 'Profil Berhasil Diupdate');
        redirect('dashboard/profile');
    }
}