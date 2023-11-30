<?php
    session_start();
    // Periksa apakah pengguna sudah login
    if (!isset($_SESSION['role'])) {
        // Jika tidak, redirect ke halaman login
        header("Location: index.php");
    }
    $title = "Dashboard - Admin";
    require_once "koneksi.php";
    require_once "./template/header.php";
    require_once "./template/sidebar.php";
    $queryJumlahSiswa = "SELECT COUNT(*) AS jumlah_siswa FROM siswa_profiles"; 
    $queryJumlahGuru = "SELECT COUNT(*) AS jumlah_guru FROM guru";
    $queryJumlahKelas = "SELECT COUNT(*) AS jumlah_kelas FROM kelas";
    $queryJumlahAdmin = "SELECT COUNT(*) AS jumlah_admin FROM admin_profiles";
    // Jalankan query
    $resultJumlahSiswa = mysqli_query($koneksi, $queryJumlahSiswa);
    $resultJumlahGuru = mysqli_query($koneksi, $queryJumlahGuru);
    $resultJumlahKelas = mysqli_query($koneksi, $queryJumlahKelas);
    $resultJumlahAdmin = mysqli_query($koneksi, $queryJumlahAdmin);
    // Ambil data dari hasil eksekusi query
    $dataJumlahSiswa = mysqli_fetch_assoc($resultJumlahSiswa);
    $dataJumlahGuru = mysqli_fetch_assoc($resultJumlahGuru);
    $dataJumlahKelas = mysqli_fetch_assoc($resultJumlahKelas);
    $dataJumlahAdmin = mysqli_fetch_assoc($resultJumlahAdmin);
?>
<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Welcome <?=$_SESSION['role']?>, <?=$_SESSION['nama']?>!</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-users"></i></span>
                        <div class="dash-widget-info">
                            <h3><?=$dataJumlahSiswa['jumlah_siswa']?></h3>
                            <span>Siswa</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon">
                            <i class="fa fa-user-tie"></i>
                        </span>
                        <div class="dash-widget-info">
                            <h3><?=$dataJumlahGuru['jumlah_guru']?></h3>
                            <span>Guru</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-school"></i></span>
                        <div class="dash-widget-info">
                            <h3><?=$dataJumlahKelas['jumlah_kelas']?></h3>
                            <span>Kelas</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                        <div class="dash-widget-info">
                            <h3><?=$dataJumlahAdmin['jumlah_admin']?></h3>
                            <span>Admin</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Starts -->
        <?php
        $query = "SELECT * FROM sekolah";
        $result = mysqli_query($koneksi, $query);
        $data = mysqli_fetch_assoc($result);
        ?>
        <div class="row">
            <div class="col-lg-8 d-flex">
                <div class="card flex-fill">
                    <img alt="" src="<?=$data['gambar']?>" class="card-img-top">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0"><?=$data['nama_sekolah']?></h5>
                        <a class="btn btn-primary" href="edit-home.php?<?=$data['sekolah_id']?>">Edit Profile</a>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">NPSN : <?=$data['npsn']?></li>
                        <li class="list-group-item">Kepala sekolah : <?=$data['kepala_sekolah']?></li>
                        <li class="list-group-item">Jenjang pendidikan : <?=$data['jenjang']?></li>
                        <li class="list-group-item">Tahun Berdiri : <?=$data['tahun_berdiri']?></li>
                        <li class="list-group-item">Status : <?=$data['status']?></li>
                        <li class="list-group-item">Akreditas : <?=$data['akreditasi']?></li>
                        <li class="list-group-item">Alamat Sekolah : <?=$data['alamat_sekolah']?></li>
                        <li class="list-group-item">Telepon Sekolah : <?=$data['telepon_sekolah']?></li>
                        <li class="list-group-item">Email Sekolah : <?=$data['email_sekolah']?></li>
                        <li class="list-group-item">Website Sekolah : <a href="<?=$data['website_sekolah']?>"
                                alt="web sekolah" target="_blank"><?=$data['website_sekolah']?></a> </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title text-center mb-0">Keterangan User</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group-flush text-center mt-auto">
                            <li class="list-group-item"><img src="pages/user-admin/<?=$_SESSION['foto']?>" alt=""
                                    class="rounded-circle shadow-sm" width="100%"></li>
                            <li class="list-group-item"><?=$_SESSION['nama']?></li>
                            <li class="list-group-item"><?=$_SESSION['role']?></li>
                            <li class="list-group-item"><a class="btn btn-primary"
                                    href="<?=$mainUrl?>my-profile.php">Lebih
                                    Detail</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Content End -->

    </div>
    <!-- /Page Content -->

</div>
<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<?php
        require_once "./template/footer.php"?>