<?php
    session_start();
    if(!isset($_SESSION["role"])){
        header("location: ../../");
        exit;
    }
    $title = "Data Siswa - Admin";
    require_once '../../koneksi.php';
    require_once '../template/header.php';
    require_once '../template/sidebar.php';
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
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
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
                                                <label for="nis">NIS</label>
                                                <input type="text" name="nis" id="nis" required class="form-control">
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
                                                    $sql = "SELECT * FROM kelas";
                                                    $query = mysqli_query($koneksi, $sql);
                                                    while ($data = mysqli_fetch_assoc($query)) {
                                                        echo '<option value="'.$data['id_kelas'].'">'.$data['nama_kelas'].'</option>';
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
        <!-- Modal untuk menampilkan pesan -->
        <div class="modal fade" id="pesanModal" tabindex="-1" role="dialog" aria-labelledby="pesanModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pesanModalLabel">Sukses!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Data siswa berhasil disimpan!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
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