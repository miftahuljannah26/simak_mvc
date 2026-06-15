<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIMAK - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: radial-gradient(at 0% 0%, #e06d94 0px, transparent 55%), radial-gradient(at 100% 0%, #5f95f7 0px, transparent 55%); background-attachment: fixed; min-height: 100vh; color: #1e1333; overflow-x: hidden; }
        .app-layout { display: flex; }
        
        /* Sidebar Tetap */
        .sidebar-col { width: 260px; background: #ffffff !important; height: 100vh; position: fixed; z-index: 99; border-right: 1px solid rgba(0,0,0,0.05); padding: 40px 24px; }
        .sidebar-brand { font-family: 'Outfit'; font-weight: 800; font-size: 28px; color: #d12264; margin-bottom: 40px; }
        .nav-link { color: #64748b; font-weight: 600; padding: 12px 0; }
        .nav-link.active { color: #db2777; }

        /* Main Content */
        .main-content-col { flex: 1; margin-left: 260px; padding: 40px; }
        
        /* Container Animasi */
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .card-stat-box { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.7); padding: 20px; border-radius: 20px; animation: fadeIn 0.6s ease-out forwards; transition: transform 0.3s; }
        .card-stat-box:hover { transform: scale(1.02); }
        
        /* Kalender */
        .cal-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 5px; text-align: center; font-size: 11px; }
        .day { padding: 5px; border-radius: 5px; }
        .day.active { background: #db2777; color: #fff; }
    </style>
</head>
<body>
    <div class="app-layout">
        <aside class="sidebar-col">
            <div class="sidebar-brand">SIMAK</div>
            <nav class="nav flex-column">
                <a href="<?= base_url('dashboard'); ?>" class="nav-link active">Dashboard</a>
                <a href="<?= base_url('aktivitas'); ?>" class="nav-link">Aktivitas</a>
                <a href="<?= base_url('keuangan'); ?>" class="nav-link">Keuangan</a>
                <a href="<?= base_url('ibadah'); ?>" class="nav-link">Ibadah</a>
                <a href="<?= base_url('statistik'); ?>" class="nav-link">Statistik</a>
                <a href="<?= base_url('auth/logout'); ?>" class="nav-link text-danger mt-5">Keluar</a>
            </nav>
        </aside>
        
        <main class="main-content-col">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div><h1 class="fw-bold">Selamat Datang di SIMAK 👋</h1><p class="text-muted">Pantau aktivitas dan keuangan harian Anda.</p></div>
                <a href="<?= base_url('profile'); ?>" class="btn btn-light shadow-sm rounded-pill px-4">⚙️ Pengaturan Profil</a>
            </div>

            <div class="card-stat-box mb-4 d-flex align-items-center gap-3">
                <img src="https://ui-avatars.com/api/?name=User" class="rounded-circle" width="50">
                <div><h5 class="m-0 fw-bold"><?= $this->session->userdata('nama'); ?></h5><small><?= $this->session->userdata('email'); ?></small></div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-3"><div class="card-stat-box"><h6>PROGRESS</h6><h4 class="fw-bold text-success"><?= $persen; ?>%</h4></div></div>
                <div class="col-md-3"><div class="card-stat-box"><h6>AGENDA</h6><h4 class="fw-bold text-warning"><?= $agenda_tertunda; ?> Tugas</h4></div></div>
                <div class="col-md-3"><div class="card-stat-box"><h6>PEMASUKAN</h6><h4 class="fw-bold text-success">Rp <?= number_format($total_masuk, 0, ',', '.'); ?></h4></div></div>
                <div class="col-md-3"><div class="card-stat-box"><h6>SALDO</h6><h4 class="fw-bold text-primary">Rp <?= number_format($saldo_aktif, 0, ',', '.'); ?></h4></div></div>
            </div>

            <div class="row g-3">
                <div class="col-md-8"><div class="card-stat-box"><canvas id="chart"></canvas></div></div>
                <div class="col-md-4">
                    <div class="card-stat-box mb-3">
                        <div class="d-flex justify-content-between mb-2"><h6>JUNE 2026</h6></div>
                        <div class="cal-grid"><?php for($i=1; $i<=27; $i++): ?><div class="day <?= $i==12?'active':''; ?>"><?= $i; ?></div><?php endfor; ?></div>
                    </div>
                    <div class="card-stat-box"><h6>Aktivitas Terbaru</h6><?php foreach($aktivitas as $a): ?><p class="small mb-1"><?= $a['nama_aktivitas']; ?></p><?php endforeach; ?></div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('chart'), { type: 'bar', data: { labels: ['Pemasukan', 'Pengeluaran'], datasets: [{ data: [<?= $total_masuk; ?>, <?= $total_keluar; ?>], backgroundColor: ['#22c55e', '#ef4444'] }] } });
    </script>
</body>
</html>