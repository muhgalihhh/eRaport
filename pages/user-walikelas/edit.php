<?php
    session_start();
    if(!isset($_SESSION["role"])){
        header("location: ../../");
        exit;
    }
    $title = "Input Wali Kelas - Admin";
    require_once '../../koneksi.php';
    require_once '../template/header.php';
    require_once '../template/sidebar.php';
      if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT *
            FROM users
            INNER JOIN walikelas_profiles ON users.user_id = walikelas_profiles.user_id
            INNER JOIN kelas ON walikelas_profiles.kelas_id = kelas.kelas_id
            WHERE users.user_id = '$id'";
        $result = mysqli_query($koneksi, $query);
        $data = mysqli_fetch_assoc($result);
    }
    if(isset($_POST['update'])){
        $nama = $_POST['nama'];
        $nip = $_POST['nip'];
        $telp = $_POST['telp'];
        $kelas = $_POST['kelas'];
        $jk = $_POST['jk'];
        $alamat = $_POST['alamat'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repeatpassword = $_POST['repeatpassword'];
        $foto = "../../asset/image/default.jpg";
         if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $allowed_extensions = array('jpg', 'jpeg', 'png');
            $foto = $_FILES['foto']['name'];
            $ukuran_foto = $_FILES['foto']['size'];
            $tipe_foto = $_FILES['foto']['type'];
            $tmp_foto = $_FILES['foto']['tmp_name'];
            $path = "../../asset/image/";
            $uniqfilename = "walikelas_".$username.".".pathinfo($foto, PATHINFO_EXTENSION);
            $foto = $path . $uniqfilename;
            if(!in_array(strtolower(pathinfo($foto, PATHINFO_EXTENSION)), $allowed_extensions)){
                echo "<script>alert('Format file tidak didukung');</script>";
                header("Location: index.php?status=failed");
                exit;
            }elseif($ukuran_foto > 1044070){
                echo "<script>alert('Ukuran file terlalu besar');</script>";
                header("Location: index.php?status=failed");
                exit;
            }else{
                move_uploaded_file($tmp_foto, $foto);
            }
            if($password != $repeatpassword){
                echo "<script>alert('Password tidak sama');</script>";
                header("Location: index.php?status=failed");
                exit;
            }else{
                // Cek apakah username sudah ada
                // Check if the username already exists
            $cek_username = "SELECT * FROM users WHERE username = '$username'";
            $query_cek = mysqli_query($koneksi, $cek_username);
            if(mysqli_num_rows($query_cek) > 0) {
                echo "<script>alert('Username sudah digunakan!');</script>";
                header("Location: input-walikelas.php?msg=failed");
                exit;
            }else{
                $password = password_hash($password, PASSWORD_DEFAULT);
                $query = "UPDATE users SET username = '$username', password = '$password' WHERE user_id = '$id'";
                $result = mysqli_query($koneksi, $query);
                if($result){
                    $query = "UPDATE walikelas_profiles SET nama = '$nama', nip = '$nip', telp = '$telp', kelas_id = '$kelas', jk = '$jk', alamat = '$alamat', foto = '$foto' WHERE user_id = '$id'";
                    $result = mysqli_query($koneksi, $query);
                    if($result){
                        echo "<script>alert('Data berhasil diubah');</script>";
                        header("Location: index.php?status=updated");
                        exit;
                    }else{
                        echo "<script>alert('Data gagal diubah');</script>";
                        header("Location: index.php?status=failed");
                        exit;
                    }
                }else{
                    echo "<script>alert('Data gagal diubah');</script>";
                    header("Location: index.php?status=failed");
                    exit;
                }
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
                    <h3 class="page-title">Tambah Data Profile dan Akun</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../../index.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.php">Data Akun Wali Kelas</a></li>
                        <li class="breadcrumb-item active">Tambah Data Profile dan Akun</li>
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
                            <h5 class="card-title">Tambah Wali Kelas</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card shadow">
                                        <div class="card-header">
                                            <h5>Profile Wali Kelas</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group text-center">
                                                <img id="imagePreview" src="<?=$data['foto']?>" alt="Preview"
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
                                                    value="<?=$data['nama']?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="nip">NIP</label>
                                                <input type="text" name="nip" id="nip" maxlength="10" required
                                                    class="form-control" value="<?=$data['nip']?>" <div
                                                    class="form-group">
                                                <label for="telp">No Telepon</label>
                                                <input type="number" name="telp" id="telp" class="form-control"
                                                    maxlength="13" required value="<?=$data['notelp']?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="kelas">Kelas</label>
                                                <select name="kelas" id="kelas" required class="form-control">
                                                    <option value="">-- Pilih Kelas --</option>
                                                    <?php
                                                        $query = "SELECT * FROM kelas";
                                                        $result = mysqli_query($koneksi, $query);
                                                        while($kelas = mysqli_fetch_assoc($result)):
                                                    ?>
                                                    <option value="<?=$kelas['kelas_id']?>"
                                                        <?=$kelas['kelas_id'] == $data['kelas_id'] ? 'selected' : ''?>>
                                                        <?=$kelas['nama_kelas']?></option>
                                                    <?php endwhile;?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="jk">Jenis Kelamin</label>
                                                <select name="jk" id="jk" required class="form-control">
                                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <textarea name="alamat" id="alamat" cols="30" rows="5"
                                                    class="form-control" required><?=$data['alamat']?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="card col-md-12 shadow ">
                                            <div class="card-header">
                                                <h5>Akun Wali Kelas</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input type="text" name="username" id="username"
                                                        pattern="[A-Za-z0-9]+" required class="form-control"
                                                        value="<?=$data['username']?>">
                                                    <small id="validationMessage" class="form-text text-muted">Hanya
                                                        diperbolehkan huruf dan angka, tanpa spasi dan
                                                        simbol.</small>
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
                                    <div class="row">
                                        <div class="card col-md-12 shadow">
                                            <div class="card-body">
                                                <div class="form-group text-center">
                                                    <button type="submit" name="update"
                                                        class="btn btn-primary">Simpan</button>
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