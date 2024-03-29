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
    $id_user = $_GET['id'];
    if(isset($_POST['simpan'])){
        $tahun_ajaran = $_POST['tahun_ajaran'];
        $semester = $_POST['semester'];
        $nama_ujian = $_POST['nama_ujian'];
        $tanggal = $_POST['tanggal'];
        $kelas = $_POST['kelas'];
        $nama = $_POST['nama'];

        // Insert ke ujian
        $query1 = "INSERT INTO ujian (nama_ujian, tanggal, kelas_id, tahun_semester_id) 
        VALUES ('$nama_ujian','$tanggal','$kelas','$tahun_ajaran');";

        if(mysqli_query($koneksi, $query1)){
            $result = mysqli_query($koneksi, "SELECT LAST_INSERT_ID() as ujian_id");
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $ujian_id = $row['ujian_id'];
                $mapel_ids = $_POST['mapel_id'];
                
                foreach ($mapel_ids as $mapel_id){
                    $nilai = $_POST['nilai_' . $mapel_id];
                    $query2 = "INSERT INTO nilai_ujian (user_id, ujian_id, mapel_id, nilai) 
                    VALUES ('$nama', '$ujian_id', '$mapel_id', '$nilai');";
                    if(!mysqli_query($koneksi, $query2)){
                        header("Location: index.php?status=failed");
                        exit;
                    }
                }
                echo "<script>
                    alert('Data berhasil ditambahkan');
                    window.location.href='index.php?id=$id_user&status=added';
                    </script>";
                exit;
            }else{
                header("Location: index.php?status=failed");
                exit;
            }
        }else{
            header("Location: index.php?status=failed");
            exit;
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
                        <li class="breadcrumb-item"><a href="index.php">Data Raport Kelas 7</a></li>
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
                            <input type='hidden' name='user_id' value='<?=$id_user?>'>
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
                                            <div class="form-group">
                                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                                <select name="tahun_ajaran" id="tahun_ajaran" class="form-control">
                                                    <option value="">-- Pilih Tahun Ajaran --</option>
                                                    <?php
                                                        $sql = "SELECT * FROM tahun_semester ORDER BY tahun_semester_id ASC";
                                                        $query = mysqli_query($koneksi, $sql);
                                                        while ($data = mysqli_fetch_assoc($query)) {
                                                            echo '<option value="'.$data['tahun_semester_id'].'">'.$data['nama_tahun'] . ' - Semester ' . $data['nama_semester'].'</option>';
                                                        }
                                                    ?>
                                                </select>
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
                                                                $sql = "SELECT * FROM kelas WHERE nama_kelas LIKE 'VII__' ORDER BY nama_kelas ASC";
                                                                $query = mysqli_query($koneksi, $sql);
                                                                while ($data = mysqli_fetch_assoc($query)) {
                                                                    echo '<option value="'.$data['kelas_id'].'">'.$data['nama_kelas'].'</option>';
                                                                }
                                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="card col-md-12 shadow ">
                                            <div class="card-header">
                                                <h5>Nilai Siswa</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="nama">Nama Siswa</label>
                                                    <select name="nama" id="nama" required class="form-control">
                                                        <option value="">-- Pilih Nama Siswa --</option>
                                                        <?php
                                                                // query join siswa dan kelas
                                                                $sql = "SELECT * FROM siswa_profiles 
                                                                        JOIN users ON siswa_profiles.user_id = users.user_id 
                                                                        JOIN kelas ON siswa_profiles.kelas_id = kelas.kelas_id 
                                                                        WHERE kelas.nama_kelas LIKE 'VII__'
                                                                        ORDER BY nama_kelas ASC";
                                                                $query = mysqli_query($koneksi, $sql);
                                                                while ($data = mysqli_fetch_assoc($query)) {
                                                                    echo '<option value="'.$data['user_id'].'">'.$data['nama'].'     ('.$data['nama_kelas'].')</option>';
                                                                }
                                                                ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mapel text-bold">Nilai Mata Pelajaran</label>
                                                    <hr class="mt-0">

                                                    <?php
                                                                                // Query untuk mengambil data mata pelajaran dari database
                                                            $sqlMapel = "SELECT * FROM mata_pelajaran";
                                                            $queryMapel = mysqli_query($koneksi, $sqlMapel);
                                                            
                                                            while ($dataMapel = mysqli_fetch_assoc($queryMapel)) {
                                                                $mapel_id = $dataMapel['mapel_id'];
                                                                echo '<div class="form-group">';
                                                                echo '<label for="nilai_' . $mapel_id . '">' . $dataMapel['nama_mapel'] . '</label>';
                                                                echo '<input type="range" class="form-control-range" id="slider_' . $mapel_id . '" name="nilai_' . $mapel_id . '" min="0" max="100">';
                                                                echo '<p id="sliderValue_' . $mapel_id . '">Nilai: 0</p>';
                                                                echo '<input type="hidden" name="mapel_id[]" value="' . $mapel_id . '">';
                                                                echo '</div>';
                                                            }
                                                        ?>
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