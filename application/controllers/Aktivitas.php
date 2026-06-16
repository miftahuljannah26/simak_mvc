<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivitas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        
        if (!$this->session->userdata('login')) {
            redirect('auth');
        }

        $this->load->model('M_aktivitas');
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');
        
        $data['aktivitas'] = $this->M_aktivitas->get_aktivitas_by_user($id_user);
        
        // Mengambil kategori bawaan (NULL) DAN kategori buatan user ini
        $this->db->where('id_user', $id_user)->or_where('id_user', NULL);
        $data['kategori']  = $this->db->get('kategori_aktivitas')->result();

        $this->load->view('dashboard/aktivitas', $data);
    }

    public function tambahKategoriMurni() {
        $nama_kategori = $this->input->post('nama_kategori_baru');
        $id_user = $this->session->userdata('id_user');

        if (!empty($nama_kategori)) {
            $data = [
                'nama_kategori' => $nama_kategori,
                'id_user'       => $id_user
            ];
            $this->db->insert('kategori_aktivitas', $data);
            $this->session->set_flashdata('pesan', 'Kategori baru berhasil dibuat!');
        }
        redirect('aktivitas');
    }

    public function hapusKategori($id_kategori) {
        $this->db->where('id_kategori_aktivitas', $id_kategori);
        $this->db->delete('kategori_aktivitas');
        
        $this->session->set_flashdata('pesan', 'Kategori berhasil dihapus!');
        redirect('aktivitas');
    }

    public function tambahAktivitas() {
        $nama_aktivitas        = $this->input->post('nama_aktivitas');
        $id_kategori_aktivitas = $this->input->post('id_kategori_aktivitas');
        $tanggal_aktivitas     = $this->input->post('tanggal_aktivitas');
        $status_aktivitas      = $this->input->post('status_aktivitas'); // Menangkap opsi dari UI baru

        $data = [
            'nama_aktivitas'        => $nama_aktivitas,
            'tanggal_aktivitas'     => $tanggal_aktivitas,
            'status_aktivitas'      => $status_aktivitas, // Menyimpan status sesuai pilihan dropdown user
            'id_user'               => $this->session->userdata('id_user'),
            'id_kategori_aktivitas' => $id_kategori_aktivitas
        ];

        $this->M_aktivitas->insert_aktivitas($data);
        redirect('aktivitas');
    }

    // FUNGSI UPDATE UTAMA - SUDAH DISINKRONKAN DENGAN MODEL ASLI KAMU
    public function perbaruiAktivitas() {
        $id_aktivitas = $this->input->post('id_aktivitas');
        
        $data = [
            'nama_aktivitas'        => $this->input->post('nama_aktivitas'),
            'id_kategori_aktivitas' => $this->input->post('id_kategori_aktivitas'),
            'tanggal_aktivitas'     => $this->input->post('tanggal_aktivitas'),
            'status_aktivitas'      => $this->input->post('status_aktivitas')
        ];

        // Mengeksekusi update lewat fungsi model bawaanmu agar terhindar dari salah nama tabel
        $this->M_aktivitas->update_aktivitas($id_aktivitas, $data); 
        
        $this->session->set_flashdata('pesan', 'Agenda berhasil diperbarui!');
        redirect('aktivitas');
    }

    public function prosesAktivitas($id_aktivitas) {
        $this->M_aktivitas->update_aktivitas($id_aktivitas, ['status_aktivitas' => 'In Progress']);
        redirect('aktivitas');
    }

    public function selesaiAktivitas($id_aktivitas) {
        $this->M_aktivitas->update_aktivitas($id_aktivitas, ['status_aktivitas' => 'Done']);
        redirect('aktivitas');
    }

    public function hapusAktivitas($id_aktivitas) {
        $this->M_aktivitas->delete_aktivitas($id_aktivitas);
        redirect('aktivitas');
    }
}