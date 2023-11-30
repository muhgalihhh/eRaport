<?php
include "../../koneksi.php";
 if(isset($_POST['update'])){
        // menggunakan for each
        foreach($_POST['mapel_id'] as $key => $value){
            $nilai = $_POST['nilai_'.$value];
            $ujian_id = $_POST['ujian_id'];
            $mapel_id = $value;
            $user_id = $_POST['user_id'];
            $sql = "UPDATE nilai_ujian SET nilai = '$nilai' WHERE mapel_id = '$mapel_id' AND user_id = '$user_id' AND ujian_id = '$ujian_id'";
            $result = mysqli_query($koneksi, $sql);
        }
        if($result){
            header("Location: index.php?id=$user_id&status=updated");
            exit();
        } else {
            header("Location: index.php?id=$user_id&status=failed");
            exit();
        }
    }
    ?>