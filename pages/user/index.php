<?php
    session_start();
    // Periksa apakah pengguna sudah login
    if (!isset($_SESSION['role'])) {
        // Jika tidak, redirect ke halaman login
        header("Location: ../../index.php");
        exit;
    }
    require_once "../../koneksi.php";
    require_once "../template/header.php"
    
?>

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <div class="header">

            <!-- Logo -->
            <div class="header-left">
                <a href="<?=$mainUrl?>/home.php" class="logo">
                    <img src="<?=$_SESSION['foto']?>" class="rounded-circle shadow" width="40" height="40"
                        alt="<?=$_SESSION['username']?>">
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
                            <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </li>
                <!-- /Search -->
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img"><img src="<?=$_SESSION['foto'];?>" alt="">
                            <span class="status online"></span>
                        </span>
                        <span><?=$_SESSION['role'];?></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="profile.html">My Profile</a>
                        <a class="dropdown-item" href="../../logout.php">Logout</a>
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
                    <a class="dropdown-item" href="../../logout.php">Logout</a>
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
                                <li><a href="../../home.php">Admin Dashboard</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="la la-edit"></i> <span> Input Data Master</span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="../siswa/">Siswa</a></li>
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
                            <h3 class="page-title">Data User</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../../home.php">Input Data Master</a></li>
                                <li class="breadcrumb-item active">Data User</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <!-- Content Starts -->
                <div class="row">
                    <div class="col-12">
                        <div class="card flex-fill">
                            <div class="card-header d-flex justify-content-between">
                                <h5 class="card-title">Data User</h5>
                                <a class="btn btn-primary" href="tambah.php"><i class="fa fa-plus"></i> Tambah User</a>
                            </div>
                            <div class="card-body">
                                <input type="text" id="searchInput" placeholder="Search..."
                                    class="form-control col-6 mb-2">
                                <div class="table-responsive">
                                    <table class="datatable table table-stripped mb-0">
                                        <div class="table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Foto</th>
                                                    <th>Username</th>
                                                    <th>Password</th>
                                                    <th>Role</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Foto</th>
                                                    <th>Username</th>
                                                    <th>Password</th>
                                                    <th>Role</th>
                                                    <th>Aksi</th>

                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $sql = "SELECT * FROM user";
                                                $result = mysqli_query($koneksi, $sql);
                                                while ($data = mysqli_fetch_array($result)) :
                                            ?>
                                                <tr>
                                                    <td><?=$no++?></td>
                                                    <td class="text-center">
                                                        <img src="<?=$data['foto']?>" alt="<?=$data['username']?>"
                                                            class="avatar-sm rounded-circle" width="30px">
                                                    </td>
                                                    <td><?=$data['username']?></td>
                                                    <td class="text-wrap" style="max-width:20px;">
                                                        <?=$data['password']?>
                                                    </td>
                                                    <td><?=$data['role']?></td>
                                                    <td class="text-center">
                                                        <a href="edit.php?id=<?=$data['id_user']?>"
                                                            class="btn btn-warning btn-sm"><i
                                                                class="fa fa-edit"></i></a>
                                                        <a onclick="return confirmDelete()"
                                                            href="hapus.php?id=<?=$data['id_user']?>"
                                                            class="btn btn-danger btn-sm"><i
                                                                class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <?php endwhile;?>
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Content End -->


    <!-- /Page Content -->


    <!-- /Page Wrapper -->


    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <?php
        require_once "../template/footer.php";