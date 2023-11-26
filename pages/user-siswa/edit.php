<?php
    session_start();
    if (!isset($_SESSION['role'])) {
        header("Location: ../../index.php");
        exit;
    }
    $title = "Edit Data Siswa - Admin";
    require_once '../../koneksi.php';
    require_once '../template/header.php';
    require_once '../template/sidebar.php';
    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];
        $query = "SELECT *
            FROM users
            INNER JOIN siswa_profiles ON users.user_id = siswa_profiles.user_id
            INNER JOIN kelas ON siswa_profiles.kelas_id = kelas.kelas_id
            WHERE users.user_id = '$user_id'";
        $result = mysqli_query($koneksi, $query);
        $row = mysqli_fetch_array($result);
    }
    if(isset($_POST['simpan'])){
        $nama = $_POST['nama'];
        $nis = $_POST['nis'];
        $telp = $_POST['telp'];
        $kelas = $_POST['kelas'];
        $jk = $_POST['jk'];
        $alamat = $_POST['alamat'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $username = $_POST['username'];
        $path_foto = $row['foto'];
        // Check if there is a file upload
        if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $allowed_extensions = array('jpg', 'jpeg', 'png');
            $foto = $_FILES['foto']['name'];
            $ukuran_foto = $_FILES['foto']['size'];
            $tipe_foto = $_FILES['foto']['type'];
            $tmp_foto = $_FILES['foto']['tmp_name'];
            $path = "../../asset/image/";
            $uniqfilename = "siswa_".$username.".".pathinfo($foto, PATHINFO_EXTENSION);
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
                $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
                $query_user = "UPDATE users SET username = '$username', password = '$hashedpassword' WHERE user_id = '$user_id'";
                $query_profile = "UPDATE siswa_profiles SET nama = '$nama', NIS = '$nis',alamat = '$alamat', jk = '$jk', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', notelp = '$telp', kelas_id = '$kelas', foto = '$path_foto' WHERE user_id = '$user_id'";
                if(mysqli_query($koneksi, $query_user) && mysqli_query($koneksi, $query_profile)) {
                    echo "<script>alert('Berhasil mengubah siswa!');window.location='index.php';</script>";
                } else {
                    echo "<script>alert('Gagal mengubah siswa!');</script>";
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
                    <h3 class="page-title">Edit Data Profile dan Akun</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../../index.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.php">Data Akun Siswa</a></li>
                        <li class="breadcrumb-item active">Edit Data Profile dan Akun</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <!-- Content Starts -->
        <div class="row">
            <div class="col-sm-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Siswa</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card shadow">
                                        <div class="card-header">
                                            <h5>Profile Siswa</h5>
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
                                            <div class="form-group">
                                                <label for="nis">NIS</label>
                                                <input type="text" name="nis" id="nis" maxlength="10" readonly
                                                    class="form-control" value="<?=$row['NIS']?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="telp">No Telepon</label>
                                                <input type="number" name="telp" id="telp" class="form-control"
                                                    value="<?=$row['notelp']?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="kelas">Kelas</label>
                                                <select name="kelas" id="kelas" required class="form-control">
                                                    <option value="">-- Pilih Kelas --</option>
                                                    <?php
                                                        $query = "SELECT * FROM kelas ORDER BY nama_kelas ASC";
                                                        $result = mysqli_query($koneksi, $query);
                                                        while ($kelas = mysqli_fetch_assoc($result)) {
                                                            if ($kelas['kelas_id'] == $row['kelas_id']) {
                                                                echo "<option value='$kelas[kelas_id]' selected>$kelas[nama_kelas]</option>";
                                                            } else {
                                                                echo "<option value='$kelas[kelas_id]'>$kelas[nama_kelas]</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="jk">Jenis Kelamin</label>
                                                <select name="jk" id="jk" required class="form-control">
                                                    <option value="">-- Jenis kelamin</option>
                                                    <option value="L" <?php if($row['jk'] == 'L'){echo "selected";} ?>>
                                                        Laki-laki</option>
                                                    <option value="P" <?php if($row['jk'] == 'P'){echo "selected";} ?>>
                                                        Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <textarea name="alamat" id="alamat" cols="30" rows="4"
                                                    class="form-control"><?=$row['alamat']?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="tempat_lahir">Tempat Lahir</label>
                                                        <input type="text" name="tempat_lahir" id="tempat_lahir"
                                                            required class="form-control"
                                                            value="<?=$row['tempat_lahir']?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="tempat_lahir">Tanggal Lahir</label>
                                                        <input type="date" class="form-control" id="tanggal_lahir"
                                                            name="tanggal_lahir" value="<?=$row['tanggal_lahir']?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="card col-md-12 shadow ">
                                            <div class="card-header">
                                                <h5>Akun Siswa</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input type="text" name="username" id="username"
                                                        pattern="[A-Za-z0-9]+" required class="form-control"
                                                        value="<?=$row['username']?>" <small id="validationMessage"
                                                        class="form-text text-muted">Hanya
                                                    diperbolehkan huruf dan angka, tanpa spasi dan simbol.</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" id="password"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Confirm Password</label>
                                                    <input type="password" name="repeatpassword" id="repeatpassword"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="card col-md-12 shadow">
                                            <div class="card-body">
                                                <div class="form-group text-center">
                                                    <button type="submit" name="simpan" class="btn btn-primary"
                                                        data-toggle="modal" data-target="#pesanModal">Simpan</button>
                                                    <button type="reset" name="simpan"
                                                        class="btn btn-secondary">Reset</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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