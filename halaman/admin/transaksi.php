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
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../header.css">
    <link rel="stylesheet" href="../sidebar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
</head>

<style>
    .card-riwayat-transaksi {
        box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.10);
        border-radius: 8px;
        background: white;
        padding: 1rem;
        margin-bottom: 1rem;
        justify-content: space-between;
        height: 165px;
        flex-direction: column;
        overflow: hidden;
        transition: 150ms;
    }
    .card-riwayat-transaksi .header {
        display: flex;
        justify-content: space-between;

    }
    .card-riwayat-transaksi .left {
        height: fit-content;
    }
    .card-riwayat-transaksi .left h4 {
        color: #0150F2;
    }
    .card-riwayat-transaksi .right {
        display: flex;
        gap: 1rem;
        align-items: center;
        height: fit-content;
    }
    .card-riwayat-transaksi .right .dropDownBtn {
        width: 1.5rem;
        cursor: pointer;
        color: #97979F;
    }

    .detail-transaksi {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .detail-transaksi section {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
        white-space: nowrap;
    }
    .hasil-detail-transaksi {
        display: flex;
        gap: 1rem;
    }
    .hasil-detail-transaksi section {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    @media screen and (max-width: 768px) {
        .header .right h4 {
            display: none;
        }
    }

    .card-group {
        gap: 1rem;
        display: flex;
        flex-wrap: wrap;
    }
    .card {
        color: white;
        padding: 1rem;
        border-radius: 12px;
        box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.25);
        width: 260px;
    }
    .card div {
        display: flex;
        gap: 0.5rem;
        margin-top: 0.5rem;
        width: 200px;
    }

    .chips-btn-group {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }
    .chip-btn {
        background: #f2f2f2;
        border-radius: 16px;
        border: none;
        padding: 0.4rem 1rem;
        transition: 150ms;
        cursor: pointer;
        height: 2.5rem;
    }
    .chip-btn:hover {
        background: #ccc;
    }
    .chip-btn:focus {
        outline: solid 4px #f2f2f2;
    }
    .chip-btn-active {
        background: #0150F2;
        border-radius: 16px;
        border: none;
        padding: 0.4rem 1rem;
        transition: 150ms;
        cursor: pointer;
        color: white;
    }
    .chip-btn-active:hover {
        background: #013DD1;
    }
    .chip-btn-active:focus {
        outline: solid 4px #BFD3FB;
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
        <a href="transaksi.php" class="menu-active">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z" clip-rule="evenodd" />
              <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375zM6 12a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V12zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 15a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V15zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 18a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V18zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
            </svg>
            <h3 id="menuTittle" style="display: none;">Transaksi</h3>
        </a>
        <a href="biodata.php" class="menu-nonactive">
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
                <img src="../../gambar/admin/profile.jpg" style="height: 3.5rem; width: 3.5rem; object-fit: cover;">
            </div>
        </main>
    </header>

    <div class="layout">

        <main class="container-layout">
            
            <h1>Riwayat Transaksi</h1>

            <br>

            <div class="card-group">
                <div class="card" style="background: white; color: black;">
                    <h3>Jumlah Transaksi</h3>
                    <div>
                        <svg style="width: 1.5rem;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                          <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z" clip-rule="evenodd" />
                          <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375zM6 12a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V12zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 15a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V15zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 18a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V18zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                        </svg>
                        <h3>
                        <?php
                            if(empty($_GET['waktu'])) {
                                echo count(loopQuery("SELECT * FROM transaksi")); 
                            }
                            if(isset($_GET['waktu']) && $_GET['waktu'] != '') {
                                if($_GET['waktu'] == 'hari_ini') {
                                    $count = 0;
                                    foreach(loopQuery("SELECT * FROM transaksi") as $transaksi) {
                                        if(date('Y-m-d', strtotime($transaksi['waktu'])) == date('Y-m-d')) {
                                            $count++;
                                        }
                                    }
                                    echo $count;
                                }
                                else if($_GET['waktu'] == 'kemarin') {
                                    $count = 0;
                                    foreach(loopQuery("SELECT * FROM transaksi") as $transaksi) {
                                        if(date('Y-m-d', strtotime($transaksi['waktu'])) == date('Y-m-d', strtotime('-1 day'))) {
                                            $count++;
                                        }
                                    }
                                    echo $count;
                                }
                                else {
                                    $count = 0;
                                    foreach(loopQuery("SELECT * FROM transaksi") as $transaksi) {
                                        if(date('Y-m-d', strtotime($transaksi['waktu'])) == $_GET['waktu']) {
                                            $count++;
                                        }
                                    }
                                    echo $count;
                                }
                            }
                        ?>
                        </h3>
                    </div>
                </div>
                <div class="card" style="background: white; color: black;">
                    <h3>Laba Kotor</h3>
                    <div>
                        <svg style="width: 1.5rem;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                          <path d="M12 7.5a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z" />
                          <path fill-rule="evenodd" d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 14.625v-9.75zM8.25 9.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM18.75 9a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V9.75a.75.75 0 00-.75-.75h-.008zM4.5 9.75A.75.75 0 015.25 9h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H5.25a.75.75 0 01-.75-.75V9.75z" clip-rule="evenodd" />
                          <path d="M2.25 18a.75.75 0 000 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 00-.75-.75H2.25z" />
                        </svg>
                        <h3>Rp.
                        <?php
                            if(empty($_GET['waktu'])) {
                                $hasil = 0;
                                foreach(loopQuery("SELECT * FROM transaksi") as $transaksi) {
                                    $hasil += $transaksi['subtotal'];
                                }
                                echo convertRupiah($hasil);
                            }
                            if(isset($_GET['waktu']) && $_GET['waktu'] != '') {
                                if($_GET['waktu'] == 'hari_ini') {
                                    $hasil = 0;
                                    foreach(loopQuery("SELECT * FROM transaksi") as $transaksi) {
                                        if(date('Y-m-d', strtotime($transaksi['waktu'])) == date('Y-m-d')) {
                                            $hasil += $transaksi['subtotal'];
                                        }
                                    }
                                    echo convertRupiah($hasil);
                                }
                                else if($_GET['waktu'] == 'kemarin') {
                                    $hasil = 0;
                                    foreach(loopQuery("SELECT * FROM transaksi") as $transaksi) {
                                        if(date('Y-m-d', strtotime($transaksi['waktu'])) == date('Y-m-d', strtotime('-1 day'))) {
                                            $hasil += $transaksi['subtotal'];
                                        }
                                    }
                                    echo convertRupiah($hasil);
                                }
                                else {
                                    $hasil = 0;
                                    foreach(loopQuery("SELECT * FROM transaksi") as $transaksi) {
                                        if(date('Y-m-d', strtotime($transaksi['waktu'])) == $_GET['waktu']) {
                                            $hasil += $transaksi['subtotal'];
                                        }
                                    }
                                    echo convertRupiah($hasil);
                                }
                            }
                            ?>
                        </h3>
                    </div>
                </div>
            </div>

            <br>
            
            <div class="chips-btn-group">
                <input value="<?= isset($_GET['waktu']) ? $_GET['waktu'] : '' ?>" onchange="inputPilihTanggal(this.value)" class="<?= (isset($_GET['waktu']) && $_GET['waktu'] != '' && $_GET['waktu'] != 'hari_ini' && $_GET['waktu'] != 'kemarin') ? 'chip-btn-active' : 'chip-btn'; ?>" type="date">
                <form style="display: flex;">
                    <button name="waktu" class="<?= empty($_GET['waktu']) ? 'chip-btn-active' : 'chip-btn'; ?>">Semua</button>
                </form>
                <form style="display: flex;">
                    <button name="waktu" value="hari_ini" class="<?= (isset($_GET['waktu']) && $_GET['waktu'] == 'hari_ini') ? 'chip-btn-active' : 'chip-btn'; ?>">Hari ini</button>
                </form>
                <form style="display: flex;">
                    <button name="waktu" value="kemarin" class="<?= (isset($_GET['waktu']) && $_GET['waktu'] == 'kemarin') ? 'chip-btn-active' : 'chip-btn'; ?>">Kemarin</button>
                </form>
            </div>

            <br>

            <?php if(empty($_GET['waktu'])) : ?>
                <?php foreach(array_reverse(loopQuery("SELECT * FROM transaksi")) as $transaksi) : ?>
                <div class="card-riwayat-transaksi">
                    <div style="display: flex; gap: 1rem;">
                        <img src="../../gambar/karyawan/<?= selectData("SELECT * FROM karyawan WHERE username = '$transaksi[username_karyawan]'")['gambar'] ?>" style="height: 4rem; width: 4rem; object-fit: cover; border-radius: 99px;">
                        <div>
                            <h2><?= selectData("SELECT * FROM karyawan WHERE username = '$transaksi[username_karyawan]'")['nama'] ?></h2>
                            <h3 style="color: red;">@<?= $transaksi['username_karyawan'] ?></h3>
                        </div>
                    </div>
                    <div class="divider-gray"></div>
                    <div class="header">
                        <div class="left">
                            <h4>Transaksi #<?= $transaksi['id_transaksi'] ?></h4>
                            <span><?= $transaksi['waktu'] ?></span>
                        </div>
                        <div class="right">
                            <h4>Subtotal: Rp. <?= convertRupiah($transaksi['subtotal']) ?></h4>
                            <svg class="dropDownBtn" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>
                    <div class="divider-gray" style="color: white;">divider</div>
                    <div class="detail-transaksi">
                        <section>
                            <h4>Menu</h4>
                            <?php foreach(loopQuery("SELECT * FROM detail_transaksi WHERE id_transaksi = " . $transaksi['id_transaksi']) as $menu) : ?>  
                            <span><?= selectData("SELECT * FROM barang WHERE id = " . $menu['id_barang'])['nama'] ?></span>
                            <?php endforeach ; ?>
                        </section>
                        <section>
                            <h4>Qty</h4>
                            <?php foreach(loopQuery("SELECT * FROM detail_transaksi WHERE id_transaksi = " . $transaksi['id_transaksi']) as $menu) : ?>  
                            <span><?= $menu['jumlah'] ?></span>
                            <?php endforeach ; ?>
                        </section>
                        <section>
                            <h4>Satuan</h4>
                            <?php foreach(loopQuery("SELECT * FROM detail_transaksi WHERE id_transaksi = " . $transaksi['id_transaksi']) as $menu) : ?>  
                            <span>Rp. <?= convertRupiah(selectData("SELECT * FROM barang WHERE id = " . $menu['id_barang'])['harga']) ?></span>
                            <?php endforeach ; ?>
                        </section>
                        <section>
                            <h4>Total</h4>
                            <?php foreach(loopQuery("SELECT * FROM detail_transaksi WHERE id_transaksi = " . $transaksi['id_transaksi']) as $menu) : ?>  
                            <span>Rp. <?= convertRupiah($menu['subtotal']) ?></span>
                            <?php endforeach ; ?>
                        </section>
                    </div>
                    <div class="divider-gray" style="color: white;">divider</div>
                    <div class="hasil-detail-transaksi">
                        <section>
                            <h4>Tunai</h4>
                            <h4>Subtotal</h4>
                            <h4>Kembali</h4>
                        </section>
                        <section>
                            <span>: Rp. <?= convertRupiah($transaksi['tunai']) ?></span>
                            <span>: Rp. <?= convertRupiah($transaksi['subtotal']) ?></span>
                            <span>: <?= $transaksi['kembali'] == 0 ? 'Lunas' : 'Rp. ' . convertRupiah($transaksi['kembali']) ?></span>
                        </section>
                    </div>
                </div>
                <?php endforeach ?>
            <?php endif ; ?>

            <?php if(isset($_GET['waktu'])) : ?>

                <?php if($_GET['waktu'] != 'hari_ini' && $_GET['waktu'] != 'kemarin') : ?>
                    <?php foreach(array_reverse(loopQuery("SELECT * FROM transaksi")) as $transaksi) : ?>
                    <?php if(date('Y-m-d', strtotime($transaksi['waktu'])) == $_GET['waktu']) : ?>
                        <div class="card-riwayat-transaksi">
                        <div style="display: flex; gap: 1rem;">
                            <img src="../../gambar/karyawan/<?= selectData("SELECT * FROM karyawan WHERE username = '$transaksi[username_karyawan]'")['gambar'] ?>" style="height: 4rem; width: 4rem; object-fit: cover; border-radius: 99px;">
                            <div>
                                <h2><?= selectData("SELECT * FROM karyawan WHERE username = '$transaksi[username_karyawan]'")['nama'] ?></h2>
                                <h3 style="color: red;">@<?= $transaksi['username_karyawan'] ?></h3>
                            </div>
                        </div>
                        <div class="divider-gray"></div>
                        <div class="header">
                            <div class="left">
                                <h4>Transaksi #<?= $transaksi['id_transaksi'] ?></h4>
                                <span><?= $transaksi['waktu'] ?></span>
                            </div>
                            <div class="right">
                                <h4>Subtotal: Rp. <?= convertRupiah($transaksi['subtotal']) ?></h4>
                                <svg class="dropDownBtn" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </div>
                        <div class="divider-gray" style="color: white;">divider</div>
                        <div class="detail-transaksi">
                            <section>
                                <h4>Menu</h4>
                                <?php foreach(loopQuery("SELECT * FROM detail_transaksi WHERE id_transaksi = " . $transaksi['id_transaksi']) as $menu) : ?>  
                                <span><?= selectData("SELECT * FROM barang WHERE id = " . $menu['id_barang'])['nama'] ?></span>
                                <?php endforeach ; ?>
                            </section>
                            <section>
                                <h4>Qty</h4>
                                <?php foreach(loopQuery("SELECT * FROM detail_transaksi WHERE id_transaksi = " . $transaksi['id_transaksi']) as $menu) : ?>  
                                <span><?= $menu['jumlah'] ?></span>
                                <?php endforeach ; ?>
                            </section>
                            <section>
                                <h4>Satuan</h4>
                                <?php foreach(loopQuery("SELECT * FROM detail_transaksi WHERE id_transaksi = " . $transaksi['id_transaksi']) as $menu) : ?>  
                                <span>Rp. <?= convertRupiah(selectData("SELECT * FROM barang WHERE id = " . $menu['id_barang'])['harga']) ?></span>
                                <?php endforeach ; ?>
                            </section>
                            <section>
                                <h4>Total</h4>
                                <?php foreach(loopQuery("SELECT * FROM detail_transaksi WHERE id_transaksi = " . $transaksi['id_transaksi']) as $menu) : ?>  
                                <span>Rp. <?= convertRupiah($menu['subtotal']) ?></span>
                                <?php endforeach ; ?>
                            </section>
                        </div>
                        <div class="divider-gray" style="color: white;">divider</div>
                        <div class="hasil-detail-transaksi">
                            <section>
                                <h4>Tunai</h4>
                                <h4>Subtotal</h4>
                                <h4>Kembali</h4>
                            </section>
                            <section>
                                <span>: Rp. <?= convertRupiah($transaksi['tunai']) ?></span>
                                <span>: Rp. <?= convertRupiah($transaksi['subtotal']) ?></span>
                                <span>: <?= $transaksi['kembali'] == 0 ? 'Lunas' : 'Rp. ' . convertRupiah($transaksi['kembali']) ?></span>
                            </section>
                        </div>
                    </div>
                    <?php endif ; ?>
                    <?php endforeach ; ?>
                <?php endif ; ?>

                <?php if($_GET['waktu'] == 'hari_ini') : ?>
                    <?php foreach(array_reverse(loopQuery("SELECT * FROM transaksi")) as $transaksi) : ?>
                    <?php if(date('Y-m-d', strtotime($transaksi['waktu'])) == date('Y-m-d')) : ?>
                    <div class="card-riwayat-transaksi">
                        <div style="display: flex; gap: 1rem;">
                            <img src="../../gambar/karyawan/<?= selectData("SELECT * FROM karyawan WHERE username = '$transaksi[username_karyawan]'")['gambar'] ?>" style="height: 4rem; width: 4rem; object-fit: cover; border-radius: 99px;">
                            <div>
                                <h2><?= selectData("SELECT * FROM karyawan WHERE username = '$transaksi[username_karyawan]'")['nama'] ?></h2>
                                <h3 style="color: red;">@<?= $transaksi['username_karyawan'] ?></h3>
                            </div>
                        </div>
                        <div class="divider-gray"></div>
                        <div class="header">
                            <div class="left">
                                <h4>Transaksi #<?= $transaksi['id_transaksi'] ?></h4>
                                <span><?= $transaksi['waktu'] ?></span>
                            </div>
                            <div class="right">
                                <h4>Subtotal: Rp. <?= convertRupiah($transaksi['subtotal']) ?></h4>
                                <svg class="dropDownBtn" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </div>
                        <div class="divider-gray" style="color: white;">divider</div>
                        <div class="detail-transaksi">
                            <section>
                                <h4>Menu</h4>
                                <?php foreach(loopQuery("SELECT * FROM detail_transaksi WHERE id_transaksi = " . $transaksi['id_transaksi']) as $menu) : ?>  
                                <span><?= selectData("SELECT * FROM barang WHERE id = " . $menu['id_barang'])['nama'] ?></span>
                                <?php endforeach ; ?>
                            </section>
                            <section>
                                <h4>Qty</h4>
                                <?php foreach(loopQuery("SELECT * FROM detail_transaksi WHERE id_transaksi = " . $transaksi['id_transaksi']) as $menu) : ?>  
                                <span><?= $menu['jumlah'] ?></span>
                                <?php endforeach ; ?>
                            </section>
                            <section>
                                <h4>Satuan</h4>
                                <?php foreach(loopQuery("SELECT * FROM detail_transaksi WHERE id_transaksi = " . $transaksi['id_transaksi']) as $menu) : ?>  
                                <span>Rp. <?= convertRupiah(selectData("SELECT * FROM barang WHERE id = " . $menu['id_barang'])['harga']) ?></span>
                                <?php endforeach ; ?>
                            </section>
                            <section>
                                <h4>Total</h4>
                                <?php foreach(loopQuery("SELECT * FROM detail_transaksi WHERE id_transaksi = " . $transaksi['id_transaksi']) as $menu) : ?>  
                                <span>Rp. <?= convertRupiah($menu['subtotal']) ?></span>
                                <?php endforeach ; ?>
                            </section>
                        </div>
                        <div class="divider-gray" style="color: white;">divider</div>
                        <div class="hasil-detail-transaksi">
                            <section>
                                <h4>Tunai</h4>
                                <h4>Subtotal</h4>
                                <h4>Kembali</h4>
                            </section>
                            <section>
                                <span>: Rp. <?= convertRupiah($transaksi['tunai']) ?></span>
                                <span>: Rp. <?= convertRupiah($transaksi['subtotal']) ?></span>
                                <span>: <?= $transaksi['kembali'] == 0 ? 'Lunas' : 'Rp. ' . convertRupiah($transaksi['kembali']) ?></span>
                            </section>
                        </div>
                    </div>
                    <?php endif ; ?>
                    <?php endforeach ; ?>
                <?php endif ; ?>

                <?php if($_GET['waktu'] == 'kemarin') : ?>
                    <?php foreach(array_reverse(loopQuery("SELECT * FROM transaksi")) as $transaksi) : ?>
                    <?php if(date('Y-m-d', strtotime($transaksi['waktu'])) == date('Y-m-d', strtotime('-1 day'))) : ?>
                    <div class="card-riwayat-transaksi">
                        <div style="display: flex; gap: 1rem;">
                            <img src="../../gambar/karyawan/<?= selectData("SELECT * FROM karyawan WHERE username = '$transaksi[username_karyawan]'")['gambar'] ?>" style="height: 4rem; width: 4rem; object-fit: cover; border-radius: 99px;">
                            <div>
                                <h2><?= selectData("SELECT * FROM karyawan WHERE username = '$transaksi[username_karyawan]'")['nama'] ?></h2>
                                <h3 style="color: red;">@<?= $transaksi['username_karyawan'] ?></h3>
                            </div>
                        </div>
                        <div class="divider-gray"></div>
                        <div class="header">
                            <div class="left">
                                <h4>Transaksi #<?= $transaksi['id_transaksi'] ?></h4>
                                <span><?= $transaksi['waktu'] ?></span>
                            </div>
                            <div class="right">
                                <h4>Subtotal: Rp. <?= convertRupiah($transaksi['subtotal']) ?></h4>
                                <svg class="dropDownBtn" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </div>
                        <div class="divider-gray" style="color: white;">divider</div>
                        <div class="detail-transaksi">
                            <section>
                                <h4>Menu</h4>
                                <?php foreach(loopQuery("SELECT * FROM detail_transaksi WHERE id_transaksi = " . $transaksi['id_transaksi']) as $menu) : ?>  
                                <span><?= selectData("SELECT * FROM barang WHERE id = " . $menu['id_barang'])['nama'] ?></span>
                                <?php endforeach ; ?>
                            </section>
                            <section>
                                <h4>Qty</h4>
                                <?php foreach(loopQuery("SELECT * FROM detail_transaksi WHERE id_transaksi = " . $transaksi['id_transaksi']) as $menu) : ?>  
                                <span><?= $menu['jumlah'] ?></span>
                                <?php endforeach ; ?>
                            </section>
                            <section>
                                <h4>Satuan</h4>
                                <?php foreach(loopQuery("SELECT * FROM detail_transaksi WHERE id_transaksi = " . $transaksi['id_transaksi']) as $menu) : ?>  
                                <span>Rp. <?= convertRupiah(selectData("SELECT * FROM barang WHERE id = " . $menu['id_barang'])['harga']) ?></span>
                                <?php endforeach ; ?>
                            </section>
                            <section>
                                <h4>Total</h4>
                                <?php foreach(loopQuery("SELECT * FROM detail_transaksi WHERE id_transaksi = " . $transaksi['id_transaksi']) as $menu) : ?>  
                                <span>Rp. <?= convertRupiah($menu['subtotal']) ?></span>
                                <?php endforeach ; ?>
                            </section>
                        </div>
                        <div class="divider-gray" style="color: white;">divider</div>
                        <div class="hasil-detail-transaksi">
                            <section>
                                <h4>Tunai</h4>
                                <h4>Subtotal</h4>
                                <h4>Kembali</h4>
                            </section>
                            <section>
                                <span>: Rp. <?= convertRupiah($transaksi['tunai']) ?></span>
                                <span>: Rp. <?= convertRupiah($transaksi['subtotal']) ?></span>
                                <span>: <?= $transaksi['kembali'] == 0 ? 'Lunas' : 'Rp. ' . convertRupiah($transaksi['kembali']) ?></span>
                            </section>
                        </div>
                    </div>
                    <?php endif ; ?>
                    <?php endforeach ; ?>
                <?php endif ; ?>
                
            <?php endif ; ?>
            
        </main>
    </div>
    
    <script src="../sidebar.js"></script>
    <script>
        document.querySelectorAll('.card-riwayat-transaksi .right .dropDownBtn').forEach((btn) => {
            btn.addEventListener('click', () => {
                const card = btn.parentElement.parentElement.parentElement
                card.classList.toggle('card-riwayat-transaksi-active')
                if(card.classList.contains('card-riwayat-transaksi-active')) {
                    card.style.height = card.scrollHeight + 'px'
                } else {
                    card.style.height = 165 + 'px'
                }
            })
        })

        function inputPilihTanggal(tanggal) {
            window.location.href = "./transaksi.php?waktu=" +tanggal
        }
    </script>

</body>
</html>