<?php
    session_start();
    if(!isset($_SESSION['role'])){
        header("Location: ../../index.php");
        exit;
    }
    $title = "Tambah Data Guru Mapel - Admin";
    require_once "../../koneksi.php";
    require_once "../template/header.php";
    require_once "../template/sidebar.php";
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $sql = "SELECT * FROM guru where guru_id = '$id'";
        $result = mysqli_query($koneksi,$sql);
        $row = mysqli_fetch_array($result);
}
    
    if(isset($_POST["simpan"])){
        $nama = $_POST['nama'];
        $nip = $_POST['nip'];
        $jk = $_POST['jk'];
        $notelp = $_POST['notelp'];
        $mapel = $_POST['mapel'];
        $tempat = $_POST['tempat'];
        $tanggal = $_POST['tanggal'];
        $alamat = $_POST['alamat'];
        $path_foto = "$row[foto]";
        // Check if there is a file upload
        if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $allowed_extensions = array('jpg', 'jpeg', 'png');
            $foto = $_FILES['foto']['name'];
            $ukuran_foto = $_FILES['foto']['size'];
            $tipe_foto = $_FILES['foto']['type'];
            $tmp_foto = $_FILES['foto']['tmp_name'];
            $path = "../../asset/image/";
            $uniqfilename = "guru_".$nip.".".pathinfo($foto, PATHINFO_EXTENSION);
            $path_foto = $path . $uniqfilename;
            // Validation
            if(!in_array(pathinfo($foto, PATHINFO_EXTENSION), $allowed_extensions)) {
                echo "<script>alert('Format gambar tidak sesuai!');</script>";
                header("Location: input-guru.php");
            } else if($ukuran_foto > 1048576) {
                echo "<script>alert('Ukuran gambar terlalu besar!');</script>";
                header("Location: input-guru.php");
            } else {
                move_uploaded_file($tmp_foto, $path_foto);
            }
        }


        $query = "UPDATE guru SET nama_guru = '$nama', nip = '$nip', jk = '$jk', notelp = '$notelp', mapel_id = '$mapel', tempat_lahir = '$tempat', tanggal_lahir = '$tanggal', alamat = '$alamat', foto = '$path_foto' WHERE guru_id = '$id'";
        $result = mysqli_query($koneksi, $query);
        if($result){ 
            echo "<script>alert('Berhasil Mengubah data guru mapel!');window.location='index.php?status=updated';</script>";
            exit;
        }else{
            echo "<script>alert('Gagal Mengubah data guru mapel!');window.location='index.php?status=failed';</script>";
        }
    }
?>

<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Edit Guru Mapel</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.php">Data Guru</a></li>
                        <li class="breadcrumb-item active">Edit Guru Mapel</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Content Starts -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Guru Mapel</div>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
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
                                        <input required type="text" class="form-control" id="nama" name="nama"
                                            value="<?=$row['nama_guru']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input id="nip" class="form-control" type="text" name="nip" required
                                            maxlength="10" value="<?=$row['nip']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="jk">Jenis Kelamin</label>
                                        <select name="jk" id="jk" class="form-control">
                                            <option value="">- Pilih </option>
                                            <option value="Laki-laki" <?=$row['jk'] == 'Laki-laki' ? 'selected' : ''?>>
                                                Laki-laki</option>
                                            <option value="Perempuan" <?=$row['jk'] == 'Perempuan' ? 'selected' : ''?>>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="notelp">Telepon</label>
                                        <input id="notelp" class="form-control" type="text" name="notelp" maxlength="13"
                                            value="<?=$row['notelp']?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mapel">Mengampu mapel</label>
                                        <select name="mapel" id="mapel" class="form-control">
                                            <option value="">- Pilih </option>
                                            <?php
                                                $sql = "SELECT * FROM mata_pelajaran";
                                                $result = mysqli_query($koneksi, $sql);
                                                // selected
                                                while($data = mysqli_fetch_array($result)){
                                                    $selected = $data['mapel_id'] == $row['mapel_id'] ? 'selected' : '';
                                                    echo "<option value='".$data['mapel_id']."' ".$selected.">".$data['nama_mapel']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat">Tempat Lahir</label>
                                        <input id="tempat" class="form-control" type="text" name="tempat"
                                            value="<?=$row['tempat_lahir']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Lahir</label>
                                        <input id="tanggal" class="form-control" type="date" name="tanggal"
                                            value="<?=$row['tanggal_lahir']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea id="alamat" class="form-control" name="alamat" cols="30"
                                            rows="5"><?=$row['alamat']?></textarea>
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
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