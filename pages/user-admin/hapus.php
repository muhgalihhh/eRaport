<?php
    require_once "../../koneksi.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM admin_profiles WHERE user_id = '$id'";
        if(mysqli_query($koneksi, $query)){
            echo "<script>alert('Berhasil menghapus admin!');</script>";
            header("Location: index.php");
        } else {
            echo "<script>alert('Gagal menghapus admin!');</script>";
            header("Location: index.php");
        }
    }
?>