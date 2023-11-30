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
?>
<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Profile <?=$_SESSION['role']?>, <?=$_SESSION['nama']?>!</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">My Profile</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <!-- Content Starts -->
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-center">
                                <img src="pages/user-admin/<?=$_SESSION['foto']?>" alt="<?=$_SESSION['username']?>"
                                    class="rounded-circle" width="200">
                            </li>
                            <li class="list-group-item">
                                <h3 class="mb-0">Nama</h3>
                                <span><?=$_SESSION['nama']?></span>
                            </li>
                            <li class="list-group-item">
                                <h3 class="mb-0">Role</h3>
                                <span><?=$_SESSION['role']?></span>
                            </li>
                            <?php
                            if($_SESSION['role'] == "walikelas"){?>
                            <li class="list-group-item">
                                <h3 class="mb-0">Mengampu Kelas</h3>
                                <?php
                                    $query = "SELECT kelas.nama_kelas FROM kelas where kelas.kelas_id = ".$_SESSION['kelas_id'];
                                    $result = mysqli_query($koneksi, $query);
                                    $data = mysqli_fetch_assoc($result);
                                ?>
                                <span><?=$data['nama_kelas']?></span>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <?php
                            if($_SESSION['role'] == "admin"){?>
                            <li class="list-group-item">Username : <?=$_SESSION['username']?></li>
                            <li class="list-group-item">Password : *****</li>
                            <li class="list-group-item">
                                <?php
                            } 

                            if($_SESSION ['role'] == 'walikelas'){?>
                            <li class="list-group-item">Username : <?=$_SESSION['username']?></li>
                            <li class="list-group-item">Password : *****</li>
                            <li class="list-group-item">Nama : <?=$_SESSION['nama']?></li>
                            <li class="list-group-item">NIP : <?=$_SESSION['nip']?></li>
                            <li class="list-group-item">kelas : <?=$data['nama_kelas']?></li>
                            <li class="list-group-item">No Telepon : <?=$_SESSION['notelp']?></li>
                            <li class="list-group-item">Jenis Kelamin : <?=$_SESSION['jk']?></li>
                            <li class="list-group-item">Alamat : <?=$_SESSION['alamat']?></li>
                            <?php
                            }
                            if($_SESSION['role'] == 'siswa'){?>
                            <li class="list-group-item">Username : <?=$_SESSION['username']?></li>
                            <li class="list-group-item">Password : *****</li>
                            <li class="list-group-item">Nama : <?=$_SESSION['nama']?></li>
                            <li class="list-group-item">NIS : <?=$_SESSION['NIS']?></li>
                            <li class="list-group-item">kelas : <?=$_SESSION['kelas']?></li>
                            <li class="list-group-item">No Telepon : <?=$_SESSION['notelp']?></li>
                            <li class="list-group-item">Jenis Kelamin : <?=$_SESSION['jk']?></li>
                            <li class="list-group-item">Tempat, Tanggal Lahir : <?=$_SESSION['tempat_lahir']?>,
                                <?=$_SESSION['tanggal_lahir']?></li>
                            <li class="list-group-item">Alamat : <?=$_SESSION['alamat']?></li>
                            <?php
                            }
                            ?>

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