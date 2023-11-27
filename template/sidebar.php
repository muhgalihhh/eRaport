<?php
    require_once "koneksi.php";
    if($_SESSION['role'] == 'admin'){
        require_once "sidebar-admin.php";
    }else if($_SESSION['role'] == 'walikelas'){
        require_once "sidebar-walikelas.php";
    }else if($_SESSION['role'] == 'siswa'){
        require_once "sidebar-siswa.php";
    }else{
        header("Location: index.php?status=failed3");
        exit();
    }
?>