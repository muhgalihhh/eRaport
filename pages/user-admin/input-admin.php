<?php  
    session_start();          
    if(!isset($_SESSION['role'])){
        header("Location: ../../index.php");
        exit;
    }
    $title = "Data Admin - Admin";       
    $msg = "Data Admin";
    require_once '../../koneksi.php';
    require_once '../template/header.php';
    require_once '../template/sidebar.php';
    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repeatpassword = $_POST['repeatpassword'];
        $nama = $_POST['nama'];
        $path_foto = "../../asset/image/default.jpg";
        // Check if there is a file upload
        if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $allowed_extensions = array('jpg', 'jpeg', 'png');
            $foto = $_FILES['foto']['name'];
            $ukuran_foto = $_FILES['foto']['size'];
            $tipe_foto = $_FILES['foto']['type'];
            $tmp_foto = $_FILES['foto']['tmp_name'];
            $path = "../../asset/image/";
            $uniqfilename = "admin_".$username.".".pathinfo($foto, PATHINFO_EXTENSION);
            $path_foto = $path . $uniqfilename;

            // Validation
            if(!in_array(pathinfo($foto, PATHINFO_EXTENSION), $allowed_extensions)) {
                header("Location: input-admin.php?status=failed");
            } else if($ukuran_foto > 1048576) {
                header("Location: input-admin.php?status=failed");
            } else {
                move_uploaded_file($tmp_foto, $path_foto);
            }
        }
        if($password != $repeatpassword) {
            header("Location: input-admin.php?status=failed");
        } else {
            // Check if the username already exists
            $cek_username = "SELECT * FROM users WHERE username = '$username'";
            $query_cek = mysqli_query($koneksi, $cek_username);
            if(mysqli_num_rows($query_cek) > 0) {
                header("Location: input-admin.php?status=failed");
            } else {
                // Process to save to the database
                $hashedpassword = password_hash($password, PASSWORD_DEFAULT); 
                $query_user = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashedpassword', 'admin')";
                $query_profile = "INSERT INTO admin_profiles (user_id, nama, foto) VALUES (LAST_INSERT_ID(), '$nama', '$path_foto')";
                if(mysqli_query($koneksi, $query_user) && mysqli_query($koneksi, $query_profile)) {
                    echo "<script>alert('Berhasil menambahkan admin!');window.location.href='index.php?status=added';</script>";
                } else {
                    echo "<script>alert('Gagal menambahkan admin!');window.location.href='index.php?status=failed';</script>";
                
                }
            }
        }
    }   
    require_once '../template/message.php';
?>
<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">

                <div class="col-sm-12">
                    <h3 class="page-title">Data Admin</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.php">Data Admin</a></li>
                        <li class="breadcrumb-item active">Tambah admin</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Content Starts -->
        <div class="row">
            <div class="col-sm-12">
                <?php
                    if(isset($_GET['status'])) {
                        echo $alert;
                    }
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card flex-fill">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title">Tambah Admin</h5>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                    Simpan</button>
                                <button type="reset" name="Reset" class="btn btn-secondary"><i class="fa fa-times"></i>
                                    Reset</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 d-flex">
                                    <div class="card flex-grow-1 shadow">
                                        <div class="card-header">
                                            <h5>Profile Admin</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group text-center">
                                                <img id="imagePreview" src="../../asset/image/default.jpg" alt="Preview"
                                                    style="max-width: 100%; max-height: 100px; margin-top: 10px;"
                                                    class="mb-2 rounded-circle">
                                                <small class="form-text text-muted">Hanya menerima file gambar JPG,JPEG,
                                                    PNG. Maks 1MB width :
                                                    height</small>
                                                <input type="file" name="foto" id="fotoInput" class="form-control"
                                                    onchange="previewImage()">
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" name="nama" id="nama" required class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div class="card flex-grow-1 shadow">
                                        <div class="card-header">
                                            <h5>Akun Admin</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" name="username" id="username" pattern="[A-Za-z0-9]+"
                                                    required class="form-control">
                                                <small id="validationMessage" class="form-text text-muted">Hanya
                                                    diperbolehkan huruf dan angka, tanpa spasi dan simbol.</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password" required
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Confirm Password</label>
                                                <input type="password" name="repeatpassword" id="repeatpassword"
                                                    required class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /Content End -->
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->
<?php
    require_once '../template/footer.php';