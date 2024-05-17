<?php

include 'partials/header.php';

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
}

$id = $_GET['id'];
$userId = $_SESSION["userId"];

$getDataPostingan = tampilData("SELECT tbl_postingan.*, tbl_user.nama_lengkap
                        FROM tbl_postingan
                        JOIN tbl_user 
                        ON tbl_postingan.user_id = tbl_user.id 
                        WHERE tbl_postingan.id='$id'")[0];

$idPostingan = $getDataPostingan['id'];

$getDataKomentar = tampilData("SELECT tbl_komentar.*, tbl_user.nama_lengkap
                                FROM tbl_komentar
                                JOIN tbl_user 
                                ON tbl_komentar.user_id = tbl_user.id
                                WHERE tbl_komentar.postingan_id = '$idPostingan'
                                ORDER BY tbl_komentar.id
                                DESC");

if (isset($_POST['komen'])) {
    tambahKomen($_POST);
    echo "<meta http-equiv='refresh' content='0'>";
}
if (isset($_POST['delete'])) {
    deleteKomen($_POST);
    echo "<meta http-equiv='refresh' content='0'>";
}

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><?= $getDataPostingan['nama_lengkap'] ?></div>
                <img src="assets/<?= $getDataPostingan['LokasiFile'] ?>" alt="">
                <div class="card-body">
                    <h5 class="card-title"><?= $getDataPostingan['JudulFoto'] ?></h5>
                    <p class="card-text "><?= $getDataPostingan['DeskripsiFoto'] ?></p>
                </div>
                <div class="card-footer text-muted">
                    <?= $getDataPostingan['TanggalUnggah'] ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Tambah Komentar
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="postingan_id" value="<?= $idPostingan ?>">
                        <input type="hidden" name="user_id" value="<?= $userId ?>">
                        <div class="mb-3">
                            <label for="komentar" class="form-label">Komentar</label>
                            <textarea name="komentar" id="komentar" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="komen" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <?php foreach ($getDataKomentar as $isi) : ?>
                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <div class="card-title float-start text-white"><?= $isi['nama_lengkap'] ?></div>
                        <?php if ($isi['user_id']  == $userId) { ?>
                            <form action="" method="post" onclick="return confirm('Komentar Akan DI Hapus! Yakin?')">
                                <input type="hidden" name="komen_id" value="<?= $isi['id'] ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm float-end">Delete</button>
                            </form>
                        <?php } ?>
                    </div>
                    <div class="card-body">
                        <div class="card-title"><?= $isi['Komentar'] ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<?php include 'partials/info_footer.php' ?>
<?php include 'partials/footer.php' ?>