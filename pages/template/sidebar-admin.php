<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <div class="header">

            <!-- Logo -->
            <div class="header-left">
                <a href="../../<?=$_SESSION['mainurl']?>" class="logo">
                    <img src="<?=$_SESSION['foto']?>" width="40" height="40" alt="" class="rounded-circle shadow-lg">
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
            <?php
        $query = "SELECT nama_sekolah FROM sekolah";
        $result = mysqli_query($koneksi, $query);
        $data = mysqli_fetch_assoc($result);
        ?>
            <!-- Header Title -->
            <div class="page-title-box">
                <h3><?=$data['nama_sekolah']?></h3>
            </div>
            <!-- /Header Title -->

            <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

            <!-- Header Menu -->
            <ul class="nav user-menu">
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img"><img src="<?=$_SESSION['foto']?>" alt="">
                            <span class="status online"></span>
                        </span>
                        <span>Admin</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?=$mainUrl?>my-profile.php">My Profile</a>
                        <a class="dropdown-item" href="<?=$mainUrl?>logout.php">Logout</a>
                    </div>
                </li>
            </ul>
            <!-- /Header Menu -->

            <!-- Mobile Menu -->
            <div class="dropdown mobile-user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="<?=$mainUrl?>my-profile.php">My Profile</a>
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
                                <li><a href="<?=$mainUrl?><?=$_SESSION['mainurl']?>">Admin Dashboard</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="la la-edit"></i> <span> Input Data Master</span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="<?=$mainUrl?>pages/guru/index.php">Guru</a></li>
                                <li><a href="<?=$mainUrl?>pages/kelas/index.php">Kelas</a></li>
                                <li><a href="<?=$mainUrl?>pages/mapel/index.php">Mata Pelajaran</a></li>
                                <li><a href="<?=$mainUrl?>pages/tahun-ajar/index.php">Tahun ajar/Semester</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">
                            <span>Akademik</span>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="la la-book"></i> <span> Nilai Raport</span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="<?=$mainUrl?>pages/raport/home.php">Kelas 7</a></li>
                                <li><a href="<?=$mainUrl?>pages/raport/home2.php">Kelas 8</a></li>
                                <li><a href="<?=$mainUrl?>pages/raport/home3.php">Kelas 9</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">
                            <span>User</span>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="la la-user"></i> <span> User </span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="<?=$mainUrl?>pages/user-admin/">Input Admin</a></li>
                                <li><a href="<?=$mainUrl?>pages/user-siswa/">Input Siswa</a></li>
                                <li><a href="<?=$mainUrl?>pages/user-walikelas/">Input Walikelas</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Sidebar -->