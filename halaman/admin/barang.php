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
    <title>Kelola Barang</title>
    <link rel="stylesheet" href="./../style.css">
    <link rel="stylesheet" href="./../header.css">
    <link rel="stylesheet" href="./../sidebar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
</head>

<style>
table {
    width: 100%;
    border-collapse: collapse;
}
table thead {
    background: #1E1E1E;
    color: white;
    height: 3rem;
}
table tbody tr td:nth-child(1) {
    text-align: center;
}
table tbody tr td {
    padding: 1rem;
}
tr:nth-child(even) {background-color: #f2f2f2;}

.layer {
    background: rgba(0, 0, 0, 0.5);
    width: 100%;
    height: 100vh;
    z-index: 2;
    transition: 150ms;

    display: flex;
    align-items: center;
    justify-content: center;
}
.layer .form {
    background: white;
    border-radius: 12px;
    box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.25);
    padding: 1rem;
    z-index: 3;
}
.form {
    position: fixed;
    transition: 150ms;
    top: 50%;
    right: 50%;
    transform: translate(50%, -50%);
    background: white;
    box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.25);
    z-index: 3;
    padding: 1rem;
    border-radius: 12px;
    width: 500px;
}

.form .header {
    display: flex;
    width: 100%;
    justify-content: space-between;
}
.form .header button {
    width: 30px;
    height: 30px;
    background: #FEDDCA;
    color: red;
    border: none;
    border-radius: 8px;
    padding: 4px;
    cursor: pointer;
}

