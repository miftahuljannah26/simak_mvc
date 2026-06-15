<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAK - Pengaturan Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* BASE THEME (LIGHT MODE) */
        :root {
            --bg-gradient: linear-gradient(135deg, #ffb7d2 0%, #b3c5ff 100%);
            --bg-sidebar: #ffffff;
            --bg-card: #ffffff;
            --text-main: #2d1f47;
            --text-muted: #8a83a4;
            --border-color: #efeafc;
            --form-bg: #fdfcff;
        }

        /* DARK MODE STYLES */
        [data-theme="dark"] {
            --bg-gradient: linear-gradient(135deg, #1e1b29 0%, #0f0c1b 100%);
            --bg-sidebar: #151221;
            --bg-card: #1b182b;
            --text-main: #f3efff;
            --text-muted: #a29bbd;
            --border-color: #2b2640;
            --form-bg: #221e38;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: var(--bg-gradient);
            background-attachment: fixed; 
            min-height: 100vh; 
            overflow-x: hidden;
            color: var(--text-main);
            transition: background 0.3s ease, color 0.3s ease;
        }
        .sidebar { 
            width: 260px; 
            height: 100vh; 
            position: fixed; 
            background: var(--bg-sidebar); 
            padding: 30px 20px; 
            border-right: 1px solid var(--border-color); 
            z-index: 10;
            transition: background 0.3s ease, border-color 0.3s ease;
        }
        .sidebar .brand { 
            font-weight: 800; 
            font-size: 24px; 
            color: #fe5196; 
            margin-bottom: 40px; 
            padding-left: 15px; 
        }
        .sidebar .nav-link { 
            color: var(--text-muted); 
            font-weight: 600; 
            padding: 12px 20px; 
            border-radius: 12px; 
            margin-bottom: 8px; 
            transition: all 0.3s ease; 
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { 
            background: linear-gradient(135deg, #ff3f86, #7f5eff); 
            color: #fff !important; 
            transform: translateX(3px); 
        }
        .main-content { 
            margin-left: 260px; 
            padding: 40px; 
            width: calc(100% - 260px);
        }
        .card-profile { 
            background: var(--bg-card); 
            border-radius: 24px; 
            padding: 40px; 
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05); 
            border: 1px solid var(--border-color);
            animation: fadeIn 0.5s ease-out forwards; 
            transition: background 0.3s ease, border-color 0.3s ease;
        }
        @keyframes fadeIn { 
            from { opacity: 0; transform: translateY(15px); } 
            to { opacity: 1; transform: translateY(0); } 
        }
        .form-label {
            font-weight: 700;
            color: var(--text-main);
            font-size: 14px;
            margin-bottom: 8px;
        }
        .form-control { 
            border-radius: 12px; 
            padding: 12px 16px; 
            border: 1px solid var(--border-color); 
            background-color: var(--form-bg);
            color: var(--text-main);
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #7f5eff;
            box-shadow: 0 0 0 4px rgba(127, 94, 255, 0.1);
            background-color: var(--form-bg);
        }
        .profile-avatar-current {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #7f5eff;
            box-shadow: 0 4px 15px rgba(127, 94, 255, 0.2);
        }
        .btn-gradient-primary {
            background: linear-gradient(135deg, #ff3f86, #7f5eff);
            color: white;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
        }
        .btn-light-custom {
            background-color: #f3efff;
            color: #7f5eff;
            font-weight: 700;
            border-radius: 12px;
            padding: 12px 24px;
            border: none;
            text-decoration: none;
            display: inline-block;
        }
        /* Style Tambahan untuk Mode Switch Box */
        .theme-switch-box {
            background-color: var(--form-bg);
            border: 1px solid var(--border-color);
        }
    </style>
</head>
<body>

    <div class="d-flex">
        <aside class="sidebar">
            <div class="brand">SIMAK</div>
            <nav class="nav flex-column">
                <a class="nav-link" href="<?= site_url('dashboard'); ?>"><i class="fa-solid fa-chart-pie me-2"></i> Dashboard</a>
                <a class="nav-link active" href="#"><i class="fa-solid fa-user-gear me-2"></i> Kelola Profil</a>
                <a class="nav-link text-danger mt-4" href="<?= site_url('auth/logout'); ?>"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</a>
            </nav>
        </aside>

        <main class="main-content">
            <div class="card-profile">
                <div class="d-flex align-items-center mb-4 gap-3">
                    <i class="fa-solid fa-user-gear text-primary fs-3"></i>
                    <h3 class="fw-800 m-0" style="color: var(--text-main); font-weight: 800;">Pengaturan Profil</h3>
                </div>

                <?php if($this->session->flashdata('pesan')): ?>
                    <div class="alert alert-success border-0 rounded-3 mb-4 fw-bold" style="background-color: #d1fae5; color: #065f46;">
                        <i class="fa-solid fa-circle-check me-2"></i> <?= $this->session->flashdata('pesan'); ?>
                    </div>
                <?php endif; ?>

                <?php if($this->session->flashdata('error_upload')): ?>
                    <div class="alert alert-danger border-0 rounded-3 mb-4 fw-bold" style="background-color: #ffe4e6; color: #9f1239;">
                        <i class="fa-solid fa-circle-xmark me-2"></i> <?= $this->session->flashdata('error_upload'); ?>
                    </div>
                <?php endif; ?>

                <div class="theme-switch-box d-flex align-items-center justify-content-between p-3 rounded-3 mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-circle-half-stroke fs-4 text-primary"></i>
                        <div>
                            <span class="fw-bold d-block" style="color: var(--text-main);">Tema Aplikasi</span>
                            <small class="text-muted text-theme-status">Ganti tampilan sistem ke Mode Gelap</small>
                        </div>
                    </div>
                    <div class="form-check form-switch m-0">
                        <input class="form-check-input fs-4" type="checkbox" role="switch" id="themeToggleBtn" style="cursor: pointer;">
                    </div>
                </div>

                <form action="<?= site_url('dashboard/update'); ?>" method="POST" enctype="multipart/form-data">
                    
                    <div class="d-flex align-items-center gap-4 mb-4 p-3 rounded-3" style="background-color: var(--form-bg); border: 1px solid var(--border-color);">
                        <img src="<?= !empty($this->session->userdata('foto_profil')) ? base_url('assets/uploads/profile/'.$this->session->userdata('foto_profil')) : 'https://i.pinimg.com/736x/c0/27/74/c027749d9af29af3d687847bc1fbb1fa.jpg'; ?>" class="profile-avatar-current" alt="Foto Profil">
                        <div>
                            <label class="form-label d-block">Foto Profil Anda</label>
                            <input type="file" name="foto_profil" class="form-control form-control-sm" accept="image/*">
                            <small class="text-muted d-block mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="<?= $this->session->userdata('nama'); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Alamat Email</label>
                            <input type="email" name="email" class="form-control" value="<?= $this->session->userdata('email'); ?>" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password lama">
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-gradient-primary"><i class="fa-solid fa-floppy-disk me-2"></i> Simpan Perubahan</button>
                            <a href="<?= site_url('dashboard'); ?>" class="btn btn-light-custom"><i class="fa-solid fa-arrow-left me-2"></i> Kembali</a>
                        </div>
                        <a href="<?= site_url('auth/logout'); ?>" class="btn btn-danger px-4 py-2 fw-bold" style="border-radius: 12px;"><i class="fa-solid fa-right-from-bracket me-2"></i> Keluar Aplikasi</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        const themeToggleBtn = document.getElementById('themeToggleBtn');
        const themeStatusText = document.querySelector('.text-theme-status');
        
        // 1. Cek memori browser, apakah user sebelumnya sudah pilih dark mode?
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
            themeToggleBtn.checked = true;
            themeStatusText.innerText = "Mode Gelap Aktif";
        } else {
            document.documentElement.setAttribute('data-theme', 'light');
            themeToggleBtn.checked = false;
            themeStatusText.innerText = "Mode Terang Aktif";
        }

        // 2. Aksi ketika tombol switch di klik/geser
        themeToggleBtn.addEventListener('change', function() {
            if (this.checked) {
                document.documentElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark'); // Simpan pilihan ke memori
                themeStatusText.innerText = "Mode Gelap Aktif";
            } else {
                document.documentElement.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light'); // Simpan pilihan ke memori
                themeStatusText.innerText = "Mode Terang Aktif";
            }
        });
    </script>
</body>
</html>