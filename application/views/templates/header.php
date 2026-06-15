<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: radial-gradient(at 0% 0%, #e06d94 0px, transparent 55%), radial-gradient(at 100% 0%, #5f95f7 0px, transparent 55%);
            background-attachment: fixed; min-height: 100vh; color: #1e1333; overflow-x: hidden; 
        }
        .app-layout { display: flex; width: 100vw; min-height: 100vh; position: relative; }
        
        /* STYLE UTAMA SIDEBAR KOTAK PUTIH KIRI */
        .sidebar-col { 
            width: 260px; background: #ffffff !important; padding: 40px 24px; position: fixed; height: 100vh; z-index: 999; 
            display: flex; flex-direction: column; justify-content: space-between; border-right: 1px solid rgba(0,0,0,0.05);
            left: 0; top: 0;
        }
        .sidebar-brand { font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 28px; color: #d12264; margin-bottom: 40px; padding-left: 10px; }
        .sidebar-col nav a { text-decoration: none; display: block; padding: 14px 20px; font-size: 15px; font-weight: 600; color: #64748b; border-radius: 14px; margin-bottom: 8px; transition: 0.3s; }
        .sidebar-col nav a:hover { background: #f8fafc; color: #1e1333; }
        .sidebar-col nav a.active { background: linear-gradient(135deg, #db2777, #9333ea) !important; color: white !important; }
        .sidebar-footer { border-top: 1px solid #f1f5f9; padding-top: 16px; }
        .sidebar-footer a { text-decoration: none; display: block; padding: 14px 20px; color: #ef4444; font-weight: 600; }
        
        /* AREA KONTEN UTAMA AGAR BERGESER KE KANAN SIDEBAR */
        .main-content-col { flex: 1; margin-left: 260px; padding: 40px; position: relative; min-height: 100vh; }
        .header-flex h1 { font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 32px; }
        .stats-summary-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 25px; margin-top: 20px; }
        .stats-mini-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 25px; }
        .card-stat-box, .card-custom { background: rgba(255, 255, 255, 0.65); border: 1px solid rgba(255, 255, 255, 0.7); padding: 22px; border-radius: 20px; backdrop-filter: blur(20px); }
        .card-custom { padding: 30px; border-radius: 24px; margin-bottom: 25px; }
        .card-title { font-size: 11px; font-weight: 800; color: #52446e; text-transform: uppercase; margin-bottom: 8px; }
        .card-value { font-family: 'Outfit', sans-serif; font-size: 24px; font-weight: 800; }
        .dashboard-main-grid { display: grid; grid-template-columns: 1.8fr 1.2fr; gap: 20px; }
        .table-custom { width: 100%; border-collapse: separate; border-spacing: 0 10px; }
        .table-custom tr.data-row { background: rgba(255, 255, 255, 0.5); }
        .table-custom td, .table-custom th { padding: 14px; }
    </style>
</head>
<body>
    <div class="app-layout">
        <aside class="sidebar-col">
            <div>
                <div class="sidebar-brand">SIMAK</div>
                <nav>
                    <a href="<?= base_url('dashboard'); ?>" class="<?= ($this->uri->segment(1) == 'dashboard') ? 'active' : ''; ?>">Dashboard</a>
                    <a href="<?= base_url('aktivitas'); ?>" class="<?= ($this->uri->segment(1) == 'aktivitas') ? 'active' : ''; ?>">Aktivitas</a>
                    <a href="<?= base_url('keuangan'); ?>" class="<?= ($this->uri->segment(1) == 'keuangan') ? 'active' : ''; ?>">Keuangan</a>
                    <a href="<?= base_url('ibadah'); ?>" class="<?= ($this->uri->segment(1) == 'ibadah') ? 'active' : ''; ?>">Ibadah</a>
                    <a href="#" class="">Statistik</a>
                    <a href="#" class="">Profil</a>
                </nav>
            </div>
            <div class="sidebar-footer">
                <a href="<?= base_url('auth/logout'); ?>">Keluar</a>
            </div>
        </aside>
        <main class="main-content-col">