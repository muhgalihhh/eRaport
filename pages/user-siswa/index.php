<?php
    session_start();             
    if(!isset($_SESSION['role'])){
        header("Location: ../../index.php");
        exit;
    }

    $title = "Data Siswa - Admin";      
    $msg= "Data User Siswa";
    require_once '../../koneksi.php';
    require_once '../template/header.php';
    require_once '../template/sidebar.php';
    require_once '../template/message.php';
?>
<!-- Page Wrapper -->
<div class="page-wrapper">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Data Akun Siswa</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../../<?=$_SESSION['mainurl']?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Akun Siswa</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page Header -->
        <!-- Content Starts -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card flex-fill">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title">Data Akun Siswa</h5>
                        <a class="btn btn-primary" href="input-siswa.php"><i class="fa fa-plus"></i> Tambah Siswa</a>
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
                                            <th>Username</th>
                                            <th>Nama Siswa</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tempat, Tanggal Lahir</th>
                                            <th>Kelas</th>
                                            <th>Alamat</th>
                                            <th>No Telepon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Username</th>
                                            <th>Nama Siswa</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tempat, Tanggal Lahir</th>
                                            <th>Kelas</th>
                                            <th>Alamat</th>
                                            <th>No Telepon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $query = "SELECT * FROM
                                                    siswa_profiles
                                                    JOIN
                                                        users ON siswa_profiles.user_id = users.user_id
                                                    JOIN
                                                        kelas ON siswa_profiles.kelas_id = kelas.kelas_id;";
                                            $result = mysqli_query($koneksi, $query);
                                            $no = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?=$no?></td>
                                            <td><img src="<?=$row['foto']?>" width="40" height="40" alt=""
                                                    class="rounded-circle shadow-lg"></td>
                                            <td><?=$row['username']?></td>
                                            <td><?=$row['nama']?></td>
                                            <td><?php 
                                                if($row['jk'] == 'L'){
                                                    echo "Laki-laki";
                                                }else{
                                                    echo "Perempuan";
                                                }
                                            ?>
                                            </td>
                                            <td><?=$row['tempat_lahir']?>, <?=$row['tanggal_lahir']?></td>
                                            <td><?=$row['nama_kelas']?></td>
                                            <td><?=$row['alamat']?></td>
                                            <td><?=$row['notelp']?></td>
                                            <td class="text-center">
                                                <a href="view.php?id=<?=$row['user_id']?>"></a>
                                                <a href="edit.php?id=<?=$row['user_id']?>" class="btn btn-warning"><i
                                                        class="fa fa-edit"></i></a> ||
                                                <button class="btn btn-danger" data-toggle="modal"
                                                    data-target="#deleteModal<?= $row['user_id'] ?>"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal<?= $row['user_id'] ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
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