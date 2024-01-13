<?php
    include("../../koneksi.php");
    session_start();
    if(!isset($_SESSION['cek_login']) || $_SESSION['tipe_pengguna'] != 'admin') {
        header('Location: ../../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Admin</title>
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
   
        <a href="dashboard.php" class="menu-nonactive">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z" clip-rule="evenodd" />
              <path fill-rule="evenodd" d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z" clip-rule="evenodd" />
            </svg>
            <h3 id="menuTittle" style="display: none;">Dashboard</h3>
        </a>
        <a href="barang.php" class="menu-nonactive">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375z" />
              <path fill-rule="evenodd" d="M3.087 9l.54 9.176A3 3 0 006.62 21h10.757a3 3 0 002.995-2.824L20.913 9H3.087zm6.163 3.75A.75.75 0 0110 12h4a.75.75 0 010 1.5h-4a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
            </svg>
            <h3 id="menuTittle" style="display: none;">Barang</h3>
        </a>
        <a href="karyawan.php" class="menu-nonactive">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
            </svg>
            <h3 id="menuTittle" style="display: none;">Karyawan</h3>
        </a>
        <a href="transaksi.php" class="menu-nonactive">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z" clip-rule="evenodd" />
              <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375zM6 12a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V12zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 15a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V15zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 18a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V18zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
            </svg>
            <h3 id="menuTittle" style="display: none;">Transaksi</h3>
        </a>
        <a href="biodata.php" class="menu-active">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
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
                <h4>Admin, <?= $_SESSION['nama'] ?></h4>
                <img style="height: 3.5rem; width: 3.5rem; object-fit: cover;" src="../../gambar/admin/profile.jpg">
            </div>
        </main>
    </header>

    <div class="layout">

        <main class="container-layout">
            <div class="banner">
                <h1>Biodata Admin</h1>
            </div>
            <br>
            <div class="header-profile">
            <img style="height: 7rem; width: 7rem; object-fit: cover; border-radius: 99px;" src="../../gambar/admin/profile.jpg">
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
            <div style="background: #f2f2f2; padding: 0.75rem; border-radius: 8px; width: fit-content;"><?= selectData("SELECT * FROM admin WHERE username = '$_SESSION[username]'")['jenis_kelamin'] ?></div>
            
            <br>

            <h3 style="margin-bottom: 0.5rem;">Tanggal Lahir</h3>
            <div style="background: #f2f2f2; padding: 0.75rem; border-radius: 8px; width: fit-content;"><?= selectData("SELECT * FROM admin WHERE username = '$_SESSION[username]'")['tanggal_lahir'] ?></div>
            
        </main>
    </div>
    
    <script src="../sidebar.js"></script>

</body>
</html>