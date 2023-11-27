<?php
    session_start();
    if (!isset($_SESSION['role'])) {
        header("Location: ../../index.php");
        exit;
    }
    $title = "Tambah Data Raport - " . $_SESSION['role'];
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
                            <h5 class="card-title">Data Ujian</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card shadow">
                                        <div class="card-header">
                                            <h5>Ujian</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="tahun_ajaran">Tahun Ajaran</label>
                                                        <select name="tahun_ajaran" id="tahun_ajaran" required
                                                            class="form-control">
                                                            <option value="">-- Pilih Tahun Ajaran --</option>
                                                            <?php
                                                            $sql = "SELECT * FROM tahun_semester ORDER BY tahun_semester_id DESC";
                                                            $query = mysqli_query($koneksi, $sql);
                                                            while ($data = mysqli_fetch_assoc($query)) {
                                                                echo '<option value="'.$data['tahun_semester_id'].'">'.$data['nama_tahun'].'</option>';
                                                            }
                                                           ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="semester">Semester</label>
                                                    <select name="semester" id="semester" required class="form-control">
                                                        <option value="">-- Pilih Semester --</option>
                                                        <?php
                                                            $sql = "SELECT * FROM semester 
                                                                    JOIN tahun_semester ON semester.tahun_semester_id = tahun_semester.tahun_semester_id 
                                                                    ORDER BY tahun_semester.tahun_semester_id DESC";
                                                            $query = mysqli_query($koneksi, $sql);
                                                            while ($data = mysqli_fetch_assoc($query)) {
                                                                echo '<option value="'.$data['tahun_semester_id'].'">'.$data['nama_semester'].'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_ujian">Nama Ujian</label>
                                                <select name="nama_ujian" id="nama_ujian" class="form-control">
                                                    <option value="">-- Pilih Nama Ujian --</option>
                                                    <option value="UTS">Ujian Tengah Semester</option>
                                                    <option value="UAS">Ujian Akhir Semester</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Tanggal Ujian</label>
                                                <input type="date" name="tanggal" id="tanggal" required
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="kelas">kelas</label>
                                                <select name="kelas" id="kelas" class="form-control">
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