public function update() {
    $id = $this->session->userdata('id_user');
    $data = [
        'nama' => $this->input->post('nama'),
        'email' => $this->input->post('email')
    ];
    
    // Jika password diisi, enkripsi dan simpan
    if($this->input->post('password')) {
        $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
    }
    
    $this->db->update('user', $data, ['id_user' => $id]);
    $this->session->set_flashdata('pesan', 'Profil Berhasil Diupdate');
    redirect('profile');
}