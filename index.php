<?php
session_start();
$title = "Halaman Login - SMP N XXXX";
require_once "koneksi.php";
require_once "template/header.php";

$query = "SELECT nama_sekolah FROM sekolah";
$result = mysqli_query($koneksi, $query);
$sekolah = mysqli_fetch_assoc($result);
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    if($role == 'admin'){
    $queryadmin = "SELECT *
              FROM users
              JOIN roles ON users.role = roles.role_name
              JOIN admin_profiles ON users.user_id = admin_profiles.user_id
              WHERE users.username = '$username' AND roles.role_name = '$role'";
            $result = mysqli_query($koneksi, $queryadmin);  
            }else if($role == 'walikelas'){
                $querywalikelas = "SELECT * FROM users 
               JOIN roles on users.role = roles.role_name 
               JOIN walikelas_profiles ON users.user_id = walikelas_profiles.user_id 
              WHERE users.username = '$username' AND roles.role_name = '$role'";
            $result = mysqli_query($koneksi, $querywalikelas);
            }else if($role == 'siswa'){
                $querysiswa = "SELECT * FROM users 
               JOIN roles on users.role = roles.role_name 
               JOIN siswa_profiles ON users.user_id = siswa_profiles.user_id 
              WHERE users.username = '$username' AND roles.role_name = '$role'";
            $result = mysqli_query($koneksi, $querysiswa);
            }else if($role == ""){
                header("Location: index.php?status=failed3");
                exit();
            }

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role_name'];
            // Redirect based on role
            switch ($_SESSION['role']) {
                case 'admin':
                    // tambahan data admin
                    $_SESSION['nama'] = $user['nama'];
                    $_SESSION['foto'] = $user['foto'];
                    $_SESSION['mainurl'] = 'home.php';
                    header("Location: home.php");
                    exit();
                case 'walikelas':
                    //tambahan data walikelas
                    $_SESSION['nama'] = $user['nama'];
                    $_SESSION['foto'] = $user['foto'];
                    $_SESSION['nip'] = $user['nip'];
                    $_SESSION['kelas_id'] = $user['kelas_id'];
                    $querykelas = "SELECT * FROM kelas WHERE kelas_id = '$user[kelas_id]' ";
                    $result = mysqli_query($koneksi, $querykelas);
                    $kelas = mysqli_fetch_assoc($result);
                    $_SESSION['kelas'] = $kelas['nama_kelas'];
                    $_SESSION['notelp'] = $user['notelp'];
                    $_SESSION['jk'] = $user['jk'];
                    $_SESSION['alamat'] = $user['alamat'];
                    $_SESSION['mainurl'] = 'home1.php';
                    header("Location: home1.php");
                    exit();
                case 'siswa':
                    //tambahan data siswa
                    $_SESSION['nama'] = $user['nama'];
                    $_SESSION['foto'] = $user['foto'];
                    $_SESSION['NIS'] = $user['NIS'];
                    $_SESSION['kelas_id'] = $user['kelas_id'];
                    $sql = "SELECT * FROM kelas WHERE kelas_id = '$user[kelas_id]' ";
                    $result = mysqli_query($koneksi, $sql);
                    $kelas = mysqli_fetch_assoc($result);
                    $_SESSION['kelas'] = $kelas['nama_kelas'];
                    $_SESSION['notelp'] = $user['notelp'];
                    $_SESSION['jk'] = $user['jk'];
                    $_SESSION['alamat'] = $user['alamat'];
                    $_SESSION['tempat_lahir'] = $user['tempat_lahir'];
                    $_SESSION['tanggal_lahir'] = $user['tanggal_lahir'];
                    $_SESSION['mainurl'] = 'home2.php';
                    header("Location: home2.php");
                    exit();
                default:
                    // Invalid role
                    header("Location: index.php?status=failed1");
                    exit();
            }
        } else {
            // Password is incorrect
            header("Location: index.php?status=failed2");
            exit();
        }
    } else {
        // User not found or invalid role
        header("Location: index.php?status=failed3");
        exit();
    }
}


if(isset($_GET['status'])){
    if($_GET['status'] == 'failed1'){
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Gagal!</strong> Terdapat kesalahan saat login, Role invalid.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>';
    }elseif($_GET['status']== "failed2"){
        $alert ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Gagal!</strong> Terdapat kesalahan saat login, Password salah.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>';

    }elseif($_GET['status']== "failed3"){
        $alert ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Gagal!</strong> Terdapat kesalahan saat login, User tidak ada/role tidak ada.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>';

    } else {
        $alert = '';
    }
} else {
    $alert = '';
}
?>

<body class="account-page">

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <div class="account-content" style="position:absolute; z-index:1;">
            <div class="container ">
                <!-- Account Logo -->
                <div class="account-logo">
                    <h2 class="text-center mb-4 mt-4"><?=$sekolah['nama_sekolah']?></h2>
                    <a href="index.php"><img src="./asset/image/logo.png" alt="Tut Wuri Handayani"></a>
                </div>
                <!-- /Account Logo -->
                <div class="account-box  shadow-lg">
                    <div class="account-wrapper">
                        <h3 class="account-title">Login</h3>
                        <p class="account-subtitle">Access to our dashboard</p>
                        <!-- show alert -->
                        <?=$alert?>
                        <!-- Account Form -->
                        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" type="text" name="username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password">
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control" name="role">
                                    <option value="" selected>--Pilih Role</option>
                                    <option value="admin">--Admin</option>
                                    <option value="walikelas">--Wali Kelas</option>
                                    <option value="siswa">--Siswa</option>
                                </select>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary account-btn" type="submit" name="login">Login</button>
                            </div>
                        </form>
                        <!-- /Account Form -->
                    </div>
                </div>
            </div>
        </div>
        <div class="background-container" style="position: relative;
            width: 100%;
            height: 1000px;
            overflow: hidden;">
            <div class="background-image" style="
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('asset/image/bg-sekolah.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            filter: grayscale(70%);"> </div>
        </div>
    </div>
    <!-- /Main Wrapper -->
    <!-- jQuery -->
    <?php
        require_once "./template/footer.php";
    ?>