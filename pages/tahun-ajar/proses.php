<?php
    require_once "../../koneksi.php";   
    if(isset($_POST['submit'])) {
    // Ambil data dari form
    $tahun = $_POST['tahun'];
    $semester = $_POST['semester'];

    // Cek apakah tahun semester sudah ada di tabel
    $queryCheckTahun = "SELECT tahun_semester_id FROM tahun_semester WHERE nama_tahun = '$tahun'";
    $resultCheckTahun = $koneksi->query($queryCheckTahun);

    if ($resultCheckTahun->num_rows > 0) {
        // Tahun semester sudah ada, ambil ID
        $row = $resultCheckTahun->fetch_assoc();
        $tahun_semester_id = $row['tahun_semester_id'];
    } else {
        // Tahun semester belum ada, tambahkan ke tabel
        $queryInsertTahun = "INSERT INTO tahun_semester (nama_tahun) VALUES ('$tahun')";
        $koneksi->query($queryInsertTahun);
        // Ambil ID tahun semester yang baru ditambahkan
        $tahun_semester_id = $koneksi->insert_id;
    }
    // Tambahkan data ke tabel semester
    $queryInsertSemester = "INSERT INTO semester (nama_semester, tahun_semester_id) VALUES ('$semester', '$tahun_semester_id')";
    if ($koneksi->query($queryInsertSemester) === TRUE) {
        echo "<script>alert('Berhasil menambahkan tahun ajar!');window.location.href='index.php?status=added';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan tahun ajar!');window.location.href='index.php?status=failed';</script>";
    }
}
?>