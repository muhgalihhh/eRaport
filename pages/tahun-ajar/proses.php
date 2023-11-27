<?php
require_once "../../koneksi.php";

if (isset($_POST['submit'])) {
    // Ambil data dari form
    $tahun = $_POST['tahun'];
    $semester = $_POST['semester'];

    // Cek apakah ada data yang belum diisi
    if ($tahun == '' || $semester == '') {
        // Jika ada data yang belum diisi
        echo "<script>alert('Mohon untuk mengisi semua data!');</script>";
        header("Location: tambah.php?status=failed");
    } else {
        // Cek apakah nama tahun dan semester sudah ada dalam database
        $cek_query = "SELECT * FROM tahun_semester WHERE nama_tahun = '$tahun' AND nama_semester = '$semester'";
        $cek_result = mysqli_query($koneksi, $cek_query);

        if (mysqli_num_rows($cek_result) > 0) {
            // Jika sudah ada, tampilkan pesan kesalahan
            echo "<script>alert('Data tahun ajar sudah ada dalam database!');</script>";
            header("Location: index.php?status=failed");
        } else {
            // Jika belum ada, lakukan penambahan data ke database
            $query = "INSERT INTO tahun_semester (nama_tahun, nama_semester) VALUES ('$tahun', '$semester')";
            $result = mysqli_query($koneksi, $query);

            if ($result) {
                echo "<script>alert('Berhasil menambahkan tahun ajar!');</script>";
                header("Location: index.php?status=added");
            } else {
                echo "<script>alert('Gagal menambahkan tahun ajar!');</script>";
                header("Location: index.php?status=failed");
            }
        }
    }
}

if($_POST['update']){
    $id = $_POST['id'];
    $tahun = $_POST['tahun_edit'];
    $semester = $_POST['nama_semester'];

    $query = "UPDATE tahun_semester SET nama_tahun = '$tahun', nama_semester = '$semester' WHERE tahun_semester_id = '$id'";
    $result = mysqli_query($koneksi, $query);

    if($result){
        echo "<script>alert('Berhasil mengubah tahun ajar!');</script>";
        header("Location: index.php?status=updated");
    } else {
        echo "<script>alert('Gagal mengubah tahun ajar!');</script>";
        header("Location: index.php?status=failed");
    }
}
?>