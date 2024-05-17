<?php

include 'partials/header.php';

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
}

$id = $_SESSION["userId"];
// $data = get("tbl_foto", "WHERE UserID='$id'");

if (isset($_POST['upload'])) {
    $uploadData = [
        'JudulFoto' => $_POST['judulFoto'],
        'DeskripsiFoto' => $_POST['deskripsiFoto'],
        'LokasiFile' => $_FILES['fileToUpload'],
        'user_id' => $id
    ];

    $uploadResult = createPhoto($uploadData, $_FILES['fileToUpload']);

    if ($uploadResult) {
        echo "<script>alert('Photo sukses di upload!');</script>";
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "<script>alert('Error uploading!');</script>";
    }
}

if (isset($_POST['delete'])) {
    $photoIDToDelete = $_POST['photo_id'];
    $deleteResult = deletePhoto($photoIDToDelete);
    if ($deleteResult) {
        echo "<script>alert('Photo sukses dihapus!'); </script>";
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "<script>alert('Error deleting!'); </script>";
    }
}

$dataPostingan = tampilData("SELECT * FROM tbl_postingan WHERE user_id='$id' ORDER BY id DESC");
?>

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    Tambah Postingan
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="username" class="form-label">Judul Postingan</label>
                            <input name="judulFoto" type="text" class="form-control" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsiFoto" rows="3" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Foto</label>
                            <input name="fileToUpload" type="file" class="form-control" id="username" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="upload">Upload Postingan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="card">
        <div class="card-header">Postingan Saya</div>
        <div class="card-body">
            <div class="row">

                <?php if (empty($dataPostingan)) { ?>
                    <div class="alert alert-danger text-center" role="alert">Belum Ada Postingan</div>
                <?php } else { ?>
                    <?php foreach ($dataPostingan as $val) : ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-header"><?= $val['JudulFoto'] ?></div>
                                <img src="assets/<?= $val['LokasiFile'] ?>" class="card-img-top" style="height: 200px;object-fit: cover;" alt="Fissure in Sandstone" />
                                <div class="card-body justify-content-end">
                                    <form action="" method="post" onclick="return confirm('Postingan Akan DI Hapus! Yakin?')">
                                        <div class="d-grid gap-2 ">
                                            <input type="hidden" name="photo_id" value="<?= $val['id'] ?>">
                                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                    <div class="d-grid gap-2 mt-2">
                                        <a href="editPost.php?id=<?= $val['id'] ?>" class="btn btn-warning text-white">Edit</a>
                                    </div>
                                </div>
                                <div class="card-footer text-muted"><?= $val['TanggalUnggah'] ?></div>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php } ?>
                <!-- https://genshin.global/wp-content/uploads/2023/11/furina-character-avatar-profile-genshin.webp -->
            </div>
        </div>
    </div>
</div>

<?php include 'partials/info_footer.php' ?>
<?php include 'partials/footer.php' ?>