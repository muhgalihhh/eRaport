<?php
    require_once "../../koneksi.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM kelas WHERE kelas_id = '$id'";
        if(mysqli_query($koneksi, $query)){
            echo "<script>alert('Berhasil menghapus kelas!');</script>";
            header("Location: index.php");
        } else {
            echo "<script>alert('Gagal menghapus kelas!');</script>";
            header("Location: index.php");
        }
    }
?>