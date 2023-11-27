<?php
    require_once "../../koneksi.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM tahun_semester WHERE tahun_semester_id = '$id'";
        if(mysqli_query($koneksi, $query)){
            echo "<script>alert('Berhasil menghapus tahun ajar!');</script>";
            header("Location: index.php?status=deleted");
        } else {
            echo "<script>alert('Gagal menghapus tahun ajar!');</script>";
            header("Location: index.php?status=failed");
        }
    }
?>