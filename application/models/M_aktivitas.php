<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_aktivitas extends CI_Model {

    public function get_aktivitas_by_user($id_user) {
        $this->db->select('aktivitas.*, kategori_aktivitas.nama_kategori');
        $this->db->from('aktivitas');
        // Menggunakan LEFT JOIN agar jika kategori dihapus, aktivitasnya tidak ikut hilang tersembunyi
        $this->db->join('kategori_aktivitas', 'aktivitas.id_kategori_aktivitas = kategori_aktivitas.id_kategori_aktivitas', 'left');
        $this->db->where('aktivitas.id_user', $id_user);
        $this->db->order_by('aktivitas.id_aktivitas', 'DESC');
        return $this->db->get()->result();
    }

    public function insert_aktivitas($data) {
        return $this->db->insert('aktivitas', $data);
    }

    public function update_aktivitas($id_aktivitas, $data) {
        $this->db->where('id_aktivitas', $id_aktivitas);
        return $this->db->update('aktivitas', $data);
    }

    public function delete_aktivitas($id_aktivitas) {
        $this->db->where('id_aktivitas', $id_aktivitas);
        return $this->db->delete('aktivitas');
    }
}