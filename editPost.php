<?php

include 'partials/header.php';

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
}

$id = $_GET['id'];
$idUser = $_SESSION["userId"];

if (isset($_POST['upload'])) {
    $uploadData = array(
        'JudulFoto' => $_POST['judulFoto'],
        'DeskripsiFoto' => $_POST['deskripsiFoto'],
        'LokasiFile' => $_FILES['fileToUpload'],
        'user_id' => $idUser,
        'id_post' => $id
    );

    $uploadResult = updateFoto($uploadData, $_FILES['fileToUpload']);

    if ($uploadResult) {
        echo "    <script>
        alert('Data Berhasil di Update!');
        window.location.href = 'dashboard.php';
    </script>";
    } else {
        echo "<script>alert('Error uploading!');</script>";
    }
}

$getData = tampilData("SELECT * FROM tbl_postingan WHERE id='$id'")[0];

// var_dump($getData); die;

?>

<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    Edit Postingan
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_post" value="<?= $id ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Judul Postingan</label>
                            <input name="judulFoto" type="text" class="form-control" id="username" value="<?= $getData['JudulFoto'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsiFoto" rows="3" class="form-control" required><?= $getData['DeskripsiFoto'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Foto</label>
                            <input name="fileToUpload" type="file" class="form-control" id="username">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="upload">Update Postingan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Foto Sebelumnnya
                </div>
                <div class="card-body">
                    <img src="assets/<?= $getData['LokasiFile'] ?>" class="img-fluid rounded-start">
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'partials/info_footer.php' ?>
<?php include 'partials/footer.php' ?>
