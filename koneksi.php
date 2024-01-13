<?php
    date_default_timezone_set('Asia/Makassar');
    
    $host = "localhost";
    $user = "root";
    $db = "mozee";
    $pass = "";

    // $host = "sql111.infinityfree.com";
    // $user = "if0_35480514";
    // $db = "if0_35480514_mozee";
    // $pass = "BcOtrrAzxfDMNm";

    // koneksi ke database
    $conn = mysqli_connect($host, $user, $pass, $db);

    // fungsi untuk me-looping seluruh data di tabel
    function loopQuery($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
    
        $data = array(); // Inisialisasi array untuk menampung hasil query
    
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row; // Menambahkan setiap baris ke dalam array
        }
    
        return $data;
    }
    function selectData($query) {
        global $conn;
        $result = mysqli_query($conn, $query);

        return mysqli_fetch_assoc($result);
    }

    function insertData($query) {
        global $conn;   

        mysqli_query($conn, $query);
    }
    function updateData($query) {
        global $conn;
        mysqli_query($conn, $query);
    }

    function convertRupiah($number) {
        // Format the number to have a dot as a thousand separator
        $formattedNumber = number_format($number, 0, ',', '.');

        // Add the "Rp" prefix
        $rupiah = $formattedNumber;
    
        return $rupiah;
    }

?>