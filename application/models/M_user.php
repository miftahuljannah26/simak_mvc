<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    public function cek_login($email, $password)
    {
        return $this->db
            ->where('email', $email)
            ->where('password', $password)
            ->get('users')
            ->row();
    }

    public function cek_email($email)
    {
        return $this->db
            ->where('email', $email)
            ->get('users')
            ->row();
    }

    public function simpan_akun($data)
    {
        return $this->db->insert('users', $data);
    }

    public function update_password_by_email($email, $password_baru)
    {
        return $this->db
            ->where('email', $email)
            ->update('users', [
                'password' => $password_baru
            ]);
    }
}