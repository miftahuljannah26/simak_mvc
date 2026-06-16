<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('M_keuangan');

        if (!$this->session->userdata('login')) {
            redirect('auth');
        }
    }

    public function index() {
        $id_user = $this->session->userdata('id_user');

        // 1. Ambil Ringkasan Saldo & Riwayat Transaksi
        $summary = $this->M_keuangan->get_summary_keuangan($id_user);
        $data['total_pemasukan']   = $summary['total_pemasukan'];
        $data['total_pengeluaran'] = $summary['total_pengeluaran'];
        $data['sisa_saldo']        = $summary['sisa_saldo'];
        $data['riwayat_keuangan']  = $this->M_keuangan->get_keuangan_by_user($id_user);

        // 2. Siapkan Data Diagram Persentase Kategori Pengeluaran
        $chart_data = $this->M_keuangan->get_pengeluaran_per_kategori($id_user);
        
        $kategori_labels = [];
        $kategori_totals = [];
        foreach ($chart_data as $c) {
            $kategori_labels[] = $c['kategori_utama'];
            $kategori_totals[] = (int)$c['total'];
        }
        
        $data['chart_labels'] = json_encode($kategori_labels);
        $data['chart_totals'] = json_encode($kategori_totals);

        $this->load->view('dashboard/keuangan', $data);
    }

   public function tambah_transaksi() {
    $id_user = $this->session->userdata('id_user');
    $jenis_transaksi = $this->input->post('jenis_transaksi');
    
    // 1. Tentukan Kategori Utama & Sub Kategori berdasarkan Jenis Transaksi
    if ($jenis_transaksi === 'Pemasukan') {
        $kategori_utama = 'Pemasukan';
        $sub_kategori   = $this->input->post('sumber_pemasukan');
    } else {
        $kategori_utama = $this->input->post('kategori_utama'); // Primer, Sekunder, dll
        $sub_kategori   = $this->input->post('sub_kategori');
        
        if ($sub_kategori === 'KUSTOM') {
            $sub_kategori = $this->input->post('sub_kategori_kustom');
        }
    }

    // 2. KELOLA DATA HIERARKI KATEGORI (Parent & Child)
    
    // A. Cek atau Buat Kategori Utama (Parent) -> Harus NULL untuk Parent Utama
    $this->db->where('nama_kategori', $kategori_utama);
    $this->db->where('id_parent IS NULL', null, false); // Mencari yang id_parent-nya NULL
    $parent = $this->db->get('kategori_keuangan')->row();
    
    if ($parent) {
        $id_parent = $parent->id_kategori_keuangan;
    } else {
        $data_parent = [
            'nama_kategori' => $kategori_utama,
            'id_parent'     => NULL // Menggunakan NULL agar lolos Foreign Key Constraint
        ];
        $this->db->insert('kategori_keuangan', $data_parent);
        $id_parent = $this->db->insert_id();
    }

    // B. Cek atau Buat Sub Kategori (Child)
    $this->db->where('nama_kategori', $sub_kategori);
    $this->db->where('id_parent', $id_parent);
    $child = $this->db->get('kategori_keuangan')->row();

    if ($child) {
        $id_kategori_keuangan = $child->id_kategori_keuangan;
    } else {
        $data_child = [
            'nama_kategori' => $sub_kategori,
            'id_parent'     => $id_parent
        ];
        $this->db->insert('kategori_keuangan', $data_child);
        $id_kategori_keuangan = $this->db->insert_id();
    }

    // 3. INSERT DATA FINAL KE TABEL KEUANGAN
    $insert_data = [
        'id_user'              => $id_user,
        'id_kategori_keuangan' => $id_kategori_keuangan,
        'jenis_transaksi'      => $jenis_transaksi,
        'nominal'              => $this->input->post('nominal'),
        'kategori_utama'       => $kategori_utama,
        'sub_kategori'         => $sub_kategori,
        'tanggal_transaksi'    => $this->input->post('tanggal_transaksi'),
        'catatan'              => $this->input->post('catatan')
    ];

    $this->db->insert('keuangan', $insert_data);
    redirect('keuangan');
}

    public function hapus($id)
{
    // Cek apakah user sudah login
    if (!$this->session->userdata('id_user')) {
        redirect('auth');
    }

    // Panggil model untuk hapus data berdasarkan id_transaksi
    $this->M_keuangan->hapus_keuangan($id);

    // Kasih notifikasi (opsional)
    $this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil dihapus!</div>');

    // Balikin ke halaman keuangan
    redirect('keuangan');
}
}