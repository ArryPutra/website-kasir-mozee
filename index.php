<?php
    include("koneksi.php");
    session_start();
    // jika pengguna sudah login ...
    if (isset($_SESSION['cek_login'])) {
        if ($_SESSION['tipe_pengguna'] == 'karyawan') {
            header("Location: halaman/karyawan/kasir.php");
            exit;
        } else if ($_SESSION['tipe_pengguna'] == 'admin') {
            header("Location: halaman/admin/dashboard.php");
            exit;
        }
    }

    $pesanGagalLogin = null;
    if (isset($_POST['masuk'])) {
        // menyimpan inputan username
        $username = $_POST['username'];
        // menyimpan inputan password
        $password = $_POST['password'];
    
        // pilih data karyawan berdasarkan inputan username
        $karyawan = mysqli_query($conn,"SELECT * FROM karyawan WHERE username = '$username'");
        // jika data karyawan hasilnya ada di tabel maka ...
        if (mysqli_num_rows($karyawan) === 1) {
            // mengambil baris data karyawan
            $row = mysqli_fetch_array($karyawan);
    
            // jika inputan password sama dengan data password karyawan di tabel maka ...
            if ($row['password'] == $password) {
                session_start();
                $_SESSION['cek_login'] = true;
                $_SESSION['tipe_pengguna'] = 'karyawan';
                $_SESSION['nama'] = $row['nama'];
                $_SESSION['username'] = $row['username'];
                // pindahkan ke halaman karyawan
                header("Location: halaman/karyawan/kasir.php");
                // tidak menjalankan kode dibawah
                exit;
            }
        }
    
        // pilih data karyawan berdasarkan inputan username
        $admin = mysqli_query($conn,"SELECT * FROM admin WHERE username = '$username'");
        // jika data admin hasilnya ada di tabel maka ...
        if (mysqli_num_rows($admin) === 1) {
            // mengambil baris data admin
            $row = mysqli_fetch_array($admin);
    
            // jika inputan password sama dengan data password admin di tabel maka ...
            if ($row['password'] == $password) {
                session_start();
                $_SESSION['cek_login'] = true;
                $_SESSION['tipe_pengguna'] = 'admin';
                $_SESSION['nama'] = $row['nama'];
                $_SESSION['username'] = $row['username'];
                // pindahkan ke halaman admin
                header("Location: halaman/admin/dashboard.php");
                // tidak menjalankan kode dibawah
                exit;
            }
        }
        // jika data tidak ada di kedua tabel tersebut maka beri pesan gagal login
        $pesanGagalLogin = true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <link rel="stylesheet" href="./halaman/style.css">
</head>
<style>
    /* @import url('https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&family=Poppins:wght@500;600;700&display=swap'); */
    * {
       box-sizing: border-box;
       padding: 0;
       margin: 0;
       font-family: 'Inter', sans-serif;
    }

    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background: #f2f2f2;
    }

    .left {
        width: 50%;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.5), transparent), url('./gambar/login-image.jpg');
        height: 100%;
        background-size: cover;
        color: white;
        display: flex;
        align-items: end;
        padding: 2.5rem;
    }
    .right {
        width: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        height: 100%;
    }

    form {
        width: 320px;
    }
    .input-group {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
        margin-bottom: 1rem;
    }
    .input-group label {
        font-weight: 600;
        margin-bottom: 2.5px;
    }
    .input-group input {
        border: none;
        background: #f2f2f2;
        padding: 0.5rem;
        border-radius: 8px;
        transition: 150ms;
        outline: #D4D4D4 solid 0px;
    }
    .input-group input:focus {
        outline: #D4D4D4 solid 2px;
    }

    .alert {
        background: rgba(254, 0, 0, 0.2);
        display: flex;
        align-items: center;
        padding: 0.5rem;
        white-space: nowrap;
        color: red;
        border-radius: 8px;
        border: solid 2px rgba(254, 0, 0, 0.25);
        margin-bottom: 1rem;
        gap: 0.25rem;
    }

    @media screen and (max-width: 768px) {
        body {
            flex-direction: column;
        }
        .left {
            width: 100%;
            height: 30%;
        }
        .right {
            width: 100%;
            align-items: start;
            padding-top: 2rem;
        }
    }

</style>
<body>

    <div class="left">
        <h2>Mozee Souffle Pancake adalah sebuah usaha UMKM yang ada di Banjarmasin.</h2>
    </div>

    <div class="right">
        <form method="post">
            <h1 style="color: red;">Masuk</h1>
            <br>
            <?php if (isset($pesanGagalLogin)): ?>
                <div class="alert">
                    <svg style="height: 1.5rem;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Username atau password salah!
                </div>
            <?php endif; ?>

            <div class="input-group">
                <label for="username">Username</label>
                <input name="username" type="username" id="username" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input name="password" type="password" id="password" required>
            </div>

            <button class="red-btn" type="submit" name="masuk">Masuk</button> 
        </form>
    </div>

</body>
</html>