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
                        <li class="breadcrumb-item">Data admin</li>
                        <li class="breadcrumb-item active">Tambah admin</li>
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
                            <h5 class="card-title">Tambah Admin</h5>
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                Simpan</button>
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