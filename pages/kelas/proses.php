<?php
    require_once "../../koneksi.php";
    if(isset($_POST['submit'])){
        $kelas = $_POST['kelas'];
        $huruf = $_POST['huruf'];
        $nama_kelas = $kelas." ".$huruf;
        // cek nama kelas sudah ada atau belum
        $cek_kelas = "SELECT * FROM kelas WHERE nama_kelas = '$nama_kelas'";
        $query_cek = mysqli_query($koneksi, $cek_kelas);
        if(mysqli_num_rows($query_cek) > 0){
            echo "<script>alert('Kelas sudah ada!');</script>";
            header("Location: index.php");
        } else {
            $query = "INSERT INTO kelas (nama_kelas) VALUES ('$nama_kelas')";
            if(mysqli_query($koneksi, $query)){
                header("Location: index.php?status=added");
            } else {
                header("Location: index.php?status=failed");
            }
        }
    }
    if(isset($_POST['update'])){
        $kelas_id = $_POST['kelas_id'];
        $edit_kelas = $_POST['edit_kelas'];
        $edit_huruf = $_POST['edit_huruf'];
        $edit_nama_kelas = $edit_kelas." ".$edit_huruf;
        $query = "UPDATE kelas SET nama_kelas = '$edit_nama_kelas' WHERE kelas_id = '$kelas_id'";
        if(mysqli_query($koneksi, $query)){
            header("Location: index.php?status=updated");
        } else {
            header("Location: index.php?status=failed");
        }
    }
?>