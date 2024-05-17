<?php
include 'partials/header.php';
$data = [];

$dataTerbaru = tampilData("SELECT tbl_postingan.*, tbl_user.nama_lengkap
                                FROM tbl_postingan
                                JOIN tbl_user 
                                ON tbl_postingan.user_id = tbl_user.id
                                ORDER BY tbl_postingan.id 
                                DESC LIMIT 1");
if ($dataTerbaru) {
    $dataTerbaru = $dataTerbaru[0];
    $idTerbaru = $dataTerbaru['id'];

    $data = tampilData("SELECT tbl_postingan.*, tbl_user.nama_lengkap
                        FROM tbl_postingan
                        JOIN tbl_user 
                        ON tbl_postingan.user_id = tbl_user.id
                        WHERE tbl_postingan.id != $idTerbaru
                        ORDER BY tbl_postingan.id 
                        DESC");
}

// var_dump($dataTerbaru[0]['nama_user']); die;
?>

<section class="py-5 bg-gradient-primary-to-secondary text-white">
    <div class="container px-5 my-5">
        <div class="text-center">
            <h2 class="display-4 fw-bolder mb-4">Selamat Datang Di AlinaGallery</h2>
            <!-- <a class="btn btn-outline-light btn-lg px-5 py-3 fs-6 fw-bolder" href="contact.html">Contact me</a> -->
        </div>
    </div>
</section>

<!-- Projects Section-->
<section class="py-5">
    <div class="container px-5 mb-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bolder mb-0">
                <?php if ($dataTerbaru) {  ?>
                    <span class="text-gradient d-inline">Alls Postingan</span>
                <?php } else {  ?>
                    <span class="text-gradient d-inline">Belum Ada Postingan</span>
                <?php }   ?>

            </h1>
        </div>

        <div class="row gx-5 justify-content-center">
            <div class="col-md-12 col-xl-12 col-xxl-8">
                <!-- Project Card 1-->
                <?php if ($dataTerbaru) {  ?>
                    <div class="card mb-3">
                        <div class="card-header  bg-primary text-white"><?= $dataTerbaru['nama_lengkap'] ?></div>
                        <img src="assets/<?= $dataTerbaru['LokasiFile'] ?>" class="card-img-top" alt="Wild Landscape" />
                        <div class="card-body">
                            <h5 class="card-title"><?= $dataTerbaru['JudulFoto'] ?></h5>
                            <p class="card-text"><?= $dataTerbaru['DeskripsiFoto'] ?></p>
                            <p class="card-text mt-3">
                                <small class="text-muted float-start"><?= $dataTerbaru['TanggalUnggah'] ?></small>
                            <div class="float-end">
                                <?php if (isset($_SESSION['userId'])) { ?>
                                    <a href="komentar.php?id=<?= $dataTerbaru['id'] ?>" class="btn btn-sm btn-primary">Komentar</a>
                                <?php } ?>
                            </div>
                            </p>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>

        <!-- Project Card 2-->

        <div class="row">
            <?php foreach ($data as $val) : ?>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-header bg-primary text-white"><?= $val['nama_lengkap'] ?></div>
                        <img src="assets/<?= $val['LokasiFile'] ?>" class="card-img-top" style="max-height: 200px;object-fit: cover;" alt="Fissure in Sandstone" />
                        <div class="card-body">
                            <h5 class="card-title"><?= $val['JudulFoto'] ?></h5>
                            <p class="card-text text-truncate"><?= $val['DeskripsiFoto'] ?></p>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="float-start">
                                <?= $val['TanggalUnggah'] ?>
                            </div>
                            <div class="float-end">
                                <?php if (isset($_SESSION['userId'])) { ?>
                                    <a href="komentar.php?id=<?= $val['id'] ?>" class="btn btn-sm btn-primary">Komentar</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <!-- style="height: 400px;object-fit: cover;"  -->

    </div>
</section>
<!-- Call to action section-->
<!-- <section class="py-5 bg-gradient-primary-to-secondary text-white">
            <div class="container px-5 my-5">
                <div class="text-center">
                    <h2 class="display-4 fw-bolder mb-4">Let's build something together</h2>
                    <a class="btn btn-outline-light btn-lg px-5 py-3 fs-6 fw-bolder" href="contact.html">Contact me</a>
                </div>
            </div>
        </section> -->
</main>

<?php include 'partials/info_footer.php' ?>
<?php include 'partials/footer.php' ?>