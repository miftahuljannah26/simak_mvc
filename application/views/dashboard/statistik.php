<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAK - Statistik & Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-body: linear-gradient(135deg, #fbc2eb 0%, #a6c1ee 100%);
            --bg-sidebar: #ffffff;
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
            margin: 0;
        }
        
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: var(--bg-sidebar);
            padding: 30px 20px;
            border-right: 1px solid var(--border-color);
            z-index: 10;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar .brand {
            font-weight: 800;
            font-size: 24px;
            color: #fe5196;
            margin-bottom: 30px;
            padding-left: 15px;
            letter-spacing: 1px;
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
        .dashboard-box {
            background: var(--bg-box);
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(127, 94, 255, 0.08);
            border: 1px solid var(--border-color);
            margin-bottom: 25px;
        }

        .btn-gradient-filter {
            background: #1e1b4b;
            color: white;
            font-weight: 600;
            border-radius: 12px;
            padding: 8px 20px;
            border: none;
            transition: all 0.2s;
        }
        .btn-gradient-filter:hover { background: #2e2a63; color: white; }

        .btn-gradient-export {
            background: linear-gradient(135deg, #ff3f86, #7f5eff);
            color: white;
            font-weight: 700;
            border: none;
            padding: 10px 24px;
            border-radius: 14px;
            transition: opacity 0.2s;
        }
        .btn-gradient-export:hover { opacity: 0.9; color: white; }

        .table th {
            color: #797195;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #f1f5f9;
        }
        .table td { padding: 16px 12px; vertical-align: middle; font-size: 14px; }
        .badge-pemasukan { background-color: #e6fbf1; color: #10b981; font-weight: 700; padding: 6px 14px; border-radius: 8px; text-transform: uppercase; font-size: 11px; }
        .badge-pengeluaran { background-color: #fff1f2; color: #f43f5e; font-weight: 700; padding: 6px 14px; border-radius: 8px; text-transform: uppercase; font-size: 11px; }
        [data-theme="dark"] .table{
    color:#f3efff;
}

[data-theme="dark"] .text-muted{
    color:#a29bbd !important;
}

[data-theme="dark"] .form-control,
[data-theme="dark"] .form-select{
    background:#221e38;
    color:#f3efff;
    border-color:#2b2640;
}

[data-theme="dark"] canvas{
    filter: brightness(0.95);
}
    </style>
</head>
<body data-theme="<?= $this->session->userdata('theme') == 'dark' ? 'dark' : 'light'; ?>"></body>
    <div class="sidebar">
        <div>
            <div class="brand">SIMAK</div>
            <nav class="nav flex-column">
                <a class="nav-link" href="<?= base_url('index.php/dashboard'); ?>"><i class="fa-solid fa-chart-pie me-2"></i> Dashboard</a>
                <a class="nav-link" href="<?= base_url('index.php/aktivitas'); ?>"><i class="fa-solid fa-calendar-days me-2"></i> Aktivitas</a>
                <a class="nav-link" href="<?= base_url('index.php/keuangan'); ?>"><i class="fa-solid fa-wallet me-2"></i> Keuangan</a>
                <a class="nav-link" href="<?= base_url('index.php/ibadah'); ?>"><i class="fa-solid fa-mosque me-2"></i> Ibadah</a>
                <a class="nav-link active" href="#"><i class="fa-solid fa-chart-line me-2"></i> Statistik</a>
            </nav>
        </div>
        <div>
            <a class="nav-link text-danger mb-4" href="<?= base_url('index.php/auth/logout'); ?>"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            
            <div class="dashboard-box p-4">
                <form method="GET" action="" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <h4 class="fw-bold mb-1" style="color:#1e1b4b;">📊 Statistik & Laporan Berkala</h4>
                        <span class="text-muted small">Analisis visual grafik aktivitas, neraca keuangan bulanan, serta berkas cetak PDF formal.</span>
                    </div>
                    <div class="col-md-2 col-6">
                        <label class="small fw-bold text-muted mb-1">Pilih Bulan</label>
                        <select name="bulan" class="form-select form-select-sm rounded-3">
                            <?php 
                            $bulan_nama = [1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                            foreach($bulan_nama as $key => $val): ?>
                                <option value="<?= $key; ?>" <?= $key == $bulan_pilih ? 'selected' : ''; ?>><?= $val; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2 col-6">
                        <label class="small fw-bold text-muted mb-1">Pilih Tahun</label>
                        <select name="tahun" class="form-select form-select-sm rounded-3">
                            <?php for($i = date('Y')-2; $i <= date('Y')+2; $i++): ?>
                                <option value="<?= $i; ?>" <?= $i == $tahun_pilih ? 'selected' : ''; ?>><?= $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col-md-2 col-6">
                        <button type="submit" class="btn btn-gradient-filter btn-sm w-100 py-2"><i class="fa-solid fa-filter me-1"></i> Terapkan</button>
                    </div>
                    <div class="col-md-2 col-6">
                       <a href="<?= base_url('statistik/ekspor_pdf?bulan=' . $bulan_pilih . '&tahun=' . $tahun_pilih); ?>" class="btn btn-gradient-export btn-sm w-100 py-2">
    <i class="fa-solid fa-file-pdf me-1"></i> Ekspor (PDF)
</a>
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <div class="dashboard-box text-center">
                        <h6 class="fw-bold text-start mb-4" style="color: #1e1b4b;"><i class="fa-solid fa-chart-pie text-primary me-2"></i>Statistik Rasio Aktivitas (<?= $bulan_nama[$bulan_pilih].' '.$tahun_pilih; ?>)</h6>
                        <div style="position: relative; height:220px;">
                            <canvas id="chartAktivitas"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="dashboard-box text-center">
                        <h6 class="fw-bold text-start mb-4" style="color: #1e1b4b;"><i class="fa-solid fa-chart-bar text-warning me-2"></i>Neraca Arus Kas Masuk & Keluar (<?= $bulan_nama[$bulan_pilih].' '.$tahun_pilih; ?>)</h6>
                        <div style="position: relative; height:220px;">
                            <canvas id="chartKeuangan"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dashboard-box p-4">
                <h6 class="fw-bold mb-4" style="color: #1e1b4b;"><i class="fa-solid fa-file-invoice-dollar text-success me-2"></i>Dokumen Laporan Transaksi Keuangan</h6>
                <div class="table-responsive">
                    <table class="table table-borderless align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Keterangan / Catatan</th>
                                <th>Aliran Dana</th>
                                <th class="text-end">Nominal Anggaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($riwayat_keuangan)): ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">Tidak ada riwayat transaksi keuangan pada periode bulan ini.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($riwayat_keuangan as $rk): ?>
                                    <tr>
                                        <td class="fw-semibold text-muted"><?= date('d M Y', strtotime($rk['tanggal_transaksi'])); ?></td>
                                        <td class="fw-bold" style="color:#1e1b4b;"><?= !empty($rk['catatan']) ? $rk['catatan'] : 'Tanpa Keterangan'; ?></td>
                                        <td>
                                            <span class="<?= strtolower($rk['jenis_transaksi']) == 'pemasukan' ? 'badge-pemasukan' : 'badge-pengeluaran'; ?>">
                                                <?= $rk['jenis_transaksi']; ?>
                                            </span>
                                        </td>
                                        <td class="text-end fw-bold <?= strtolower($rk['jenis_transaksi']) == 'pemasukan' ? 'text-success' : 'text-danger'; ?>">
                                            <?= strtolower($rk['jenis_transaksi']) == 'pemasukan' ? '+ ' : '- '; ?>Rp <?= number_format($rk['nominal'], 0, ',', '.'); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                
                                <tr class="border-top" style="border-top-style: dashed !important;">
                                    <td colspan="3" class="text-end fw-bold text-uppercase pt-3" style="color:#797195; font-size:12px;">Sisa Saldo Bersih Periode Ini:</td>
                                    <td class="text-end fw-bold pt-3 <?= $saldo_bersih >= 0 ? 'text-success' : 'text-danger'; ?>" style="font-size:16px;">
                                        <?= $saldo_bersih < 0 ? '- ' : ''; ?>Rp <?= number_format(abs($saldo_bersih), 0, ',', '.'); ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <script>
        // Taruh di baris paling terakhir file statistik.php
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
        document.body.className = savedTheme + '-theme';
    </script>
</body>
</html>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // 1. Logika Donut Chart (Aktivitas)
        const ctxAktivitas = document.getElementById('chartAktivitas').getContext('2d');
        new Chart(ctxAktivitas, {
            type: 'doughnut',
            data: {
                labels: ['Selesai (Done)', 'Tertunda / Belum'],
                datasets: [{
                    data: [<?= $count_selesai; ?>, <?= $count_belum; ?>],
                    backgroundColor: ['#10b981', '#f97316'], 
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top' } }
            }
        });

        // 2. Logika Bar Chart (Arus Kas Keuangan)
        const ctxKeuangan = document.getElementById('chartKeuangan').getContext('2d');
        new Chart(ctxKeuangan, {
            type: 'bar',
            data: {
                labels: ['Pemasukan', 'Pengeluaran'],
                datasets: [{
                    label: 'Nominal Rupiah',
                    data: [<?= $total_pemasukan; ?>, <?= $total_pengeluaran; ?>],
                    backgroundColor: ['#10b981', '#f97316'], 
                    borderRadius: 10,
                    barThickness: 50
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>
</body>
</html>