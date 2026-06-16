<!DOCTYPE html>
<html lang="id">
<head>
   <script>
        // 1. LANGSUNG EKSEKUSI DI DETIK PERTAMA SEBELUM HALAMAN DI-RENDER
        const currentSavedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', currentSavedTheme);

        // 2. Kunci class body begitu elemen HTML-nya siap
        document.addEventListener("DOMContentLoaded", function() {
            const bodyEl = document.getElementById("pageBody") || document.body;
            if (bodyEl) {
                bodyEl.classList.remove('light-theme', 'dark-theme');
                bodyEl.classList.add(currentSavedTheme === 'dark' ? 'dark-theme' : 'light-theme');
            }

            // 3. Jika ini halaman profil yang ada SAKLAR SWITCH-nya (themeToggleBtn)
            const switchBtn = document.getElementById('themeToggleBtn');
            if (switchBtn) {
                switchBtn.checked = (currentSavedTheme === 'dark');
                switchBtn.addEventListener('change', function() {
                    const targetTheme = this.checked ? 'dark' : 'light';
                    executeThemeChange(targetTheme);
                });
            }

            // 4. Jika ini halaman yang ada TOMBOL ICON-nya (themeToggle)
            const iconBtn = document.getElementById('themeToggle');
            if (iconBtn) {
                iconBtn.innerHTML = currentSavedTheme === 'dark' ? '<i class="fa-solid fa-sun"></i>' : '<i class="fa-solid fa-moon"></i>';
                iconBtn.addEventListener('click', function() {
                    let targetTheme = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
                    executeThemeChange(targetTheme);
                });
            }

            // Fungsi pembantu biar gak ngetik berulang
            function executeThemeChange(newTheme) {
                localStorage.setItem('theme', newTheme);
                document.documentElement.setAttribute('data-theme', newTheme);
                
                const bEl = document.getElementById("pageBody") || document.body;
                if (bEl) {
                    bEl.classList.remove('light-theme', 'dark-theme');
                    bEl.classList.add(newTheme === 'dark' ? 'dark-theme' : 'light-theme');
                }

                // Update UI tombol icon jika ada di halaman itu
                const tBtn = document.getElementById('themeToggle');
                if (tBtn) tBtn.innerHTML = newTheme === 'dark' ? '<i class="fa-solid fa-sun"></i>' : '<i class="fa-solid fa-moon"></i>';
                
                // Update UI saklar jika ada di halaman itu
                const sBtn = document.getElementById('themeToggleBtn');
                if (sBtn) sBtn.checked = (newTheme === 'dark');
            }
        });
    </script>

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
            transition: background 0.3s, color 0.3s;
        }
        .app-layout { display: flex; width: 100vw; min-height: 100vh; position: relative; }
        
        /* STYLE SIDEBAR */
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
        
        /* AREA KONTEN UTAMA */
        .main-content-col { flex: 1; margin-left: 260px; padding: 40px; position: relative; min-height: 100vh; }
        .header-flex h1 { font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 32px; }
        .stats-summary-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 25px; margin-top: 20px; }
        .stats-mini-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 25px; }
        .card-stat-box, .card-custom { background: rgba(255, 255, 255, 0.65); border: 1px solid rgba(255, 255, 255, 0.7); padding: 22px; border-radius: 20px; backdrop-filter: blur(20px); transition: 0.3s; }
        .card-custom { padding: 30px; border-radius: 24px; margin-bottom: 25px; }
        .card-title { font-size: 11px; font-weight: 800; color: #52446e; text-transform: uppercase; margin-bottom: 8px; }
        .card-value { font-family: 'Outfit', sans-serif; font-size: 24px; font-weight: 800; }
        .dashboard-main-grid { display: grid; grid-template-columns: 1.8fr 1.2fr; gap: 20px; }
        .table-custom { width: 100%; border-collapse: separate; border-spacing: 0 10px; }
        .table-custom tr.data-row { background: rgba(255, 255, 255, 0.5); }
        .table-custom td, .table-custom th { padding: 14px; }

        /* ==================================================== */
        /* MANTRA FIX: ATURAN BLACKOUT MODE GELAP (DARK THEME)  */
        /* ==================================================== */
        [data-theme='dark'] body, body.dark-theme { 
            background: #0f172a !important; 
            color: #f1f5f9 !important; 
        }

        /* Perbaiki warna teks di semua elemen penting biar kontras (bisa dibaca) */
        [data-theme='dark'] h1, [data-theme='dark'] h2, [data-theme='dark'] h3, 
        [data-theme='dark'] h4, [data-theme='dark'] h5, [data-theme='dark'] h6,
        [data-theme='dark'] th, [data-theme='dark'] td, [data-theme='dark'] span, 
        [data-theme='dark'] label, [data-theme='dark'] p, [data-theme='dark'] small {
            color: #f1f5f9 !important;
        }

        /* Judul kecil kartu stat box biar tetap kebaca tapi agak soft */
        [data-theme='dark'] .card-title {
            color: #94a3b8 !important;
        }

        /* Ubah Kotak Box Card & Tabel Data row jadi Gelap Elegan */
        [data-theme='dark'] .card-stat-box, 
        [data-theme='dark'] .card-custom, 
        [data-theme='dark'] .table-custom tr.data-row { 
            background: #1e293b !important; 
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
        }

        /* Ubah warna latar belakang Sidebar Kiri di Mode Gelap */
        [data-theme='dark'] .sidebar-col { 
            background: #1e293b !important; 
            border-right: 1px solid rgba(255, 255, 255, 0.08) !important;
        }
        [data-theme='dark'] .sidebar-col nav a { 
            color: #94a3b8 !important; 
        }
        [data-theme='dark'] .sidebar-col nav a:hover { 
            background: #334155 !important; 
            color: #ffffff !important; 
        }
    </style>
</head>