<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['role'])) {
    // Jika tidak, redirect ke halaman login
    header("Location: index.php");
    exit;
}

require_once "../../koneksi.php";
require_once "../template/header.php";

// Update data
if (isset($_POST['simpan'])) {
    // Validate and sanitize input data
    $id = $_GET['id'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    // Check if username already exists (excluding the current user)
    $checkUsernameQuery = "SELECT * FROM user WHERE username = ? AND id_user != ?";
    $stmt = $koneksi->prepare($checkUsernameQuery);
    $stmt->bind_param("si", $username, $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Username already exists
        echo "<script>alert('Username sudah ada')</script>";
    } else {
        // Upload file
        $foto = "";
        if (!empty($_FILES['foto']['name'])) {
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $uploadDir = "../../asset/image/";
            $uploadFile = $uploadDir . basename($_FILES['foto']['name']);
            $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

            // Check if the file type is allowed
            if (in_array($imageFileType, $allowedExtensions)) {
                // Check if the file size is less than 1MB
                if ($_FILES['foto']['size'] < 1000000) {
                    $foto = $uploadDir . uniqid() .'-'.$username.'.'  . $imageFileType;
                    move_uploaded_file($_FILES['foto']['tmp_name'], $foto);

                    // Hapus foto lama jika bukan default
                    $queryGetOldFoto = "SELECT foto FROM user WHERE id_user=?";
                    $stmt = $koneksi->prepare($queryGetOldFoto);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $oldFoto = $result->fetch_assoc()['foto'];

                    if (!empty($oldFoto) && !strpos($oldFoto, 'default.jpg')) {
                        unlink($oldFoto);
                    }
                } else {
                    echo "<script>alert('Ukuran file terlalu besar')</script>";
                    $foto = "../../asset/image/default.jpg";
                }
            } else {
                echo "<script>alert('Ekstensi file tidak diizinkan')</script>";
                $foto = "../../asset/image/default.jpg";
            }
        } else {
            // If no file is uploaded, use the existing image path
            $queryGetOldFoto = "SELECT foto FROM user WHERE id_user=?";
            $stmt = $koneksi->prepare($queryGetOldFoto);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $oldFoto = $result->fetch_assoc()['foto'];

            if (!empty($oldFoto) && !strpos($oldFoto, 'default.jpg')) {
                unlink($oldFoto);
            }

            $foto = "../../asset/image/default.jpg";
        }

        // Update data in the database (excluding password)
        $updateQuery = "UPDATE user SET username=?, role=?, foto=? WHERE id_user=?";
        $stmt = $koneksi->prepare($updateQuery);
        $stmt->bind_param("sssi", $username, $role, $foto, $id);

        if ($stmt->execute()) {
            echo "<script>alert('User berhasil diperbarui');window.location.href='index.php?status=success'</script>";
        } else {
            echo "<script>alert('User gagal diperbarui');window.location.href='index.php?status=failed'</script>";
        }
    }
}

// Fetch data user yang akan diupdate
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id'");
    $data = mysqli_fetch_array($query);
} else {
    header("Location: index.php");
}
?>



<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <div class="header">
            <!-- Logo -->
            <div class="header-left">
                <a href="index.html" class="logo">
                    <img src="asset/image/logo.png" width="40" height="40" alt="">
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
                        <span class="user-img"><img src="asset/image/logo.png" alt="">
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
                                <li><a href="chat.html">Siswa</a></li>
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
                            <h3 class="page-title">Edit User</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../../home.php">Input User</a></li>
                                <li class="breadcrumb-item"><a href="index.php">Data User</a></li>
                                <li class="breadcrumb-item active">Edit User</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <!-- Content Starts -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card flex-fill">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="card-title mb-0"> Edit User</h4>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class=" form-group">
                                            <img id="imagePreview" src="<?= $data['foto'] ?>" alt="Preview"
                                                style="max-width: 100%; max-height: 100px; margin-top: 10px;"
                                                class="mb-2 rounded-circle">
                                            <span class="d-block mb-1"><small>Hanya menerima format(JPG,JPEG,PNG), Maks
                                                    1MB, Usahakan width : height</small></span>
                                            <input type="file" name="foto" class="col-6 form-control" id="fotoInput"
                                                onchange="previewImage()">
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" name="username" class="form-control"
                                                value="<?=$data['username'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select name="role" id="role" class="form-control">
                                                <option value="">-- Pilih Role --</option>
                                                <option value="Admin"
                                                    <?php if($data['role'] == 'Admin'){echo "selected";}?>>
                                                    Admin</option>
                                                <option value="Walikelas"
                                                    <?php if($data['role'] == 'Walikelas'){echo "selected";}?>>
                                                    Walikelas</option>
                                                <option value="Siswa"
                                                    <?php if($data['role'] == 'Siswa'){echo "selected";}?>>
                                                    Siswa</option>
                                            </select>
                                        </div>
                                        <input type="submit" class="btn btn-primary" value="Simpan" name="simpan">
                                    </form>
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
        require_once "../template/footer.php"?>