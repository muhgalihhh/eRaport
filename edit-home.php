<?php
    session_start();
    if(!isset($_SESSION['role'])){
        header("Location: index.php");
        exit;
    }
    $title = "Update Data Sekolah - Admin";
    require_once "koneksi.php";
    require_once "./template/header.php";
    require_once "./template/sidebar.php";
    $query = "SELECT * FROM sekolah";
    $result = mysqli_query($koneksi, $query); 
    $data = mysqli_fetch_assoc($result);
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $npsn = $_POST['npsn'];
        $jenjang = $_POST['jenjang'];
        $status = $_POST['status'];
        $akreditas = $_POST['akreditas'];
        $kepala_sekolah = $_POST['kepala_sekolah'];
        $telpon = $_POST['telpon'];
        $email = $_POST['email'];
        $website = $_POST['website'];
        $alamat = $_POST['alamat'];
        $foto = $data['gambar'];
        // Check if there is a file upload
        if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $allowed_extensions = array('jpg', 'jpeg', 'png');
            $foto = $_FILES['foto']['name'];
            $ukuran_foto = $_FILES['foto']['size'];
            $tipe_foto = $_FILES['foto']['type'];
            $tmp_foto = $_FILES['foto']['tmp_name'];
            $path = "./asset/image/";
            $uniqfilename = "sekolah_".$npsn.".".pathinfo($foto, PATHINFO_EXTENSION);
            $foto = $path . $uniqfilename;
            // Validation
            if(!in_array(pathinfo($foto, PATHINFO_EXTENSION), $allowed_extensions)) {
                echo "<script>alert('Format gambar tidak sesuai!');</script>";
                header("Location: edit-home.php");
            } else if($ukuran_foto > 1048576) {
                echo "<script>alert('Ukuran gambar terlalu besar!');</script>";
                header("Location: edit-home.php");
            } else {
                unlink($data['gambar']);
                move_uploaded_file($tmp_foto, $foto);
            }
        }
        $query = "UPDATE sekolah SET nama_sekolah = '$nama', npsn = '$npsn', jenjang = '$jenjang', status = '$status', akreditasi = '$akreditas', kepala_sekolah = '$kepala_sekolah', telepon_sekolah = '$telpon', email_sekolah = '$email', website_sekolah = '$website', alamat_sekolah = '$alamat', gambar = '$foto' WHERE sekolah_id = '$id'";
        $result = mysqli_query($koneksi, $query);
        if($result){
            echo "<script>alert('Berhasil mengubah data sekolah!');window.location='home.php?status=updated';</script>";
            exit;
        }else{
            echo "<script>alert('Gagal mengubah data sekolah!');window.location='home.php?status=failed';</script>";
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
                    <h3 class="page-title">Data Sekolah</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Sekolah</li>
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
                            <h5 class="card-title">Edit Profile Sekolah</h5>
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                Simpan</button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 d-flex">
                                    <div class="card flex-grow-1 shadow">
                                        <div class="card-header">
                                            <h5>Profile Sekolah</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group text-center">
                                                <input type="hidden" name="id" value="<?=$data['sekolah_id']?>">
                                                <img id="imagePreview" src="<?=$data['gambar']?>" alt="Preview"
                                                    class="mb-2" width="500">
                                                <small class="form-text text-muted">Hanya menerima file gambar JPG,JPEG,
                                                    PNG. Maks 1MB width :
                                                    height</small>
                                                <input type="file" name="foto" id="fotoInput" class="form-control"
                                                    onchange="previewImage()">
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Nama Sekolah</label>
                                                <input type="text" name="nama" id="nama" required class="form-control"
                                                    value="<?=$data['nama_sekolah']?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="npsn">NPSN</label>
                                                <input type="text" name="npsn" id="npsn" required class="form-control"
                                                    value="<?=$data['npsn']?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="jenjang">Jenjang</label>
                                                <input type="text" name="jenjang" id="jenjang" required
                                                    class="form-control" value="<?=$data['jenjang']?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <input type="text" name="status" id="status" required
                                                    class="form-control" value="<?=$data['status']?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="akreditas">Akreditasi</label>
                                                <input type="text" name="akreditas" id="akreditas" required
                                                    class="form-control" value="<?=$data['akreditasi']?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div class="card flex-grow-1 shadow">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="kepala_sekolah">Kepala Sekolah</label>
                                                <input type="text" name="kepala_sekolah" id="kepala_sekolah" required
                                                    class="form-control" value="<?=$data['kepala_sekolah']?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="telpon">Telepon Sekolah</label>
                                                <input type="text" name="telpon" id="telpon" required
                                                    class="form-control" value="<?=$data['telepon_sekolah']?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email Sekolah</label>
                                                <input type="email" name="email" id="email" required
                                                    class="form-control" value="<?=$data['email_sekolah']?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="website">Website Sekolah</label>
                                                <input type="text" name="website" id="website" required
                                                    class="form-control" value="<?=$data['website_sekolah']?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat Sekolah</label>
                                                <textarea name="alamat" id="alamat" required class="form-control"
                                                    rows="5"><?=$data['alamat_sekolah']?></textarea>
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