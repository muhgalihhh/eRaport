<?php
    session_start();
    if(!isset($_SESSION["role"])){
        header("location: ../../");
        exit;
    }
    $title = "Input Siswa - Admin";
    require_once '../../koneksi.php';
    require_once '../template/header.php';
    require_once '../template/sidebar.php';
    if(isset($_POST['simpan'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $repeatpassword = $_POST['repeatpassword'];
        $nama = $_POST['nama'];
        $nis = $_POST['nis'];
        $telp = $_POST['telp'];
        $kelas = $_POST['kelas'];
        $jk = $_POST['jk'];
        $alamat = $_POST['alamat'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $path_foto = "../../asset/image/default.jpg";
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
                header("Location: input-siswa.php");
            } else if($ukuran_foto > 1048576) {
                echo "<script>alert('Ukuran gambar terlalu besar!');</script>";
                header("Location: input-siswa.php");
            } else {
                move_uploaded_file($tmp_foto, $path_foto);
            }
        }
        if($password != $repeatpassword) {
            echo "<script>alert('Password tidak sama!');</script>";
            header("Location: input-siswa.php");
        } else {
            // Check if the username already exists
            $cek_username = "SELECT * FROM users WHERE username = '$username'";
            $query_cek = mysqli_query($koneksi, $cek_username);
            if(mysqli_num_rows($query_cek) > 0) {
                echo "<script>alert('Username sudah digunakan!');</script>";
                header("Location: input-siswa.php");
            } else {
                // Process to save to the database
                $hashedpassword = password_hash($password, PASSWORD_DEFAULT); 
                $query_user = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashedpassword', 'siswa')";
                $query_profile = "INSERT INTO siswa_profiles (user_id, nama, NIS, alamat, jk, tempat_lahir, tanggal_lahir, notelp, kelas_id, foto) VALUES (LAST_INSERT_ID(), '$nama', '$nis', '$alamat', '$jk', '$tempat_lahir', '$tanggal_lahir', '$telp', '$kelas', '$path_foto')";
                if(mysqli_query($koneksi, $query_user) && mysqli_query($koneksi, $query_profile)) {
                    echo "<script>alert('Berhasil menambahkan siswa!');window.location='index.php';</script>";
                } else {
                    echo "<script>alert('Gagal menambahkan siswa!');</script>";
                    header("Location: input-siswa.php");
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
                        <li class="breadcrumb-item"><a href="index.php">Data Akun Siswa</a></li>
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
                            <h5 class="card-title">Tambah Siswa</h5>
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
                                            <div class="form-group">
                                                <?php
                                                    $prefix = "SK"; // Anda dapat mengganti awalan ini sesuai kebutuhan
                                                    $query_max_nis = "SELECT MAX(CAST(SUBSTRING(nis, 3) AS UNSIGNED)) AS max_nis FROM siswa_profiles";
                                                    $result_max_nis = mysqli_query($koneksi, $query_max_nis);
                                                    $row_max_nis = mysqli_fetch_assoc($result_max_nis);
                                                    $max_nis = $row_max_nis['max_nis'];
                                                    $nis_number = $max_nis + 1;
                                                    $nis = $prefix . str_pad($nis_number, 7, '0', STR_PAD_LEFT);
                                                ?>
                                                <label for="nis">NIS</label>
                                                <input type="text" name="nis" id="nis" maxlength="10" readonly
                                                    value="<?php echo $nis; ?>" required class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="telp">No Telepon</label>
                                                <input type="number" name="telp" id="telp" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="kelas">Kelas</label>
                                                <select name="kelas" id="kelas" required class="form-control">
                                                    <option value="">-- Pilih Kelas --</option>
                                                    <?php
                                                                $sql = "SELECT * FROM kelas ORDER BY nama_kelas ASC";
                                                                $query = mysqli_query($koneksi, $sql);
                                                                while ($data = mysqli_fetch_assoc($query)) {
                                                                    echo '<option value="'.$data['kelas_id'].'">'.$data['nama_kelas'].'</option>';
                                                                }
                                                                ?>
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
                                                <textarea name="alamat" id="alamat" required class="form-control"
                                                    rows="3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="tempat_lahir">Tempat Lahir</label>
                                                        <input type="text" name="tempat_lahir" id="tempat_lahir"
                                                            required class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="tempat_lahir">Tanggal Lahir</label>
                                                        <input type="date" class="form-control" id="tanggal_lahir"
                                                            name="tanggal_lahir">
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
                                                        pattern="[A-Za-z0-9]+" required class="form-control">
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