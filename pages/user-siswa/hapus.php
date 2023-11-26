<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../../index.php");
    exit;
}

require_once '../../koneksi.php';

// Pastikan parameter id ada dan merupakan angka
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = $_GET['id'];

    // Query untuk menghapus data dari tabel siswa_profiles
    $query_delete_siswa = "DELETE FROM siswa_profiles WHERE user_id = $user_id";
    $result_delete_siswa = mysqli_query($koneksi, $query_delete_siswa);

    // Query untuk menghapus data dari tabel users
    $query_delete_user = "DELETE FROM users WHERE user_id = $user_id";
    $result_delete_user = mysqli_query($koneksi, $query_delete_user);

    if ($result_delete_siswa && $result_delete_user) {
        // Redirect kembali ke halaman data siswa jika berhasil dihapus
        header("Location: index.php");
        exit;
    } else {
        // Tampilkan pesan error jika terjadi masalah
        echo "Gagal menghapus data siswa.";
    }
} else {
    // Redirect ke halaman data siswa jika parameter id tidak ditemukan atau tidak valid
    header("Location: index.php");
    exit;
}
?>