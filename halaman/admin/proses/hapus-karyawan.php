<?php

    include("../../../koneksi.php");
    $usernameKaryawan = $_POST['username'];

    mysqli_query($conn, "DELETE FROM karyawan WHERE username = '$usernameKaryawan'");
                $gambarSebelum = selectData("SELECT * FROM karyawan WHERE username = '$usernameKaryawan'")['gambar'];
    unlink("../../../gambar/karyawan/" . $gambarSebelum);
    header("Location: " . $_SERVER["HTTP_REFERER"]);
?>