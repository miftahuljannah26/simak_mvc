<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAK - Dompet Finansial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-body: linear-gradient(135deg, #fbc2eb 0%, #a6c1ee 100%);
            --bg-sidebar: #ffffff; /* Sesuai Light Theme */
            --bg-box: #ffffff;
            --text-main: #1e1b4b;
            --text-muted: #4a3f6d;
            --border-color: #e2e8f0;
        }
        [data-theme="dark"]{
            --bg-body: linear-gradient(135deg, #140d26 0%, #0f172a 100%);
            --bg-sidebar: #151221;
            --bg-box: #1b182b;
            --text-main: #f3efff;
            --text-muted: #a29bbd;
            --border-color: #2b2640;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
        }
        
        /* SIDEBAR LIGHT THEME DENGAN MENUL LENGKAP */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: var(--bg-sidebar);
            padding: 30px 20px;
            border-right: 1px solid var(--border-color);
            z-index: 10;
        }
        .sidebar .brand {
            font-weight: 800;
            font-size: 24px;
            color: #fe5196;
            margin-bottom: 40px;
            padding-left: 15px;
        }
        .sidebar .nav-link {
            color: #797195 !important;
            font-weight: 600;
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 8px;
            text-decoration: none;
            display: block;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: linear-gradient(135deg, #ff3f86, #7f5eff) !important;
            color: #fff !important;
        }
        
        .main-content {
            margin-left: 260px;
            padding: 40px;
            min-height: 100vh;
        }
        .finance-card {
            background: var(--bg-box);
            border-radius: 24px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(127, 94, 255, 0.08);
            border: 1px solid var(--border-color);
            text-align: center;
        }
        .saldo-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
        }
        .saldo-value {
            font-size: 42px;
            font-weight: 800;
            margin: 10px 0;
            color: var(--text-main);
        }
        .summary-badge {
            font-size: 14px;
            font-weight: 600;
        }
        .dashboard-box {
            background: var(--bg-box);
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(127, 94, 255, 0.08);
            border: 1px solid var(--border-color);
            margin-top: 25px;
        }
        .btn-gradient {
            background: linear-gradient(135deg, #ff3f86, #7f5eff);
            color: white;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
        }
        .btn-dark-custom {
            background-color: #1e1b29;
            color: white;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
        }
        .bg-success-subsub {
            background-color: #d1fae5;
            color: #065f46;
        }
        .bg-danger-subsub {
            background-color: #fee2e2;
            color: #991b1b;
        }
        [data-theme="dark"] .table{
            color:#f3efff;
        }

        [data-theme="dark"] .text-muted{
            color:#a29bbd !important;
        }

        [data-theme="dark"] .modal-content{
            background:#1b182b;
            color:#f3efff;
            border:1px solid #2b2640;
        }

        [data-theme="dark"] .form-control,
        [data-theme="dark"] .form-select{
            background:#221e38;
            color:#f3efff;
            border-color:#2b2640;
        }

        [data-theme="dark"] .form-control:focus,
        [data-theme="dark"] .form-select:focus{
            background:#221e38;
            color:#f3efff;
        }
    </style>
</head>
<body data-theme="<?= $this->session->userdata('theme') == 'dark' ? 'dark' : 'light'; ?>">

    <div class="sidebar">
        <div class="brand">SIMAK</div>
        <nav class="nav flex-column">
            <a class="nav-link" href="<?= base_url('index.php/dashboard'); ?>"><i class="fa-solid fa-chart-pie me-2"></i> Dashboard</a>
            <a class="nav-link" href="<?= base_url('index.php/aktivitas'); ?>"><i class="fa-solid fa-calendar-days me-2"></i> Aktivitas</a>
            <a class="nav-link active" href="#"><i class="fa-solid fa-wallet me-2"></i> Keuangan</a>
            <a class="nav-link" href="<?= base_url('index.php/ibadah'); ?>"><i class="fa-solid fa-mosque me-2"></i> Ibadah</a>
            <a class="nav-link" href="<?= base_url('index.php/statistik'); ?>"><i class="fa-solid fa-chart-line me-2"></i> Statistik</a>
            <a class="nav-link text-danger mt-5" href="<?= base_url('index.php/auth/logout'); ?>"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            
            <h2 class="mb-4" style="font-weight:800; color:#1e1b4b;">Dompet Finansial 💳</h2>

            <div class="finance-card mb-4">
                <div class="saldo-title">Total Saldo Aktif Kamu</div>
                <div class="saldo-value">Rp <?= number_format($sisa_saldo, 0, ',', '.'); ?></div>
                <div class="mb-4">
                    <span class="summary-badge text-success me-3">Pemasukan: <b class="text-success">Rp <?= number_format($total_pemasukan, 0, ',', '.'); ?></b></span> | 
                    <span class="summary-badge text-danger ms-3">Pengeluaran: <b class="text-danger">Rp <?= number_format($total_pengeluaran, 0, ',', '.'); ?></b></span>
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <button class="btn btn-gradient" data-bs-toggle="modal" data-bs-target="#modalTransaksi"><i class="fa-solid fa-plus me-2"></i>Catat Transaksi</button>
                    <button class="btn btn-dark-custom" data-bs-toggle="modal" data-bs-target="#modalChart"><i class="fa-solid fa-chart-pie me-2"></i>Persentase Kategori</button>
                </div>
            </div>

            <div class="dashboard-box">
                <h5 class="fw-bold mb-4">📋 Riwayat Histori Finansial</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr class="text-muted" style="font-size: 14px;">
                                <th>Catatan / Keterangan</th>
                                <th>Tanggal</th>
                                <th>Aliran Dana</th>
                                <th>Kategori [Sub]</th>
                                <th>Nominal Anggaran</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($riwayat_keuangan)): ?>
                                <?php foreach($riwayat_keuangan as $row): ?>
                                    <tr>
                                        <td>
                                            <span class="fw-bold d-block"><?= !empty($row->catatan) ? $row->catatan : 'Tanpa Keterangan'; ?></span>
                                        </td>
                                        <td class="text-muted">
                                            <?php 
                                                $tgl = (!empty($row->tanggal_transaksi)) ? $row->tanggal_transaksi : date('Y-m-d');
                                                echo date('d-m-Y', strtotime($tgl)); 
                                            ?>
                                        </td>
                                        <td>
                                            <span class="badge <?= (strtolower($row->jenis_transaksi) == 'pemasukan') ? 'bg-success-subsub text-success' : 'bg-danger-subsub text-danger'; ?> fw-bold px-3 py-2">
                                                <?= strtoupper($row->jenis_transaksi); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if(strtolower($row->jenis_transaksi) == 'pengeluaran'): ?>
                                                <span class="badge bg-secondary text-white"><?= $row->kategori_utama; ?></span>
                                                <small class="text-muted d-block mt-1"><?= $row->sub_kategori; ?></small>
                                            <?php else: ?>
                                                <span class="badge bg-success text-white">Pemasukan</span>
                                                <small class="text-muted d-block mt-1"><?= $row->sub_kategori; ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td class="fw-bold <?= (strtolower($row->jenis_transaksi) == 'pemasukan') ? 'text-success' : 'text-danger'; ?>">
                                            <?= (strtolower($row->jenis_transaksi) == 'pemasukan') ? '+ ' : '- '; ?>Rp <?= number_format($row->nominal, 0, ',', '.'); ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url('index.php/keuangan/hapus/'.$row->id_transaksi); ?>" class="btn btn-sm btn-light text-danger" onclick="return confirm('Hapus transaksi ini?')"><i class="fa-solid fa-xmark"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="text-center text-muted py-4">Belum ada riwayat transaksi finansial.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="modalTransaksi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Tambah Transaksi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= base_url('index.php/keuangan/tambah_transaksi'); ?>" method="POST">
                    <div class="modal-body">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Aliran Dana</label>
                            <select name="jenis_transaksi" id="jenis_transaksi" class="form-control" required>
                                <option value="Pemasukan">Pemasukan</option>
                                <option value="Pengeluaran">Pengeluaran</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nominal (Rp)</label>
                            <input type="number" name="nominal" class="form-control" placeholder="Contoh: 50000" required>
                        </div>

                        <div id="container_pengeluaran" style="display: none;">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Kategori Utama</label>
                                <select name="kategori_utama" id="kat_utama" class="form-control">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Primer">Primer</option>
                                    <option value="Sekunder">Sekunder</option>
                                    <option value="Spiritual">Spiritual</option>
                                    <option value="Pribadi">Pribadi</option>
                                </select>
                            </div>

                            <div class="mb-3" id="wrapper_sub_kat">
                                <label class="form-label fw-bold">Sub Kategori</label>
                                <select name="sub_kategori" id="sub_kat" class="form-control">
                                    <option value="">-- Pilih Sub Kategori --</option>
                                </select>
                            </div>
                        </div>

                        <div id="container_pemasukan">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Sumber Pemasukan</label>
                                <select name="sumber_pemasukan" id="sumber_pemasukan" class="form-control">
                                    <option value="Gaji Utama">Gaji Utama</option>
                                    <option value="Uang Saku / Bulanan">Uang Saku / Bulanan</option>
                                    <option value="Hasil Bisnis / Dagang">Hasil Bisnis / Dagang</option>
                                    <option value="Bonus / Hadiah">Bonus / Hadiah</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3" id="wrapper_sub_kustom" style="display: none;">
                            <label class="form-label fw-bold text-primary">Ketik Sub Kategori Baru</label>
                            <input type="text" name="sub_kategori_kustom" id="sub_kategori_kustom" class="form-control" placeholder="Misal: Servis Laptop, Beli Kado">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal</label>
                            <input type="date" name="tanggal_transaksi" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Catatan / Keterangan <span class="text-muted fw-normal">(Opsional)</span></label>
                            <input type="text" name="catatan" class="form-control" placeholder="Keterangan tambahan jika ada">
                        </div>

                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-gradient">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalChart" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">📊 Persentase Pengeluaran Berdasarkan Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <div style="max-width: 320px; margin: 0 auto;">
                        <canvas id="categoryPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        const subKategoriPengeluaran = {
            'Primer': ['Makanan', 'Transportasi', 'Pendidikan'],
            'Sekunder': ['Hiburan', 'Belanja', 'Skin Care'],
            'Spiritual': ['Sedekah', 'Zakat', 'Infaq'],
            'Pribadi': ['Tabungan', 'Keperluan Mandiri']
        };

        const jenisTransaksi = document.getElementById('jenis_transaksi');
        const containerPengeluaran = document.getElementById('container_pengeluaran');
        const containerPemasukan = document.getElementById('container_pemasukan');
        const wrapperSubKustom = document.getElementById('wrapper_sub_kustom');
        const katUtama = document.getElementById('kat_utama');
        const subKat = document.getElementById('sub_kat');
        const subKustomInput = document.getElementById('sub_kategori_kustom');

        jenisTransaksi.addEventListener('change', function() {
            wrapperSubKustom.style.display = 'none';
            subKustomInput.removeAttribute('required');

            if (this.value === 'Pemasukan') {
                containerPemasukan.style.display = 'block';
                containerPengeluaran.style.display = 'none';
                katUtama.removeAttribute('required');
            } else {
                containerPemasukan.style.display = 'none';
                containerPengeluaran.style.display = 'block';
                katUtama.setAttribute('required', 'required');
                updateSubKategori();
            }
        });

        function updateSubKategori() {
            const utama = katUtama.value;
            subKat.innerHTML = '<option value="">-- Pilih Sub Kategori --</option>';
            wrapperSubKustom.style.display = 'none';
            subKustomInput.removeAttribute('required');

            if (subKategoriPengeluaran[utama]) {
                subKategoriPengeluaran[utama].forEach(sub => {
                    subKat.innerHTML += `<option value="${sub}">${sub}</option>`;
                });
                subKat.innerHTML += '<option value="KUSTOM" style="font-weight: bold; color: #7f5eff;">+ Tambah Sub Kategori Baru</option>';
            }
        }

        katUtama.addEventListener('change', updateSubKategori);

        subKat.addEventListener('change', function() {
            if (this.value === 'KUSTOM') {
                wrapperSubKustom.style.display = 'block';
                subKustomInput.setAttribute('required', 'required');
                subKustomInput.focus();
            } else {
                wrapperSubKustom.style.display = 'none';
                subKustomInput.removeAttribute('required');
            }
        });

        // Jalankan trigger default awal
        jenisTransaksi.dispatchEvent(new Event('change'));

        // GENERATE GRAPH CHART
        const ctx = document.getElementById('categoryPieChart').getContext('2d');
        const labelsData = <?= isset($chart_labels) ? $chart_labels : '[]'; ?>;
        const totalsData = <?= isset($chart_totals) ? $chart_totals : '[]'; ?>;

        if (labelsData.length > 0) {
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labelsData,
                    datasets: [{
                        data: totalsData,
                        backgroundColor: ['#ff3f86', '#7f5eff', '#10b981', '#f59e0b']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'bottom' } }
                }
            });
        } else {
            document.getElementById('categoryPieChart').parentElement.innerHTML = "<p class='text-muted py-4'>Belum ada data pengeluaran untuk dianalisis.</p>";
        }
    </script>
</body>
</html>