<?php
    require_once "../../koneksi.php";
    if(isset($_POST['submit'])){
        $mapel = $_POST['mapel'];
        $query = "INSERT INTO mata_pelajaran (nama_mapel) VALUES ('$mapel')";
        if(mysqli_query($koneksi, $query)){
            header("Location: index.php?status=added");
            exit;
        } else {
            header("Location: index.php?status=failed");
            exit;
        }
    }
    if(isset($_POST['update'])){
        $mapel_id = $_POST['mapel_id'];
        $mapel = $_POST['edit_mapel'];
        $query = "UPDATE mata_pelajaran SET nama_mapel = '$mapel' WHERE mapel_id = '$mapel_id'";
        if(mysqli_query($koneksi, $query)){
            header("Location: index.php?status=updated");
            exit;
        } else {
            header("Location: index.php?status=failed");
            exit;
        }
    }
?>