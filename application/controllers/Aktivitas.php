<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivitas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        if (!$this->session->userdata('login')) { redirect('auth'); }
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');
        $data['aktivitas'] = $this->db->where('id_user', $id_user)->order_by('id_aktivitas', 'DESC')->get('tbl_aktivitas')->result_array();
        $this->load->view('aktivitas', $data);
    }

    public function simpan() {
        $data = [
            'id_user' => $this->session->userdata('id_user'),
            'nama_aktivitas' => $this->input->post('nama_aktivitas'),
            'kategori' => $this->input->post('kategori'),
            'tanggal' => $this->input->post('tanggal'),
            'status' => $this->input->post('status')
        ];
        $this->db->insert('tbl_aktivitas', $data);
        redirect('aktivitas');
    }

    public function hapus($id) {
        $this->db->where('id_aktivitas', $id);
        $this->db->delete('tbl_aktivitas');
        redirect('aktivitas');
    }
}