<?php

    include("../../../koneksi.php");

    $idBarang = $_GET['id'];

    $nama = $_POST["nama"];
    $harga = $_POST["harga"];

    updateData("UPDATE barang SET nama = '$nama' WHERE id = '$idBarang'");
    updateData("UPDATE barang SET harga = '$harga' WHERE id = '$idBarang'");
    // Periksa apakah file 'gambar' telah diunggah dan nama sementara tidak null
    if ($_FILES['gambar']['tmp_name'] != null) {
        // Tentukan jalur direktori tempat file yang diunggah akan dipindahkan
        $direktori = "../../../gambar/barang/";
        
        // Dapatkan nama asli dari file yang diunggah
        $namaFile = $_FILES['gambar']['name'];
        
        // Pindahkan file yang diunggah dari lokasi sementara ke direktori yang ditentukan
        move_uploaded_file($_FILES['gambar']['tmp_name'], $direktori . $namaFile);
        
        // Hapus gambar sebelumnya
        $gambarSebelum = selectData("SELECT * FROM barang WHERE id = '$idBarang'")['gambar'];
        unlink($direktori . $gambarSebelum);

        // Perbarui data dalam database dengan mengatur kolom 'gambar' ke nama file yang baru
        // Dengan asumsi $idBarang adalah variabel yang berisi identifikasi untuk rekaman tertentu di tabel 'barang'
        updateData("UPDATE barang SET gambar = '$namaFile' WHERE id = '$idBarang'");
        
    }
    
    echo "<script>alert('Barang berhasil diperbarui!')</script>";
    echo '<script>window.history.go(-2);</script>';
    exit();
?>