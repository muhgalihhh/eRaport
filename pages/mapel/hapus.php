<?php
    require_once "../../koneksi.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM mata_pelajaran WHERE mapel_id = '$id'";
        if(mysqli_query($koneksi, $query)){
            echo "<script>alert('Berhasil menghapus mata pelajaran!');</script>";
            header("Location: index.php?status=deleted");
        } else {
            echo "<script>alert('Gagal menghapus mata pelajaran!');</script>";
            header("Location: index.php?status=failed");
        }
    }

?>