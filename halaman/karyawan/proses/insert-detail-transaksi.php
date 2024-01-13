<?php
    $id_transaksi = mysqli_insert_id($conn);

    foreach ($daftarPesanan as $pesanan) {
        $id_barang = $pesanan[0];
        $jumlah = $pesanan[1];
        $subtotal = $pesanan[2];
        insertData("INSERT INTO detail_transaksi VALUES
                ('', $id_transaksi, $id_barang, $jumlah, $subtotal)");
    }
?>