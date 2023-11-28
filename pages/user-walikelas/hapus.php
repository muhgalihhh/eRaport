<?php
    require_once "../../koneksi.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM walikelas_profiles WHERE user_id = '$id'";
        if(mysqli_query($koneksi, $query)){
            echo "<script>alert('Berhasil menghapus wali kelas!');</script>";
            header("Location: index.php?status=deleted");
        } else {
            echo "<script>alert('Gagal menghapus wali kelas!');</script>";
            header("Location: index.php?status=failed");
        }
    }
?>