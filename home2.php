<?php
    session_start();
    require_once "koneksi.php";
    echo "login berhasil, selamat datang ".$_SESSION['username'];?>