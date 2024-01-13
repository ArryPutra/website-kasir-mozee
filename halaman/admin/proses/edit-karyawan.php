<?php

    include("../../../koneksi.php");

    $username = $_GET['username'];

    $nama = $_POST['nama'];
    $jenisKelamin = $_POST['jenis_kelamin'];
    $tanggalLahir = $_POST['tanggal_lahir'];
    $nomorHp = $_POST['nomor_hp'];
    $password = $_POST['password'];

    updateData("UPDATE karyawan SET nama = '$nama' WHERE username = '$username'");
    updateData("UPDATE karyawan SET jenis_kelamin = '$jenisKelamin' WHERE username = '$username'");
    updateData("UPDATE karyawan SET tanggal_lahir = '$tanggalLahir' WHERE username = '$username'");
    updateData("UPDATE karyawan SET nomor_hp = '$nomorHp' WHERE username = '$username'");
    updateData("UPDATE karyawan SET password = '$password' WHERE username = '$username'");
    // Periksa apakah file 'gambar' telah diunggah dan nama sementara username null
    if ($_FILES['gambar']['tmp_name'] != null) {
        // Tentukan jalur direktori tempat file yang diunggah akan dipindahkan
        $direktori = "../../../gambar/karyawan/";
        
        // Dapatkan nama asli dari file yang diunggah
        $namaFile = $_FILES['gambar']['name'];
        
        // Pindahkan file yang diunggah dari lokasi sementara ke direktori yang ditentukan
        move_uploaded_file($_FILES['gambar']['tmp_name'], $direktori . $namaFile);
        
        // Hapus gambar sebelumnya
        $gambarSebelum = selectData("SELECT * FROM karyawan WHERE username = '$username'")['gambar'];
        unlink($direktori . $gambarSebelum);

        // Perbarui data dalam database dengan mengatur kolom 'gambar' ke nama file yang baru
        // Dengan asumsi $username adalah variabel yang berisi usernameentifikasi untuk rekaman tertentu di tabel 'karyawan'
        updateData("UPDATE karyawan SET gambar = '$namaFile' WHERE username = '$username'");
        
    }
    
    echo "<script>alert('karyawan berhasil diperbarui!')</script>";
    echo '<script>window.history.go(-2);</script>';
    exit();
?>