<?php

    include("../../../koneksi.php");

    if(isset($_POST['input-karyawan'])) {
        $username = $_POST['username'];
        $nama = $_POST['nama'];
        $jenisKelamin = $_POST['jenis_kelamin'];
        $tanggalLahir = $_POST['tanggal_lahir'];
        $nomorHp = $_POST['nomor_hp'];
        $password = $_POST['password'];

        $direktori = "../../../gambar/karyawan/";
        $namaFile = $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'],  $direktori . $namaFile);

        $query = mysqli_query($conn, "INSERT INTO karyawan VALUES
                                    ('$username', '$nama', '$namaFile', '$jenisKelamin', '$tanggalLahir', '$nomorHp', '$password')");
    }

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
?>