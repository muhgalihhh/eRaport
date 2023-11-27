<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <div class="header">

            <!-- Logo -->
            <div class="header-left">
                <a href="home.php" class="logo">
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
                        <span><?=$_SESSION['role'];?></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/my-profile.php">My Profile</a>
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
                    <a class="dropdown-item" href="/my-profile.php">My Profile</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
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
                                <li><a href="<?=$_SESSION['mainurl']?>">Walikelas Dashboard</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">
                            <span>Akademik</span>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="la la-download"></i> <span> Unduh Nilai Raport</span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="/pages/raport/home.php">Kelas 7</a></li>
                                <li><a href="/pages/raport/home2.php">Kelas 8</a></li>
                                <li><a href="/pages/raport/home3.php">Kelas 9</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Sidebar -->