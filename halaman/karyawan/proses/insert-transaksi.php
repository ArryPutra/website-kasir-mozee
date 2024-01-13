<?php

    session_start();
    include("../../../koneksi.php");

    $daftarPesanan = json_decode($_POST['daftarPesanan']);

    $waktu = date("Y-m-d H:i:s");
    $jumlahPesanan = $_POST['totalItem'];
    $subTotal = $_POST['subTotal'];
    $inputTunai = $_POST['inputTunai'];
    $kembali = $_POST['kembali'];

    $username_karyawan = $_SESSION['username'];

    insertData("INSERT INTO transaksi VALUES
                ('', '$waktu', $jumlahPesanan, '$subTotal', '$inputTunai', '$kembali', '$username_karyawan')");

    include("./insert-detail-transaksi.php");

?>