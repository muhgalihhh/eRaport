<?php
    require_once "../../koneksi.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM guru WHERE guru_id = '$id'";
        if(mysqli_query($koneksi, $query)){
            echo "<script>alert('Berhasil menghapus guru!');</script>";
            header("Location: index.php?status=deleted");
        } else {
            echo "<script>alert('Gagal menghapus guru!');</script>";
            header("Location: index.php?status=failed");
        }
    }
?>