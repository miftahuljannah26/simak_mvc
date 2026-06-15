<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        if (!$this->session->userdata('login')) { redirect('auth'); }
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');
        
        // Ambil riwayat keuangan dari database tabel 'keuangan'
        $data['keuangan'] = $this->db->where('id_user', $id_user)->order_by('id_keuangan', 'DESC')->get('keuangan')->result_array();
        
        // Hitung total pemasukan dan pengeluaran untuk ringkasan di atas tabel
        $pemasukan = $this->db->select_sum('jumlah')->where(['id_user' => $id_user, 'jenis' => 'pemasukan'])->get('keuangan')->row()->jumlah ?? 0;
        $pengeluaran = $this->db->select_sum('jumlah')->where(['id_user' => $id_user, 'jenis' => 'pengeluaran'])->get('keuangan')->row()->jumlah ?? 0;
        
        $data['total_masuk'] = $pemasukan;
        $data['total_keluar'] = $pengeluaran;
        $data['saldo_aktif'] = $pemasukan - $pengeluaran;

        $this->load->view('keuangan', $data);
    }

    public function simpan() {
        $data = [
            'id_user' => $this->session->userdata('id_user'),
            'nama_transaksi' => $this->input->post('nama_transaksi'),
            'jenis' => $this->input->post('jenis'),
            'jumlah' => $this->input->post('jumlah'),
            'tanggal' => $this->input->post('tanggal')
        ];
        $this->db->insert('keuangan', $data);
        redirect('keuangan');
    }

    public function hapus($id) {
        $this->db->where('id_keuangan', $id);
        $this->db->delete('keuangan');
        redirect('keuangan');
    }
}