<?php
    session_start(); 
    if(!isset($_SESSION['role'])){
        header("Location: ../../index.php");
    }               
    $title = "Data Tahun Ajar - Admin";
    $msg = "Data Tahun Ajar";
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
                    <h3 class="page-title">Data Kelas</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../../<?=$_SESSION['mainurl']?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Kelas</li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
                if(isset($alert)){
                    echo $alert;
                }
            ?>
        <!-- Page Header -->
        <!-- Content Starts -->
        <div class="row">

            <div class="col-sm-4 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="card-title">Input Tahun Ajar</div>
                    </div>
                    <div class="card-body">
                        <form action="proses.php" method="POST">
                            <div class="form-group">
                                <label for="tahun">Tahun Ajar</label>
                                <input class="form-control" type="text" name="tahun" id="tahun" maxlength="9" required>
                                <small class="form-text text-muted">Contoh : 2020/2021</small>
                            </div>
                            <div class="form-group">
                                <label for="semester">Semeseter</label>
                                <select name="semester" id="semester" class="form-control" required>
                                    <option value="">Pilih Semester</option>
                                    <option value="ganjil">Ganjil</option>
                                    <option value="genap">Genap</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input id="submit" class="btn btn-primary form-control" type="submit" name="submit"
                                    value="Simpan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card flex-fill">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title">Data Tahun Ajar/Semester</h5>
                    </div>
                    <div class="card-body">
                        <input type="text" id="searchInput" placeholder="Search..." class="form-control col-6 mb-2">
                        <div class="table-responsive">
                            <table class="datatable table table-stripped mb-0">
                                <div class="table-responsive">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun Ajar</th>
                                            <th>Semester</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun Ajar</th>
                                            <th>Semester</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $query = "SELECT * FROM tahun_semester";
                                        $result = mysqli_query($koneksi, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['nama_tahun'] ?></td>
                                            <td><?= $row['nama_semester'] ?></td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#editModal<?= $row['tahun_semester_id'] ?>"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="#" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#deleteModal<?= $row['tahun_semester_id'] ?>"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal<?= $row['tahun_semester_id'] ?>"
                                            tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Tahun/Semester
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Tambahkan formulir edit di sini -->
                                                        <form action="proses.php" method="POST">
                                                            <div class="form-group">
                                                                <input type="text" name="id" hidden
                                                                    value="<?=$row['tahun_semester_id']?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="tahun_edit">Tahun Ajar</label>
                                                                <input class="form-control" type="text"
                                                                    name="tahun_edit" id="tahun_edit" maxlength="9"
                                                                    required value="<?=$row['nama_tahun']?>">
                                                                <small class="form-text text-muted">Contoh :
                                                                    2020/2021</small>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama_semester">Semeseter</label>
                                                                <select name="nama_semester" id="nama_semester"
                                                                    class="form-control" required>
                                                                    <option value="">Pilih Semester</option>
                                                                    <?php
                                                                    if ($row['nama_semester'] == 'ganjil') {
                                                                        echo '<option value="ganjil" selected>Ganjil</option>';
                                                                        echo '<option value="genap">Genap</option>';
                                                                    } else {
                                                                        echo '<option value="ganjil">Ganjil</option>';
                                                                        echo '<option value="genap" selected>Genap</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <input id="submit" class="btn btn-primary form-control"
                                                                    type="submit" name="update"
                                                                    value="Simpan Perubahan">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Edit Modal -->
                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal<?= $row['tahun_semester_id'] ?>"
                                            tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                                            aria-hidden="true">
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
                                                        <a href="hapus.php?id=<?=$row['tahun_semester_id']?>"
                                                            class="btn btn-danger">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Delete Modal -->
                                        <?php
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