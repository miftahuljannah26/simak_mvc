<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    public function cek_login($email, $password)
    {
        // Diubah dari 'users' menjadi 'user' sesuai database barumu
        return $this->db
            ->where('email', $email)
            ->where('password', $password)
            ->get('user')
            ->row();
    }

    public function cek_email($email)
    {
        // Diubah dari 'users' menjadi 'user'
        return $this->db
            ->where('email', $email)
            ->get('user')
            ->row();
    }

    public function simpan_akun($data)
    {
        // Diubah dari 'users' menjadi 'user'
        return $this->db->insert('user', $data);
    }

    public function update_password_by_email($email, $password_baru)
    {
        // Diubah dari 'users' menjadi 'user'
        return $this->db
            ->where('email', $email)
            ->update('user', [
                'password' => $password_baru
            ]);
    }
}