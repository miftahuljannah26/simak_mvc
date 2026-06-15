<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Forgot Password - SIMAK</title>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Outfit',sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    background:linear-gradient(
        135deg,
        #f4bfd0 0%,
        #ece8f3 50%,
        #a9c5f7 100%
    );
    overflow:hidden;
}

.left-side{
    width:45%;
    padding:40px 60px;
    display:flex;
    justify-content:center;
    align-items:center;
}

.form-wrapper{
    width:100%;
    max-width:600px;
}

.brand-title{
    font-size:52px;
    font-weight:800;
    color:#fe5196;
    margin-bottom:10px;
}

.brand-subtitle{
    font-size:18px;
    color:#555;
    margin-bottom:40px;
}

.form-heading{
    font-size: 34px;
    font-weight:800;
    color:#2d1f47;
    margin-bottom:30px;
}

.form-group{
    margin-bottom:30px;
}

.form-group label{
    display:block;
    font-size:16px;
    font-weight:700;
    color:#2d2d2d;
    margin-bottom:10px;
}

.form-control{
    width:100%;
    padding:16px 20px;
    border-radius:16px;
    border:2px solid rgba(255,255,255,.8);
    background:#dfe7f4;
    font-size:16px;
    transition:.3s;
}

.form-control:hover{
    transform:translateY(-2px);
}

.form-control:focus{
    outline:none;
    border-color:#8b5cf6;
    box-shadow:0 0 15px rgba(139,92,246,.3);
}

.btn-reset{
    width:100%;
    padding:16px;
    border:none;
    border-radius:16px;
    color:white;
    font-size:18px;
    font-weight:700;
    cursor:pointer;
    background:linear-gradient(90deg,#ff4d8d,#7c4dff);
    transition:.3s;
    box-shadow:0 10px 30px rgba(255,77,141,.25);
}

.btn-reset:hover{
    transform:translateY(-3px);
    box-shadow:0 15px 35px rgba(124,77,255,.35);
}

.login-link{
    text-align:center;
    margin-top:30px;
}

.login-link a{
    text-decoration:none;
    color:#ff4d8d;
    font-size:18px;
    font-weight:700;
}

.right{
    width:55%;
}

.right img{
    width:100%;
    height:100vh;
    object-fit:cover;
}

/* Animasi */
@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(30px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

.form-wrapper{
    animation:fadeUp .8s ease;
     max-width:500px;
}

@keyframes pulseLogo{
    0%,100%{
        transform:scale(1);
    }
    50%{
        transform:scale(1.03);
    }
}

.brand-title{
    animation:pulseLogo 3s infinite;
}
@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.brand-title,
.logo{
    animation: fadeUp 0.6s ease;
}
.brand-subtitle{
    animation: fadeUp 0.8s ease;
}
.form-heading{
    animation: fadeUp 1s ease;
}
.subtitle,
.form-heading{
    animation: fadeUp 1s ease;
}
form{
    animation: fadeUp 1.2s ease;
}
.btn,
.btn-login,
.btn-reset{
    animation: fadeUp 1.4s ease;
}
</style>
</head>

<body>

<div class="left-side">

    <div class="form-wrapper">

        <h1 class="brand-title">SIMAK</h1>

        <p class="brand-subtitle">
            Sistem Manajemen Aktivitas & Keuangan Mahasiswa
        </p>

        <h2 class="form-heading">
            Forgot Password!
        </h2>

        <form action="<?= base_url('auth/proses_reset'); ?>" method="post">

            <div class="form-group">
                <label>Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Masukkan Email"
                    required>
            </div>

            <div class="form-group">
                <label>Password Baru</label>
                <input
                    type="password"
                    name="password_baru"
                    class="form-control"
                    required>
            </div>

            <button type="submit" class="btn-reset">
                Reset Password
            </button>

        </form>

        <div class="login-link">
            <a href="<?= base_url('auth'); ?>">
                Kembali ke Login
            </a>
        </div>

    </div>

</div>

<div class="right">
    <img src="https://i.pinimg.com/1200x/6c/ad/54/6cad542c3f32411c550134ff4fba5c0e.jpg" alt="Anime">
</div>

</body>
</html>