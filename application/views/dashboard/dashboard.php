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
    <link href="https://fonts.googleapis.com/css2 family=Outfit:wght@400;600;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #ffb7d2 0%, #b3c5ff 50%, #cfa0ff 100%);
            min-height: 100vh;
            color: #2d1f47;
            overflow-x: hidden;
        }

        /* ANIMASI FADE UP UNTUK CONTAINER */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* SIDEBAR STYLING EFFECTS */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            padding: 40px 24px;
            border-right: 1px solid rgba(255, 255, 255, 0.4);
            z-index: 100;
        }
        .sidebar .brand {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 32px;
            color: #fe5196;
            margin-bottom: 50px;
            letter-spacing: -1px;
        }
        .sidebar .nav-link {
            color: #5c527f;
            font-weight: 700;
            padding: 14px 20px;
            border-radius: 16px;
            margin-bottom: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: linear-gradient(135deg, #ff3f86, #7f5eff);
            color: #fff;
            transform: translateX(5px) translateY(-2px);
            box-shadow: 0 8px 20px rgba(127, 94, 255, 0.3);
        }
        .sidebar .logout-link {
            position: absolute;
            bottom: 40px;
            color: #ff3f86;
            font-weight: 800;
        }

        /* MAIN CONTENT FULL SCREEN & EXPANDED */
        .main-content {
            margin-left: 280px;
            padding: 50px;
            min-height: 100vh;
            width: calc(100vw - 280px);
        }
        
        .welcome-title {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 38px;
            color: #2d1f47;
        }

        /* FOTO PROFILE DI POJOK KANAN ATAS (SESUAI ERD) */
        .profile-trigger {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            padding: 6px 18px 6px 8px;
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .profile-trigger:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 8px 25px rgba(127, 94, 255, 0.15);
        }
        .profile-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #7f5eff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        /* PREMIUM 3D GLASSMORPHISM CARDS */
        .stat-card {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05), inset 0 4px 4px rgba(255, 255, 255, 0.3);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            animation: fadeUp 0.8s ease both;
        }
        .stat-card:hover {
            transform: translateY(-10px) scale(1.02);
            background: rgba(255, 255, 255, 0.6);
            box-shadow: 0 25px 45px rgba(127, 94, 255, 0.15);
        }
        .stat-card .card-label {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 800;
            color: #6a5f93;
            letter-spacing: 1px;
        }
        .stat-card .card-value {
            font-family: 'Outfit', sans-serif;
            font-size: 28px;
            font-weight: 800;
            margin-top: 8px;
        }

        /* 3D BOX UNTUK GRAFIK DAN WIDGET KANAN */
        .dashboard-box {
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 32px;
            padding: 35px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.06), inset 0 4px 10px rgba(255, 255, 255, 0.4);
            animation: fadeUp 1s ease both;
        }

        /* SCROLLABLE UTAMA UNTUK AKTIVITAS TERBARU */
        .scrollable-activities {
            max-height: 290px;
            overflow-y: auto;
            padding-right: 8px;
        }
        /* Custom Scrollbar Cantik */
        .scrollable-activities::-webkit-scrollbar {
            width: 6px;
        }
        .scrollable-activities::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.03);
            border-radius: 10px;
        }
        .scrollable-activities::-webkit-scrollbar-thumb {
            background: rgba(127, 94, 255, 0.3);
            border-radius: 10px;
        }
        .scrollable-activities::-webkit-scrollbar-thumb:hover {
            background: rgba(127, 94, 255, 0.6);
        }

        /* LIST ITEM AKTIVITAS 3D */
        .activity-item {
            background: rgba(255, 255, 255, 0.7);
            padding: 16px;
            border-radius: 16px;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
        }
        .activity-item:hover {
            transform: translateY(-3px) scale(1.01);
            background: #fff;
            box-shadow: 0 8px 20px rgba(0,0,0,0.04);
        }
        
        .badge-done { background-color: #d1fae5; color: #065f46; font-weight: 700; border: 1px solid #a7f3d0; }
        .badge-incoming { background-color: #ffe4e6; color: #9f1239; font-weight: 700; border: 1px solid #fecdd3; }

        /* DELAY ANIMASI TIAP KARTU BIAR MUNCUL BERURUTAN */
        .card-delay-1 { animation-delay: 0.1s; }
        .card-delay-2 { animation-delay: 0.2s; }
        .card-delay-3 { animation-delay: 0.3s; }
        .card-delay-4 { animation-delay: 0.4s; }
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
        <div class="container-fluid p-0">
            
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div>
                    <h2 class="welcome-title">Selamat Datang di SIMAK 👋</h2>
                    <p class="text-secondary fw-medium mb-0">Pantau ringkasan aktivitas, keuangan, dan perkembangan ibadah harian Anda secara langsung.</p>
                </div>
                
                <a href="<?php echo base_url('profile'); ?>" class="profile-trigger">
                    <img src="<?php echo !empty($this->session->userdata('foto_profil')) ? base_url('assets/uploads/profile/'.$this->session->userdata('foto_profil')) : 'https://i.pinimg.com/736x/c0/27/74/c027749d9af29af3d687847bc1fbb1fa.jpg'; ?>" class="profile-avatar me-2" alt="Foto Profil">
                    <div class="d-none d-md-block text-start">
                        <div class="fw-bold text-dark" style="font-size: 14px; line-height: 1.2;"><?php echo $this->session->userdata('nama'); ?></div>
                        <small class="text-muted" style="font-size: 11px;">Kelola Profil</small>
                    </div>
                </a>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <div class="stat-card card-delay-1">
                        <div class="card-label">Progress Aktivitas</div>
                        <div class="card-value text-success"><?php echo $persentase_progress; ?>%</div>
                        <div class="progress mt-3" style="height: 8px; background: rgba(0,0,0,0.05); border-radius: 10px;">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: <?php echo $persentase_progress; ?>%; border-radius: 10px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card card-delay-2">
                        <div class="card-label">Agenda Tertunda</div>
                        <div class="card-value text-danger"><?php echo $agenda_tertunda; ?> Tugas</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card card-delay-3">
                        <div class="card-label">Total Pemasukan</div>
                        <div class="card-value text-primary">Rp <?php echo number_format($total_pemasukan, 0, ',', '.'); ?></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card card-delay-4">
                        <div class="card-label">Sisa Saldo Aktif</div>
                        <div class="card-value" style="color: <?php echo ($sisa_saldo < 0) ? '#ff3f86' : '#6366f1'; ?>;">
                            Rp <?php echo number_format($sisa_saldo, 0, ',', '.'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-xl-8">
                    <div class="dashboard-box">
                        <h5 class="fw-bold text-dark mb-4"><i class="fa-solid fa-chart-bar me-2 text-primary"></i> Grafik Analisis Keuangan</h5>
                        <div style