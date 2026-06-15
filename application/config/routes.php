<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 1. Rute Default Halaman Awal (Form Login)
$route['default_controller'] = 'auth';

// 2. Rute Sektor Autentikasi (Registrasi & Lupa Password)
$route['auth/registrasi'] = 'auth/registrasi';
$route['auth/registrasi_process'] = 'auth/registrasi_process';
$route['auth/forgot_password'] = 'auth/forgot_password';
$route['auth/proses_reset'] = 'auth/proses_reset';

// 3. Rute Sektor Dashboard Utama
$route['dashboard'] = 'dashboard';

// ========== TAMBAHKAN 2 BARIS BARU INI (KUNCI PASAL 404) ==========
$route['dashboard/profile'] = 'dashboard/profile';
$route['dashboard/update']  = 'dashboard/update';
// ==================================================================

// 4. Rute Sektor Manajemen Aktivitas (Mengarah ke Controller Aktivitas yang Benar)
$route['aktivitas'] = 'Aktivitas'; 
$route['aktivitas/simpan'] = 'Aktivitas/simpan';
$route['aktivitas/hapus/(:any)'] = 'Aktivitas/hapus/$1';

// 5. Rute Sektor Keuangan
$route['keuangan'] = 'keuangan';
$route['keuangan/simpan'] = 'keuangan/simpan';

// 6. Rute Lainnya (Sesuai Kebutuhan)
$route['logout'] = 'auth/logout';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;