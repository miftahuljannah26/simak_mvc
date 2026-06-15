<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIMAK - Pengaturan Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: radial-gradient(at 0% 0%, #e06d94 0px, transparent 55%), radial-gradient(at 100% 0%, #5f95f7 0px, transparent 55%); background-attachment: fixed; min-height: 100vh; }
        .card-profile { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.7); padding: 40px; border-radius: 24px; animation: fadeIn 0.6s ease-out forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .sidebar-col { width: 260px; background: #fff; height: 100vh; position: fixed; border-right: 1px solid rgba(0,0,0,0.05); padding: 40px 24px; }
        .main-content { margin-left: 260px; padding: 40px; }
        .form-control { border-radius: 12px; padding: 12px; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="d-flex">
        <aside class="sidebar-col">
            <div class="fw-bold" style="font-family:'Outfit'; font-size:28px; color:#d12264;">SIMAK</div>
            <nav class="nav flex-column mt-5">
                <a href="<?= base_url('dashboard'); ?>" class="nav-link text-dark">Dashboard</a>
            </nav>
        </aside>

        <main class="main-content w-100">
            <div class="card-profile">
                <h3 class="fw-bold mb-4" style="font-family:'Outfit';">Pengaturan Profil</h3>
                <form action="<?= base_url('profile/update'); ?>" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="<?= $this->session->userdata('nama'); ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?= $this->session->userdata('email'); ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Password Baru (Kosongkan jika tidak ubah)</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                    <a href="<?= base_url('auth/logout'); ?>" class="btn btn-danger px-4">Logout</a>
                </form>
            </div>
        </main>
    </div>
</body>
</html>