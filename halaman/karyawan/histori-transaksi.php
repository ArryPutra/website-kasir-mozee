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
    .card-riwayat-transaksi {
        box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.10);
        border-radius: 8px;
        background: white;
        padding: 1rem;
        margin-bottom: 1rem;
        display: flex;
        justify-content: space-between;
        height: 70px;
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
    }
    .detail-transaksi section {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
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
   
        <a href="kasir.php" class="menu-nonactive">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path d="M5.223 2.25c-.497 0-.974.198-1.325.55l-1.3 1.298A3.75 3.75 0 007.5 9.75c.627.47 1.406.75 2.25.75.844 0 1.624-.28 2.25-.75.626.47 1.406.75 2.25.75.844 0 1.623-.28 2.25-.75a3.75 3.75 0 004.902-5.652l-1.3-1.299a1.875 1.875 0 00-1.325-.549H5.223z" />
              <path fill-rule="evenodd" d="M3 20.25v-8.755c1.42.674 3.08.673 4.5 0A5.234 5.234 0 009.75 12c.804 0 1.568-.182 2.25-.506a5.234 5.234 0 002.25.506c.804 0 1.567-.182 2.25-.506 1.42.674 3.08.675 4.5.001v8.755h.75a.75.75 0 010 1.5H2.25a.75.75 0 010-1.5H3zm3-6a.75.75 0 01.75-.75h3a.75.75 0 01.75.75v3a.75.75 0 01-.75.75h-3a.75.75 0 01-.75-.75v-3zm8.25-.75a.75.75 0 00-.75.75v5.25c0 .414.336.75.75.75h3a.75.75 0 00.75-.75v-5.25a.75.75 0 00-.75-.75h-3z" clip-rule="evenodd" />
            </svg>
            <h3 id="menuTittle" style="display: none;">Kasir</h3>
        </a>
        <a href="histori-transaksi.php" class="menu-active">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
              <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z" clip-rule="evenodd" />
              <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375zM6 12a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V12zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 15a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V15zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75zM6 18a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H6.75a.75.75 0 01-.75-.75V18zm2.25 0a.75.75 0 01.75-.75h3.75a.75.75 0 010 1.5H9a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
            </svg>

            <h3 id="menuTittle" style="display: none;">Transaksi</h3>
        </a>
        <a href="biodata.php" class="menu-nonactive">
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
                                echo count(loopQuery("SELECT * FROM transaksi WHERE username_karyawan = '$_SESSION[username]'")); 
                            }
                            if(isset($_GET['waktu']) && $_GET['waktu'] != '') {
                                if($_GET['waktu'] == 'hari_ini') {
                                    $count = 0;
                                    foreach(loopQuery("SELECT * FROM transaksi WHERE username_karyawan = '$_SESSION[username]'") as $transaksi) {
                                        if(date('Y-m-d', strtotime($transaksi['waktu'])) == date('Y-m-d')) {
                                            $count++;
                                        }
                                    }
                                    echo $count;
                                }
                                else if($_GET['waktu'] == 'kemarin') {
                                    $count = 0;
                                    foreach(loopQuery("SELECT * FROM transaksi WHERE username_karyawan = '$_SESSION[username]'") as $transaksi) {
                                        if(date('Y-m-d', strtotime($transaksi['waktu'])) == date('Y-m-d', strtotime('-1 day'))) {
                                            $count++;
                                        }
                                    }
                                    echo $count;
                                }
                                else {
                                    $count = 0;
                                    foreach(loopQuery("SELECT * FROM transaksi WHERE username_karyawan = '$_SESSION[username]'") as $transaksi) {
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

            <?php if(empty($_GET['waktu'])) : ?>
                <?php foreach(array_reverse(loopQuery("SELECT * FROM transaksi WHERE username_karyawan = '$_SESSION[username]'")) 
                    as $transaksi) : 
                ?>
                <div class="card-riwayat-transaksi">
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
                    <?php foreach(array_reverse(loopQuery("SELECT * FROM transaksi WHERE username_karyawan = '$_SESSION[username]'")) as $transaksi) : ?>
                    <?php if(date('Y-m-d', strtotime($transaksi['waktu'])) == $_GET['waktu']) : ?>
                        <div class="card-riwayat-transaksi">
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
                    <?php foreach(array_reverse(loopQuery("SELECT * FROM transaksi WHERE username_karyawan = '$_SESSION[username]'")) as $transaksi) : ?>
                    <?php if(date('Y-m-d', strtotime($transaksi['waktu'])) == date('Y-m-d')) : ?>
                    <div class="card-riwayat-transaksi">
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
                    <?php foreach(array_reverse(loopQuery("SELECT * FROM transaksi WHERE username_karyawan = '$_SESSION[username]'")) as $transaksi) : ?>
                    <?php if(date('Y-m-d', strtotime($transaksi['waktu'])) == date('Y-m-d', strtotime('-1 day'))) : ?>
                    <div class="card-riwayat-transaksi">
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
                    card.style.height = 4.2 + 'rem'
                }
            })
        })

        function inputPilihTanggal(tanggal) {
            window.location.href = "./histori-transaksi.php?waktu=" +tanggal
        }
    </script>

</body>
</html>