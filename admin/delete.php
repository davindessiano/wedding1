<?php
require '../firebase/firebase.php'; // Pastikan path sesuai dengan file firebase.php

// Pastikan ada parameter 'id' yang dikirim lewat URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Menghapus data undangan berdasarkan ID
        $firebase->getReference("undangan/$id")->remove();

        // Redirect kembali ke halaman index setelah berhasil menghapus
        header("Location: ../admin/index.php?status=deleted");
        exit(); // Pastikan tidak ada kode lain yang dieksekusi setelah redirect
    } catch (Exception $e) {
        die("Error: " . $e->getMessage()); // Jika terjadi error
    }
} else {
    die("ID tidak ditemukan."); // Jika tidak ada ID yang dikirimkan
}
?>
