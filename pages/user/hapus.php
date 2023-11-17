<?php
    $koneksi = mysqli_connect("localhost","root","","db_eraport");
    // delete
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM user WHERE id_user = ?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        header("Location: index.php");
        exit();
    }
?>