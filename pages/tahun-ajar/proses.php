<?php
    require_once "../../koneksi.php";   
    if(isset($_POST['submit'])){
        $tahunajar = $_POST['tahun'];
        $semester = $_POST['semester'];
        $query = "INSERT INTO tahun_semester (nama_tahun, nama_semester) VALUES ('$tahunajar', '$semester')";
        if(mysqli_query($koneksi, $query)){
            header("Location: index.php?status=added");
            exit;
        } else {
            header("Location: index.php?status=failed");
            exit;
        }
    }
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $tahunajar = $_POST['tahun_edit'];
        $semester = $_POST['nama_semester'];
        $query = "UPDATE tahun_semester SET nama_tahun = '$tahunajar', nama_semester = '$semester' WHERE tahun_semester_id = '$id'";
        if(mysqli_query($koneksi, $query)){
            header("Location: index.php?status=updated");
            exit;
        } else {
            header("Location: index.php?status=failed");
            exit;
        }
    }

?>