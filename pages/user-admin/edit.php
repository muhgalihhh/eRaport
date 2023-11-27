<?php         
    session_start();   
    if(!isset($_SESSION['role'])){
        header("Location: ../../index.php");
        exit;
    }       
    $title = "Edit Admin - Admin";
    require_once '../../koneksi.php';
    require_once '../template/header.php';
    require_once '../template/sidebar.php';
   if(isset($_GET['id'])){
    $user_id = $_GET['id'];
    $query = "SELECT users.user_id, admin_profiles.foto, users.username, users.password, admin_profiles.nama
            FROM users
            INNER JOIN admin_profiles ON users.user_id = admin_profiles.user_id
            WHERE users.user_id = '$user_id'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_array($result);
    }
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $nama = $_POST['nama'];
        $path_foto = $row['foto'];
        // Check if there is a file upload
        if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $allowed_extensions = array('jpg', 'jpeg', 'png');
            $foto = $_FILES['foto']['name'];
            $ukuran_foto = $_FILES['foto']['size'];
            $tipe_foto = $_FILES['foto']['type'];
            $tmp_foto = $_FILES['foto']['tmp_name'];
            $path = "../../asset/image/";
            $uniqfilename ="admin_".$username.".".pathinfo($foto, PATHINFO_EXTENSION);
            $path_foto = $path . $uniqfilename;
            // Validation
            if(!in_array(pathinfo($foto, PATHINFO_EXTENSION), $allowed_extensions)) {
                echo "<script>alert('Format gambar tidak sesuai!');</script>";
                header("Location: edit.php?id=".$user_id);
            } else if($ukuran_foto > 1048576) {
                echo "<script>alert('Ukuran gambar terlalu besar!');</script>";
                header("Location: edit.php?id=".$user_id);
            } else {
                unlink($row['foto']);
                move_uploaded_file($tmp_foto, $path_foto);
            }
        }
        if($password != $repeatpassword) {
            echo "<script>alert('Password tidak sama!');</script>";
            header("Location: edit.php?id=".$user_id);
        } else {
            // Check if the username already exists
            $cek_username = "SELECT * FROM users WHERE username = '$username' AND user_id != '$user_id'";
            $query_cek = mysqli_query($koneksi, $cek_username);
            if(mysqli_num_rows($query_cek) > 0) {
                echo "<script>alert('Username sudah digunakan!');</script>";
                header("Location: edit.php?id=".$user_id);
            } else {
                // Process to save to the database
                $query_user = "UPDATE users SET username = '$username'WHERE user_id = '$user_id'";
                $query_profile = "UPDATE admin_profiles SET nama = '$nama', foto = '$path_foto' WHERE user_id = '$user_id'";
                if(mysqli_query($koneksi, $query_user) && mysqli_query($koneksi, $query_profile)) {
                    echo "<script>alert('Berhasil mengubah admin!');</script>";
                    header("Location: index.php?status=updated");
                } else {
                    echo "<script>alert('Gagal mengubah admin!');</script>";
                    header("Location: edit.php?id=".$user_id);
                }
        
    }
}
}
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
                        <li class="breadcrumb-item"><a href="../../home.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.php">Data Admin</a></li>
                        <li class="breadcrumb-item active">Edit admin</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <!-- Content Starts -->
        <div class="row">
            <div class="col-sm-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card flex-fill">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title">Edit Admin</h5>
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
                                                <img id="imagePreview" src="<?=$row['foto']?>" alt="Preview"
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
                                                <input type="text" name="nama" id="nama" required class="form-control"
                                                    value="<?=$row['nama']?>">
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
                                                    required class="form-control" value="<?=$row['username']?>">
                                                <small id="validationMessage" class="form-text text-muted">Hanya
                                                    diperbolehkan huruf dan angka, tanpa spasi dan simbol.</small>
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