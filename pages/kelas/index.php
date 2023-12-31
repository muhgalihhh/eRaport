<?php
    session_start(); 
    if(!isset($_SESSION['role'])){
        header("Location: ../../index.php");
    }               
    $title = "Data Kelas - Admin";
    $msg = "Data Kelas";
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
                        <div class="card-title">Input Kelas</div>
                    </div>
                    <div class="card-body">
                        <form action="proses.php" method="POST">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select name="kelas" id="kelas" class="form-control" required>
                                    <option value="">Pilih Kelas</option>
                                    <option value="VII">VII</option>
                                    <option value="VIII">VIII</option>
                                    <option value="IX">IX</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="huruf">Huruf</label>
                                <select name="huruf" id="huruf" class="form-control" required>
                                    <option value="">Pilih Huruf</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
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
                        <h5 class="card-title">Data Kelas</h5>
                    </div>
                    <div class="card-body">
                        <input type="text" id="searchInput" placeholder="Search..." class="form-control col-6 mb-2">
                        <div class="table-responsive">
                            <table class="datatable table table-stripped mb-0">
                                <div class="table-responsive">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kelas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kelas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM kelas";
                                        $result = mysqli_query($koneksi, $query);
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['nama_kelas'] ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#editModal<?= $row['kelas_id'] ?>"><i
                                                        class="fa fa-pencil"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#deleteModal<?= $row['kelas_id'] ?>"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal<?= $row['kelas_id'] ?>" tabindex="-1"
                                            role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Kelas</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Tambahkan formulir edit di sini -->
                                                        <form action="proses.php" method="POST">
                                                            <input type="hidden" name="kelas_id"
                                                                value="<?= $row['kelas_id'] ?>">
                                                            <div class="form-group">
                                                                <label for="edit_kelas">Kelas</label>
                                                                <select name="edit_kelas" id="edit_kelas"
                                                                    class="form-control" required>
                                                                    <option value="">Pilih Kelas</option>
                                                                    <option value="VII">VII</option>
                                                                    <option value="VII">VIII</option>
                                                                    <option value="VII">IX</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="edit_huruf">Huruf</label>
                                                                <input type="text" name="edit_huruf" id="edit_huruf"
                                                                    class="form-control" required>
                                                            </div>
                                                            <div class="form-group text-center">
                                                                <button type="submit" class="btn btn-primary"
                                                                    name="update">Simpan
                                                                    Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Edit Modal -->
                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal<?= $row['kelas_id'] ?>" tabindex="-1"
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
                                                        <a href="hapus.php?id=<?=$row['kelas_id']?>"
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