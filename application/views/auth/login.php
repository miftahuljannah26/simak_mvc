<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIMAK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f3f0ff; height: 100vh; overflow: hidden; }
        .full-screen-container { display: flex; height: 100vh; width: 100vw; }
        
        /* Sisi Kiri: Form Login dengan Gradien Halus */
        .left-side { 
            flex: 1; 
            background: rgba(255, 255, 255, 0.45); 
            background-image: radial-gradient(at 0% 0%, #ffb7d2 0px, transparent 60%), radial-gradient(at 100% 0%, #a0c4ff 0px, transparent 60%); 
            backdrop-filter: blur(30px); 
            padding: 60px; 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            align-items: center; 
        }
        .form-wrapper { width: 100%; max-width: 440px; }
        
        /* Sisi Kanan: Tempat Gambar Anime Ungu Pinterest */
        .right-side { 
            flex: 1.3; 
            height: 100vh; 
            background: url('https://i.pinimg.com/1200x/6c/ad/54/6cad542c3f32411c550134ff4fba5c0e.jpg') center/cover no-repeat; 
        }
        
        .brand-title { font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 52px; color: #fe5196; letter-spacing: -2px; }
        .form-heading { font-family: 'Outfit', sans-serif; font-weight: 800; color: #2d1f47; font-size: 34px; margin: 30px 0; }
        .form-control { border-radius: 16px; padding: 15px 20px; background: rgba(255, 255, 255, 0.7); border: 2px solid rgba(255,255,255,0.8); }
        
        .btn-main { 
            background: linear-gradient(135deg, #ff3f86, #7f5eff); 
            border: none; 
            padding: 16px; 
            font-size: 18px; 
            border-radius: 16px; 
            font-family: 'Outfit', sans-serif; 
            font-weight: 700; 
            color: white; 
            width: 100%; 
            box-shadow: 0 10px 25px rgba(255, 63, 134, 0.3); 
            transition: all 0.3s ease;
        }
        .btn-main:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(127, 94, 255, 0.4); }
        input{ transition:all 0.3s ease; }
        input:hover{ transform:translateY(-2px); }
        input:focus{ outline:none; border-color:#8b5cf6; box-shadow:0 0 15px rgba(139,92,246,0.3); }
        .btn{ transition:all 0.3s ease; }
        .btn:hover{ transform:translateY(-3px); box-shadow:0 10px 25px rgba(147,51,234,0.3); }
        
        @keyframes fadeUp {
            from{ opacity:0; transform:translateY(40px); }
            to{ opacity:1; transform:translateY(0); }
        }
        .brand-title, .logo{ animation:fadeUp .6s ease; }
        .brand-subtitle{ animation:fadeUp .8s ease; }
        .form-heading{ animation:fadeUp 1s ease; }
        form{ animation:fadeUp 1.2s ease; }
        .btn-login, .btn{ animation:fadeUp 1.4s ease; }
        .form-control:hover{ transform:translateY(-2px); }
        .form-control:focus{ outline:none; border-color:#8b5cf6; box-shadow:0 0 15px rgba(139,92,246,.3); }
        .btn-login:hover{ transform:translateY(-3px); box-shadow:0 15px 35px rgba(124,77,255,.35); }
    </style>
</head>

<body>
    <div class="full-screen-container">
        <div class="left-side">
            <div class="form-wrapper">
                <h1 class="brand-title">SIMAK</h1>
                <p class="text-muted">Sistem Manajemen Aktivitas & Keuangan Mahasiswa</p>
                <h1 class="form-heading">Welcome Back!</h1>
                
                <form action="<?php echo base_url('auth/login_process'); ?>" method="POST">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan Email Anda" required>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between">
                            <label class="form-label fw-bold">Password</label>
                            <a href="<?php echo base_url('auth/forgot_password'); ?>" style="color: #ff3f86; text-decoration: none; font-size: 14px; font-weight: 600;">Lupa Password?</a>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="••••" required>
                    </div>
                    <button type="submit" class="btn-main">Masuk Sekarang</button>
                </form>
                
                <p class="mt-4 text-center text-muted">Belum punya akun? <a href="<?php echo base_url('auth/registrasi'); ?>" style="color:#ff3f86; text-decoration:none; font-weight:700;">Silahkan Registrasi</a></p>
            </div>
        </div>
        <div class="right-side"></div>
    </div>
</body>

</html>