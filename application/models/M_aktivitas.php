<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_aktivitas extends CI_Model {

    public function get_by_user($id_user) {
        $this->db->where('id_user', $id_user);
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get('tbl_aktivitas')->result_array();
    }
}