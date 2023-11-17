<?php
session_start();
require_once "koneksi.php";
require_once "template/header.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM user WHERE username = ? AND role = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $role);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    // Check if the user exists
    if ($row = mysqli_fetch_array($result)) {
        
        // Verify the entered password with the hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['foto'] = $row['foto'];

            // Redirect based on the user's role
            if ($role == 'Admin') {
                header("Location: home.php");
                exit();
            } elseif ($role == 'Walikelas') {
                header("Location: home1.php");
                exit();
            } elseif ($role == 'Siswa') {
                header("Location: home2.php");
                exit();
            }
        } else {
            echo "<script>alert('Login Gagal');window.location.href='index.php?status=failed'</script>";
        }
    } else {
        echo "<script>alert('Login Gagal');window.location.href='index.php?status=failed'</script>";
    }
}

if(isset($_GET['status'])){
    if($_GET['status'] == 'failed'){
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Gagal!</strong> Terdapat kesalahan saat login, silahkan coba lagi.
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

        <div class="account-content">

            <div class="container">

                <!-- Account Logo -->
                <div class="account-logo">
                    <h2 class="text-center mb-4 mt-4">SMP N XXXX</h2>
                    <a href="index.html"><img src="./asset/image/logo.png" alt="Tut Wuri Handayani"></a>
                </div>
                <!-- /Account Logo -->
                <div class="account-box">
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
                                <label for="role">Role</label>
                                <select class="form-control" name="role" id="role">
                                    <option value="">Pilih Role --</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Walikelas">Walikelas</option>
                                    <option value="Siswa">Siswa</option>
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
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <?php
        require_once "./template/footer.php";
    ?>