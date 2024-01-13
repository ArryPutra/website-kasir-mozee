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
    <title>Halaman Kasir</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" href="../sidebar.css">
    <link rel="stylesheet" href="../header.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
</head>

<style>

    header {
        position: static;
        justify-content: flex-start;
        padding-left: 0px;
    }
    header main {
        justify-content: flex-start;
    }

    .layout {
        margin-top: -100px;
    }
    .container-layout {
        display: flex;
    }

    .left {
        width: 100%;
    }

    .right {
        border-left: 2px solid #f2f2f2;
        width: fit-content;
        padding: 1rem;
    }

    .card-menu-group {
        display: flex;
        flex-wrap: wrap;
        padding: 1rem 0;
    }
    .card-menu {
        background: white;
        border-radius: 12px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        padding-bottom: 1rem;
        margin: 0.75rem;
    }

    .card-pesanan {
        display: flex;
        margin-bottom: 2rem;
        gap: 2rem;
        align-items: center;
        justify-content: space-between;
        /* flex-wrap: wrap; */
    }
    .card-pesanan button {
        background: rgba(256, 0, 0, 0.2);
        color: red;
        width: 2.5rem;
        height: 2.5rem;
        border: none;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
    }
    .number-input {
        display: flex;
    }
    .number-input button {
        background: #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.5rem;
        color: black;
        border-radius: 0;
    }

    .number-input input[type=number] {
        font-family: 'Inter', sans-serif;
        width: 3rem;
        text-align: center;
        border: none;
        background: #f2f2f2;
        outline: none;
    }
    
    table tr td {
        padding: 1rem 0rem;
        padding-right: 1rem;
    }

    @media screen and (max-width: 1024px) {
        .container-layout {
            flex-direction: column;
        }
        .right {
            border-left: 0;
            width: 100%;
        }

        .card-menu-group {
            flex-wrap: nowrap;
            overflow: auto;
        }
        .profile {
            display: none;
        }

    }

    #struk {
        z-index: 3;
        display: flex;
        justify-content: center;
        flex-direction: column;
        white-space: nowrap;
        background: white;
        position: absolute;
        width: 100%;
        gap: 0.75rem;
        display: none;
    }
    #struk .header {
        display: flex;
        align-items: center;
        flex-direction: column;
        gap: 0.25rem;
    }
    #struk div {
        display: flex;
        gap: 1rem;
    }
    #struk div section {
        display: flex;
        flex-direction: column;
        gap: 0.25rem; 
    }
    #struk .line {
        border: solid 1px;
        background: black;
        border-style: dashed;
    }

    @media print {
        body * {
            display: none;
        }
        #struk, #struk * {
            display: flex;
        }
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
   
        <a href="kasir.php" class="menu-active">
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

    <div class="layout">
        <main class="container-layout">

            <div class="left">
                <header class="static">
                    <main>
                        <img src="../../gambar/logo.png" width="65px" alt="">
                    </main>
                </header>

                <h1>Halaman Kasir</h1>

                <br>
                
                <main class="card-menu-group">
                    <?php foreach(loopQuery("SELECT * FROM barang") as $barang) : ?>
                    <div class="card-menu">
                        <div style="
                        background: linear-gradient(to top, rgba(0, 0, 0, 0.25), transparent), url('../../gambar/barang/<?= $barang['gambar'] ?>');
                        background-size: cover;
                        height: 160px;
                        width: 100%;
                        display: flex;
                        align-items: end;
                        padding: 0.5rem;
                        border-radius: 12px;">
                            <h2 style="color: white;"><?= $barang['nama'] ?></h2>
                        </div>
                        <div style="padding: 0rem 1rem;">
                            <h3 style="font-weight: 600; margin: 0.5rem 0px;">Rp. <?= convertRupiah($barang['harga']) ?></h3>
                            <button id="tambahMenuBtn" onclick="tambahMenu(<?= $barang['id'] ?>, '<?= $barang['nama'] ?>', <?= $barang['harga'] ?>, '<?= $barang['gambar'] ?>', <?= $barang['harga'] ?>)" class="red-btn"><h4>Tambah Menu</h4></button>
                        </div>
                    </div>
                    <?php endforeach ; ?>
                </main>
            </div>
            
            <div class="right">
                <div class="profile">
                    <h4 style="white-space: nowrap;">Kasir, <?= $_SESSION['nama'] ?></h4>
                    <img style="height: 3.5rem; width: 3.5rem; object-fit: cover; border-radius: 99px;" src="../../gambar/karyawan/<?= selectData("SELECT * FROM karyawan WHERE username = '$_SESSION[username]'")['gambar'] ?>">
                </div>

                <div class="divider-gray"></div>

                <h1 style="white-space: nowrap; color: red;">Daftar Pesanan</h1>

                <br>

                <div id="cardPesananGroup">

                    <span id="tidakAdaDaftarPesanan" style="color: gray;">Tidak ada daftar pesanan.</span>
                    
                </div>

                <div class="divider-gray"></div>

                <table>
                    <tr>
                        <td><h4>Subtotal</h4></td>
                        <td>: Rp. <span id="subTotal">0</span></td>
                    </tr>
                    <tr>
                        <td><h4>Total Item</h4></td>
                        <td>: <span id="totalItem">0</span></td>
                    </tr>
                    <tr>
                        <td><h4>Tunai</h4></td>
                        <td style="display: flex; background: #f2f2f2; border-radius: 8px; padding: 0.75rem 1rem;">
                            <h4>Rp. </h4>
                            <input id="inputTunai" oninput="inputTunai(this.value)" style="border: none; outline: none; background: none; padding-left: 0.5rem; font-size: 15px; width: 100%;" type="text">
                        </td>
                    </tr>
                    <tr>
                        <td><h4>Kembali</h4></td>
                        <td>: <span id="kembali">Rp. -</span></td>
                    </tr>
                </table>

                <br>

                <div style="display: flex; gap: 1rem;">
                    <button class="disabled-btn" id="buatPesananBtn" onclick="buatPesanan()">
                        Buat Pesanan
                    </button>
                    <button style="display: none;" class="blue-btn" id="buatTransaksiBaruBtn" onclick="buatTransaksiBaru()">Buat Transaksi Baru</button>
                    <button class="disabled-btn" id="cetakStrukBtn" onclick="cetakStruk()" style="width: fit-content; padding: 0 1rem;">
                        Cetak
                        <svg style="width: 1rem;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.875 1.5C6.839 1.5 6 2.34 6 3.375v2.99c-.426.053-.851.11-1.274.174-1.454.218-2.476 1.483-2.476 2.917v6.294a3 3 0 003 3h.27l-.155 1.705A1.875 1.875 0 007.232 22.5h9.536a1.875 1.875 0 001.867-2.045l-.155-1.705h.27a3 3 0 003-3V9.456c0-1.434-1.022-2.7-2.476-2.917A48.716 48.716 0 0018 6.366V3.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM16.5 6.205v-2.83A.375.375 0 0016.125 3h-8.25a.375.375 0 00-.375.375v2.83a49.353 49.353 0 019 0zm-.217 8.265c.178.018.317.16.333.337l.526 5.784a.375.375 0 01-.374.409H7.232a.375.375 0 01-.374-.409l.526-5.784a.373.373 0 01.333-.337 41.741 41.741 0 018.566 0zm.967-3.97a.75.75 0 01.75-.75h.008a.75.75 0 01.75.75v.008a.75.75 0 01-.75.75H18a.75.75 0 01-.75-.75V10.5zM15 9.75a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75V10.5a.75.75 0 00-.75-.75H15z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <br>
            </div>
        </main>
    </div>

    <script>
    </script>
    <script src="proses/kasir.js"></script>
    <script src="../sidebar.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>

