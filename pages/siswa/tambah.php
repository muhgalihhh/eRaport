<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['role'])) {
    // Jika tidak, redirect ke halaman login
    header("Location: index.php");
    exit;
}
$title = "Tambah Siswa - Admin";

require_once "../../koneksi.php";
require_once "../template/header.php";

// Use prepared statements to prevent SQL injection


?>

<!-- The rest of your HTML code goes here -->


<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <div class="header">

            <!-- Logo -->
            <div class="header-left">
                <a href="index.html" class="logo">
                    <img src="<?=$_SESSION['foto']?>" width="40" height="40" alt="" class="rounded-circle shadow">
                </a>
            </div>
            <!-- /Logo -->

            <a id="toggle_btn" href="javascript:void(0);">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

            <!-- Header Title -->
            <div class="page-title-box">
                <h3>Admin - SMK N 01 XXXXXXXXXXXXX</h3>
            </div>
            <!-- /Header Title -->

            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

            <!-- Header Menu -->
            <ul class="nav user-menu">

                <!-- Search -->
                <li class="nav-item">
                    <div class="top-nav-search">
                        <a href="javascript:void(0);" class="responsive-search">
                            <i class="fa fa-search"></i>
                        </a>
                        <form action="search.html">
                            <input class="form-control" type="text" placeholder="Search here">
                            <button class="btn" type="submit" name="simpan"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </li>
                <!-- /Search -->



                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img"><img src="<?=$_SESSION['foto']?>" alt="">
                            <span class="status online"></span>
                        </span>
                        <span><?=$_SESSION['role'];?></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="profile.html">My Profile</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
            <!-- /Header Menu -->

            <!-- Mobile Menu -->
            <div class="dropdown mobile-user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </div>
            <!-- /Mobile Menu -->
        </div>
        <!-- /Header -->

        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">
                            <span>Main</span>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="la la-dashboard"></i> <span> Dashboard</span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="home.php">Admin Dashboard</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="la la-edit"></i> <span> Input Data Master</span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="index.php">Siswa</a></li>
                                <li><a href="events.html">Guru</a></li>
                                <li><a href="inbox.html">Kelas</a></li>
                                <li><a href="file-manager.html">Mata Pelajaran</a></li>
                                <li><a href="file-manager.html">Tahun ajar</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">
                            <span>Akademik</span>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="la la-book"></i> <span> Nilai Raport</span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="projects.html">Kelas 10</a></li>
                                <li><a href="projects.html">Kelas 11</a></li>
                                <li><a href="projects.html">Kelas 12</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">
                            <span>Pengguna</span>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="la la-user"></i> <span> User </span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="index.php">Input User</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Sidebar -->

        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <!-- Page Content -->
            <div class="content container-fluid">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Tambah Siswa</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../../home.php">Input Siswa</a></li>
                                <li class="breadcrumb-item"><a href="index.php">Data Siswa</a></li>
                                <li class="breadcrumb-item active">Tambah Siswa</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <!-- Content Starts -->

                <div class="card flex-fill">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title mb-0"> Tambah Siswa</h4>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <button type="submit" class="btn btn-primary" name="simpan"><i
                                        class="fa-solid fa-floppy-disk"></i> Simpan</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group text-center">
                                                <img id="imagePreview" src="../../asset/image/default.jpg" alt="Preview"
                                                    style="max-width: 100%; max-height: 100px; margin-top: 10px;"
                                                    class="mb-2 rounded-circle">
                                                <span class="d-block mb-1"><small>Hanya menerima format(JPG,JPEG,PNG),
                                                        Maks
                                                        1MB, Usahakan width : height</small></span>
                                                <input type="file" name="foto" class="form-control" id="fotoInput"
                                                    onchange="previewImage()">
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" name="nama" class="form-control" id="nama"
                                                    placeholder="Masukkan Nama" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nis">NIS</label>
                                                <input type="text" name="nis" class="form-control" id="nis"
                                                    placeholder="Masukkan NIS" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jk">Jenis kelamin</label>
                                                <input type="text" name="jk" class="form-control" id="jk"
                                                    placeholder="Masukkan Jenis kelamin" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="kelas">Kelas</label>
                                                <select name="kelas" class="form-control" id="kelas" required>
                                                    <option value="">Pilih Kelas</option>
                                                    <option value="X">X</option>
                                                    <option value="XI">XI</option>
                                                    <option value="XII">XII</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <textarea name="alamat" class="form-control" id="alamat" required
                                                    placeholder="Masukkan Alamat" rows="5"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="no_telp">No Telepon</label>
                                                <input type="text" name="no_telp" class="form-control" id="no_telp"
                                                    placeholder="Masukkan No Telepon" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
        require_once "../template/footer.php"?>