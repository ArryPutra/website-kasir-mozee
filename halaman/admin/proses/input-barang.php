<?php

    include("../../../koneksi.php");

    if(isset($_POST['input-barang'])) {
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];

        $direktori = "../../../gambar/barang/";
        $namaFile = $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'],  $direktori . $namaFile);

        $query = mysqli_query($conn, "INSERT INTO barang VALUES
                                    ('', '$nama', '$harga', '$namaFile')");
    }

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
?>