<main id="struk">
        <span class="header">
            <h3>Mozee Souffle Pancake</h3>
            <span>Jln. Kayu Tangi II</span>
        </span>
        <span class="line"></span>
        <div>
            <section>
                <span>Kasir,</span>
                <span>No. Struk</span>
                <span>Tanggal</span>
            </section>
            <section>
                <span>: <?= $_SESSION['nama'] ?></span>
                <span>: #<?php
                            $row = mysqli_query($conn, "SELECT MAX(id_transaksi) as max_id FROM transaksi")->fetch_assoc();
                            $lastId = $row['max_id'];
                            echo $lastId + 1;
                            ?></span>
                <span id="waktuStruk">: 29-11-2023 21:00:00</span>
            </section>
        </div>
        <span class="line"></span>
        <div>
            <section>
                <h4>Menu</h4>
                <section id="strukDaftarMenu">
                    
                </section>
            </section>
            <section>
                <h4>Qty</h4>
                <section id="strukQty">
                    
                </section>
            </section>
            <section>
                <h4>Satuan</h4>
                <section id="strukSatuan">

                </section>
            </section>
            <section>
                <h4>Total</h4>
                <section id="strukTotal">

                </section>
            </section>
        </div>
        <span class="line"></span>
            <div>
                <section>
                    <h4>Total</h4>
                    <h4>Tunai</h4>
                    <h4>Kembali</h4>
                </section>
                <section>
                    <span>: Rp. <span id="strukSubTotal"></span></span>
                    <span>: Rp. <span id="strukTunai">-</span></span>
                    <span>: Rp. <span id="strukKembali"></span></span>
                </section>
            </div>
        <span class="line"></span>
        <span>Terima kasih, selamat menikmati.</span>
    </main>