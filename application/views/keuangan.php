<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMAK - Keuangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: radial-gradient(at 0% 0%, #e06d94 0px, transparent 55%), radial-gradient(at 100% 0%, #5f95f7 0px, transparent 55%);
            background-attachment: fixed; min-height: 100vh; color: #1e1333; overflow-x: hidden;
        }
        .app-layout { display: flex; width: 100vw; min-height: 100vh; }
        
        /* STYLE SIDEBAR KOTAK PUTIH */
        .sidebar-col { 
            width: 260px; background: #ffffff !important; padding: 40px 24px; position: fixed; height: 100vh; z-index: 99; 
            display: flex; flex-direction: column; justify-content: space-between; border-right: 1px solid rgba(0,0,0,0.05); left: 0; top: 0;
        }
        .sidebar-brand { font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 28px; color: #d12264; margin-bottom: 40px; padding-left: 10px; }
        .sidebar-col nav a { text-decoration: none; display: block; padding: 14px 20px; font-size: 15px; font-weight: 600; color: #64748b; border-radius: 14px; margin-bottom: 8px; transition: 0.3s; }
        .sidebar-col nav a:hover { background: #f8fafc; color: #1e1333; }
        .sidebar-col nav a.active { background: linear-gradient(135deg, #db2777, #9333ea) !important; color: white !important; }
        .sidebar-footer { border-top: 1px solid #f1f5f9; padding-top: 16px; }
        .sidebar-footer a { text-decoration: none; display: block; padding: 14px 20px; color: #ef4444; font-weight: 600; }
        
        .main-content-col { flex: 1; margin-left: 260px; padding: 40px; }
        .card-custom { background: rgba(255, 255, 255, 0.65); border: 1px solid rgba(255, 255, 255, 0.7); padding: 30px; border-radius: 24px; backdrop-filter: blur(20px); margin-bottom: 25px; }
        .stats-mini-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 25px; }
        .table-custom { width: 100%; border-collapse: separate; border-spacing: 0 10px; }
        .table-custom tr.data-row { background: rgba(255, 255, 255, 0.5); }
        .table-custom td, .table-custom th { padding: 14px; }
    </style>
</head>
<body>
    <div class="app-layout">
        <aside class="sidebar-col">
            <?php $this->load->view('templates/sidebar'); ?>
        </aside>
        
        <main class="main-content-col">
            <h1 class="fw-bold mb-4" style="font-family:'Outfit';">Catatan Keuangan Mahasiswa</h1>
            
            <div class="stats-mini-grid">
                <div class="card-custom m-0" style="padding:20px;"><div style="font-size:11px; font-weight:800; color:#52446e;">TOTAL PEMASUKAN</div><div class="fw-bold text-success fs-4">Rp <?= number_format($total_masuk, 0, ',', '.'); ?></div></div>
                <div class="card-custom m-0" style="padding:20px;"><div style="font-size:11px; font-weight:800; color:#52446e;">TOTAL PENGELUARAN</div><div class="fw-bold text-danger fs-4">Rp <?= number_format($total_keluar, 0, ',', '.'); ?></div></div>
                <div class="card-custom m-0" style="padding:20px;"><div style="font-size:11px; font-weight:800; color:#52446e;">SISA SALDO AKTIF</div><div class="fw-bold text-primary fs-4">Rp <?= number_format($saldo_aktif, 0, ',', '.'); ?></div></div>
            </div>

            <div class="card-custom">
                <h5 class="fw-bold mb-3" style="color:#d12264;">+ Catat Transaksi Baru</h5>
                <form action="<?= base_url('keuangan/simpan'); ?>" method="POST">
                    <div class="row g-2">
                        <div class="col-md-3"><input type="text" name="nama_transaksi" class="form-control" placeholder="Keterangan" required></div>
                        <div class="col-md-2"><select name="jenis" class="form-select"><option value="pemasukan">Pemasukan</option><option value="pengeluaran">Pengeluaran</option></select></div>
                        <div class="col-md-3"><input type="number" name="jumlah" class="form-control" placeholder="Jumlah" required></div>
                        <div class="col-md-3"><input type="date" name="tanggal" class="form-control" required></div>
                        <div class="col-md-1"><button type="submit" class="btn btn-primary w-100 fw-bold">SIMPAN</button></div>
                    </div>
                </form>
            </div>

            <div class="card-custom">
                <h5 class="fw-bold mb-3">Riwayat Arus Kas</h5>
                <table class="table-custom">
                    <thead><tr><th>Keterangan</th><th>Jenis</th><th>Tanggal</th><th>Jumlah</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php if(!empty($keuangan)): foreach($keuangan as $row): ?>
                            <tr class="data-row">
                                <td class="fw-bold"><?= $row['nama_transaksi']; ?></td>
                                <td><span class="badge bg-<?= $row['jenis']=='pemasukan'?'success':'danger'; ?>"><?= ucfirst($row['jenis']); ?></span></td>
                                <td><?= date('d M Y', strtotime($row['tanggal'])); ?></td>
                                <td class="fw-bold text-<?= $row['jenis']=='pemasukan'?'success':'danger'; ?>">Rp <?= number_format($row['jumlah'], 0, ',', '.'); ?></td>
                                <td><a href="<?= base_url('keuangan/hapus/'.$row['id_keuangan']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus catatan ini?')">Hapus</a></td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr><td colspan="5" class="text-center text-muted">Belum ada data keuangan.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>