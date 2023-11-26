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
?>

<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Tambah Guru Mapel</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="index.php">Data Guru</a></li>
                        <li class="breadcrumb-item active">Tambah Guru Mapel</li>
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
                            <h5 class="card-title">Tambah Guru</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 d-flex">
                                    <div class="card flex-grow-1 shadow">
                                        <div class="card-header">
                                            <h5>Profile Guru Mapel</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" name="nama" id="nama" required
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nip">NIP</label>
                                                    <input type="text" name="nip" id="nip" required class="form-control"
                                                        maxlength="10">
                                                </div>
                                                <div class="form-group">
                                                    <label for="mapel">Mata Pelajaran</label>
                                                    <select name="mapel" id="mapel" class="form-control">
                                                        <option value="">-- Pilih Mata Pelajaran --</option>
                                                        <?php
                                                            $query = mysqli_query($koneksi, "SELECT * FROM mapel");
                                                            while($row = mysqli_fetch_assoc($query)):
                                                                echo "<option value='$row[mapel_id]'>$row[nama_mapel]</option>";
                                                            endwhile;
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_telp">No Telepon</label>
                                                    <input type="text" name="no_telp" id="no_telp" required
                                                        class="form-control" maxlength="15">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <textarea name="alamat" id="alamat" cols="30" rows="3"
                                                        class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" name="submit" class="btn btn-primary"><i
                                                        class="fa fa-plus"></i>
                                                    Simpan</button>
                                                <button type="reset" name="Reset" class="btn btn-secondary"><i
                                                        class="fa fa-times"></i>
                                                    Reset</button>
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