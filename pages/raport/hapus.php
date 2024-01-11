<?php
include "../../koneksi.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $ujian_id = $_GET['ujian_id_delete'];
    $deleteNilaiUjian = mysqli_query($koneksi, "DELETE FROM nilai_ujian WHERE user_id='$id' and ujian_id='$ujian_id'");
    if($deleteNilaiUjian){
        $deleteUjian= mysqli_query($koneksi, "DELETE FROM ujian WHERE ujian_id='$ujian_id'");
        if($deleteUjian){
            echo "<script>alert('Data berhasil dihapus');window.location.href='index.php?id=$id&status=deleted;</script>";
        }else{
            echo "<script>alert('Data gagal dihapus');window.location.href='index.php?id=$id&status=failed;</script>";
        }
    }else{
        echo "<script>alert('Data gagal dihapus');window.location.href='index.php?id=$id&status=failed;</script>";
    }
}
?>