<?php

    include("../../../koneksi.php");
    $idBarang = $_POST['id'];
    
    // Hapus gambar sebelumnya
    $gambarSebelum = selectData("SELECT * FROM barang WHERE id = '$idBarang'")['gambar'];
    unlink("../../../gambar/barang/" . $gambarSebelum);

    mysqli_query($conn, "DELETE FROM barang WHERE id = $idBarang");

    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
?>