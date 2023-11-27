<?php
    session_start();    
    if(!isset($_SESSION['role'])){
        header("Location: ../../index.php");
        exit;
    }
    $title = "Data Raport - Raport"; 
    $msg = "Data Raport";              
    require_once '../../koneksi.php';
    require_once '../template/header.php';
    require_once '../template/sidebar.php';
    require_once '../template/message.php';
    $query = "SELECT 
                siswa_profiles.foto,
                siswa_profiles.NIS,
                siswa_profiles.nama AS nama_siswa,
                kelas.nama_kelas,
                ujian.nama_ujian,
                tahun_semester.nama_tahun,
                semester.nama_semester
            FROM 
                siswa_profiles
            JOIN 
                nilai_ujian ON siswa_profiles.user_id = nilai_ujian.user_id
            JOIN 
                ujian ON nilai_ujian.ujian_id = ujian.ujian_id
            JOIN 
                kelas ON ujian.kelas_id = kelas.kelas_id
            JOIN 
                tahun_semester ON ujian.tahun_semester_id = tahun_semester.tahun_semester_id
            JOIN
                semester ON tahun_semester.tahun_semester_id = semester.tahun_semester_id
                 WHERE kelas.nama_kelas LIKE 'VIII__';";
    $result = mysqli_query($koneksi, $query);
?>
<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Data Raport</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../../<?=$_SESSION['mainurl']?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Raport Kelas 7</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page Header -->
        <!-- Content Starts -->
        <div class="row">

            <div class="col-sm-12"> <?php
                if(isset($_GET['status'])) {
                    echo $alert;
                }
            ?>
                <div class="card flex-fill">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title">Data Raport Kelas 7</h5>
                        <a class="btn btn-primary" href="input-nilai.php"><i class="fa fa-plus"></i> Tambah Nilai
                            Raport</a>
                    </div>
                    <div class="card-body">
                        <input type="text" id="searchInput" placeholder="Search..." class="form-control col-6 mb-2">
                        <div class="table-responsive">
                            <table class="datatable table table-stripped mb-0">
                                <div class="table-responsive">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>nama_ujian</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>nama_ujian</th>
                                            <th>Tahun Ajaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><img src="<?= $row['foto'] ?>" alt="Foto" width="40px" height="40px"
                                                    class="rounded-circle shadow-lg"></td>
                                            <td><?= $row['NIS'] ?></td>
                                            <td><?= $row['nama_siswa'] ?></td>
                                            <td><?= $row['nama_kelas'] ?></td>
                                            <td><?= $row['nama_ujian'] ?></td>
                                            <td><?=$row['nama_tahun']?>, <?= $row['nama_semester'] ?></td>
                                            <td>
                                                <a href="print.php" class="btn btn-success btn-sm"><i
                                                        class="fa fa-print"></i></a>
                                                <a href="edit.php?id=<?= $row['user_id'] ?>"
                                                    class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#deleteModal<?= $row['user_id'] ?>"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal<?= $row['user_id'] ?>" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Confirmation
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Anda Yakin Ingin Menghapus Data Ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <a href="hapus.php?id=<?=$row['user_id']?>"
                                                                class="btn btn-danger">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Delete Modal -->
                                            <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </div>
                            </table>
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