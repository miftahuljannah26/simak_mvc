<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAK - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #fbc2eb 0%, #a6c1ee 100%) !important;
            overflow-x: hidden;
            min-height: 100vh;
        }
        /* Sidebar Kiri - Tema Gelap Gulita */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: #110e1b !important;
            padding: 30px 20px;
            border-right: 1px solid #1f1a30;
            z-index: 10;
        }
        .sidebar .brand {
            font-weight: 800;
            font-size: 24px;
            color: #fe5196;
            margin-bottom: 40px;
            padding-left: 15px;
            letter-spacing: 1px;
        }
        .sidebar .nav-link {
            color: #797195 !important;
            font-weight: 600;
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: linear-gradient(135deg, #ff3f86, #7f5eff) !important;
            color: #fff !important;
            transform: translateX(3px);
        }
        .sidebar .logout-link {
            position: absolute;
            bottom: 30px;
            color: #ff3f86 !important;
            font-weight: 700;
        }

        /* Container Utama */
        .main-content {
            margin-left: 260px;
            padding: 40px;
            background: linear-gradient(135deg, #fbaec8 0%, #c1bdf7 50%, #b8cbfc 100%) !important;
            min-height: 100vh;
        }
        .welcome-title {
            font-weight: 800;
            color: #ffffff !important;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .welcome-subtitle {
            color: #4a3f6d !important;
            font-weight: 600;
        }
        
        /* Box Gelap Premium (Dipaksa !important agar tidak ditimpa bootstrap) */
        .stat-card {
            background: #191528 !important;
            border-radius: 20px !important;
            padding: 22px 20px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2) !important;
            transition: all 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #241f3a !important;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-card .card-label {
            font-size: 11px;
            text-transform: uppercase;
            font-weight: 700;
            color: #928aa9 !important;
            letter-spacing: 0.5px;
        }
        .stat-card .card-value {
            font-size: 24px;
            font-weight: 800;
            color: #ffffff !important;
            margin-top: 3px;
        }
        
        .stat-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            background: #201b33 !important;
        }
        .icon-purple { color: #8b5cf6; }
        .icon-danger { color: #ec4899; }
        .icon-success { color: #10b981; }
        .icon-primary { color: #3b82f6; }

        .dashboard-box {
            background: #191528 !important;
            border-radius: 24px !important;
            padding: 30px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2) !important;
            height: 100%;
            border: 1px solid #241f3a !important;
        }
        .dashboard-box h5 {
            color: #ffffff !important;
        }

        /* Foto Profil */
        .profile-btn {
            background: rgba(25, 21, 40, 0.85) !important;
            padding: 6px 16px 6px 8px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            text-decoration: none !important;
            border: 1px solid #241f3a !important;
        }
        .profile-img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #7f5eff;
        }

        /* Kalender */
        .mini-calendar {
            background: #191528 !important;
            color: #fff !important;
            border-radius: 24px !important;
            padding: 25px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2) !important;
            border: 1px solid #241f3a !important;
        }
        .calendar-header {
            font-weight: 800;
            color: #ffffff !important;
            text-align: center;
            margin-bottom: 20px;
        }
        .calendar-days div {
            color: #fe5196 !important;
            font-weight: 700;
        }
        .calendar-grid div {
            color: #baafda !important;
        }
        .calendar-grid .current-day {
            background: linear-gradient(135deg, #ff3f86, #7f5eff) !important;
            color: #fff !important;
            border-radius: 50%;
            font-weight: 800;
        }

        /* List Aktivitas Terbaru */
        .scrollable-activities {
            max-height: 380px;
            overflow-y: auto;
        }
        .activity-item {
            background: #201b33 !important;
            padding: 16px;
            border-radius: 16px;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #2b2546 !important;
        }
        
        /* Badges / Status */
        .badge-done { 
            background-color: #10b981 !important; 
            color: #ffffff !important; 
            font-weight: 700; 
        }
        .badge-inprogress { 
            background-color: #2563eb !important; 
            color: #ffffff !important; 
            font-weight: 700; 
        }
        .badge-incoming { 
            background-color: rgba(255, 63, 134, 0.2) !important; 
            color: #ff5596 !important; 
            font-weight: 700; 
            border: 1px solid rgba(255, 63, 134, 0.4) !important; 
        }
    </style>
</head>
<body>

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

    <div class="main-content">
        <div class="container-fluid">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="welcome-title">Selamat Datang di SIMAK</h2>
                    <p class="welcome-subtitle mb-0">Pantau ringkasan aktivitas, keuangan, dan perkembangan ibadah harian Anda secara langsung.</p>
                </div>
                
                <a href="<?php echo base_url('dashboard/profile'); ?>" class="profile-btn">
                    <img src="<?php echo !empty($this->session->userdata('foto_profil')) ? base_url('assets/uploads/profile/'.$this->session->userdata('foto_profil')) : 'https://i.pinimg.com/736x/c0/27/74/c027749d9af29af3d687847bc1fbb1fa.jpg'; ?>" class="profile-img me-2" alt="Profile">
                    <div class="text-start me-1">
                        <div class="fw-bold text-white" style="font-size: 13px; line-height: 1.1;"><?php echo $this->session->userdata('nama'); ?></div>
                        <small class="text-muted" style="font-size: 10px;">Kelola Profil</small>
                    </div>
                </a>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div>
                            <div class="card-label">Progress Aktivitas</div>
                            <div class="card-value"><?php echo isset($persentase_progress) ? $persentase_progress : 0; ?>%</div>
                        </div>
                        <div class="stat-icon-box icon-success">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="stat-card">
                        <div>
                            <div class="card-label">Agenda Tertunda</div>
                            <div class="card-value"><?php echo isset($agenda_tertunda) ? $agenda_tertunda : 0; ?> Tugas</div>
                        </div>
                        <div class="stat-icon-box icon-danger">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="stat-card">
                        <div>
                            <div class="card-label">Total Pemasukan</div>
                            <div class="card-value">Rp <?php echo number_format((isset($total_pemasukan) ? $total_pemasukan : 0), 0, ',', '.'); ?></div>
                        </div>
                        <div class="stat-icon-box icon-primary">
                            <i class="fa-solid fa-arrow-trend-up"></i>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="stat-card">
                        <div>
                            <div class="card-label">Sisa Saldo Aktif</div>
                            <div class="card-value">Rp <?php echo number_format((isset($sisa_saldo) ? $sisa_saldo : 0), 0, ',', '.'); ?></div>
                        </div>
                        <div class="stat-icon-box icon-purple">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="dashboard-box">
                        <h5 class="fw-bold mb-4"><i class="fa-solid fa-chart-bar me-2 text-primary"></i> Grafik Analisis Keuangan</h5>
                        <div style="position: relative; height:450px; width:100%">
                            <canvas id="financialChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 d-flex flex-column gap-4">
                    
                    <div class="mini-calendar">
                        <div class="calendar-header">JUNE 2026</div>
                        <div class="d-flex justify-content-between calendar-days text-center mb-2" style="font-size: 11px;">
                            <div style="width:14%">Min</div><div style="width:14%">Sen</div><div style="width:14%">Sel</div><div style="width:14%">Rab</div><div style="width:14%">Kam</div><div style="width:14%">Jum</div><div style="width:14%">Sab</div>
                        </div>
                        <div class="d-flex flex-wrap calendar-grid text-center" style="font-size: 12px; row-gap: 10px;">
                            <div style="width:14%"></div><div style="width:14%">1</div><div style="width:14%">2</div><div style="width:14%">3</div><div style="width:14%">4</div><div style="width:14%">5</div><div style="width:14%">6</div>
                            <div style="width:14%">7</div><div style="width:14%">8</div><div style="width:14%">9</div><div style="width:14%">10</div><div style="width:14%">11</div><div style="width:14%">12</div><div style="width:14%">13</div>
                            <div style="width:14%">14</div><div style="width:14%">15</div><div style="width:14%"><span class="current-day px-2 py-1">16</span></div><div style="width:14%">17</div><div style="width:14%">18</div><div style="width:14%">19</div><div style="width:14%">20</div>
                            <div style="width:14%">21</div><div style="width:14%">22</div><div style="width:14%">23</div><div style="width:14%">24</div><div style="width:14%">25</div><div style="width:14%">26</div><div style="width:14%">27</div>
                            <div style="width:14%">28</div><div style="width:14%">29</div><div style="width:14%">30</div>
                        </div>
                    </div>

                    <div class="dashboard-box">
                        <h5 class="fw-bold mb-3"><i class="fa-solid fa-list-check me-2 text-danger"></i> Aktivitas Terbaru</h5>
                        <div class="scrollable-activities">
                            <?php if(!empty($aktivitas_terbaru)): ?>
                                <?php foreach($aktivitas_terbaru as $row): ?>
                                    <div class="activity-item">
                                        <div>
                                            <div class="fw-bold text-white" style="font-size: 14px;"><?php echo $row->nama_aktivitas; ?></div>
                                            <small style="color: #797195; font-size: 11px;">
                                                <i class="fa-regular fa-calendar me-1"></i>
                                                <?php echo date('d M Y', strtotime($row->tanggal_aktivitas)); ?>
                                            </small>
                                        </div>
                                        
                                        <?php 
                                        $status = strtolower(trim($row->status_aktivitas));
                                        if($status == 'selesai' || $status == 'done'): 
                                        ?>
                                            <span class="badge badge-done rounded-pill px-3 py-1">Done</span>
                                        <?php elseif($status == 'incoming'): ?>
                                            <span class="badge badge-incoming rounded-pill px-3 py-1">Incoming</span>
                                        <?php else: ?>
                                            <span class="badge badge-inprogress rounded-pill px-3 py-1">In Progress</span>
                                        <?php endif; ?>

                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center text-muted py-3" style="font-size: 13px;">Belum ada aktivitas terbaru.</div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('financialChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Pemasukan', 'Total Pengeluaran'],
                datasets: [{
                    data: [300000, 0],
                    backgroundColor: ['rgba(59, 130, 246, 0.95)', 'rgba(236, 72, 153, 0.95)'],
                    borderRadius: 12,
                    barThickness: 50
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: 'rgba(255, 255, 255, 0.05)' }, ticks: { color: '#797195' } },
                    x: { grid: { display: false }, ticks: { color: '#797195' } }
                }
            }
        });
    </script>
</body>
</html>