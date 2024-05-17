<?php 
    include 'partials/header.php';

    if (isset($_SESSION['userId'])){
        header("Location: dashboard.php");
    }

    if (isset($_POST['login'])) {
       
        $hasilLogin =  _login($_POST);

        if ($hasilLogin) {
            echo "    <script>
            alert('Login Berhasil!');
            window.location.href = 'dashboard.php';
        </script>";
        exit();
        } else {
            echo "    <script>
            alert('Login Gagal!');
            window.location.href = 'login.php';
        </script>";
        exit();
        }
    }
?>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input name="username" type="text" class="form-control" id="username" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include 'partials/footer.php' ?>

