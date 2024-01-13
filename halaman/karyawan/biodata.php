<?php
    include("../../koneksi.php");
    session_start();
    if(!isset($_SESSION['cek_login']) || $_SESSION['tipe_pengguna'] != 'karyawan') {
        header('Location: ../../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Karyawan</title>
    <link rel="stylesheet" href="../header.css">
    <link rel="stylesheet" href="../sidebar.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
</head>

<style>
    .banner {
        width: 100%;
        height: 150px;
        background: url('../../gambar/banner.jpg');
        display: flex;
        align-items: end;
        padding: 1rem;
        border-radius: 1rem;
    }
    .banner h1 {
        color: white;
    }

    .header-profile {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
</style>

<body>

<aside>
        <main class="menu-main">
            <div class="menu" onclick="menuBtn(this)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </div>
        </main>

        <div id="divider"></div>
   
        <a href="kasir.php" class="menu-nonactive">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path d="M5.223 2.25c-.497 0-.974.198-1.325.55l-1.3 1.298A3.75 3.75 0 007.5 9.75c.627.47 1.406.75 2.25.75.844 0 1.624-.28 2.25-.75.626.47 1.406.75 2.25.75.844 0 1.623-.28 2.25-.75a3.75 3.75 0 004.902-5.652l-1.3-1.299a1.875 1.875 0 00-1.325-.549H5.223z" />
              <path fill-rule="evenodd" d="M3 20.25v-8.755c1.42.674 3.08.673 4.5 0A5.234 5.234 0 009.75 12c.804 0 1.568-.182 2.25-.506a5.234 5.234 0 002.25.506c.804 0 1.567-.182 2.25-.506 1.42.674 3.08.675 4.5.001v8.755h.75a.75.75 0 010 1.5H2.25a.75.75 0 010-1.5H3zm3-6a.75.75 0 01.75-.75h3a.75.75 0 01.75.75v3a.75.75 0 01-.75.75h-3a.75.75 0 01-.75-.75v-3zm8.25-.75a.75.75 0 00-.75.75v5.25c0 .414.336.75.75.75h3a.75.75 0 00.75-.75v-5.25a.75.75 0 00-.75-.75h-3z" clip-rule="evenodd" />
            </svg>
            <h3 id="menuTittle" style="display: none;">Kasir</h3>
        </a>
        <a href="histori-transaksi.php" class="menu-nonactive">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z" clip-rule="evenodd" />
              <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375zM6 12a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V12zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 15a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V15zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 18a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V18zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
            </svg>
            <h3 id="menuTittle" style="display: none;">Transaksi</h3>
        </a>
        <a href="biodata.php" class="menu-active">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
            </svg>
            <h3 id="menuTittle" style="display: none;">Profil</h3>
        </a>

        <a href="../../proses/keluar.php" class="menu-active" style="position: absolute; bottom: 1rem; text-decoration: none;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
            </svg>
            <h3 id="menuTittle" style="display: none;">Keluar</h3>
        </a>
    </aside>
    
    <header>
        <main>
            <img src="../../gambar/logo.png" width="65px" alt="">
            <div class="profile">
                <h4>Kasir, <?= $_SESSION['nama'] ?></h4>
                <img style="height: 3.5rem; width: 3.5rem; object-fit: cover;" src="../../gambar/karyawan/<?= selectData("SELECT * FROM karyawan WHERE username = '$_SESSION[username]'")['gambar'] ?>">
            </div>
        </main>
    </header>

    <div class="layout">

        <main class="container-layout">
            <div class="banner">
                <h1>Biodata Karyawan</h1>
            </div>
            <br>
            <div class="header-profile">
            <img style="height: 7rem; width: 7rem; object-fit: cover; border-radius: 99px;" src="../../gambar/karyawan/<?= selectData("SELECT * FROM karyawan WHERE username = '$_SESSION[username]'")['gambar'] ?>">
                <div>
                    <h2><?= $_SESSION['nama'] ?></h2>
                    <h3 style="color: red;">@<?= $_SESSION['username'] ?></h3>
                </div>
            </div>
            
            <div class="divider-gray"></div>

            <h3 style="margin-bottom: 0.5rem;">Nama</h3>
            <div style="background: #f2f2f2; padding: 0.75rem; border-radius: 8px; width: fit-content;"><?= $_SESSION['nama'] ?></div>
            
            <br>

            <h3 style="margin-bottom: 0.5rem;">Username</h3>
            <div style="background: #f2f2f2; padding: 0.75rem; border-radius: 8px; width: fit-content;"><?= $_SESSION['username'] ?></div>
            
            <br>
            
            <h3 style="margin-bottom: 0.5rem;">Jenis Kelamin</h3>
            <div style="background: #f2f2f2; padding: 0.75rem; border-radius: 8px; width: fit-content;"><?= selectData("SELECT * FROM karyawan WHERE username = '$_SESSION[username]'")['jenis_kelamin'] ?></div>
            
            <br>

            <h3 style="margin-bottom: 0.5rem;">Tanggal Lahir</h3>
            <div style="background: #f2f2f2; padding: 0.75rem; border-radius: 8px; width: fit-content;"><?= selectData("SELECT * FROM karyawan WHERE username = '$_SESSION[username]'")['tanggal_lahir'] ?></div>
            
            <br>

            <h3 style="margin-bottom: 0.5rem;">No. HP</h3>
            <div style="background: #f2f2f2; padding: 0.75rem; border-radius: 8px; width: fit-content;"><?= selectData("SELECT * FROM karyawan WHERE username = '$_SESSION[username]'")['nomor_hp'] ?></div>
            
        </main>
    </div>
    
    <script src="../sidebar.js"></script>

</body>
</html>