<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIMAK - Ibadah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* INI CSS YANG SAMA PERSIS DENGAN DASHBOARD ANDA */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: radial-gradient(at 0% 0%, #e06d94 0px, transparent 55%), radial-gradient(at 100% 0%, #5f95f7 0px, transparent 55%);
            background-attachment: fixed; min-height: 100vh; color: #1e1333; overflow-x: hidden; 
        }
        .app-layout { display: flex; width: 100vw; min-height: 100vh; }
        
        /* Sidebar Styling */
        .sidebar-col { width: 260px; padding: 40px 24px; position: fixed; height: 100vh; }
        
        /* Main Content Styling */
        .main-content-col { flex: 1; margin-left: 260px; padding: 40px; }
        .card-custom { 
            background: rgba(255, 255, 255, 0.65); 
            border: 1px solid rgba(255, 255, 255, 0.7); 
            padding: 30px; 
            border-radius: 24px; 
            backdrop-filter: blur(20px); 
            margin-bottom: 25px; 
        }
    </style>
</head>
<body>
    <div class="app-layout">
        <aside class="sidebar-col">
            <?php $this->load->view('templates/sidebar'); ?>
        </aside>
        
        <main class="main-content-col">
            <h2 class="fw-bold mb-4" style="font-family:'Outfit';">Mutabaah Ibadah</h2>
            
            <div class="card-custom">
                <form action="<?= base_url('ibadah/simpan'); ?>" method="POST">
                    <div class="row g-3">
                        <div class="col-md-4"><input type="text" name="nama_ibadah" class="form-control" placeholder="Nama Ibadah" required></div>
                        <div class="col-md-3"><input type="date" name="tanggal_ibadah" class="form-control" value="<?= date('Y-m-d'); ?>" required></div>
                        <div class="col-md-3"><select name="status_ibadah" class="form-select"><option value="Selesai">Selesai</option><option value="Belum">Belum</option></select></div>
                        <div class="col-md-2"><button type="submit" class="btn btn-primary w-100 fw-bold">Simpan</button></div>
                    </div>
                </form>
            </div>

            <div class="card-custom">
                <table class="table">
                    <thead><tr><th>Nama Ibadah</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php if (!empty($ibadah)) : foreach($ibadah as $row): ?>
                        <tr>
                            <td><?= $row['nama_ibadah']; ?></td>
                            <td><?= date('d M Y', strtotime($row['tanggal_ibadah'])); ?></td>
                            <td><span class="badge bg-info"><?= $row['status_ibadah']; ?></span></td>
                            <td><a href="<?= base_url('ibadah/hapus/'.$row['id_ibadah']); ?>" class="text-danger" onclick="return confirm('Hapus?')">Hapus</a></td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4" class="text-center text-muted">Belum ada data.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>