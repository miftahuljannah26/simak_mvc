<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
        $this->load->model('M_aktivitas');
    }

    public function index() 
    {
        $id_user = $this->session->userdata('id_user');

        // Ambil list aktivitas terbaru
        $data['aktivitas'] = $this->M_aktivitas->get_by_user($id_user); 

        // Rangkuman Agenda
        $this->db->where('id_user', $id_user);
        $total_agenda = $this->db->count_all_results('tbl_aktivitas');
        
        $this->db->where(['id_user' => $id_user, 'status' => 'selesai']);
        $agenda_selesai = $this->db->count_all_results('tbl_aktivitas');

        $this->db->where(['id_user' => $id_user, 'status !=' => 'selesai']);
        $data['agenda_tertunda'] = $this->db->count_all_results('tbl_aktivitas');
        
        $data['persen'] = ($total_agenda > 0) ? round(($agenda_selesai / $total_agenda) * 100) : 0;

        // Hitung Keuangan Langsung lewat DB Builder
        $pemasukan = $this->db->select_sum('jumlah')->where(['id_user' => $id_user, 'jenis' => 'pemasukan'])->get('keuangan')->row()->jumlah ?? 0;
        $pengeluaran = $this->db->select_sum('jumlah')->where(['id_user' => $id_user, 'jenis' => 'pengeluaran'])->get('keuangan')->row()->jumlah ?? 0;
        
        $data['total_masuk'] = $pemasukan;
        $data['total_keluar'] = $pengeluaran;
        $data['saldo_aktif'] = $pemasukan - $pengeluaran;

        $this->load->view('dashboard', $data);
    }
}