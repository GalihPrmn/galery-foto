<?php
include 'partials/header.php';

if (isset($_POST['register'])) {

    $hasilRegister =  _register($_POST);

    if ($hasilRegister > 0) {
        echo "<script>
            alert('Register Berhasil! Silahkan Login!!');
            window.location.href = 'login.php';
        </script>";
        exit();
    } else {
        echo "    <script>
            alert('Register Gagal!');
            window.location.href = 'register.php';
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
                    <h3>Register</h3>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" name="password2" required>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="namaLengkap" name="nama_lengkap" required>
                                </div>
                                <div class="mb-3">
                                    <label for="alamatFor" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamatFor" name="alamat" required>
                                </div>
                            </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" name="register" class="btn btn-primary">Register</button>
                                </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/footer.php' ?>