.input-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-bottom: 1rem;
}
.input-group input {
    padding: 10px;
    border-radius: 6px;
    border: none;
    background: #f2f2f2;
}
.input-group input:focus {
    outline: #009dff 2px solid;
    caret-color: #009dff;
}
.submit-btn {
    background: #009dff;
    border: none;
    width: 100%;
    padding: 10px;
    font-weight: bold;
    color: white;
    border-radius: 8px;
    cursor: pointer;
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
        <a href="barang.php" class="menu-active">
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
            <img src="../../gambar/logo.png" width="65px">
            <div class="profile">
                <h4>Admin, <?= $_SESSION['nama'] ?></h4>
                <img src="../../gambar/admin/profile.jpg" style="height: 3.5rem; width: 3.5rem; object-fit: cover;">
            </div>
        </main>
    </header>

    <div class="layout">
        <main class="container-layout">
            <h1>Kelola Menu</h1>

            <br>

            <button onclick="tambahBarangBtn()" class="red-btn" style="width: fit-content; padding: 0 1rem; margin-bottom: 1rem;">Tambah Barang</button>
            <div style="display: flex; width: 100%; justify-content: space-between; align-items: center; margin-bottom: 1rem; flex-wrap: wrap-reverse; gap: 1rem;">
                <h3>Jumlah Menu: <?= count(loopQuery("SELECT * FROM barang")) ?></h3>
                <div style=" display: flex; gap: 0.5rem; height: 35px;">
                    <form style="display: flex; gap: 0.5rem; height: 35px;" action="">
                        <input class="search" name="cari" type="search" placeholder="Cari Barang">
                        <button type="submit" class="blue-btn">
                            <svg style="width: 1.25rem;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                              <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                    <?php if(isset($_GET['cari'])) : ?>
                    <form action="./barang.php">
                        <button class="red-btn">
                            Reset
                        </button>
                    </form>
                    <?php endif ; ?>
                </div>
            </div>
            <main style="overflow-x: auto; margin-top: 0.5rem;">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $queryBarang = "SELECT * FROM barang";
                        if(isset($_GET['cari'])) {
                            $queryBarang = "SELECT * FROM barang WHERE nama LIKE '%$_GET[cari]%'";
                        }
                        ?>
                        <?php $count = 1; foreach(loopQuery("$queryBarang") as $barang) : ?>
                        <tr>
                            <td><?= $count++ ?></td>
                            <td><span style="font-weight: bold;"><?= $barang['nama'] ?></span></td>
                            <td style="white-space: nowrap;">Rp. <?= convertRupiah($barang['harga']) ?></td>
                            <td><img height="100px" width="100px" style="object-fit: cover; border-radius: 8px;" src="../../gambar/barang/<?= $barang['gambar'] ?>" alt=""></td>
                            <td style="display: flex; gap: 1rem;
                            justify-content: end; 
                            align-items: center; 
                            height: 3.5rem;">
                                <a href="?id=<?= $barang['id'] ?>" class="blue-btn" style="width: fit-content;">
                                    Edit
                                    <svg style="width: 1rem;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </a>
                                <form action="proses/hapus-barang.php" method="post">
                                    <button
                                    onclick="return confirm('Yakin hapus barang <?= $barang['nama'] ?>?')"
                                    name="id" value="<?= $barang['id'] ?>"
                                    class="red-btn" style="font-size: 16px;">
                                        Hapus
                                        <svg style="width: 1rem;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach ; ?>
                    </tbody>
                </table>
            </main>
        </main>
    </div>

    <div onclick="layerTap()" id="layer" class="" style="position: fixed; opacity: 0;"></div>
    <form class="form" style="display: none;" action="proses/input-barang.php" method="post" enctype="multipart/form-data">
        <div class="header">
            <h2>Buat Barang</h2>
            <button onclick="layerTap()" >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            </button>
        </div>
        <br>
        <div class="input-group">
            <label for="gambar">Gambar Barang</label>
            <img height="100px" width="100px" style="object-fit: cover; border-radius: 8px; display: none;" id="preview">
            <input type="file" name="gambar" id="gambar" required onchange="previewImage(this);">
        </div>
        <div class="input-group">
            <label for="nama">Nama Barang</label>
            <input type="text" name="nama" id="nama" required>
        </div>
        <div class="input-group">
            <label for="harga">Harga</label>
            <input type="text" name="harga" id="harga" required>
        </div>
        <button type="submit" name="input-barang" class="submit-btn">Buat Barang</button>
    </form>

    <?php if(isset($_GET['id'])) : ?>
        <div onclick="window.history.back()" class="layer" style="position: fixed;"></div>
        <form class="form" action="proses/edit-barang.php?id=<?= $_GET['id']; ?>" method="post" enctype="multipart/form-data">
            <div class="header">
                <h2>Edit Barang</h2>
                <button type="button" onclick="window.history.back()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="divider"></div>
            <br>
            <div class="input-group">
                <label for="gambar">Gambar Barang</label>
                <img height="100px" width="100px" style="object-fit: cover; border-radius: 8px;" src="../../gambar/barang/<?= selectData("SELECT * FROM barang WHERE id = '$_GET[id]'")['gambar'] ?>" id="preview">
                <input value="<?= selectData("SELECT * FROM barang WHERE id = '$_GET[id]'")['gambar'] ?>" type="file" name="gambar" id="gambar" onchange="previewImage(this);">
            </div>
            <div class="input-group">
                <label for="nama">Nama Barang</label>
                <input value="<?= selectData("SELECT * FROM barang WHERE id = '$_GET[id]'")['nama'] ?>" type="text" name="nama" id="nama" required>
            </div>
            <div class="input-group">
                <label for="harga">Harga</label>
                <input value="<?= selectData("SELECT * FROM barang WHERE id = '$_GET[id]'")['harga'] ?>" type="text" name="harga" id="harga" required>
            </div>
            <button type="submit" name="edit-barang" class="submit-btn">Edit Barang</button>
        </form>
    <?php endif ; ?>
    
    <script src="../sidebar.js"></script>
    <script>
        const layer =document.getElementById('layer')
        const form =document.querySelector('.form')
        function tambahBarangBtn() {
            layer.classList.add('layer')
            form.style.display = 'block'
            layer.style.opacity = '1'
        }
        function layerTap() {
            layer.classList.remove('layer')
            layer.style.opacity = '0'
            form.style.display = 'none'
        }

        // Fungsi untuk menampilkan pratinjau gambar sebelum diunggah
        function previewImage(input) {
        // Dapatkan elemen gambar pratinjau dari elemen parent input
        var preview = input.parentElement.children[1];
        // Setel tampilan gambar pratinjau menjadi terlihat (display: block)
        preview.style.display = "block";
        // Buat objek FileReader untuk membaca konten file
        var reader = new FileReader();
        // Atur fungsi yang akan dijalankan ketika proses pembacaan file selesai
        reader.onload = function (e) {
            // Setel sumber gambar pratinjau dengan hasil pembacaan file
            preview.src = e.target.result;
        };
        // Baca konten file sebagai URL data (data URL)
        reader.readAsDataURL(input.files[0]);
        }

    </script>

</body>
</html>