<?php
class Ibadah extends CI_Controller {
    public function index() {
        // Mengambil data dari tabel 'ibadah' berdasarkan user yang login
        $id_user = $this->session->userdata('id_user');
        $data['ibadah'] = $this->db->get_where('ibadah', ['id_user' => $id_user])->result_array();
        $this->load->view('ibadah', $data);
    }

    public function simpan() {
        $data = [
            'nama_ibadah'    => $this->input->post('nama_ibadah'),
            'tanggal_ibadah' => $this->input->post('tanggal_ibadah'),
            'status_ibadah'  => $this->input->post('status_ibadah'),
            'id_user'        => $this->session->userdata('id_user')
        ];
        $this->db->insert('ibadah', $data);
        redirect('ibadah');
    }

    public function hapus($id) {
        $this->db->delete('ibadah', ['id_ibadah' => $id]);
        redirect('ibadah');
    }
}