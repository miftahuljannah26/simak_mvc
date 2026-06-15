<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('M_user');
    }

    public function index() {
        if ($this->session->userdata('login')) {
            redirect('dashboard');
        }
        $this->load->view('auth/login');
    }

    public function login_process()
{
    $email    = $this->input->post('email');
    $password = $this->input->post('password');

    if (empty($email) || empty($password)) {
        echo "<script>
                alert('Input tidak boleh kosong!');
                window.location.href='".base_url('auth')."';
              </script>";
        return;
    }

    $user = $this->M_user->cek_login(
        $email,
        md5($password)
    );

    if ($user) {

        $session_data = array(
            'id_user'       => $user->id_user,
            'nama_lengkap'  => $user->nama_lengkap,
            'email'         => $user->email,
            'login'         => TRUE
        );

        $this->session->set_userdata($session_data);

        redirect('dashboard');

    } else {

        echo "<script>
                alert('Email atau Password salah!');
                window.location.href='".base_url('auth')."';
              </script>";
    }
}

    public function registrasi() {
        $this->load->view('auth/registrasi');
    }

    public function registrasi_process() {

        $email    = $this->input->post('email');
        $password = $this->input->post('password');

        if (strlen($password) > 15) {

            echo "<script>
                    alert('Password maksimal 15 karakter!');
                    window.location.href='".base_url('auth/registrasi')."';
                  </script>";
            return;
        }

        $email_exist = $this->M_user->cek_email($email);

        if ($email_exist) {

            echo "<script>
                    alert('Email sudah digunakan!');
                    window.location.href='".base_url('auth/registrasi')."';
                  </script>";
            return;
        }

        $data_user = array(
    'nama_lengkap' => $this->input->post('nama'),
    'email'        => $email,
    'password'     => md5($password)
);

        $this->M_user->simpan_akun($data_user);

        echo "<script>
                alert('Registrasi berhasil! Silahkan login.');
                window.location.href='".base_url('auth')."';
              </script>";
    }

    public function forgot_password() {
        $this->load->view('auth/forgot_password');
    }

    public function proses_reset() {

        $email = $this->input->post('email');
        $password_baru = $this->input->post('password_baru');

        if (strlen($password_baru) > 15) {

            echo "<script>
                    alert('Password maksimal 15 karakter!');
                    window.location.href='".base_url('auth/forgot_password')."';
                  </script>";
            return;
        }

        $email_found = $this->M_user->cek_email($email);

        if ($email_found) {

            $this->M_user->update_password_by_email(
                $email,
                md5($password_baru)
            );

            echo "<script>
                    alert('Password berhasil diperbarui! Silahkan login kembali.');
                    window.location.href='".base_url('auth')."';
                  </script>";

        } else {

            echo "<script>
                    alert('Email tidak ditemukan!');
                    window.location.href='".base_url('auth/forgot_password')."';
                  </script>";
        }
    }

    public function logout() {

        $this->session->sess_destroy();
        redirect('auth');
    }
}