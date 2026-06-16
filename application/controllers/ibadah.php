<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ibadah extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('auth');
        }
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');
        $hari_ini = date('Y-m-d');
        
        // Ambil tanggal dari parameter GET
        $tanggal = $this->input->get('tanggal_ibadah') ? $this->input->get('tanggal_ibadah') : $hari_ini;

        // CRITICAL LOGIC VALIDATION: Jika input tanggal melebihi hari ini, paksa balik ke hari ini!
        if ($tanggal > $hari_ini) {
            redirect('ibadah?tanggal_ibadah=' . $hari_ini);
        }

        // Ambil data dari database berdasarkan model EAV baris bertingkat kamu
        $this->db->where('id_user', $id_user);
        $this->db->where('tanggal_ibadah', $tanggal);
        $list_ibadah = $this->db->get('ibadah')->result();

        $data['checked_ibadah'] = [];
        $data['nilai_kustom'] = ['mengaji' => '', 'target_lainnya' => ''];
        
        $total_terpenuhi = 0;
        $total_target = 5; 

        foreach ($list_ibadah as $row) {
            $nama = strtolower($row->nama_ibadah);
            
            if (in_array($nama, ['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya'])) {
                if ($row->status_ibadah == 'Sudah' || $row->status_ibadah == '1') {
                    $data['checked_ibadah'][$nama] = true;
                    $total_terpenuhi++;
                }
            } elseif ($nama == 'mengaji') {
                $data['nilai_kustom']['mengaji'] = $row->status_ibadah;
                if (!empty($row->status_ibadah)) {
                    $total_target++;
                    $total_terpenuhi++;
                }
            } elseif ($nama == 'target_lainnya') {
                $data['nilai_kustom']['target_lainnya'] = $row->status_ibadah;
                if (!empty($row->status_ibadah)) {
                    $total_target++;
                    $total_terpenuhi++;
                }
            }
        }

        $data['progress_total'] = ($total_terpenuhi > 0) ? round(($total_terpenuhi / $total_target) * 100) : 0;
        $data['tanggal_pilih'] = $tanggal;
        $data['hari_ini'] = $hari_ini; // Dikirim ke view untuk penguncian tombol

        $this->load->view('dashboard/ibadah', $data);
    }

    public function simpan_ibadah() {
        $id_user = $this->session->userdata('id_user');
        $tanggal = $this->input->post('tanggal_ibadah');
        $hari_ini = date('Y-m-d');

        // VALIDATION SECURITY: Tolak simpan kalau tanggal form di manipulasi ke masa depan
        if ($tanggal > $hari_ini) {
            redirect('ibadah?tanggal_ibadah=' . $hari_ini);
        }

        $daftar_waktu = ['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya'];
        foreach ($daftar_waktu as $waktu) {
            $status = $this->input->post($waktu) ? 'Sudah' : 'Belum';
            $this->save_atau_update($id_user, $tanggal, $waktu, $status);
        }

        $mengaji = $this->input->post('mengaji');
        $this->save_atau_update($id_user, $tanggal, 'mengaji', $mengaji);

        $target_lainnya = $this->input->post('target_lainnya');
        $this->save_atau_update($id_user, $tanggal, 'target_lainnya', $target_lainnya);

        redirect('ibadah?tanggal_ibadah='.$tanggal);
    }

    private function save_atau_update($id_user, $tanggal, $nama_ibadah, $status) {
        $this->db->where('id_user', $id_user);
        $this->db->where('tanggal_ibadah', $tanggal);
        $this->db->where('nama_ibadah', $nama_ibadah);
        $cek = $this->db->get('ibadah')->row();

        $data = [
            'id_user'        => $id_user,
            'tanggal_ibadah' => $tanggal,
            'nama_ibadah'    => $nama_ibadah,
            'status_ibadah'  => $status
        ];

        if ($cek) {
            $this->db->where('id_ibadah', $cek->id_ibadah);
            $this->db->update('ibadah', $data);
        } else {
            $this->db->insert('ibadah', $data);
        }
    }
}