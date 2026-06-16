<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAK - Jurnal & Target Ibadah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-body: linear-gradient(135deg, #fbc2eb 0%, #a6c1ee 100%);
            --bg-sidebar: #ffffff; /* Menggunakan Light Theme Sesuai Menu Lain */
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
        
        /* SIDEBAR LIGHT THEME DENGAN LOGO PINK SIMAK */
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
        .sidebar .nav-link:hover {
            background: linear-gradient(135deg, #ff3f86, #7f5eff) !important;
            color: #fff !important;
        }
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #ff3f86, #7f5eff) !important;
            color: #fff !important;
        }
        
        /* MAIN CONTENT AREA */
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
        
        /* JADWAL SHOLAT BOXES */
        .time-box {
            background-color: #1e1b29;
            color: white;
            border-radius: 16px;
            padding: 15px;
            text-align: center;
            font-weight: 700;
        }
        .time-box span {
            display: block;
            font-size: 12px;
            color: #a6c1ee;
            margin-bottom: 5px;
            font-weight: 500;
            text-transform: uppercase;
        }

        /* ACCORDION & CHECKBOX CUSTOMIZATION */
        .accordion-button:not(.collapsed) {
            background-color: #fff;
            color: #1e1b4b;
            box-shadow: none;
        }
        .form-check-input:checked {
            background-color: #fe5196;
            border-color: #fe5196;
        }
        
        .btn-gradient-submit {
            background: linear-gradient(135deg, #ff3f86, #7f5eff);
            color: white;
            font-weight: 700;
            width: 100%;
            border: none;
            padding: 14px;
            border-radius: 16px;
            transition: opacity 0.2s;
        }
        .btn-gradient-submit:hover {
            opacity: 0.9;
            color: white;
        }
        [data-theme="dark"] .form-control,
[data-theme="dark"] .form-select{
    background:#221e38;
    color:#f3efff;
    border-color:#2b2640;
}

[data-theme="dark"] .accordion-button{
    background:#1b182b;
    color:#f3efff;
}

[data-theme="dark"] .accordion-item{
    background:#1b182b;
    border-color:#2b2640;
}

[data-theme="dark"] .text-muted{
    color:#a29bbd !important;
}
    </style>
</head>
<body data-theme="<?= $this->session->userdata('theme') == 'dark' ? 'dark' : 'light'; ?>"></body>

    <div class="sidebar">
        <div class="brand">SIMAK</div>
        <nav class="nav flex-column">
            <a class="nav-link" href="<?= base_url('index.php/dashboard'); ?>"><i class="fa-solid fa-chart-pie me-2"></i> Dashboard</a>
            <a class="nav-link" href="<?= base_url('index.php/aktivitas'); ?>"><i class="fa-solid fa-calendar-days me-2"></i> Aktivitas</a>
            <a class="nav-link" href="<?= base_url('index.php/keuangan'); ?>"><i class="fa-solid fa-wallet me-2"></i> Keuangan</a>
            <a class="nav-link active" href="#"><i class="fa-solid fa-mosque me-2"></i> Ibadah</a>
            <a class="nav-link" href="<?= base_url('index.php/statistik'); ?>"><i class="fa-solid fa-chart-line me-2"></i> Statistik</a>
            <a class="nav-link text-danger mt-5" href="<?= base_url('index.php/auth/logout'); ?>"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</a>
        </nav>
    </div>

    <div class="main-content">
        <div class="container-fluid">
            
            <h2 class="mb-4" style="font-weight:800; color:#1e1b4b;">Jurnal & Target Ibadah 🕋</h2>

            <div class="dashboard-box p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="?tanggal_ibadah=<?= date('Y-m-d', strtotime($tanggal_pilih . ' -1 day')); ?>" class="btn btn-dark btn-sm rounded-3 px-3">
                        <i class="fa-solid fa-backward me-1"></i> Kemarin
                    </a>
                    
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-calendar text-primary"></i>
                        <input type="date" class="form-control form-control-sm border-0 fw-bold text-center" 
                               style="width:160px; background:transparent;" 
                               value="<?= $tanggal_pilih; ?>" 
                               max="<?= $hari_ini; ?>" 
                               onchange="window.location.href='?tanggal_ibadah='+this.value">
                    </div>

                    <?php if ($tanggal_pilih < $hari_ini): ?>
                        <a href="?tanggal_ibadah=<?= date('Y-m-d', strtotime($tanggal_pilih . ' +1 day')); ?>" class="btn btn-dark btn-sm rounded-3 px-3">
                            Esok <i class="fa-solid fa-forward ms-1"></i>
                        </a>
                    <?php else: ?>
                        <button class="btn btn-secondary btn-sm rounded-3 px-3" disabled style="opacity: 0.4; cursor: not-allowed;">
                            Esok <i class="fa-solid fa-lock ms-1"></i>
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <div class="dashboard-box text-center">
                <span class="text-muted d-block fw-bold small text-uppercase">Progress Evaluasi Total Ibadah Tanggal Ini</span>
                <h2 class="fw-bold my-2 text-danger" style="font-size:36px;"><?= isset($progress_total) ? $progress_total : 0; ?>% Terpenuhi</h2>
                <div class="progress rounded-pill mt-3" style="height: 14px; background-color: #f1f5f9;">
                    <div class="progress-bar" role="progressbar" style="width: <?= isset($progress_total) ? $progress_total : 0; ?>%; background: linear-gradient(135deg, #ff3f86, #7f5eff); border-radius:50px;"></div>
                </div>
                <small class="text-muted d-block mt-2" style="font-size:11px;">(Besar pembagi: 5 Sholat Wajib. Pembagi otomatis bertambah adil jika target opsional diisi)</small>
            </div>

            <form action="<?= base_url('index.php/ibadah/simpan_ibadah'); ?>" method="POST">
                <input type="hidden" name="tanggal_ibadah" value="<?= $tanggal_pilih; ?>">

                <div class="dashboard-box">
                    <h5 class="fw-bold mb-3" style="color: #1e1b4b;">🌙 1. Jadwal Sholat Waktu Setempat</h5>
                    <div class="row g-2 mb-4">
                        <div class="col-md-6">
                            <label class="small text-muted fw-bold mb-1">Negara</label>
                            <select class="form-select form-select-sm rounded-3" id="negara"><option>Indonesia</option></select>
                        </div>
                        <div class="col-md-6">
                            <label class="small text-muted fw-bold mb-1">Kota</label>
                            <select class="form-select form-select-sm rounded-3" id="kota">
                                <option value="Pekanbaru" selected>Pekanbaru</option>
                                <option value="Jakarta">Jakarta</option>
                                <option value="Surabaya">Surabaya</option>
                            </select>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-5 g-2">
                        <div class="col"><div class="time-box"><span>Subuh</span><div id="sh_subuh">04:46</div></div></div>
                        <div class="col"><div class="time-box"><span>Dzuhur</span><div id="sh_dzuhur">12:14</div></div></div>
                        <div class="col"><div class="time-box"><span>Ashar</span><div id="sh_ashar">15:40</div></div></div>
                        <div class="col"><div class="time-box"><span>Maghrib</span><div id="sh_maghrib">18:19</div></div></div>
                        <div class="col"><div class="time-box"><span>Isya</span><div id="sh_isya">19:35</div></div></div>
                    </div>
                </div>

                <div class="dashboard-box">
                    <h5 class="fw-bold mb-3" style="color: #1e1b4b;">✅ 2. Evaluasi Sholat 5 Waktu</h5>
                    <div class="row row-cols-1 row-cols-md-5 g-3">
                        <?php $waktu = ['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya']; ?>
                        <?php foreach($waktu as $w): ?>
                            <div class="col">
                                <div class="p-3 border rounded-4 d-flex justify-content-between align-items-center bg-light">
                                    <span class="fw-bold text-capitalize" style="color:#4a3f6d;"><?= $w; ?></span>
                                    <input type="checkbox" name="<?= $w; ?>" value="1" class="form-check-input shadow-sm" style="transform: scale(1.3);" <?= isset($checked_ibadah[$w]) ? 'checked' : ''; ?>>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="accordion mb-4" id="targetAccordion">
                    <div class="accordion-item border-0 shadow-sm rounded-4 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-white text-dark fw-bold justify-content-center text-center py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTarget">
                                ➔ Tampilkan Target & Capaian Pribadi (Opsional) ➔
                            </button>
                        </h2>
                        <div id="collapseTarget" class="accordion-collapse collapse <?= (!empty($nilai_kustom['mengaji']) || !empty($nilai_kustom['target_lainnya'])) ? 'show' : ''; ?>" data-bs-parent="#targetAccordion">
                            <div class="accordion-body bg-white border-top p-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold" style="color:#1e1b4b;"><i class="fa-solid fa-book-open text-success me-1"></i> Mengaji / Tilawah Al-Qur'an</label>
                                    <input type="text" name="mengaji" class="form-control rounded-3" placeholder="Contoh: Juz 30, Al-Baqarah 1-10" value="<?= isset($nilai_kustom['mengaji']) ? $nilai_kustom['mengaji'] : ''; ?>">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label fw-bold" style="color:#1e1b4b;"><i class="fa-solid fa-star text-warning me-1"></i> Target Ibadah Lainnya</label>
                                    <input type="text" name="target_lainnya" class="form-control rounded-3" placeholder="Contoh: Sholat Dhuha, Tahajjud" value="<?= isset($nilai_kustom['target_lainnya']) ? $nilai_kustom['target_lainnya'] : ''; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-gradient-submit mb-5 shadow-sm"><i class="fa-solid fa-floppy-disk me-2"></i> Simpan Semua Rekam Ibadah</button>
            </form>

        </div>
    </div>
    <script>
    // Tempelkan ini di halaman Keuangan, Statistik, dll agar ikut sinkron otomatis
    document.addEventListener("DOMContentLoaded", function() {
        const currentTheme = localStorage.getItem("simak-theme");
        const bodyEl = document.querySelector("body"); // atau sesuaikan dengan ID body kamu
        
        if (currentTheme === "light") {
            bodyEl.classList.remove("dark-theme");
            bodyEl.classList.add("light-theme");
        } else {
            bodyEl.classList.remove("light-theme");
            bodyEl.classList.add("dark-theme");
        }
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        async function loadJadwalSholat() {
            const kota = document.getElementById('kota').value;
            const tgl = '<?= $tanggal_pilih; ?>'.split('-');
            
            try {
                const response = await fetch(`https://api.aladhan.com/v1/timings/${tgl[2]}-${tgl[1]}-${tgl[0]}?latitude=-0.5070&longitude=101.4478&method=11`);
                const resData = await response.json();
                const timings = resData.data.timings;

                document.getElementById('sh_subuh').innerText = timings.Fajr;
                document.getElementById('sh_dzuhur').innerText = timings.Dhuhr;
                document.getElementById('sh_ashar').innerText = timings.Asr;
                document.getElementById('sh_maghrib').innerText = timings.Maghrib;
                document.getElementById('sh_isya').innerText = timings.Isha;
            } catch (error) {
                console.log("Gagal memuat API jadwal sholat", error);
            }
        }

        document.getElementById('kota').addEventListener('change', loadJadwalSholat);
        window.addEventListener('DOMContentLoaded', loadJadwalSholat);
</script>
</body>
</html>