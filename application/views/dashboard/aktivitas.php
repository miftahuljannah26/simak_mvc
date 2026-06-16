<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SIMAK - Agenda & Aktivitas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* --- CONFIGURASI UTAMA DUAL THEME --- */
        :root {
            --bg-gradient: linear-gradient(135deg, #ffe6f2 0%, #b3c6ff 100%);
            --card-bg: rgba(255, 255, 255, 0.85);
            --text-main: #1a1a3a;
            --text-sub: #7a7a9a;
            --sidebar-bg: #ffffff;
            --border-color: #f1f1f5;
            --input-bg: #f8f9fd;
            --input-border: #e1e1e9;
            --table-td: #2a2a4a;
        }
        [data-theme="dark"]{
    --bg-body: linear-gradient(135deg, #140d26 0%, #0f172a 100%);
    --bg-sidebar: #151221;
    --bg-box: #1b182b;
    --text-main: #f3efff;
    --text-muted: #a29bbd;
    --border-color: #2b2640;
}

        /* PERBAIKAN: Mode Dark disamakan dengan Gradasi Ungu Transparan Mewah Dashboard */
        [data-theme="dark"] {
            --bg-gradient: linear-gradient(135deg, #140d26 0%, #0f172a 100%); 
            --card-bg: rgba(17, 16, 29, 0.65); 
            --text-main: #f5f5fa;
            --text-sub: #a0a0c0;
            --sidebar-bg: rgba(10, 9, 19, 0.85);
            --border-color: rgba(255, 255, 255, 0.05);
            --input-bg: rgba(255, 255, 255, 0.03);
            --input-border: rgba(255, 255, 255, 0.08);
            --table-td: #e0e0f0;
        }

        /* --- ANIMASI MASUK CONTAINER (FADE IN UP) --- */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            background: var(--bg-gradient); 
            margin: 0; padding: 0; 
            min-height: 100vh; display: flex; 
            color: var(--text-main);
            transition: all 0.3s ease;
        }

        /* --- SIDEBAR LAYOUT --- */
        .sidebar { 
            width: 240px; background: var(--sidebar-bg); min-height: 100vh; 
            display: flex; flex-direction: column; justify-content: space-between; 
            padding: 30px 20px; box-sizing: border-box; 
            box-shadow: 2px 0 10px rgba(0,0,0,0.05); 
            position: fixed; left: 0; top: 0; z-index: 10;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        .sidebar-brand { font-size: 24px; font-weight: 700; color: #cc2b5e; margin-bottom: 40px; padding-left: 15px; }
        .sidebar-menu { list-style: none; padding: 0; margin: 0; flex-grow: 1; }
        .sidebar-menu li { margin-bottom: 10px; }
        .sidebar-menu li a { display: flex; align-items: center; gap: 15px; padding: 12px 20px; color: var(--text-sub); text-decoration: none; font-weight: 500; border-radius: 12px; transition: all 0.3s ease; }
        .sidebar-menu li.active a { background: #b642f5; color: #ffffff; font-weight: 600; }
        .sidebar-logout a { display: flex; align-items: center; gap: 15px; padding: 12px 20px; color: #dc4c64; text-decoration: none; font-weight: 600; }
        
        /* --- MAIN CONTENT AREA --- */
        .main-content { 
            margin-left: 240px; flex: 1; padding: 40px; 
            box-sizing: border-box; max-width: calc(100vw - 240px); 
            transition: filter 0.3s ease;
        }

        /* --- CARD ELEMENTS DENGAN ANIMASI HALUS --- */
        .animated-card { 
            background: var(--card-bg); border-radius: 20px; 
            padding: 30px; margin-bottom: 25px; 
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.15); 
            border: 1px solid var(--border-color); cursor: pointer;
            position: relative; 
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            
            /* Memicu Efek Animasi Masuk */
            animation: fadeInUp 0.6s cubic-bezier(0.25, 1, 0.5, 1) both;
        }
        
        /* Delay sedikit untuk kartu kedua agar muncul bergantian */
        .animated-card:nth-child(2) {
            animation-delay: 0.15s;
        }

        /* --- INTERFACE COMPONENTS --- */
        .title-icon { color: #b642f5; margin-right: 10px; font-size: 24px; }
        .header-section h2 { margin: 0 0 5px 0; color: var(--text-main); font-weight: 700; font-size: 26px; display: flex; align-items: center; }
        .header-section h3 { margin: 0; color: var(--text-main); font-weight: 600; font-size: 20px; }
        .header-section p { margin: 0 0 25px 0; color: var(--text-sub); font-size: 14px; }
        
        .form-inline { display: flex; gap: 15px; flex-wrap: wrap; }
        .form-group { display: flex; flex-direction: column; flex: 1; min-width: 150px; }
        .form-group label { font-size: 12px; color: var(--text-sub); margin-bottom: 6px; font-weight: 600; }
        
        .form-control { 
            padding: 12px; border: 1px solid var(--input-border); border-radius: 10px; 
            background: var(--input-bg); font-family: inherit; font-size: 13px; 
            color: var(--text-main); box-sizing: border-box; width: 100%; 
            transition: all 0.3s ease;
        }
        .form-control:focus { outline: none; border-color: #b642f5; }
        
        .btn-simpan { background: linear-gradient(135deg, #cc2b5e, #753a88); color: white; border: none; padding: 0 25px; border-radius: 10px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px; margin-top: 21px; height: 45px; transition: all 0.2s ease; }
        .btn-simpan:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(204,43,94,0.3); }

        /* --- TABLE STYLE --- */
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { text-align: left; padding: 15px; color: var(--text-sub); font-size: 13px; font-weight: 600; border-bottom: 2px solid var(--border-color); }
        td { padding: 18px 15px; color: var(--table-td); font-size: 14px; border-bottom: 1px solid var(--border-color); }
        
        .badge-kat { background: #2b2b48; color: #ffd700; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 500; display: inline-flex; align-items: center; gap: 6px; }
        .badge-status { padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; }
        
        /* Pertahankan Warna Asli Terang Lembut Badge Statusmu */
        .status-done { background: #e6f9f0; color: #00b368; }
        .status-incoming { background: #fff4e6; color: #ff922b; }
        .status-progress { background: #e6f0ff; color: #0d6efd; }
        
        /* Atur warna kontras badge status saat dark mode agar tetap terbaca jelas */
        [data-theme="dark"] .status-done { background: rgba(0, 179, 104, 0.15); color: #00b368; }
        [data-theme="dark"] .status-incoming { background: rgba(255, 146, 43, 0.15); color: #ff922b; }
        [data-theme="dark"] .status-progress { background: rgba(13, 110, 253, 0.15); color: #0d6efd; }
        
        .btn-action-container { display: flex; gap: 6px; }
        .btn-action { padding: 6px 12px; border-radius: 8px; border: none; font-size: 12px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; font-weight: 500; box-sizing: border-box; transition: all 0.2s; }
        .btn-action:hover { transform: scale(1.08); }

        /* THE DYNAMIC OVERLAY SYSTEM */
        .smooth-focus-overlay { display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0, 0, 0, 0.4); backdrop-filter: blur(8px); z-index: 9999; align-items: center; justify-content: center; }
        .focused-container-box { background: var(--sidebar-bg); width: 85%; max-width: 900px; padding: 40px; border-radius: 24px; box-shadow: 0 25px 60px rgba(0,0,0,0.25); position: relative; border: 1px solid var(--border-color); }
        .smooth-focus-overlay.active { display: flex; }
        .body-blur-active .sidebar, .body-blur-active .main-content { filter: blur(3px); pointer-events: none; }
        .close-focus-btn { position: absolute; top: 25px; right: 25px; background: #ffe6e6; color: #dc4c64; border: none; border-radius: 50%; width: 36px; height: 36px; cursor: pointer; font-weight: bold; }

        /* MANAJEMEN KATEGORI MODAL */
        .custom-modal { display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: var(--sidebar-bg); padding: 30px; border-radius: 16px; box-shadow: 0 20px 50px rgba(0,0,0,0.25); z-index: 100005; width: 450px; border: 1px solid var(--border-color); }
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.4); backdrop-filter: blur(5px); z-index: 100004; }
        .kategori-manager-list { max-height: 180px; overflow-y: auto; margin-top: 15px; padding-right: 5px; border-top: 1px dashed var(--border-color); padding-top: 10px; }
        .kategori-item { display: flex; justify-content: space-between; align-items: center; padding: 10px 12px; background: var(--input-bg); border-radius: 8px; margin-bottom: 8px; font-size: 13px; color: var(--text-main); }
        .btn-delete-kat { color: #ff4d4d; background: none; border: none; font-size: 18px; cursor: pointer; font-weight: bold; }

        /* THEME FLOATING SWITCH MODE */
        .theme-switch-btn { position: fixed; bottom: 25px; right: 25px; z-index: 99999; background: #b642f5; color: white; border: none; width: 50px; height: 50px; border-radius: 50%; cursor: pointer; font-size: 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(182,66,245,0.4); transition: transform 0.2s ease; }
        .theme-switch-btn:hover { transform: rotate(15deg); }
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
<body>

    <div class="sidebar">
        <div>
            <div class="sidebar-brand">SIMAK</div>
            <ul class="sidebar-menu">
                <li><a href="<?= site_url('dashboard'); ?>"><i class="fa-solid fa-chart-pie"></i> Dashboard</a></li>
                <li class="active"><a href="<?= site_url('aktivitas'); ?>"><i class="fa-solid fa-calendar-check"></i> Aktivitas</a></li>
                <li><a href="<?= site_url('keuangan'); ?>"><i class="fa-solid fa-wallet"></i> Keuangan</a></li>
                <li><a href="<?= site_url('ibadah'); ?>"><i class="fa-solid fa-heart-pulse"></i> Ibadah</a></li>
                <li><a href="<?= site_url('statistik'); ?>"><i class="fa-solid fa-chart-line"></i> Statistik</a></li>
            </ul>
        </div>
        <div class="sidebar-logout">
            <a href="<?= site_url('auth/logout'); ?>"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
        </div>
    </div>

    <div class="main-content">
        <div class="animated-card">
            <div class="header-section">
                <h2><i class="fa-solid fa-calendar-check title-icon"></i> Agenda & Aktivitas Mahasiswa</h2>
                <p>Manajemen pengerjaan tugas kuliah, kegiatan organisasi, dan agenda harian Anda.</p>
            </div>
            
            <form action="<?= site_url('aktivitas/tambahAktivitas'); ?>" method="POST" class="form-inline">
                <div class="form-group" style="flex: 2.5;">
                    <label>Nama Agenda / Aktivitas</label>
                    <input type="text" name="nama_aktivitas" class="form-control" placeholder="Contoh: Pemrograman Web (Tugas 2)..." required>
                </div>
                
                <div class="form-group">
                    <label>Kategori Aktivitas</label>
                    <select name="id_kategori_aktivitas" id="selectKategori" class="form-control" required>
                        <option value="">Pilih Kategori...</option>
                        <?php if(!empty($kategori)): ?>
                            <?php foreach($kategori as $kat): ?>
                                <option value="<?= $kat->id_kategori_aktivitas; ?>"><?= $kat->nama_kategori; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <option disabled>────────────────────</option>
                        <option value="TAMBAH_BARU" style="background: #e6f0ff; color: #0d6efd; font-weight: bold;">+ Kelola Kategori Baru</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Tanggal Target</label>
                    <input type="date" name="tanggal_aktivitas" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Status Kerja</label>
                    <select name="status_aktivitas" class="form-control" required>
                        <option value="Incoming">⏳ Incoming</option>
                        <option value="In Progress">🔵 In Progress</option>
                        <option value="Done">✅ Done</option>
                    </select>
                </div>

                <button type="submit" class="btn-simpan"><i class="fa-solid fa-paper-plane"></i> Simpan Agenda</button>
            </form>
        </div>

        <div class="animated-card">
            <div class="header-section">
                <h3><i class="fa-solid fa-book-bookmark title-icon" style="color:#cc2b5e;"></i> Buku Kendali Seluruh Aktivitas</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nama Kegiatan</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($aktivitas)): ?>
                        <?php foreach($aktivitas as $row): ?>
                        <tr>
                            <td><?= $row->nama_aktivitas; ?></td>
                            <td><span class="badge-kat"><i class="fa-solid fa-folder"></i> <?= !empty($row->nama_kategori) ? $row->nama_kategori : 'Umum'; ?></span></td>
                            <td><i class="fa-solid fa-calendar-days" style="color:#3b71ca;"></i> <?= date('d M Y', strtotime($row->tanggal_aktivitas)); ?></td>
                            <td>
                                <?php if(strtolower($row->status_aktivitas) == 'done'): ?>
                                    <span class="badge-status status-done"><i class="fa-solid fa-circle-check"></i> Done</span>
                                <?php elseif(strtolower($row->status_aktivitas) == 'in progress'): ?>
                                    <span class="badge-status status-progress"><i class="fa-solid fa-spinner fa-spin"></i> In Progress</span>
                                <?php else: ?>
                                    <span class="badge-status status-incoming"><i class="fa-solid fa-hourglass-half"></i> Incoming</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-action-container">
                                    <button type="button" class="btn-action btn-trigger-edit" 
                                            data-id="<?= $row->id_aktivitas; ?>" data-nama="<?= htmlspecialchars($row->nama_aktivitas); ?>"
                                            data-kategori="<?= $row->id_kategori_aktivitas; ?>" data-tanggal="<?= $row->tanggal_aktivitas; ?>"
                                            data-status="<?= $row->status_aktivitas; ?>" style="background: #e6f0ff; color: #0d6efd;">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <?php if(strtolower($row->status_aktivitas) != 'done'): ?>
                                        <?php if(strtolower($row->status_aktivitas) == 'incoming'): ?>
                                            <a href="<?= site_url('aktivitas/prosesAktivitas/'.$row->id_aktivitas); ?>" class="btn-action" style="background: #e6f0ff; color: #0d6efd;"><i class="fa-solid fa-play"></i></a>
                                        <?php endif; ?>
                                        <a href="<?= site_url('aktivitas/selesaiAktivitas/'.$row->id_aktivitas); ?>" class="btn-action" style="background: #e6f9f0; color: #00b368;"><i class="fa-solid fa-check"></i></a>
                                    <?php endif; ?>
                                    
                                    <a href="<?= site_url('aktivitas/hapusAktivitas/'.$row->id_aktivitas); ?>" class="btn-action" onclick="return confirm('Hapus?')" style="background: #ffe6e6; color: #dc4c64;"><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" style="text-align:center; color: var(--text-sub);">Belum ada data aktivitas.</td></tr>
                    <?php endif; ?>
                </tbody> 
            </table>
        </div>
    </div>

    <div class="smooth-focus-overlay" id="focusOverlay">
        <div class="focused-container-box">
            <button class="close-focus-btn" id="closeFocusBtn">&times;</button>
            <div class="header-section">
                <h2><i class="fa-solid fa-pen-to-square title-icon"></i> Edit Agenda</h2>
            </div>
            <form action="<?= site_url('aktivitas/perbaruiAktivitas'); ?>" method="POST" class="form-inline">
                <input type="hidden" name="id_aktivitas" id="edit_id_aktivitas">
                <div class="form-group" style="min-width: 100%; margin-bottom:10px;">
                    <label>Nama Agenda / Aktivitas</label>
                    <input type="text" name="nama_aktivitas" id="edit_nama_aktivitas" class="form-control" required>
                </div>
                <div class="form-group"><label>Kategori</label>
                    <select name="id_kategori_aktivitas" id="edit_kategori_aktivitas" class="form-control" required>
                        <?php foreach($kategori as $kat): ?><option value="<?= $kat->id_kategori_aktivitas; ?>"><?= $kat->nama_kategori; ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group"><label>Tanggal Target</label><input type="date" name="tanggal_aktivitas" id="edit_tanggal_aktivitas" class="form-control" required></div>
                <div class="form-group"><label>Status Kerja</label>
                    <select name="status_aktivitas" id="edit_status_aktivitas" class="form-control" required>
                        <option value="Incoming">⏳ Incoming</option><option value="In Progress">🔵 In Progress</option><option value="Done">✅ Done</option>
                    </select>
                </div>
                <div style="width: 100%; display: flex; justify-content: flex-end; gap: 10px; margin-top: 15px;">
                    <button type="submit" class="btn-simpan" style="margin-top:0;"><i class="fa-solid fa-floppy-disk"></i> Perbarui</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal-overlay" id="modalOverlay"></div>
    <div class="custom-modal" id="katModal">
        <h3 style="color: var(--text-main);">Manajemen Kategori</h3>
        <form action="<?= site_url('aktivitas/tambahKategoriMurni'); ?>" method="POST">
            <div style="display:flex; gap:10px;">
                <input type="text" name="nama_kategori_baru" class="form-control" placeholder="Kategori baru..." required>
                <button type="submit" style="background:#b642f5; color:white; border:none; padding:10px; border-radius:10px; cursor:pointer;">+Tambah</button>
            </div>
        </form>
        <div class="kategori-manager-list">
            <?php foreach($kategori as $kat): ?>
                <div class="kategori-item"><span><?= $kat->nama_kategori; ?></span><a href="<?= site_url('aktivitas/hapusKategori/'.$kat->id_kategori_aktivitas); ?>" class="btn-delete-kat">&times;</a></div>
            <?php endforeach; ?>
        </div>
        <button type="button" id="btnBatalKat" style="margin-top:15px; width:100%; padding:10px; border-radius:8px; border:1px solid var(--input-border); background:none; color:var(--text-main); cursor:pointer;">Selesai</button>
    </div>

    <button class="theme-switch-btn" id="themeToggle"><i class="fa-solid fa-moon"></i></button>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // SCRIPT DATA EDIT POPUP
            $('.btn-trigger-edit').on('click', function() {
                $('#edit_id_aktivitas').val($(this).data('id'));
                $('#edit_nama_aktivitas').val($(this).data('nama'));
                $('#edit_kategori_aktivitas').val($(this).data('kategori'));
                $('#edit_tanggal_aktivitas').val($(this).data('tanggal'));
                $('#edit_status_aktivitas').val($(this).data('status'));
                $('body').addClass('body-blur-active');
                $('#focusOverlay').addClass('active');
            });
            $('#closeFocusBtn').on('click', function() { $('#focusOverlay').removeClass('active'); $('body').removeClass('body-blur-active'); });

            // SCRIPT POPUP KATEGORI
            $('#selectKategori').on('change', function() { if ($(this).val() === 'TAMBAH_BARU') { $('#modalOverlay').fadeIn(200); $('#katModal').fadeIn(300); $(this).val(''); } });
            $('#btnBatalKat, #modalOverlay').on('click', function() { $('#modalOverlay').fadeOut(300); $('#katModal').fadeOut(200); });
        });
    </script>
</body>
</html>