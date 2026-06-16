<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Statistik Keuangan</title>
    <style>
        body { font-family: sans-serif; color: #333; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .header h2 { margin: 0; text-transform: uppercase; }
        .header p { margin: 5px 0 0 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #666; }
        th { background-color: #f2f2f2; padding: 10px; text-align: left; }
        td { padding: 10px; }
        .text-end { text-align: right; }
        .fw-bold { font-weight: bold; }
        .pemasukan { color: green; font-weight: bold; }
        .pengeluaran { color: red; font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Statistik Keuangan SIMAK</h2>
        <p>Periode Bulan: <?= $bulan_pilih; ?> | Tahun: <?= $tahun_pilih; ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jenis Transaksi</th>
                <th class="text-end">Nominal</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($riwayat_keuangan)): ?>
                <tr>
                    <td colspan="4" style="text-align: center; color: #999;">Tidak ada riwayat transaksi pada bulan ini.</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; foreach($riwayat_keuangan as $rk): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <?php 
                            // Menggunakan kolom asli database: 'tanggal_laporan' atau fallback aman
                            $tgl = !empty($rk['tanggal_laporan']) ? $rk['tanggal_laporan'] : (!empty($rk['tanggal']) ? $rk['tanggal'] : '');
                            echo !empty($tgl) ? date('d M Y', strtotime($tgl)) : '-'; 
                            ?>
                        </td>
                        <td>
                            <?php 
                            // Menggunakan kolom asli database: 'jenis_laporan' atau fallback aman
                            $jenis = !empty($rk['jenis_laporan']) ? $rk['jenis_laporan'] : (!empty($rk['jenis_transaksi']) ? $rk['jenis_transaksi'] : 'Pemasukan');
                            $class_jenis = (strtolower($jenis) == 'pemasukan') ? 'pemasukan' : 'pengeluaran';
                            ?>
                            <span class="<?= $class_jenis; ?>">
                                <?= ucfirst($jenis); ?>
                            </span>
                        </td>
                        <td class="text-end fw-bold">
                            <?php 
                            // Menggunakan kolom asli database: 'nominal'
                            $nominal = isset($rk['nominal']) ? $rk['nominal'] : 0;
                            echo 'Rp ' . number_format($nominal, 0, ',', '.');
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
        // Otomatis memicu pop-up print browser saat halaman ini dimuat
        window.onload = function() {
            window.print();
        }
    </script>

</body>
</html>