<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAK - Dashboard</title>
    <!-- Bootstrap 5 & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8f6ff;
            overflow-x: hidden;
        }
        /* Sidebar Kiri */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: #fff;
            padding: 30px 20px;
            border-right: 1px solid #efeafc;
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
            color: #8a83a4;
            font-weight: 600;
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: linear-gradient(135deg, #ff3f86, #7f5eff);
            color: #fff;
            transform: translateX(3px);
        }
        .sidebar .logout-link {
            position: absolute;
            bottom: 30px;
            color: #ff3f86;
            font-weight: 700;
        }

        /* Container Utama dengan Gradasi */
        .main-content {
            margin-left: 260px;
            padding: 40px;
            background: linear-gradient(135deg, #ffb7d2 0%, #b3c5ff 100%);
            min-height: 100vh;
        }
        .welcome-title {
            font-weight: 800;
            color: #2d1f47;
        }
        
        /* Layout Fleksibel 4 Kotak Atas dengan Icon Sistem */
        .stat-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 22px 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.08);
        }
        .stat-card .card-label {
            font-size: 11px;
            text-transform: uppercase;
            font-weight: 700;
            color: #8a83a4;
            letter-spacing: 0.5px;
        }
        .stat-card .card-value {
            font-size: 22px;
            font-weight: 800;
            color: #2d1f47;
            margin-top: 3px;
        }
        /* Desain Simbol Bulat untuk Icon Kategori */
        .stat-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        .icon-purple { background-color: #f3efff; color: #7f5eff; }
        .icon-danger { background-color: #fff1f2; color: #ff3f86; }
        .icon-success { background-color: #ecfdf5; color: #10b981; }
        .icon-primary { background-color: #eff6ff; color: #3b82f6; }

        /* Box Putih Solid */
        .dashboard-box {
            background: #ffffff;
            border-radius: 24px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            height: 100%;
        }

        /* Foto Profil Klikabel */
        .profile-btn {
            background: #ffffff;
            padding: 6px 16px 6px 8px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            text-decoration: none !important;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            border: 1px solid transparent;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .profile-btn:hover {
            transform: translateY(-2px);
            border-color: #7f5eff;
            box-shadow: 0 6px 15px rgba(127, 94, 255, 0.15);
        }
        .profile-img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #7f5eff;
        }

        /* STYLING KALENDER MINI GELAP */
        .mini-calendar {
            background: #231b3c;
            color: #fff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }
        .calendar-header {
            font-weight: 800;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: center;
            color: #ffffff;
            margin-bottom: 15px;
        }
        .calendar-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            text-align: center;
            font-size: 11px;
            font-weight: 700;
            color: #fe5196;
            margin-bottom: 10px;
        }
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            row-gap: 12px;
            text-align: center;
            font-size: 12px;
            font-weight: 600;
        }
        .calendar-grid div {
            padding: 6px 0;
            color: #b1a9cc;
        }
        .calendar-grid .current-day {
            background: linear-gradient(135deg, #ff3f86, #7f5eff);
            color: #fff !important;
            border-radius: 50%;
            font-weight: 800;
            box-shadow: 0 4px 10px rgba(255, 63, 134, 0.4);
        }

        /* Fitur Scroll di Kotak Aktivitas */
        .scrollable-activities {
            max-height: 250px;
            overflow-y: auto;
            padding-right: 5px;
        }
        .scrollable-activities::-webkit-scrollbar {
            width: 5px;
        }
        .scrollable-activities::-webkit-scrollbar-thumb {
            background: #efeafc;
            border-radius: 10px;
        }

        /* Item List Aktivitas */
        .activity-item {
            background: #fdfcff;
            padding: 14px;
            border-radius: 14px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #f1edf8;
        }
        /* Taruh ini di paling atas dalam tag <style> setiap file view */
:root {
    --bg-gradient: linear-gradient(135deg, #ffb7d2 0%, #b3c5ff 100%);
    --bg-sidebar: #ffffff;
    --bg-card: #ffffff;
    --text-main: #2d1f47;
    --border-color: #efeafc;
}

[data-theme="dark"] {
    --bg-gradient: linear-gradient(135deg, #1e1b29 0%, #0f0c1b 100%);
    --bg-sidebar: #151221;
    --bg-card: #1b182b;
    --text-main: #f3efff;
    --border-color: #2b2640;
}

/* Pastikan komponen utama background menggunakan variabel di atas */
body { 
    background: var(--bg-gradient) !important; 
    color: var(--text-main) !important;
    transition: background 0.3s ease, color 0.3s ease;
}
.sidebar { 
    background: var(--bg-sidebar) !important; 
    border-right: 1px solid var(--border-color) !important;
}
.card, .card-custom { 
    background: var(--bg-card) !important; 
    border: 1px solid var(--border-color) !important;
    color: var(--text-main) !important;
}
        .badge-done { background-color: #d1fae5; color: #065f46; font-weight: 700; }
        .badge-incoming { background-color: #ffe4e6; color: #9f1239; font-weight: 700; }
    </style>
</head>
<body>

    <!-- SIDEBAR KIRI -->
    <div class="sidebar">
        <div class="brand">SIMAK</div>
        <nav class="nav flex-column">
            <a class="nav-link active" href="<?php echo base_url('dashboard'); ?>"><i class="fa-solid fa-chart-pie me-2"></i> Dashboard</a>
            <a class="nav-link" href="<?php echo base_url('aktivitas'); ?>"><i class="fa-solid fa-calendar-check me-2"></i> Aktivitas</a>
            <a class="nav-link" href="<?php echo base_url('keuangan'); ?>"><i class="fa-solid fa-wallet me-2"></i> Keuangan</a>
            <a class="nav-link" href="<?php echo base_url('ibadah'); ?>"><i class="fa-solid fa-mosque me-2"></i> Ibadah</a>
            <a class="nav-link" href="<?php echo base_url('statistik'); ?>"><i class="fa-solid fa-chart-line me-2"></i> Statistik</a>
            <a class="nav-link logout-link" href="<?php echo base_url('auth/logout'); ?>"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</a>
        </nav>
    </div>

    <!-- KONTEN UTAMA -->
    <div class="main-content">
        <div class="container-fluid">
            
            <!-- HEADER UTAMA -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="welcome-title">Selamat Datang di SIMAK</h2>
                    <p class="text-secondary mb-0">Pantau ringkasan aktivitas, keuangan, dan perkembangan ibadah harian Anda secara langsung.</p>
                </div>
                
                <!-- LINK FOTO PROFIL (Sesuaikan rute controller jika masih 404 saat diklik) -->
                <a href="<?php echo base_url('dashboard/profile'); ?>" class="profile-btn">
                    <img src="<?php echo !empty($this->session->userdata('foto_profil')) ? base_url('assets/uploads/profile/'.$this->session->userdata('foto_profil')) : 'https://i.pinimg.com/736x/c0/27/74/c027749d9af29af3d687847bc1fbb1fa.jpg'; ?>" class="profile-img me-2" alt="Profile">
                    <div class="text-start me-1">
                        <div class="fw-bold text-dark" style="font-size: 13px; line-height: 1.1;"><?php echo $this->session->userdata('nama'); ?></div>
                        <small class="text-muted" style="font-size: 10px;">Kelola Profil</small>
                    </div>
                </a>
            </div>

            <!-- 4 KOTAK INFORMASI ATAS + LOGO SIMBOL SISTEM -->
            <div class="row g-3 mb-4">
                <!-- 1. Progress Aktivitas -->
                <div class="col-md-3">
                    <div class="stat-card">
                        <div>
                            <div class="card-label">Progress Aktivitas</div>
                            <div class="card-value text-success"><?php echo $persentase_progress; ?>%</div>
                            <div class="progress mt-2" style="height: 5px; width: 120px;">
                                <div class="progress-bar bg-success" style="width: <?php echo $persentase_progress; ?>%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-box icon-success">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                    </div>
                </div>
                
                <!-- 2. Agenda Tertunda -->
                <div class="col-md-3">
                    <div class="stat-card">
                        <div>
                            <div class="card-label">Agenda Tertunda</div>
                            <div class="card-value text-danger"><?php echo $agenda_tertunda; ?> Tugas</div>
                        </div>
                        <div class="stat-icon-box icon-danger">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                    </div>
                </div>
                
                <!-- 3. Total Pemasukan -->
                <div class="col-md-3">
                    <div class="stat-card">
                        <div>
                            <div class="card-label">Total Pemasukan</div>
                            <div class="card-value text-primary">Rp <?php echo number_format($total_pemasukan, 0, ',', '.'); ?></div>
                        </div>
                        <div class="stat-icon-box icon-primary">
                            <i class="fa-solid fa-arrow-trend-up"></i>
                        </div>
                    </div>
                </div>
                
                <!-- 4. Sisa Saldo Aktif (ICON DOMPET) -->
                <div class="col-md-3">
                    <div class="stat-card">
                        <div>
                            <div class="card-label">Sisa Saldo Aktif</div>
                            <div class="card-value" style="color: <?php echo ($sisa_saldo < 0) ? '#ff3f86' : '#7f5eff'; ?>;">
                                Rp <?php echo number_format($sisa_saldo, 0, ',', '.'); ?>
                            </div>
                        </div>
                        <div class="stat-icon-box icon-purple">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BARIS GRAFIK & KANAN (KALENDER + RIWAYAT) -->
            <div class="row g-4">
                <!-- SISI KIRI: GRAFIK KEUANGAN -->
                <div class="col-lg-8">
                    <div class="dashboard-box">
                        <h5 class="fw-bold text-dark mb-4"><i class="fa-solid fa-chart-bar me-2 text-primary"></i> Grafik Analisis Keuangan</h5>
                        <div style="position: relative; height:450px; width:100%">
                            <canvas id="financialChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- SISI KANAN: KALENDER MINI & AKTIVITAS TERBARU -->
                <div class="col-lg-4 d-flex flex-column gap-4">
                    
                    <!-- WIDGET 1: CALENDAR MINI -->
                    <div class="mini-calendar">
                        <div class="calendar-header">
                            <?php echo date('F Y'); ?>
                        </div>
                        <div class="calendar-days">
                            <div>Min</div><div>Sen</div><div>Sel</div><div>Rab</div><div>Kam</div><div>Jum</div><div>Sab</div>
                        </div>
                        <div class="calendar-grid">
                            <?php
                            $hari_ini   = date('d'); 
                            $total_hari = date('t'); 
                            $start_day  = date('w', strtotime(date('Y-m-01')));

                            for ($i = 0; $i < $start_day; $i++) {
                                echo "<div></div>";
                            }
                            for ($day = 1; $day <= $total_hari; $day++) {
                                $class = ($day == $hari_ini) ? 'current-day' : '';
                                echo "<div class='$class'>$day</div>";
                            }
                            ?>
                        </div>
                    </div>

                    <!-- WIDGET 2: AKTIVITAS TERBARU -->
                    <div class="dashboard-box">
                        <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-list-check me-2 text-danger"></i> Aktivitas Terbaru</h5>
                        
                        <div class="scrollable-activities">
                            <?php if(!empty($aktivitas_terbaru)): ?>
                                <?php foreach($aktivitas_terbaru as $row): ?>
                                    <div class="activity-item">
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 14px;"><?php echo $row->nama_aktivitas; ?></div>
                                            <small class="text-muted" style="font-size: 11px;"><?php echo date('d M Y', strtotime($row->tanggal_aktivitas)); ?></small>
                                        </div>
                                        <span class="badge <?php echo (strtolower($row->status_aktivitas) == 'selesai' || strtolower($row->status_aktivitas) == 'done') ? 'badge-done' : 'badge-incoming'; ?> rounded-pill px-3 py-1">
                                            <?php echo ucfirst($row->status_aktivitas); ?>
                                        </span>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center p-3 text-muted" style="font-size: 13px;">Belum ada riwayat aktivitas.</div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Core JavaScript & Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        const ctx = document.getElementById('financialChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Pemasukan', 'Total Pengeluaran'],
                datasets: [{
                    data: [<?php echo $total_pemasukan; ?>, <?php echo $total_pengeluaran; ?>],
                    backgroundColor: [
                        'rgba(52, 211, 153, 0.9)', 
                        'rgba(251, 146, 60, 0.9)'  
                    ],
                    borderColor: [
                        '#10b981',
                        '#f97316'
                    ],
                    borderWidth: 2,
                    borderRadius: 12,
                    barThickness: 60
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0, 0, 0, 0.05)' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
       
    // Langsung cek memori LocalStorage saat halaman di-load
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
    } else {
        document.documentElement.setAttribute('data-theme', 'light');
    }
    </script>
</body>
</html>