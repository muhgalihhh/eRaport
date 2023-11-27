<?php
    session_start();
    if(!isset($_SESSION['role'])){
        header("Location: ../../index.php");
        exit;
    }
    require_once "../../koneksi.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        // Ambil nama file foto sebelum menghapus admin
        $query_select = "SELECT foto FROM admin_profiles WHERE user_id = '$id'";
        $result = mysqli_query($koneksi, $query_select);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $foto_filename = $row['foto'];
        // Hapus foto dari direktori jika file foto ada
        if (!empty($foto_filename) && file_exists("../../asset/image" . $foto_filename)) {
            unlink("../../asset/image" . $foto_filename);
        }
    }
        $query = "DELETE FROM admin_profiles WHERE user_id = '$id'";
        if(mysqli_query($koneksi, $query)){
            echo "<script>alert('Berhasil menghapus admin!');</script>";
            header("Location: index.php?status=deleted");
        } else {
            echo "<script>alert('Gagal menghapus admin!');</script>";
            header("Location: index.php?status=failed");
        }
    }
?>